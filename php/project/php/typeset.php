<?php

session_start();
if(isset($_SESSION['unique_id'])){
    include_once "config.php";
    

    $sql = mysqli_query($conn, "SELECT * FROM typeStatus WHERE
                        sender_id = '{$_SESSION['unique_id']}'
                        AND receiver_id = {$_SESSION['user_id']}");
    if(mysqli_num_rows($sql) > 0){
        $sql2 = mysqli_query($conn, "UPDATE typeStatus SET type_status=1 WHERE
                                    sender_id = {$_SESSION['unique_id']} AND
                                    receiver_id = {$_SESSION['user_id']}");
        // if($sql2){
        //     echo "success";
        // }
    } else {
        $sql3 = mysqli_query($conn, "INSERT INTO typeStatus (sender_id, receiver_id, type_status)
                                    VALUES ({$_SESSION['unique_id']},{$_SESSION['user_id']},1)") or die();
        // if($sql3){
        //     echo "success 2";
        // }
    }
}


?>