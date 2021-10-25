<?php

use SimpleMvc\middleware\AdminMiddleware;
use SimpleMvc\middleware\AuthMiddleware;
use SimpleMvc\routing\Routing;
use SimpleMvc\Framework;

$framework = new Framework();
$framework->start();

Routing::get('/', 'TaskController@index');
Routing::get('/tasks', 'TaskController@index');
Routing::get('/tasks/{page:\d+}', 'TaskController@index');
Routing::get('/login', 'AuthController@index');
Routing::post('/auth/login', 'AuthController@login');
Routing::get('/tasks/insert', 'TaskController@createView');
Routing::post('/tasks/create', 'TaskController@create');

Routing::get('/tasks/edit/{id:\d+}', 'TaskController@edit')->setMiddleware([AuthMiddleware::class, AdminMiddleware::class]);
Routing::get('/tasks/delete/{id:\d+}', 'TaskController@delete')->setMiddleware([AuthMiddleware::class, AdminMiddleware::class]);

Routing::post('/tasks/update/{id:\d+}', 'TaskController@update')->setMiddleware([AuthMiddleware::class, AdminMiddleware::class]);

Routing::get('/logout', 'AuthController@logout')->setMiddleware([AuthMiddleware::class]);
