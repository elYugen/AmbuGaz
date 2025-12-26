<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    public function __construct(private RouterInterface $router)
    {
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): RedirectResponse
    {
        $roles = $token->getRoleNames();

        // Redirige selon le rôle le plus élevé
        if (in_array('ROLE_DEV', $roles)) {
            return new RedirectResponse($this->router->generate('admin'));
        }
        
        if (in_array('ROLE_ADMIN', $roles)) {
            return new RedirectResponse($this->router->generate('auth_index'));
        }

        // Par défaut, ROLE_USER
        return new RedirectResponse($this->router->generate('auth_index'));
    }
}
