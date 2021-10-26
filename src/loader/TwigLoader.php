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
    /**
     * @var string
     */
    private $appUri;

    /**
     * TwigLoader constructor.
     * @param string $appUri
     */
    public function __construct(string $appUri)
    {
        $this->appUri = $appUri;
    }

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
        $environment->addGlobal('appUri', $this->appUri);
        View::setEnvironment($environment);
    }
}