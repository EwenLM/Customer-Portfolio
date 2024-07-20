<?php
namespace App\Controllers;

use PDOException ;
use App\Models\User;


class UserController
{

    //Affichage vue ajout de client
    public function index()
    {
        require_once RACINE . "/App/Views/head.php";
        require_once RACINE . "/App/Views/header.php";
        require_once RACINE . "/App/Views/addUser.php";
        require_once RACINE . "/App/Views/footer.php";
    }


    //Ajouter un client
    public function userAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
                } elseif (!preg_match('/^[0-9]+$/', $zip_code)) { // Validation du code postal
                    $msg = 'Code postal non valide';
                } elseif (!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿœŒ\s]+$/', $city)) {
                    $msg = 'Nom de ville non valide';
                } elseif (!preg_match('/^[0-9]+$/', $mobile)) { // Validation du numéro de mobile
                    $msg = 'Numéro de mobile non valide';
                } else {
                    // Création de l'utilisateur
                    $newUser = new User(null,$last_name ,$first_name , $address, $zip_code, $city, $mobile);
                    try {
                        $newUser->create($newUser);
                        $msg = "Ajout du client réussi !";
                    } catch (PDOException $e) {
                        $msg = "Erreur d'ajout du client: " . $e->getMessage();
                    }
                }
                // Stocker le message dans la session
                $_SESSION['msg'] = $msg;

                // Redirection après traitement
            }
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    //Affichage de la vue de recherche
    public function search()
    {
        require RACINE . "/App/Views/head.php";
        require RACINE . "/App/Views/header.php";
        require RACINE . "/App/Views/search.php";
        require RACINE . "/App/Views/footer.php";
    }


    //Rrechercher un client
    public function userFind()
    {
        $results = [];

        if (isset($_POST['search'])) {
            $searchTerm = $_POST['search'] ?? '';
    
            $userFind = new User();
    
            // Vérifier si le terme de recherche est un entier
            if (ctype_digit($searchTerm)) {
                // Recherche par ID
                $results = $userFind->findBy(["id_user" => (int)$searchTerm]);
            } else {
                // Recherche par nom
                $userFind->findBy(["last_name" => $searchTerm]);
            }
            
            var_dump($userFind);
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    

    //Retrouver tous les clients
    public function usersFindAll(){

        
        $users = new User();
        $allUsers = $users->findAll();
        
        $_SESSION['users'] = $allUsers;

        var_dump($allUsers);
        require RACINE . "/App/Views/head.php";
        require RACINE . "/App/Views/header.php";
        require RACINE . "/App/Views/allUsers.php";
        require RACINE . "/App/Views/footer.php";
    }
    
}
