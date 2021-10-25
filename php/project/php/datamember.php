<?php


    while($row = $sqlmem -> fetch_assoc()){


        
        clearResult($conn);

        $sql2 = "SELECT * FROM users WHERE unique_id={$row['member_id']}";
        $query2 = $conn -> query($sql2);
        $row2 = $query2 -> fetch_assoc();
        clearResult($conn);

        ($row2['status'] == "Active now") ? $offline = "online" : $offline = "offline";

        clearResult($conn);
        $checkAdmin = $conn -> query("CALL spCheckAdmin({$_SESSION['user_id']},{$row['member_id']})");

        if($checkAdmin -> num_rows > 0){
            $admin = "(Admin)";
        } else {
            $admin = "";
        }
        if($row2['unique_id'] == $_SESSION['unique_id']){
            $output .= '<a href="users.php?user_id='.$_SESSION['user_id'].'" style="border-bottom-color: none; border: none;">
                            <div class="content" style="position: relative;">
                                <img src="php/images/'. $row2['img'] .'" alt="">
                                    <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i>
                                        <span class="user-span">'. $row2['fname']. " " . $row2['lname'] . " " . $admin .'</span>
                                    </div>  
                            
                            </div>
                        </a>';
        } else {
            $output .= '<a href="users.php?user_id='. $row2['unique_id'] .'" style="border-bottom-color: none; border: none;">
                            <div class="content" style="position: relative;">
                                <img src="php/images/'. $row2['img'] .'" alt="">
                                    <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i>
                                        <span class="user-span">'. $row2['fname']. " " . $row2['lname'] . " " . $admin .'</span>
                                    </div>  
                            
                            </div>
                        </a>';
        }



    }
?>
 