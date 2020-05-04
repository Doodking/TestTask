<?php

function postData($connect, $data){
    $sum = $data['sum'];
    $porpose = $data['porpose'];
    mysqli_query($connect, "INSERT INTO `test`.`orders` (`id`, `sum`, `porpose`) VALUES (NULL, '$sum', '$porpose')");
    http_response_code(201);
    $res = [
        "status" => true,
        "data_id" => mysqli_insert_id($connect),
    ];
    echo json_encode($res);    
}

function getData($connect){
    $order = mysqli_query($connect, "SELECT * FROM `orders`");
    $orders = [];
    while ($data = mysqli_fetch_assoc($order)){
        $orders[] = $data;
    }
    echo json_encode($orders);
}

function deleteData($connect){
    $order = mysqli_query($connect, "DELETE FROM `orders`");
    $res = [
        "status" => true,
        "message" => 'deleted',
    ];
    echo json_encode($res);
}

function postPayment($data){
    $name = $data['name'];
    $number = $data['number'];
    $expiration = $data['expiration'];
    $cvv = $data['cvv'];
    if(isValidCreditCard($number)){
        $res = [
            "status" => true,
            "message" => 'good',
        ];
    }else{
        $res = [
            "status" => false,
            "message" => 'bad number',
        ];
    }
    echo json_encode($res);
}

function isValidCreditCard($num) {
    $num = preg_replace('/[^\d]/', '', $num);
    $sum = '';

    for ($i = strlen($num) - 1; $i >= 0; -- $i) {
        $sum .= $i & 1 ? $num[$i] : $num[$i] * 2;
    }

    return array_sum(str_split($sum)) % 10 === 0;
}