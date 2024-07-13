<?php

namespace App\Controllers;

use App\Models\User;


class UserController
{

    //Fonction d'affichage de la page



    //Fonction d'inscription
    public function index()
    {
        require_once RACINE . "/App/Views/head.php";
        require_once RACINE . "/App/Views/header.php";
        require_once RACINE . "/App/Views/addUser.php";
        require_once RACINE . "/App/Views/footer.php";
    }

    public function useradd()
    {



        // Récupération des données saisies dans le formulaire
        if (isset($_POST["firstname"], $_POST["lastname"], $_POST["address"], $_POST["zip_code"], $_POST["city"], $_POST["mobile"])) {
            $first_name = htmlspecialchars($_POST["firstname"]);
            $last_name = htmlspecialchars($_POST["lastname"]);
            $address = htmlspecialchars($_POST["address"]);
            $zip_code = htmlspecialchars($_POST["zip_code"]);
            $city = htmlspecialchars($_POST["city"]);
            $mobile = htmlspecialchars($_POST["mobile"]);

            // Validation des données
            if (empty($first_name) || empty($last_name) || empty($address) || empty($zip_code) || empty($city) || empty($mobile)) {
                $msg = 'Veuillez saisir tous les champs';
            } elseif (!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿœŒ\s]+$/', $last_name)) {
                $msg = 'Le nom ne doit contenir que des lettres';
            } elseif (!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿœŒ\s]+$/', $first_name)) {
                $msg = 'Le prénom ne doit contenir que des lettres';
            } elseif (!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿœŒ0-9\s,.\'-]+$/', $address)) {
                $msg = "L'adresse saisie n'est pas valide";
            } elseif (!preg_match('/^[0-9]+$/', $zip_code)) { // Validation du code postal
                $msg = 'Code postal non valide';
            } elseif (!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿœŒ\s]+$/', $city)) {
                $msg = 'Nom de ville non valide';
            } elseif (!preg_match('/^[0-9]+$/', $mobile)) { // Validation du numéro de mobile
                $msg = 'Numéro de mobile non valide';
            } else {
                // Création de l'utilisateur
                $newUser = new User($id = null, $last_name, $first_name, $address, $zip_code, $city, $mobile);
                if ($newUser->create($newUser)) {
                    $msg = "Client ajouté !";
                } else {
                    $msg = "Erreur lors de l'ajout du client";
                }
            }

            // Stocker le message dans la session pour affichage après redirection
            $_SESSION['msg'] = $msg;
            header("Location: ../user/register");
        }
    }


    public function search()
    {
        require RACINE . "/App/Views/head.php";
        require RACINE . "/App/Views/header.php";
        require RACINE . "/App/Views/search.php";
        require RACINE . "/App/Views/footer.php";
    }

    public function userFind()
    {
        if (isset($_POST['search'])) {
            $searchTerm = $_POST['search'];
    
            $userFind = new User();
            
            // Vérifier si le terme de recherche est un entier
            if (ctype_digit($searchTerm)) {
                // Recherche par ID
                $results = $userFind->findBy(["id" => (int)$searchTerm]);
            } else {
                // Recherche par nom
                $results = $userFind->findBy(["lastname" => $searchTerm, "firstname" => $searchTerm]);
            }
    
            // Stocker les résultats dans la session pour affichage
            $_SESSION['search_results'] = $results;
    
            header("Location: ../user/search");
            exit();
        }
    }
    
    public function usersFindAll(){

        
        $users = new User();
        $allUsers = $users->findBy(["id"=> '*']);
        
        $_SESSION['users'] = $allUsers;

        var_dump($allUsers);
        require RACINE . "/App/Views/head.php";
        require RACINE . "/App/Views/header.php";
        require RACINE . "/App/Views/allUsers.php";
        require RACINE . "/App/Views/footer.php";
    }
    
}
