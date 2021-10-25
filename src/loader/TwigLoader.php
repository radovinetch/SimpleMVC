<?php


namespace SimpleMvc\loader;

use SimpleMvc\model\User;
use SimpleMvc\session\Session;
use SimpleMvc\Utils;
use SimpleMvc\view\View;
use Twig\Environment;
use Twig\Loader\FilesystemLoader as TwigFilesystemLoader;

class TwigLoader implements ILoader
{
    public function onLoad(): void
    {
        $loader = new TwigFilesystemLoader(VIEWS_DIR);
        $environment = new Environment($loader, [
            //'cache' => TWIG_CACHE_DIR
        ]);
        $environment->addGlobal('session', $_SESSION);
        $user = Session::getInstance()->get('user');
        if ($user !== null) {
            $environment->addGlobal('user', User::where(['id' => $user['user_id']])->get());
        }
        View::setEnvironment($environment);
    }
}