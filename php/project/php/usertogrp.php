<?php
session_start();
include_once "config.php";


$query = "CALL spCheckMember({$_SESSION['user_id']},{$_SESSION['usr_add']})";
$checkquery = $conn -> query($query);
if($checkquery -> num_rows > 0){
    header("location: ../users.php");
} else {
    $addquery = $conn -> query("CALL spAddMember({$_SESSION['user_id']}, {$_SESSION['usr_add']})");
    if($addquery){
        header("location: ../users.php");
    } else {
        header("location: adduser.php");
    }
}

?>