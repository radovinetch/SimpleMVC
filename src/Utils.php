<?php


namespace SimpleMvc;


final class Utils
{
    public static function d($value)
    {
        ob_start();
        var_dump($value);
        $value = ob_get_clean();
        echo "<pre>"; echo $value; echo "</pre>";
    }

    public static function dd($value)
    {
        self::d($value);
        die();
    }
}