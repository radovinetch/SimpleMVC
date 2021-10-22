<?php

namespace src\loader;

/**
 * Те действия, которые нужно выполнить во время загрузки приложения
 */
interface ILoader {
    public function onLoad(): void;
}