<?php


namespace SimpleMvc\controller;


use phpDocumentor\Reflection\Types\Void_;
use SimpleMvc\model\User;
use SimpleMvc\Utils;
use SimpleMvc\Validator;
use SimpleMvc\view\View;

class AuthController extends Controller
{
    public function index(): void
    {
        if ($this->session->get('user') !== null) {
            $this->response->redirect('/');
        } else {
            View::view('login');
        }
    }

    public function logout(): void
    {
        $this->session->set('user', null);
        $this->response->redirect('/');
    }

    public function login(): void
    {
        $validatorErrors = Validator::validate($this->request, [
            'username' => 'required|min:3|max:16',
            'password' => 'required|min:3|max:48'
        ]);

        if (!empty($validatorErrors)) {
            $this->session->set('message', implode(PHP_EOL, $validatorErrors));
            $this->response->back();
            return;
        }

        $username = strtolower($this->request->post('username'));
        $user = User::where(['username' => $username])->get();
        //ВАЖНО! Вообще пароли нужно шифровать, для удобства тестирования этого не делаю
        if ($user == null || $user->getVar('password') != $this->request->post('password')) {
            $this->session->set('message', 'Логин или пароль неверный!');
            $this->response->redirect('/login');
            return;
        }

        $this->session->set('user', [
            'user_id' => $user->getVar('id'),
            'username' => $user->getVar('username')
        ]);
        $this->response->redirect('/');
    }
}