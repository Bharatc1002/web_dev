<?php
    session_start();
    include_once "config.php";
    $gname = mysqli_real_escape_string($conn, $_POST['gname']);

    if(isset($_FILES['image'])){
        $img_name = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];
        
        $img_explode = explode('.',$img_name);
        $img_ext = end($img_explode);
        $extensions = ["jpeg", "png", "jpg"];
    
        if(in_array($img_ext, $extensions) === true){
            $types = ["image/jpeg", "image/jpg", "image/png"];
            if(in_array($img_type, $types) === true){
            $time = time();
            $ran_id = rand(time(), 100000000);
            $new_img_name = $time.$img_name;
            if(move_uploaded_file($tmp_name,"./images/".$new_img_name)){            
                $insert_query = mysqli_query($conn, "INSERT INTO grpadmin(group_name, group_id, admin_id, img_name)
                                                        VALUES ('{$gname}', {$ran_id}, {$_SESSION['unique_id']}, '{$new_img_name}')");
                if($insert_query){
                   $addself = mysqli_query($conn, "INSERT INTO grpmember(group_id, member_id) VALUES({$ran_id},{$_SESSION['unique_id']})");
                   if($addself){
                       echo "success";
                   }
                } else{
                        echo "This address not Exist!";
                    }
                }
            }
        }
    }
?>