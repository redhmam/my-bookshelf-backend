<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/*
** Rotas sem autenticação
*/
$router->post('/login', ['uses' => 'UserController@authenticate']);
$router->post('/signup', ['uses' => 'UserController@signup']);
