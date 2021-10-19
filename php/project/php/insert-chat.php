<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = $conn -> real_escape_string($_POST['incoming_id']);
        $message = $conn -> real_escape_string($_POST['message']);
        $read_count = 1;
        if(!empty($message)){
            $sql = $conn -> query("INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, read_state)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', {$read_count})") or die();
        }
    }else{
        header("location: ../login.php");
    }


    
?>