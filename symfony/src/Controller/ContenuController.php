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
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=fitness', 'root', '');
            $mot = $_POST["mot"];
            $statement = $pdo->prepare('SELECT city FROM franchise WHERE city like ?');
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $statement->execute(array(trim($mot)."%"));
            $searchCity = $statement->fetchAll();
            for ($i = 0; $i < count($searchCity); $i++) {
                echo "<div>" . $searchCity[$i]["city"] . "</div>";
            }
        } catch (PDOException $e) {
            echo 'Impossible de récupérer la liste des villes';
        }


        
    return $this->render('contenu.html.twig');
    }

    
}