<?php
/**
 * Created by PhpStorm.
 * User: davidlukac
 * Date: 01/06/16
 * Time: 12:15
 */

namespace AppBundle\Controller;

use AppBundle\Repository\ArticleRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param int $id
     *
     * @return array
     *
     * @Template()
     */
    public function viewAction(Request $request, $id) {

//        $articlesRepo = new ArticleRepository();

        /* @var ArticleRepository $articleRepo */
        $articleRepo = $this->get('acme.article_repository');

        return [
            'id' => $id,
            'extra' => $request->attributes->get('_extra'),
            'articles' => $articleRepo->findAll()
        ];
    }

}
