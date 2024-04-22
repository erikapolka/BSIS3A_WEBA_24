<?php

class User extends Controller{
    public function index(){
        $user = new User();

        if(isset($_POST['btn_submit'])){
            $arr['firstname'] = $_POST['firstname'];
            $arr['lastname'] = $_POST['lastname'];
            $arr['email'] = $_POST['email'];
            $arr['password'] = $_POST['password'];

            $data = $user->insert($arr);
            redirect('/user');
        }


    $this->view('user');
    }
}