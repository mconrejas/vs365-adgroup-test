<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/auth/login', 'AuthController@login');
    $router->post('/auth/refreshtoken', 'AuthController@refresh');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->get('/auth/me', 'AuthController@me');
        $router->post('/auth/logout', 'AuthController@logout');

        $router->group(['prefix' => 'ip'], function () use ($router) {
            $router->get('/', 'IpController@get');
            $router->post('/', 'IpController@store');
            $router->get('/{id}', 'IpController@show');
            $router->put('/{id}', 'IpController@update');
        });

        $router->group(['prefix' => 'comment'], function () use ($router) {
            $router->post('/', 'CommentController@store');
            $router->put('/{id}', 'CommentController@update');
        });
    });
});
