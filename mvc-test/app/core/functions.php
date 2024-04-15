<?php

function show($stuff){

    echo '<pre>';
    print_r($stuff);
    echo '</pre>';
    //print_r(explode("/" , trim($_GET['url'], "/")));
}