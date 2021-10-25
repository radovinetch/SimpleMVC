<?php


namespace SimpleMvc\session;


final class Session
{
    /**
     * @var Session|null
     */
    private static $instance = null;

    public function __construct()
    {
        self::$instance = $this;
    }

    /**
     * @return Session|null
     */
    public static function getInstance(): ?Session
    {
        return self::$instance;
    }

    /**
     * @param string $key
     * @param $value
     */
    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }
}