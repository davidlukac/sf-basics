<?php
/**
 * Created by PhpStorm.
 * User: davidlukac
 * Date: 03/06/16
 * Time: 12:35
 */

namespace AppBundle\Request\ParamConverter;


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

    public function apply(Request $request, ParamConverter $configuration) {
        $articles = $this->articleRepository->findAll();

        $article = $articles[$request->attributes->get('article')];

        $request->attributes->set('article', $article);
    }

    public function supports(ParamConverter $configuration) {
        return ($configuration->getClass() === 'AppBundle:Article');
    }
}
