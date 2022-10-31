<?php

namespace App\Controller;

use PDO;
use PDOException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContenuSallesController extends AbstractController
{
    #[Route(path: '/contenuSalles', name: 'app_contenu_salles')]
    public function contenuSalles()
    {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=fitness', 'root', '');
            $ville = $_POST["ville"];
            
            $statement = $pdo->prepare('SELECT * FROM franchise WHERE city like ?');         
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
                echo '<h5 class="card-title">' . $searchCity[$i]["city"] .'Franchise</h5>';

                foreach ($pdo->query('SELECT * FROM structures', PDO::FETCH_ASSOC) as $structures) {
                    foreach ($pdo->query('SELECT id, email FROM login', PDO::FETCH_ASSOC) as $user) {
                        if ($structures['franchise_id'] === $searchCity[$i]['id'] && $structures['login_id'] === $user['id']) {
                            echo '<p class="card-text">Mail du gérant de la structure : ' . $user['email'] . '</p>';
                            echo '<p class="card-text">L\'adresse de la structure est : ' . $structures['address'] . '</p>';
                        }
                    }
                }    
                if ($structures['franchise_id'] !== $searchCity[$i]['id'] )  {
                echo '<p class="card-text">Aucune structure n\'a été créée pour cette Franchise</p>';
                echo '<p class="card-text">Pour en créer une , rendez-vous sur la page du formulaire (Admin seulement) : <button class="btn btn-primary" type="button" onclick="window.location.href=\'/form\'">Formulaire</button></p>';
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