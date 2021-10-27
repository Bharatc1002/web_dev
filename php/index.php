<?php

header("Content-Type:application/json");

function get_price($find){
    if($find==1){
        return "java";
    } else if($find==2){
        return "c";
    } else {
        return "php";
    }
}

if(!empty($_GET['name'])){
    $name = $_GET['name'];
    $price = get_price($name);

    if(empty($price)){
        deliver_response(NULL);
    } else {
        deliver_response($price);
    }
}
else {
        deliver_response(NULL);
}

function deliver_response($val){
    header("HTTP/1.1 $status $status_message");
    $books=array(
        "java"=>["hello", "one"],
        "c"=>348,
        "php"=>267
    );

    $json_response = json_encode($books[$val]);
    echo $json_response;
}



?>