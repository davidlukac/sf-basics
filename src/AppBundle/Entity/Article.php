<?php
/**
 * Created by PhpStorm.
 * User: davidlukac
 * Date: 01/06/16
 * Time: 12:39
 */

namespace AppBundle\Entity;


class Article
{
    private $title;
    private $content;

    /**
     * Article constructor.
     *
     * @param $title
     * @param $content
     */
    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

}
