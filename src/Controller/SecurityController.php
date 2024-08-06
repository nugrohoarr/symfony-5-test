<?php
// src/Controller/SecurityController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $error = null;
        if ($request->isMethod('POST')) {
            $username = $request->request->get('username');
            $password = $request->request->get('password');
            $user = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);

            if ($user && $user->getPassword() === md5($password)) {
                // Store user data in session
                $session->set('user', [
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                    'level' => $user->getLevel()
                ]);

                return $this->redirectToRoute('dashboard'); // Redirect to your home page
            } else {
                $error = 'Invalid credentials';
            }
        }

        return $this->render('security/login.html.twig', [
            'error' => $error,
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout(SessionInterface $session): Response
    {
        $session->invalidate();
        return $this->redirectToRoute('login');
    }
}
