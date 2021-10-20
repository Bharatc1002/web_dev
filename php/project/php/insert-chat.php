<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        function clearResult($con){
            while($con -> next_result()){
                if($result = $con -> store_result()){
                    $result -> free();
                }
            }
        }
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = $conn -> real_escape_string($_POST['incoming_id']);
        $message = $conn -> real_escape_string($_POST['message']);
        $read_count = 1;
        if(!empty($message)){
            $sql = $conn -> query("CALL spInsertChat({$incoming_id},{$outgoing_id},'{$message}',{$read_count})");
            clearResult($conn);
        }
    }else{
        header("location: ../login.php");
    }


    
?>