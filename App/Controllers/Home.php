<?php

namespace App\Controllers;


echo " zr";
class Home
{
    public function index()
    {
       
        require RACINE . '/App/Views/head.php';
        require RACINE . '/App/Views/header.php';
        require RACINE . '/App/Views/home.php';
        require RACINE . '/App/Views/footer.php';
    }

}