<?php

namespace App\Controllers;

class Home
{
    public function index()
    {
       
        require_once RACINE . '/App/Views/head.php';
        require_once RACINE . '/App/Views/header.php';
        require_once RACINE . '/App/Views/home.php';
        require_once RACINE . '/App/Views/footer.php';
    }

}