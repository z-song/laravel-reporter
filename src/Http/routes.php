<?php

app('router')->group(
    [
        'prefix'    => config('reporter.base_uri'),
        'namespace' => 'Encore\\Reporter\\Http\\Controllers'
    ],
    function (\Illuminate\Routing\Router $router) {

        $router->get('auth/login', 'AuthController@getLogin');
        $router->post('auth/login', 'AuthController@postLogin');
        $router->get('auth/logout', 'AuthController@getLogout');

        $router->resource('issues', IssueController::class);
        $router->resource('issues/{id}/events', EventController::class);

    }
);