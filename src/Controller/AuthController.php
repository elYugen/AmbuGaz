<?php
// src/Controller/AuthController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/auth')]
class AuthController extends AbstractController
{
    #[Route('/', name: 'auth_index')]
    public function index(): Response
    {
        return $this->render('auth/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
}
