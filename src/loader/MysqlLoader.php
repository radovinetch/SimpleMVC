<?php


namespace SimpleMvc\loader;


use SimpleMvc\Utils;
use SimpleORM\SimpleORM;

class MysqlLoader implements ILoader
{
    public function onLoad(): void
    {
        $config = json_decode(file_get_contents(CONFIG), true);
        (new SimpleORM($config['DATABASE']));
    }
}