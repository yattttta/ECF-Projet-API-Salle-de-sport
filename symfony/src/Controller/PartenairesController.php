<?php

namespace App\Controller;
use Twig\TwigFunction;
use App\Entity\Login;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PartenairesController extends AbstractController
{
    /**
     * @Route("/partenaires")
     */
    public function partenaires(UserPasswordHasherInterface $encoder)
    {
        dd($encoder->hashpassword(new Login(), ''));
        return $this->render('PartenairesPage/partenaires.html.twig');
    }
}