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

    public function start(): void
    {
        $this->registerLoader(new MainLoader());
        $this->registerLoader(new MysqlLoader());
        $this->registerLoader(new TwigLoader());

        foreach ($this->loaders as $loader) {
            $loader->onLoad();
        }
    }

    public function registerLoader(ILoader $loader): void
    {
        $this->loaders[] = $loader;
    }
}