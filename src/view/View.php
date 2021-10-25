<?php


namespace SimpleMvc\view;


use SimpleMvc\session\Session;
use Twig\Environment;

final class View
{
    /**
     * @var Environment|null
     */
    private static Environment |null $environment = null;

    /**
     * @param Environment|null $environment
     */
    public static function setEnvironment(?Environment $environment): void
    {
        self::$environment = $environment;
    }

    public static function view(string $view, array $arguments = []): void
    {
        $template = self::$environment->load($view . '.twig');
        echo $template->render($arguments);
        $session = Session::getInstance();
        $session->set('message', null);
    }
}