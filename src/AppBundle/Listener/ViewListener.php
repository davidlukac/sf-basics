<?php
/**
 * Created by PhpStorm.
 * User: davidlukac
 * Date: 03/06/16
 * Time: 11:55
 */

namespace AppBundle\Listener;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

class ViewListener
{

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        /** @var Template $template */
        $template = $event->getRequest()->attributes->get('_template');
        $template->setTemplate('AppBundle:Blog:other.html.twig');
    }

}
