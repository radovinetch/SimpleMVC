<?php

namespace SimpleMvc;

use SimpleMvc\loader\ILoader;
use SimpleMvc\loader\MainLoader;
use SimpleMvc\loader\MysqlLoader;
use SimpleMvc\loader\TwigLoader;

class Framework 
{
    /** @var ILoader[] $loaders */
    private array $loaders = [];

    /** @var string */
    private string $appUri;

    /**
     * @var Framework $instance
     */
    private static $instance;

    /**
     * Framework constructor.
     * @param string $appUri
     */
    public function __construct(string $appUri)
    {
        $this->appUri = $appUri;
        self::$instance = $this;
    }

    /**
     * @return Framework
     */
    public static function getInstance(): Framework
    {
        return self::$instance;
    }

    /**
     * @return string
     */
    public function getAppUri(): string
    {
        return $this->appUri;
    }

    public function start(): void
    {
        $this->registerLoader(new MainLoader());
        $this->registerLoader(new MysqlLoader());
        $this->registerLoader(new TwigLoader($this->appUri));

        foreach ($this->loaders as $loader) {
            $loader->onLoad();
        }
    }

    public function registerLoader(ILoader $loader): void
    {
        $this->loaders[] = $loader;
    }
}