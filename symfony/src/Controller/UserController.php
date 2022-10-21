<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Login;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function user(ManagerRegistry $doctrine): Response
    {
        

        $user = new Login();
        $user->setEmail('');
        $user->setPassword('');
        $user->setRoles([]);
        $entityManager = $doctrine->getManager();
        

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
