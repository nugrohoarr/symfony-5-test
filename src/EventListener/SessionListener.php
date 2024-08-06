<?php
// src/EventListener/SessionListener.php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionListener
{
    private $router;
    private $session;

    public function __construct(RouterInterface $router, SessionInterface $session)
    {
        $this->router = $router;
        $this->session = $session;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        $route = $request->attributes->get('_route');

        // List of routes that don't require authentication
        $openRoutes = ['login', 'app_logout'];

        if (!in_array($route, $openRoutes) && !$this->session->has('user')) {
            $event->setResponse(new RedirectResponse($this->router->generate('login')));
        }
    }
}
