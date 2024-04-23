<?php

require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';

<<<<<<< HEAD
spl_autoload_register(function ($class_name) {

    require '../app/models/' . $class_name . '.php';
=======
spl_autoload_register(function ($class_name){
  
  require '../app/models/' . $class_name . '.php';
>>>>>>> 04940915305848809957acfa441225bf5a9210cf
});