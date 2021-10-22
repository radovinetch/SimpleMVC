<?php

namespace src;

use src\loader\ILoader;
use src\loader\MainLoader;

class Framework 
{
    /** @var ILoader[] $loaders */
    private $loaders = [];

    public function start(): void
    {
        $this->registerLoader(new MainLoader());
        foreach ($this->loaders as $loader) {
            $loader->onLoad();
        }
    }

    public function registerLoader(ILoader $loader): void
    {
        $this->loaders[] = $loader;
    }
}