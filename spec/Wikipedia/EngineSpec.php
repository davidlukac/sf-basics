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

    function it_returns_array_of_results_given_an_article_id(ArticleRepository $articleRepository, Client $client) {
        // Mock results of `findAll` function.
        $articleRepository->findAll()->willReturn([
            new Article('some title one', ''),
            new Article('some title two', ''),
        ]);

        $client->get($this->url . "some title two")->willReturn(
            [
                (object) ['title' => 'some title one', 'snippet' => 'some content one'],
                (object) ['title' => 'some title two', 'snippet' => 'some content two'],
            ]
        );

        // Act.
        $results = $this->search(1);

        // Assert.
        $results[0]->title->shouldBe('some title one');
        $results[1]->title->shouldBe('some title two');
    }
}
