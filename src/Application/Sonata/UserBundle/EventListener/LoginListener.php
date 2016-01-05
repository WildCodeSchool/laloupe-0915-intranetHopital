<?php

namespace Application\Sonata\UserBundle\EventListener;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class LoginListener {

    private $authorization;
    private $router;
    private $dispatcher;

    public function __construct(AuthorizationChecker $authorization, Router $router, EventDispatcherInterface $dispatcher) {
        $this->authorization = $authorization;
        $this->router = $router;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param InteractiveLoginEvent $event
     * if user has never logged before, he's redirected to change password
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event) {
        if ($this->authorization->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $event->getAuthenticationToken()->getUser();

            if ($user->getLastLogin() === null) {
                $this->dispatcher->addListener ( KernelEvents::RESPONSE, array (
                    $this,
                    'onKernelResponse'
                ) );
            }
        }
    }
    public function onKernelResponse(FilterResponseEvent $event) {
        $response = new RedirectResponse($this->router->generate('fos_user_change_password'));
        $event->setResponse($response);
    }
}
