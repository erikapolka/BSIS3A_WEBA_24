<?php
session_start();
class Facultypage extends Controller{

    private function auto_auth()
    {
        if (!Auth::logged_in('faculty')) {
            redirect('404');
        }
    }
    public function index(){
        $this->auto_auth();
        
        $this->view("faculty/faculty");
    }
}