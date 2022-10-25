<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Login;
use App\Entity\Structures;
use App\Form\FinalFormType;
;

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
        $structure = new Structures();
        $user = new Login();
        $user->setRoles(["ROLE_USER"]);

        $form = $this->createForm(FinalFormType::class, ['structure' => $structure, 'user' => $user]);       
        $form->handleRequest($request); 

        if ($form->isSubmitted() && $form->isValid()) {  
            

            $password = $user->getPassword();
            $hash_password = $encoder->hashPassword($user, $password);
            $user->setPassword($hash_password); 

            $address = $structure->getAddress();
            $structure->setAddress($address);

            $structure->setLogin($user);
            $em = $doctrine->getManager(); 
            $em->persist($user);
            $em->flush();        
        }

        return $this->render('FormPage/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

