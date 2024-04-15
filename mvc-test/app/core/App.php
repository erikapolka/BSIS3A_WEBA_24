<?php

class App{

    protected $controllers = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct(){

        $url = $this->splitURL();

        if(isset($url[0])){

            if(file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')){
            
                $this->controllers = $url[0];
                unset($url[0]);
            }
            else{
                $this->controllers = '_404';
            }

        }


        require '../app/controllers/' . $this->controllers . '.php';
        $this->controllers = new $this->controllers;

        if(isset($url[1])){
            if(method_exists($this->controllers,$url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controllers , $this->method], $this->params);
    }

    private function splitURL(){
        if(isset($_GET['url'])){
        $url = explode("/" , trim($_GET['url'], "/"));
        return $url;
        }
    }
}