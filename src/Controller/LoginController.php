<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class LoginController extends AbstractController
{
    #[Route('/connexion', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // Gérer les erreurs
        $error = $authenticationUtils->getLastAuthenticationError();
        // Dernier username
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername,
        ]);
    }

    #[Route('/deconnexion', name: 'app_logout', methods: ['GET'])] // Correction ici
    public function logout(): never
    {
        // Le contrôleur peut être vide, il ne sera jamais appelé !
        throw new \Exception("Don't forget to activate logout in security.yaml"); // Correction ici
    }
}