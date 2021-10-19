<?php
session_start();
include_once "config.php";


$query = "SELECT * FROM grpmember
        WHERE group_id={$_SESSION['user_id']} AND member_id={$_SESSION['usr_add']}";
$checkquery = mysqli_query($conn, $query);
if(mysqli_num_rows($checkquery) > 0){
    header("location: ../users.php");
} else {
    $addquery = mysqli_query($conn, "INSERT INTO grpmember(group_id, member_id)
                                    VALUES({$_SESSION['user_id']}, {$_SESSION['usr_add']})");
    if($addquery){
        header("location: ../users.php");
    } else {
        header("location: adduser.php");
    }
}

?>