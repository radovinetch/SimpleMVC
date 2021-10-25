<?php


namespace SimpleMvc\controller;


use SimpleMvc\model\Task;
use SimpleMvc\Pagination;
use SimpleMvc\Utils;
use SimpleMvc\Validator;
use SimpleMvc\view\View;

class TaskController extends Controller
{
    public function index($page = 1): void
    {
        if ($page <= 0) {
            $page = 1;
        }

        $all = $this->request->getAll();

        $pagination = Pagination::get(Task::class, 3, $page, $all);
        $array = ['pagination' => $pagination, 'request' => http_build_query($all)];
        $array = array_merge($array, $all);
        View::view('tasks', $array);
    }

    public function createView(): void
    {
        View::view('create');
    }

    public function create(): void
    {
        $validatorErrors = Validator::validate($this->request, [
            'username' => 'required|min:3|max:48',
            'email' => 'required|email',
            'text' => 'required|max:255'
        ]);

        if (!empty($validatorErrors)) {
            $this->session->set('message', implode(' ', $validatorErrors));
            $this->response->back();
            return;
        }

        $username = $this->request->post('username');
        $email = $this->request->post('email');
        $task = htmlspecialchars($this->request->post('text'));

        Task::insert(
            [
                'username' => $username,
                'email' => $email,
                'text' => $task
            ]
        );
        $this->session->set('message', 'Добавление задачи успешно!');
        $this->response->redirect('/tasks');
    }

    public function delete($id): void
    {
        $model = Task::where(['id' => $id])->get();
        if ($model !== null) {
            $model->delete();
        }

        $this->session->set('message', 'Удаление успешно!');
        $this->response->redirect('/tasks');
    }

    public function edit($id): void
    {
        $model = Task::where(['id' => $id])->get();
        if ($model !== null) {
            View::view('edit', ['model' => $model]);
        } else {
            $this->response->redirect('/tasks');
        }
    }

    public function update($id): void
    {
        $validatorErrors = Validator::validate($this->request, [
            'text' => 'required|max:255|min:3',
            'status' => 'required|int'
        ]);

        if (!empty($validatorErrors)) {
            $this->session->set('message', implode(' ', $validatorErrors));
            $this->response->back();
            return;
        }

        $model = Task::where(['id' => $id])->get();
        if ($model !== null) {
            $postAll = $this->request->postAll();
            if ($model->getVar('text') != $postAll['text']) {
                $postAll['edited'] = 1;
            }
            $model->update($postAll);
        }

        $this->session->set('message', 'Успешно!');
        $this->response->redirect('/tasks');
    }
}