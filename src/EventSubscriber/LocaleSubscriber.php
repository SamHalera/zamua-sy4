<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LocaleSubscriber implements EventSubscriberInterface
{
    // Language by dafault
    private $defaultLocale;

    public function __construct($defaultLocale = 'it')
    {
        $this->defaultLocale = $defaultLocale;
        
        
    }
    public function onKernelRequest(RequestEvent $event)
    {
        
        $request = $event->getRequest();
        if (!$request->hasPreviousSession()) {
            return;
        }

        //We check if the language has been passed as parameter of the URL
        if ($locale = $request->query->get('_locale')) {
            $request->setLocale($locale);
        } else {
            //If not we use the locale stored into the session
            $request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));
        }
    }

    public static function getSubscribedEvents()
    {
        
        return [
            KernelEvents::REQUEST => [['onKernelRequest', 20]],
        ];
    }
}
