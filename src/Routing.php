<?php

namespace src;

class Routing {

    /**
     * @var Routing
     */
    private static $instance;

    public function __construct()
    {
        self::$instance = $this;
    }

    protected $routes = [];

    /**
     * Регистрирует маршрут
     *
     * @param string $route
     * @param string $exec
     * @return void
     */
    public static function register(string $route, string $exec): void
    {
        self::$instance->routes[$route] = $exec;
    }

    public static function match(string $uri): void
    {
        $routes = self::$instance->routes;
        foreach ($routes as $expression => $route) {
            preg_match_all('/^({[a-z]+})+$/i', $uri);
        }           
    }
}