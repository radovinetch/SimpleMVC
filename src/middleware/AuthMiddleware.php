<?php


namespace SimpleMvc\middleware;


use SimpleMvc\http\Request;
use SimpleMvc\http\Response;
use SimpleMvc\session\Session;

class AuthMiddleware implements IMiddleware
{
    public function handle(Request $request, Response $response): bool
    {
        $session = Session::getInstance();
        if ($session->get('user') === null) {
            $session->set('message', 'Для просмотра этой странички вам необходимо авторизоваться!');
            $response->redirect('/login');
            return false;
        }
        return $session->get('user') !== null;
    }
}