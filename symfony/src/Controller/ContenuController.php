<?php

namespace App\Controller;

use PDO;
use PDOException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContenuController extends AbstractController
{
    #[Route(path: '/contenu', name: 'app_contenu')]
    public function contenu()
    {
        if (getenv('JAWSDB_PUCE_URL') !== false) {
            $dbparts = parse_url(getenv('JAWSDB_PUCE_URL'));
        
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
        try {
            $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
            $ville = $_POST["ville"];
            
            $statement = $pdo->prepare('SELECT city, login_id FROM franchise WHERE city like ?');         
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute(array(trim($ville)."%"));
            $searchCity = $statement->fetchAll();
            
            
    
            for ($i = 0; $i < count($searchCity); $i++) {
               
                echo '<div class="col-12 col-md-4">'; 
                echo '<div class="card m-3 six" id="carte1">';
                echo '<div class="row g-0">';
                echo '<div class="col-md-4">';
                echo '<img src="..." class="img-fluid rounded-start" alt="...">';
                echo '</div>';
                echo '<div class="col-md-8">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $searchCity[$i]["city"] .'Franchise' . '</h5>';
                echo '<p class="card-text">Ceci est une description de la franchise de ' . $searchCity[$i]["city"] .'Franchise' .'</p>';
                
                foreach ($pdo->query('SELECT id, email FROM login', PDO::FETCH_ASSOC) as $user) {
                    if ($user['id'] === $searchCity[$i]['login_id']) {
                        echo '<p class="card-text">Mail du directeur de la Franchise : ' . $user['email'] . '</p>';
                    }
                }            
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

            }
            
        } catch (PDOException $e) {
            echo 'Impossible de récupérer la liste des villes';
        }


        
    return $this->render('contenu.html.twig');
    }

    
}