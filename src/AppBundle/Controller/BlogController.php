<?php
/**
 * Created by PhpStorm.
 * User: davidlukac
 * Date: 01/06/16
 * Time: 12:15
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \AppBundle\Entity\Article $article
     *
     * @return array
     *
     * @Template()
     * @ParamConverter("article", class="AppBundle:Article")
     */
    public function viewAction(Request $request, Article $article)
    {

//        $result = $this->get('acme.wikisearch')->search($id);

//        $articleRepository = $this->get('acme.article_repository')->findAll();
//        $article = $articleRepository[0];

        return [
//            'id' => $id,
            'extra' => $request->attributes->get('_extra'),
//            'articles' => $articleRepo->findAll()
//            'articles' => $result,
            'article' => $article,
            'browser' => $request->attributes->get('_browser')
        ];
    }

}
