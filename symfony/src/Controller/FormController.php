<?php

namespace App\Controller;

use App\Entity\Franchise;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Login;
use App\Entity\Structures;
use App\Form\FinalFormType;
use PDO;
use PDOException;

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
        $franchise = new Franchise();

        $user->setRoles(["ROLE_USER"]);

        $form = $this->createForm(FinalFormType::class, ['structure' => $structure, 'user' => $user, 'franchise' => $franchise]);       
        $form->handleRequest($request); 

        if ($form->isSubmitted() && $form->isValid()) {
            $city = $franchise->getCity();
            $address = $structure->getAddress();
            
            //hasher le mdp avant de l'insérer en bdd
            $password = $user->getPassword();
            $hash_password = $encoder->hashPassword($user, $password);
            $user->setPassword($hash_password);
        
            $structure->setLogin($user);
            $em = $doctrine->getManager(); 
            $em->persist($user);
            $em->flush();
        
            try { 
                $pdo = new PDO('mysql:host=localhost;dbname=fitness', 'root', '');
                $statement = $pdo->prepare('SELECT id, city FROM franchise WHERE city = :city ');  
                $statement2 = $pdo->prepare('SELECT MAX(id) FROM login');            
                $statement->bindValue(':city', $city, PDO::PARAM_STR);
                $statement->execute();
                $statement2->execute();
                $franchiseId = $statement->fetch();
                $loginId = $statement2->fetch();
            } catch (PDOException $e) {
                echo 'Impossible de récupérer la liste des utilisateurs';
            }
            
            $data = [
                'id' => 0,
                'franchise_id' => $franchiseId['id'],
                'login_id' => $loginId['MAX(id)'],
                'address' => $address,
            ];
            try {
                $statement3 = $pdo->prepare('INSERT INTO structures VALUES (:id, :franchise_id, :login_id, :address)');
                $statement3->execute($data);

            } catch (PDOException $e) {
                echo 'Impossible de récupérer la liste des utilisateurs';
            }
        }
        return $this->render('FormPage/form.html.twig', [
            'form' => $form->createView(),
        ]);      
    }    
}