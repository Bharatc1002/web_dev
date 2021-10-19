<?php

session_start();
if(isset($_SESSION['unique_id'])){
    include_once "config.php";

    $sql = $conn -> query("SELECT * FROM typeStatus WHERE
                        sender_id = '{$_SESSION['unique_id']}'
                        AND receiver_id = {$_SESSION['user_id']}");
    if($sql -> num_rows > 0){
        $sql2 = $conn -> query("UPDATE typeStatus SET type_status=0 WHERE
                                    sender_id = {$_SESSION['unique_id']} AND
                                    receiver_id = {$_SESSION['user_id']}");
    } else {
        $sql3 = $conn -> query("INSERT INTO typeStatus(sender_id, receiver_id, type_status)
                                    VALUES ({$_SESSION['unique_id']},{$_SESSION['user_id']},0)");
    }
}

?>