<?php

namespace App\Controller;

use App\Entity\Franchise;

use App\Entity\Login;
use App\Entity\PermissionsList;
use App\Entity\Structures;
use App\Form\FinalFormType;
use Doctrine\Persistence\ManagerRegistry;
use PDO;
use PDOException;
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
        $permissions = new PermissionsList;
        

        //Donner rôle USER à toutes les nouvelles structures créées
        $user->setRoles(["ROLE_USER"]);

        $form = $this->createForm(FinalFormType::class, ['structure' => $structure, 'user' => $user, 'franchise' => $franchise, 'permissions' => $permissions]); 
        $form->handleRequest($request); 

        if ($form->isSubmitted() && $form->isValid()) {
            $city = $franchise->getCity();
            $address = $structure->getAddress();
            
            //hasher le mdp avant de l'insérer en bdd
            $password = $user->getPassword();
            $hash_password = $encoder->hashPassword($user, $password);
            $user->setPassword($hash_password);

            //Insérer données dans table Login
            $structure->setLogin($user);
        
            $em = $doctrine->getManager(); 
            $em->persist($user);
            $em->flush();

            if (getenv('DATABASE_URL') !== false) {
                $dbparts = parse_url(getenv('DATABASE_URL'));
            
                $hostname = $dbparts['host'];
                $username = $dbparts['user'];
                $password = $dbparts['pass'];
                $database = ltrim($dbparts['path'], '/');
            
            } else {
                $username = 'root';
                $password = '';
                $database = 'fitness';
                $hostname = 'localhost';
            } 
           
            //Récupération des données dans bdd
            try { 
                $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
                $statement = $pdo->prepare('SELECT id, city FROM franchise WHERE city = :city ');  
                $statement2 = $pdo->prepare('SELECT MAX(id) FROM login');         
                $statement->bindValue(':city', $city, PDO::PARAM_STR);
                $statement->execute();
                $statement2->execute();
                $franchiseId = $statement->fetch();
                $loginId = $statement2->fetch();
            } catch (PDOException $e) {
                echo 'Impossible de récupérer la liste des utilisateurs <br>';
            }

            //Insérer données dans table Structure
            if ($franchiseId !== false) {           
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
                    echo 'Impossible de créer la structure <br>';
                }

                $statement4 = $pdo->prepare('SELECT MAX(id) FROM structures');
                $statement4->execute();
                $structuresId = $statement4->fetch();
                
                //Ajouter valeur dans table permissions_list
                $data2 = [
                    'id' => 0,
                    'structures_id' => $structuresId['MAX(id)'],
                    'drink_sales' => $permissions->isDrinkSales(),
                    'food_sales' => $permissions->isFoodSales(),
                    'members_statistics' => $permissions->isMembersStatistics(),
                    'members_subscriptions' => $permissions->isMembersSubscriptions(),
                    'payment_schedules' => $permissions->isPaymentSchedules(),
                ];
                try {
                   $statement5 = $pdo->prepare('INSERT INTO permissions_list VALUES (:id, :structures_id, :drink_sales, :food_sales, :members_statistics, :members_subscriptions, :payment_schedules)'); 
                   $statement5->execute($data2);
                } catch (PDOException $e) {
                    echo 'Impossible d\'ajouter des permissions';
                }

            //effacer le login si la franchise n'existe pas             
            } else {
                echo 'Cette franchise n\'existe pas';
                
                $delete = $pdo->prepare('DELETE FROM login WHERE id = :login_id');
                $delete->bindValue(':login_id', $loginId['MAX(id)']);
                $delete->execute();
            }
        }
        return $this->render('FormPage/form.html.twig', [
            'form' => $form->createView(),
        ]);      
    }    
}