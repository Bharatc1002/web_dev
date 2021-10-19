<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY user_id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";


    $grpquery = mysqli_query($conn, "SELECT * FROM grpmember WHERE member_id={$_SESSION['unique_id']}");



    if(mysqli_num_rows($query) == 0 && mysqli_num_rows($grpquery) == 0){
        $output .= "No users are available to chat";
    }else if(mysqli_num_rows($query) > 0 && mysqli_num_rows($grpquery) > 0){
        include_once "grpdata.php";
    }
    echo $grpoutput;
?>