<?php

namespace App\Controllers;

class User
{
    public function getAllUsers()
    {

        require RACINE . '/App/Views/head.php';
        require RACINE . '/App/Views/header.php';
        require RACINE . '/App/Views/allUsers.php';
        require RACINE . '/App/Views/footer.php';
    }

    public function addUser()
    {

        require RACINE . '/App/Views/head.php';
        require RACINE . '/App/Views/header.php';
        require RACINE . '/App/Views/addUser.php';
        require RACINE . '/App/Views/footer.php';


        $msg = null;

        if (isset($_POST['lastname'], $_POST['firstname'], $_POST['address'], $_POST['zip_code'], $_POST['city'])) {

            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $address = $_POST['address'];
            $zip_code = $_POST['zip_code'];
            $city = $_POST['city'];

            if (empty($lastname) || empty($firstname) || empty($address) || empty($zip_code) || empty($city)) {

                $msg = "Veuillez saisir tous les champs";
            } elseif (!preg_match("/^[a-zA-Z\d]+$/", $lastname)) {
                $msg = 'Votre nom ne doit contenir que des lettres';
            } elseif (!preg_match("/^[a-zA-Z\d]+$/", $firstname)) {
                $msg = 'Votre prénom ne doit contenir que des lettres';
            }
        }
    }
}
