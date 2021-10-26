<?php


namespace SimpleMvc\http;


class Request
{
    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null)
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
    public function post(string $key, $default = null)
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