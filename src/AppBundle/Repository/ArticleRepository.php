<?php
/**
 * Created by PhpStorm.
 * User: davidlukac
 * Date: 01/06/16
 * Time: 12:41
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Article;

class ArticleRepository
{

    private $articles = [];

    /**
     * ArticleRepository constructor.
     */
    public function __construct()
    {
        $this->articles = [
            new Article('Title1', 'some content 1'),
            new Article('Title2', 'some content 2'),
            new Article('Title3', 'some content 3'),
            new Article('Title4', 'some content 4')
        ];
    }

    public function findAll()
    {
        return $this->articles;
    }

}
