<?php

use src\Routing;
use src\Framework;

$framework = new Framework();
$framework->start();

Routing::register('/tasks', 'TaskController@index');
Routing::register('/tasks/delete/{id}', 'TaskController@delete');
Routing::register('/tasks/update/{id}', 'TaskController@update');