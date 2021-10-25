<?php

namespace SimpleMvc\loader;

use SimpleMvc\routing\Routing;
use SimpleMvc\session\Session;

/**
 * Main loader class of the framework
 */
class MainLoader implements ILoader {
    public function onLoad(): void
    {
        (new Routing());
        (new Session());
    }
}