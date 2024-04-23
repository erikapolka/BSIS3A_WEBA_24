<?php

class Home extends Controller{
    public function index(){
<<<<<<< HEAD
    $this->view('home');
=======
<<<<<<< HEAD
=======

    $this->view('home');
>>>>>>> 07101f8eaa379cca20378a9d2071150aa8fc3654
>>>>>>> 04940915305848809957acfa441225bf5a9210cf
        
        $user = new User();

        $model = new Model();
        $arr['firstname'] = "dio";
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 04940915305848809957acfa441225bf5a9210cf

=======
>>>>>>> 07101f8eaa379cca20378a9d2071150aa8fc3654
        $data = $model->where($arr);
        show($data);
        $arr['firstname'] = 'Nice';
        $rows = $user->insert($arr);
        $this->view('home');
        
        
    }

    

}