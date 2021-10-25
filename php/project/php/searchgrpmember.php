<?php
    session_start();
    include_once "config.php";

    $outgoing_id = $_SESSION['unique_id'];
    $searchTerm = $conn -> real_escape_string($_POST['searchTerm']);

    function clearResult($con){
        while($con -> next_result()){
            if($result = $con -> store_result()){
                $result -> free();
            }
        }
    }

    $sql = "SELECT * FROM users JOIN grpmember WHERE NOT users.unique_id = {$outgoing_id} AND grpmember.group_id={$_SESSION['user_id']} AND 
            users.unique_id = grpmember.member_id AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
    $output = "";
    $sqlmem = $conn -> query($sql);
    clearResult($conn);
    
    if($sqlmem -> num_rows > 0){
        include_once "datamember.php";
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>