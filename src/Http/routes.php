<?php

app('router')->group(
    [
        'prefix'    => config('reporter.base_uri'),
        'namespace' => 'Encore\\Reporter\\Http\\Controllers',
        'middleware' => ['pjax'],
    ],
    function (\Illuminate\Routing\Router $router) {

        $router->get('issues', 'ExceptionController@issues');
        $router->resource('exceptions', ExceptionController::class);
    }
);