<?php
session_start();
if(isset($_SESSION['unique_id'])){
    include_once "config.php";
    $set_state = "UPDATE messages SET read_state=0 WHERE incoming_msg_id='".$_SESSION['unique_id']."'
                    AND outgoing_msg_id='".$_SESSION['user_id']."' ";
    $set_query = $conn -> query($set_state);
    
}


?>