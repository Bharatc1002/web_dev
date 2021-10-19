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
        ($row['status'] == "Active now") ? $offline = "" : $offline = "offline";
        ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

        
        $sqld = "SELECT * FROM messages WHERE incoming_msg_id = {$_SESSION['unique_id']} AND 
                outgoing_msg_id = {$row['unique_id']} AND read_state = 1";
        $var = $conn -> query($sqld);

        if($var){
            
            if($var -> num_rows > 0){
                $style = '<div style = "position: absolute;
                bottom: -3px;
                righleftt: -3px;
                cursor: pointer;
                border-radius: 50%;
                height: 20px;
                width: 20px;
                display: flex !important;
                align-items: center;
                justify-content: center;
                background-color: white;
                color: black;
                box-shadow: 0 0 8px 3px #b8b8b8;"
                >'.mysqli_num_rows($var).'</div>';
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
        


        $output .= '<a href="chat.php?user_id='. $row['unique_id'] .'">
                        <div class="content" style="position: relative;">
                            <img src="php/images/'. $row['img'] .'" alt="">
                            '.$style .'
                            <div class="details">
                                <span>'. $row['fname']. " " . $row['lname'] .'</span>
                                <p>'. $typ .'</p>
                            </div>
                        
                        </div>

                        <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                    
                    </a>';


    }
?>
 