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
        require_once RACINE . "/App/Views/addUser.php";
    }

    public function useradd()
    {
        $msg = null;


        // Récupération des données saisies dans le formulaire
        if (isset($_POST["first_name"], $_POST["last_name"], $_POST["address"], $_POST["zip_code"], $_POST["city"], $_POST["mobile"])) {
            $first_name = htmlspecialchars($_POST["first_name"]);
            $last_name = htmlspecialchars($_POST["last_name"]);
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
            } elseif (!preg_match('/^[0-9]/', $zip_code)) {
                $msg = 'Code postal non valide';
            } elseif (!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿœŒ\s]+$/', $city)) {
                $msg = 'Nom de ville non valide';
            } elseif (!preg_match('/^[0-9]/', $mobile)) {
                $msg = 'Code postal non valide';
            } else {
                // Création de l'utilisateur
                $newUser = new User($first_name, $last_name, $address, $zip_code, $city, $mobile);
                $newUser->create($newUser);
                $msg = "Client ajouté !";
            }
            header("location: ../user/register");
        }

        $_SESSION['msg'] = $msg;
    }


    public function search()
    {
        require RACINE . "/App/Views/search.php";
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
                $results = $userFind->findBy(["lastname" => $searchTerm]);
            }
        $_SESSION['results'] = $results;
        }
        header('Location: ../user/search');
    }
    

    public function userDelete($id)
    {
        $id = $_SESSION['idUser'];
    }
}
