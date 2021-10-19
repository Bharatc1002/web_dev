<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY user_id DESC";
    $query = $conn -> query($sql);
    $output = "";


    $grpquery = $conn -> query("SELECT * FROM grpmember WHERE member_id={$_SESSION['unique_id']}");



    if($query -> num_rows == 0 && $grpquery -> num_rows == 0){
        $output .= "No users are available to chat";
    }else {
        include_once "grpdata.php";
    }
    echo $grpoutput;
?>