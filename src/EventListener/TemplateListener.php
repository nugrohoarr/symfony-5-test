<?php
// src/EventListener/TemplateListener.php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Twig\Environment;

class TemplateListener
{
    private $session;
    private $twig;

    public function __construct(SessionInterface $session, Environment $twig)
    {
        $this->session = $session;
        $this->twig = $twig;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $user = $this->session->get('user', null);
        $this->twig->addGlobal('app_user', $user);
    }
}
