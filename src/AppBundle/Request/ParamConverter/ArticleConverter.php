<?php
/**
 * Created by PhpStorm.
 * User: davidlukac
 * Date: 03/06/16
 * Time: 12:35
 */

namespace AppBundle\Request\ParamConverter;

use AppBundle\Entity\Article;
use AppBundle\Repository\ArticleRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class ArticleConverter implements ParamConverterInterface
{
    /**
     * @var \AppBundle\Repository\ArticleRepository
     */
    private $articleRepository;

    /**
     * ArticleConverter constructor.
     *
     * @param \AppBundle\Repository\ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Stores the object in the request.
     *
     * @param Request $request The request
     * @param ParamConverter $configuration Contains the name, class and options of the object
     *
     * @return bool True if the object has been successfully set, else false
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $return = false;
        $articleId = $request->attributes->get('article');
        $articles = $this->articleRepository->findAll();
        $article = $articles[$articleId];
        if (empty($article) === false) {
            $request->attributes->set('article', $article);
            $return = true;
        }

        return $return;
    }

    /**
     * Checks if the object is supported.
     *
     * @param ParamConverter $configuration Should be an instance of ParamConverter
     *
     * @return bool True if the object is supported, else false
     */
    public function supports(ParamConverter $configuration)
    {
        $return = $configuration->getClass() === Article::class;
        return $return;
    }
}
