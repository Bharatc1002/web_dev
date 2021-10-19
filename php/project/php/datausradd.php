<?php

    while($row = $query -> fetch_assoc()){
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = $conn -> query($sql2);
        $row2 = $query2 -> fetch_assoc();



        ($query2 -> num_rows > 0) ? $result = $row2['msg'] : $result ="No message available";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

        
        $sqld = "SELECT * FROM messages WHERE incoming_msg_id = {$_SESSION['unique_id']} AND 
                outgoing_msg_id = {$row['unique_id']} AND read_state = 1";
        $var = $conn -> query($sqld);

        if($var){
            if($var -> num_rows > 0){
                $style = '<div style = "width: 20px;
                height: 20px;
                border-radius: 50%;
                color: black;
                position: absolute;
                right: 0;
                bottom: 0;
                text-align: center;
                background-color: orange;"
                >'.$var -> num_rows.'</div>';
            } else {
                $style = '<div style = "none;"></div>';
            }
        } else {
            $style = '<div style = "none;"></div>';
        }

        $typing = $conn -> query("SELECT * FROM typeStatus
                                        WHERE sender_id={$row['unique_id']}
                                        AND receiver_id={$_SESSION['unique_id']}");
        if($typing){
            $type_status = $typing -> fetch_assoc();
            if($type_status){
                if($type_status['type_status'] == 1){
                    $typ = "Typing...";   
                } else {
                    $typ = $you . $msg;
                }
            } else {
                $typ = $you . $msg;
            }
        } else {
            $typ = $you . $msg;
        }


        $_SESSION['usr_add'] = $row['unique_id'];

        $output .= '<a href="php/usertogrp.php">
                        <div class="content" style="position: relative;">
                        <img src="php/images/'. $row['img'] .'" alt="">
                        <div class="details">
                            <span>'. $row['fname']. " " . $row['lname'] .'</span>
                            <p>'. $typ .'</p>
                        </div>
                        '.$style .'
                        </div>

                        <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                    
                    </a>';



    }
?>
 