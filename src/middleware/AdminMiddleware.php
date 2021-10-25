<?php


namespace SimpleMvc\middleware;


use SimpleMvc\http\Request;
use SimpleMvc\http\Response;
use SimpleMvc\model\User;
use SimpleMvc\session\Session;

class AdminMiddleware implements IMiddleware
{
    public function handle(Request $request, Response $response): bool
    {
        $session = Session::getInstance();
        $user = User::where(['id' => $session->get('user')['user_id']])->get();
        if ($user->getVar('role') != 1) {
            $session->set('danger', 'У вас нет доступа к этой странице!');
            $response->back();
            return false;
        }
        return true;
    }
}