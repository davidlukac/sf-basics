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
            new Article('Richard III', 'some content 1'),
            new Article('Henry VII', 'some content 3'),
            new Article('Elizabeth', 'some content 2'),
        ];
    }

    /**
     * @return Article[]
     */
    public function findAll()
    {
        return $this->articles;
    }

}
