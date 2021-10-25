<?php

session_start();

const VIEWS_DIR = __DIR__ . '/../view';
const TWIG_CACHE_DIR = __DIR__ . '/../cache';
const CONFIG = __DIR__ . '/../config.json';

require __DIR__ .'/../vendor/autoload.php';
require_once __DIR__.'/../route.php';

use SimpleMvc\routing\Routing;

$uri = $_SERVER['REQUEST_URI'];
$uri = str_ireplace('/public/', '', $uri);

Routing::match($uri);