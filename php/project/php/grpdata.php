<?php


    while($grprow = $grpquery -> fetch_assoc()){

        clearResult($conn);
 
            $grpquery2 = $conn -> query("CALL spGroupData({$grprow['group_id']})");
            clearResult($conn);
            $grprow2 = $grpquery2 -> fetch_assoc();


        $grpoutput .= '<a href="users.php?user_id='. $grprow2['group_id'] .'">
                        <div class="content" style="position: relative;">
                        <img src="php/images/'. $grprow2['img_name'] .'" alt="">
                        <div class="details">
                            <span>'. $grprow2['group_name'] .'</span>
                        </div>
                        </div>
                    </a>';


    }
?>
 