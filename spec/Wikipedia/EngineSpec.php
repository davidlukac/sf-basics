<?php

namespace spec\Wikipedia;

use AppBundle\Entity\Article;
use AppBundle\Repository\ArticleRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Wikipedia\Client;

class EngineSpec extends ObjectBehavior
{
    private $url = 'foo';

    function let(ArticleRepository $articleRepository, Client $client) {
        $this->beConstructedWith($articleRepository, $client, $this->url);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Wikipedia\Engine');
    }

    function it_returns__array_of_results_given_an_article_id(ArticleRepository $articleRepository, Client $client) {
        // Arrange.
        $articleRepository->findAll()->willReturn([
            new Article('some title', 'whatever'),
            new Article('some title', 'whatever'),
        ]);

        $client->get($this->url . "some title")->willReturn(
            [
                (object) ['title' => 'some title 1', 'snippet' => 'some content'],
                (object) ['title' => 'some title 2', 'snippet' => 'some content'],
            ]
        );

        // Act.
        $results = $this->search(1);

        // Assert.
        $results[0]->title->shouldBe('some title 1');
        $results[1]->title->shouldBe('some title 2');
    }
}
