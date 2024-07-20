<?php

namespace App\Controllers;

use App\Models\Location;
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
                $newUser = new User($first_name, $last_name, $address, $zip_code, $city, $mobile);
                $newUser->create($newUser);
                $msg = "Inscription réussie !";
            }
            header("location: ../user/register");
        }

        $_SESSION['msg'] = $msg;
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
        $results = [];

        if (isset($_POST['search'])) {
            $searchTerm = $_POST['search'] ?? '';
    
            $userFind = new User();
    
            // Vérifier si le terme de recherche est un entier
            if (ctype_digit($searchTerm)) {
                // Recherche par ID
                $results = $userFind->findBy(["id" => (int)$searchTerm]);
            } else {
                // Recherche par nom
                $userFind->findBy(["lastname" => $searchTerm]);
            }
            
            var_dump($userFind);
        }
        header('Location: ../user/search');
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
