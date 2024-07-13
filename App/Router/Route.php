<?php

use App\Controllers\UserController;
use Bramus\Router\Router;

$router = new Router();
$router->setNamespace('\App\Controllers');

// page d'accueil
$router->get('/', 'HomeController@index');

$router->get('/home', 'HomeController@index');


//=======Routes liées à l'utilisateur======

//Ajout de client
$router->get('/user/register', 'UserController@index');
$router->post('/user/add', 'UserController@userAdd');

$router ->get('/user/search', 'UserController@search');
$router->post('/user/find','UserController@userFind');

$router ->get('/users', 'UserController@usersFindAll');

$router->run();