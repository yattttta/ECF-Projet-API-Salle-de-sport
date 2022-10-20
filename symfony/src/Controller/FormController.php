<?php

namespace App\Controller;

use App\Form\FormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    #[Route('/form', name: 'app_form')]
    public function form(Request $request): Response
    {
       $form = $this->createForm(FormType::class);

       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
       }

        return $this->render('FormPage/form.html.twig', [
            'controller_name' => 'FormController',
        ]);
    }
}

