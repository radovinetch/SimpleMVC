<?php

session_start();

const VIEWS_DIR = __DIR__ . '/../view';
const TWIG_CACHE_DIR = __DIR__ . '/../cache';
const CONFIG = __DIR__ . '/../config.json';

require __DIR__ .'/../vendor/autoload.php';

use SimpleMvc\routing\Routing;
use SimpleMvc\Framework;

$script_name = str_ireplace('index.php', '', $_SERVER['SCRIPT_NAME']);
$framework = new Framework($script_name);
$framework->start();

require_once __DIR__.'/../route.php';

$uri = $_SERVER['REQUEST_URI'];
if ($script_name !== '/') {
    $uri = preg_replace('#'.$script_name.'#', '', $uri);
}

$uri = str_ireplace('/public/', '', $uri);

Routing::match($uri);