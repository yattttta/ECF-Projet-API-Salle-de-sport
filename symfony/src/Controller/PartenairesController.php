<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class PartenairesController extends AbstractController
{
    #[Route(path:'/partenaires', name: 'app_partenaires')]
    public function partenaires()
    {    
        return $this->render('PartenairesPage/partenaires.html.twig');
    }
}