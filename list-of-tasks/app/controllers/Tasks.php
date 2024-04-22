<?php
session_start();
class Tasks extends Controller
{
    public function index()
    {
        $task = new Task();
        $rows = $task->findAll();

        $this->view('tasks/index', ['rows' => $rows]);
    }

    public function create()
    {
        $task = new Task();
        if (count($_POST) > 0) {
            $task->insert($_POST);
            $_SESSION["notif"] = showAlert(' Created task successfully!', 'success');
            redirect('tasks/index');
        }
        $this->view('tasks/create');
    }

    public function edit($id)
    {
        $task = new Task();
        $arr['id'] = $id;
        $rows = $task->first($arr);
        if (count($_POST) > 0) {
            $task->update($id, $_POST);
            $_SESSION["notif"] = showAlert(' Updated task successfully!', 'success');
            redirect('tasks/index');
        }
        $this->view('tasks/edit', ['rows' => $rows]);
    }

    public function delete($id)
    {
        $task = new Task();
        $arr['id'] = $id;
        $rows = $task->first($arr);
        if (count($_POST) > 0) {
            $task->delete($id);
            $_SESSION["notif"] = showAlert(' Deleted task successfully!', 'success');
            redirect('tasks/index');
        }
        $this->view('tasks/delete', ['rows' => $rows]);
    }
}
