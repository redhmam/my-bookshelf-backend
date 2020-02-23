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

$router->post('/login', ['uses' => 'UserController@authenticate']);
$router->post('/signup', ['uses' => 'UserController@signup']);

$router->group(['middleware' => 'auth',], function () use ($router) {
    $router->get('/books', ['uses' => 'BooksController@getAll']);
    $router->post('/books', ['uses' => 'BooksController@create']);
    $router->put('/books/{id}/list', ['uses' => 'BooksController@updateList']);
    $router->put('/books/{id}/favorite', ['uses' => 'BooksController@favorite']);
    $router->delete('/books/{id}', ['uses' => 'BooksController@delete']);
});
