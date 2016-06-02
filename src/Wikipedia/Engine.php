<?php
/**
 * Created by PhpStorm.
 * User: davidlukac
 * Date: 02/06/16
 * Time: 11:41
 */

namespace Wikipedia;

use AppBundle\Entity\Article;
use AppBundle\Repository\ArticleRepository;

class Engine
{

    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * @var string
     */
    private $searchApiUrl;

    /**
     * @var Client
     */
    private $client;


    /**
     * Engine constructor.
     *
     * @param \AppBundle\Repository\ArticleRepository $articleRepository
     * @param \Wikipedia\Client $client
     * @param string $searchApiUrl
     */
    public function __construct(ArticleRepository $articleRepository, Client $client, $searchApiUrl)
    {
        $this->articleRepository = $articleRepository;
        $this->searchApiUrl = $searchApiUrl;
        $this->client = $client;
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function search($id)
    {
        // $articlesRepo = new ArticleRepository();
        // /* @var $articleRepo ArticleRepository */
        // $articleRepo = $this->get('acme.article_repository');

        // Get data from Wikipedia API.
        /* @var Article[] $articles */
        $articles = $this->articleRepository->findAll();
        $title = $articles[$id]->getTitle();

        // $json = file_get_contents($this->searchApiUrl . $title);
        $result = $this->client->get($this->searchApiUrl . $title);

        return $result;
    }

}
