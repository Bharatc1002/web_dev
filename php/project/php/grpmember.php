<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = "CALL spShowUser({$outgoing_id})";
    $query = $conn -> query($sql);
    
    function clearResult($con){
        while($con -> next_result()){
            if($result = $con -> store_result()){
                $result -> free();
            }
        }
    }
    // while($memrow = $sqlmem -> fetch_assoc())

    clearResult($conn);

    $sqlmem = $conn -> query("SELECT * FROM grpmember WHERE group_id={$_SESSION['user_id']}");

    // $grpquery = $conn -> query("CALL spShowGroup({$_SESSION['unique_id']})");
    $output = "";



    if($query -> num_rows == 0 && $grpquery -> num_rows == 0){
        $output .= "No users are available to chat";
    }else {
        include_once "datamember.php";
    }
    echo $output;
?>