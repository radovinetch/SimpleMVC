<?php


namespace SimpleMvc\routing;

use SimpleMvc\middleware\IMiddleware;

class Route
{
    private string $method;

    private string $regexPattern;

    private string $execute;

    /**
     * @var string[]
     */
    private array $middleware;

    public function __construct(string $method, string $regexPattern, string $execute, array $middleware = [])
    {
        $this->method = $method;
        $this->regexPattern = $regexPattern;
        $this->execute = $execute;
        $this->middleware = $middleware;
    }

    /**
     * @return string
     */
    public function getExecute(): string
    {
        return $this->execute;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getRegexPattern(): string
    {
        return $this->regexPattern;
    }

    /**
     * @return array
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
    }

    /**
     * @param string[] $middleware
     */
    public function setMiddleware(array $middleware): void
    {
        $this->middleware = $middleware;
    }
}