<?php
/**
 * Created by PhpStorm.
 * User: davidlukac
 * Date: 31/05/16
 * Time: 11:52
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TrainingController extends Controller
{
    /**
     * @Route("/training/{job}/{name}", name="training", defaults={ "name" = "WhoAreYou?" })
     * @Template()
     */
    public function trainingAction($job, $name)
    {
        $parameters = [
            'name' => $name,
            'job' => $job
        ];

        return $parameters;
    }

}
