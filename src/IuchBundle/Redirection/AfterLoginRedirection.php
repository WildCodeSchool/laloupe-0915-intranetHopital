<?php

namespace IuchBundle\Redirection;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\SecurityContext;

class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{
    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;
    /**
     * @param RouterInterface $router
     */

    protected $security;

    public function __construct(RouterInterface $router, SecurityContext $security)
    {
        $this->router = $router;
        $this->security = $security;
    }
    /**
     * @param Request $request
     * @param TokenInterface $token
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        if ($this->security->isGranted('ROLE_DASHBOARD')){
            $redirection = new RedirectResponse($this->router->generate('sonata_admin_dashboard'));
        }
        else {
            $redirection = new RedirectResponse($this->router->generate('iuch_homepage'));
        }

        return $redirection;
    }
}
