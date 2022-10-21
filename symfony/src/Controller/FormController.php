<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Login;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class FormController extends AbstractController
{
    #[Route('/form', name: 'app_form')]
    public function form(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $encoder): Response
    {
        $user = new Login();
        $form = $this->createForm(UserType::class, $user);
        $user->setRoles(["ROLE_USER"]);       
        $form->handleRequest($request);        

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager(); 
            $password = $user->getPassword();
            $hash_password = $encoder->hashPassword($user, $password);
            $user->setPassword($hash_password);          
            $em->persist($user);
            $em->flush();
            
        }
        

        return $this->render('FormPage/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

