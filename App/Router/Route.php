<?php

use Bramus\Router\Router;

$router = new Router();

$router->setNamespace('\App\Controllers');

//Page d'accueil
$router->get('/', 'Home@index');
$router->get('/home', 'Home@index');

//Utilisateurs
$router->get('/user/id', 'User@getUser');
$router->get('/users', 'User@getAllUsers');
$router->get('user/search', 'User@search');
$router->get('/user/add', 'User@addUser');
$router->get('/user/id/update', 'User@updateUser');
$router->get('/user/id/delete', 'User@deleteUser');

