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
use Symfony\Component\Validator\Constraints\Length;

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

        //Configuration requêtes PDO
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
        $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

        //Récupération des données dans bdd
        try {            
            $statement = $pdo->prepare('SELECT id, city FROM franchise');            
            $statement->execute();
            $franchiseId = $statement->fetchAll();           
        } catch (PDOException $e) {
            echo 'Impossible de récupérer les données de la franchise <br>';
        }
        

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

            try {
                $statement2 = $pdo->prepare('SELECT MAX(id) FROM login');   
                $statement2->execute();
                $loginId = $statement2->fetch();
            } catch (PDOException $e) {
                echo "Impossible de récupérer les données de l'utilisateur";
            }


            //Boucler sur la table franchise
            $franchiseLength = count($franchiseId);
            
            for ($i = 0; $i < $franchiseLength; $i++) {
                if ($city === $franchiseId[$i]['city']) {
                    $data = [
                        'id' => 0,
                        'franchise_id' => $franchiseId[$i]['id'],
                        'login_id' => $loginId['MAX(id)'],
                        'address' => $address,
                    ]; 
                    
                    //Insérer données dans table Structure
                    try {
                        $statement3 = $pdo->prepare('INSERT INTO structures VALUES (:id, :franchise_id, :login_id, :address)');
                        $statement3->execute($data);

                    } catch (PDOException $e) {
                        echo 'Impossible de créer la structure <br>';
                    }
                    
                    //récupération du plus grand id de la table structure
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
                    break;
                } elseif ($i === ($franchiseLength - 1)) {
                    $test = true;
                    return $this->render('FormPage/form.html.twig', [
                        'form' => $form->createView(),
                        'franchiseId' => $franchiseId,  
                        'franchiseLength' => $franchiseLength, 
                        'city' => $city,
                        'test' => $test,
                    ]);
                }
                
            }
            
        }       

        return $this->render('FormPage/form.html.twig', [
            'form' => $form->createView(),
            'franchiseId' => $franchiseId,
        ]);  
        
        
    }    
}