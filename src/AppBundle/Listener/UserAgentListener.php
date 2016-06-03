<?php
/**
 * Created by PhpStorm.
 * User: davidlukac
 * Date: 03/06/16
 * Time: 11:14
 */

namespace AppBundle\Listener;

use Jenssegers\Agent\Agent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class UserAgentListener implements EventSubscriberInterface
{
    /**
     * @var \Jenssegers\Agent\Agent
     */
    private $agent;

    /**
     * UserAgentListener constructor.
     *
     * @param \Jenssegers\Agent\Agent $agent
     */
    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        $this->agent->setUserAgent($request->headers->get('user-agent'));

        $request->attributes->set('_browser', $this->agent->browser());

        // Handle Safari and stop the whole application by setting new Response.
        if ($this->agent->browser() === 'Safari') {
            $event->setResponse(
                new Response("Sorry, we don't support Safari!")
            );
        }
    }

    public function processUserAgent(GetResponseEvent $event)
    {
        return $this->onKernelRequest($event);
    }

    public function processUserLanguage(GetResponseEvent $event)
    {
        $lang = $event->getRequest()->headers->get('accept-language');

//        if ($lang != 'en-US') {
//            $event->setResponse(
//                new Response("Sorry, we know only English atm.")
//            );
//        };
    }


    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            'kernel.request' => [
                [ 'processUserLanguage', 1 ],
                [ 'processUserAgent', 2 ]
            ]
        ];
    }
}
