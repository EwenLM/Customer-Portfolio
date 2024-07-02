<?php

use Bramus\Router\Router;

$router = new Router();
$router->setNamespace('\App\Controllers');
use App\Controllers\Home;
//Page d'accueil
$router->get('/', function() {
    $controller = new Home();
    $controller->index();
});
$router->get('/home', 'Home@index');

//Utilisateurs
$router->get('/user/(\d+)', 'User@getUser');


$router->get('/users', 'User@getAllUsers');
$router->get('/user/search', 'User@search');
$router->get('/user/add', 'User@addUser');
$router->get('/user/(\d+)/update', 'User@updateUser');
$router->get('/user/(\d+)id/delete', 'User@deleteUser');



$router->run();