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
    $router->post('/login', 'AuthController@login');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->get('/me', 'AuthController@me');
        $router->post('/logout', 'AuthController@logout');

        $router->get('/ip', 'IPController@get');
        $router->post('/ip', 'IPController@store');
        $router->get('/ip/{id}', 'IPController@show');
        $router->put('/ip/{id}', 'IPController@update');

        $router->group(['prefix' => 'ip'], function () use ($router) {
            $router->post('/{ip_id}/comment', 'CommentController@save');
        });
    });
});
