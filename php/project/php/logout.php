<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        include_once "time.php";
        $logout_id = $conn -> real_escape_string($_GET['logout_id']);
        if(isset($logout_id)){
            $sql = $conn -> query("UPDATE users SET status = '{$time}' WHERE unique_id={$_GET['logout_id']}");
            if($sql){
                $sqlTime = $conn -> query("UPDATE users SET last_seenTime = '{$time}', last_seenDate = '{$date}' WHERE unique_id = {$_SESSION['unique_id']}");
                if($sqlTime){
                    session_unset();
                    session_destroy();
                    header("location: ../login.php");
                }
            }
        }else{
            header("location: ../users.php");
        }
    }else{  
        header("location: ../login.php");
    }
?>