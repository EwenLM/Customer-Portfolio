<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
       
        require_once RACINE . '/App/Views/head.php';
        require_once RACINE . '/App/Views/header.php';
        require_once RACINE . '/App/Views/homeView.php';
        require_once RACINE . '/App/Views/footer.php';
    }

 
}
