<?php

namespace src\loader;

use src\Routing;

/**
 * Main loader class of the framework
 */
class MainLoader implements ILoader {
    public function onLoad(): void
    {
        (new Routing());
    }
}