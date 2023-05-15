<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class SallesDesPartenairesController extends AbstractController
{
    #[Route('/sallesDesPartenaires', name: 'app_salles_des_partenaires')]
    public function index(): Response
    {


        return $this->render('SallesDesPartenairesPage/sallesDesPartenaires.html.twig', [
            'controller_name' => 'SallesDesPartenairesController',
        ]);
    }
}
