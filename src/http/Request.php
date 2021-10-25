<?php


namespace SimpleMvc\http;


class Request
{
    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $_GET[$key] ?? $default;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $_GET;
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function post(string $key, mixed $default = null): mixed
    {
        return $_POST[$key] ?? $default;
    }

    /**
     * @return array
     */
    public function postAll(): array
    {
        return $_POST;
    }
}