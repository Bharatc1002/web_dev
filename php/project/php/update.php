<?php
    session_start();

    if(isset($_SESSION['unique_id'])){
        include_once "config.php";

        $imgsql = mysqli_query($conn, "SELECT * from users WHERE unique_id = {$_SESSION['unique_id']}");
        $old_data = mysqli_fetch_assoc($imgsql);
        $old_img = $old_data['img'];

        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        
        if((isset($_FILES['image']))){
            $img_name = $_FILES['image']['name'];  
                    
            if(!empty($img_name)){
                $img_type = $_FILES['image']['type'];
                $tmp_name = $_FILES['image']['tmp_name'];
                $img_explode = explode('.',$img_name);
                $img_ext = end($img_explode);

                $extensions = ["jpeg", "png", "jpg"];
                if(in_array($img_ext, $extensions) === true){
                    $types = ["image/jpeg", "image/jpg", "image/png"];
                    if(in_array($img_type, $types) === true){
                        $time = time();
                        $new_img_name = $time.$img_name;
                        if(move_uploaded_file($tmp_name,"./images/".$new_img_name)){
                            if(unlink("./images/" . $old_img)){
                                if(!empty($fname) && !empty($lname)){
                                $update_sql = mysqli_query($conn, "UPDATE users SET fname='".$fname."', lname='".$lname."', img='".$new_img_name."'
                                                                    WHERE unique_id='".$_SESSION['unique_id']."'");
                                if($update_sql){
                                    echo "success";
                                } else {
                                    echo "img fail";
                                }
                            } else if(!empty($fname) && empty($lname)){
                                $update_sql = mysqli_query($conn, "UPDATE users SET fname='".$fname."', img='".$new_img_name."'
                                                                    WHERE unique_id='".$_SESSION['unique_id']."'");
                                if($update_sql){
                                    echo "success";
                                } else {
                                    echo "img fail";
                                }
                            } else if(empty($fname) && !empty($lname)){
                                $update_sql = mysqli_query($conn, "UPDATE users SET lname='".$lname."', img='".$new_img_name."'
                                                                    WHERE unique_id='".$_SESSION['unique_id']."'");
                                if($update_sql){
                                    echo "success";
                                } else {
                                    echo "img fail";
                                }
                            } else {
                                $update_sql = mysqli_query($conn, "UPDATE users SET img='".$new_img_name."'
                                                                WHERE unique_id='".$_SESSION['unique_id']."'");
                                if($update_sql){
                                echo "success";
                                } else {
                                echo "img fail";
                                }
                            }
                            } else {
                                echo "can't unlink";
                            }
                        }
                    } else {
                        echo "img invalid";
                    }
                }
            } else {
                if(!empty($fname) && !empty($lname)){
                    $update_sql = mysqli_query($conn, "UPDATE users SET fname='".$fname."', lname='".$lname."'
                                                        WHERE unique_id='".$_SESSION['unique_id']."'");
                    if($update_sql){
                        echo "success";
                    } else {
                        echo "img fail";
                    }
                } else if(!empty($fname) && empty($lname)){
                    $update_sql = mysqli_query($conn, "UPDATE users SET fname='".$fname."'
                                                        WHERE unique_id='".$_SESSION['unique_id']."'");
                    if($update_sql){
                        echo "success";
                    } else {
                        echo "img fail";
                    }
                } else if(empty($fname) && !empty($lname)) {
                    $update_sql = mysqli_query($conn, "UPDATE users SET lname='".$lname."'
                                                        WHERE unique_id='".$_SESSION['unique_id']."'");
                    if($update_sql){
                        echo "success";
                    } else {
                        echo "img fail";
                    }
                }
            } 
        }else {
            echo "something went wrong";
        }
        
    }

    ?>