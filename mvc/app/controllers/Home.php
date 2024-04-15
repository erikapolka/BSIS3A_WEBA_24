<?php

class Home extends Controller{
    public function index(){

    $this->view('home');
        
        $user = new User();

        $model = new Model();
        $arr['firstname'] = "dio";
        $data = $model->where($arr);
        show($data);
        $arr['firstname'] = 'Nice';
        $rows = $user->insert($arr);
        $this->view('home');
        
        
    }

    

}