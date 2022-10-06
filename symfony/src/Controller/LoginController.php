<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/lol")
     */
    public function login()
    {
        return $this->render('LoginPage/login.html.twig');
    }
}