<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Request-Methods: *');
    header('Access-Control-Request-Headers: *');
    header('Access-Control-Allow-Credentials: true');
    require 'connect.php';
    require 'functions.php';
    $q = $_GET['q'];
    $params = explode('/', $q);
    $type = $params[0];
    $id = $params[1];
    $method = $_SERVER['REQUEST_METHOD'];
    header('Content-type: json/application');
    if($method == 'GET'){
        if($type == 'data'){
            getData($connect);
        }
    }elseif ($method == 'POST'){
        if($type == 'register'){
            postData($connect, $_POST);
        }elseif($type == 'pay'){
            postPayment($_POST);
        }
    }elseif($method == 'DELETE'){
        if($type == 'delete'){
            deleteData($connect);
        }   
    }