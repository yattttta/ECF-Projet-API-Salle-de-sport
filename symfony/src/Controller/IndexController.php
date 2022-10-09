<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route(path: '/index', name: 'app_index')]
    public function index()
    {
        return $this->render('IndexPage/index.html.twig');
    }
}