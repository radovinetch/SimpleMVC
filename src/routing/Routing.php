<?php

namespace SimpleMvc\routing;

use SimpleMvc\exception\InvalidRouteArguments;
use SimpleMvc\exception\ControllerMethodNotFound;
use SimpleMvc\exception\RouteMethodNotAllowed;
use SimpleMvc\http\Request;
use SimpleMvc\http\Response;
use SimpleMvc\middleware\IMiddleware;
use SimpleMvc\session\Session;
use SimpleMvc\Utils;
use SimpleMvc\view\View;

final class Routing {

    /**
     * @var Routing
     */
    private static Routing $instance;

    /**
     * Routing constructor.
     */
    public function __construct()
    {
        self::$instance = $this;
    }

    /**
     * @var Route[]
     */
    private array $routes = [];

    /**
     * @param string $route
     * @param string $exec
     *
     * @return Route
     */
    public static function get(string $route, string $exec): Route
    {
        return self::register('GET', $route, $exec);
    }

    /**
     * @param string $route
     * @param string $exec
     *
     * @return Route
     */
    public static function post(string $route, string $exec): Route
    {
        return self::register('POST', $route, $exec);
    }

    /**
     * Регистрирует маршрут
     *
     * @param string $method
     * @param string $route
     * @param string $exec
     * @param array $middleware
     * @return Route
     */
    private static function register(string $method, string $route, string $exec, array $middleware = []): Route
    {
        $route = rtrim($route, '/');
        $route = "#^" . preg_replace('/{([a-zA-Z0-9]+):([a-zA-Z0-9\\\+]+)}/', "(?P<$1>$2)", $route) . "$#i";
        return self::$instance->routes[] = new Route($method, $route, $exec, $middleware);
    }

    /**
     * @param string $uri
     * @throws InvalidRouteArguments
     * @throws ControllerMethodNotFound
     * @throws RouteMethodNotAllowed
     * @throws \ReflectionException
     */
    public static function match(string $uri): void
    {
        $uri = preg_replace('/\\?.*/i', '', $uri);
        $uri = rtrim($uri, '/');

        $routes = self::$instance->routes;
        foreach ($routes as $route) {
            if (preg_match_all($route->getRegexPattern(), $uri, $matches) === 0) {
                continue;
            }

            if (($needMethod = $route->getMethod()) !== ($method = $_SERVER['REQUEST_METHOD'])) {
                throw new RouteMethodNotAllowed('Method ' . $method . ' not allowed for this route! Supported method: ' . $needMethod);
            }

            $arguments = explode('@', $route->getExecute());
            if (count($arguments) > 2) {
                throw new InvalidRouteArguments('Invalid route arguments!');
            }

            $request = new Request();
            $response = new Response();

            foreach ($route->getMiddleware() as $middleware) {
                /** @var IMiddleware $middleware */
                $middleware = new $middleware();
                if (!$middleware->handle($request, $response)) {
                    return;
                }
            }

            $reflect = new \ReflectionClass('SimpleMvc\controller\\' . $arguments[0]);
            if (!$reflect->hasMethod($arguments[1])) {
                throw new ControllerMethodNotFound('Method ' . $arguments[1] . 'not found!');
            }

            array_shift($matches);
            if (!empty($matches)) {
                $_matches = [];
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $_matches[$key] = array_values($match)[0];
                    }
                }
                $matches = $_matches;
            }

            $method = $reflect->getMethod($arguments[1]);
            $method->invokeArgs($reflect->newInstance($request, $response, Session::getInstance()), $matches);
            return;
        }

        View::view('404');
    }
}