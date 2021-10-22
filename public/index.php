<?php

require 'vendor/autoload.php';
require_once 'route.php';

//$page = $_GET['page']; //page = 1
//https://website.com/page/1 - page/1 - REQUEST_URI /admin /news

$uri = $_SERVER['REQUEST_URI'];
Routing::match($uri);