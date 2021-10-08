
<?php

$conn = mysqli_connect("mysql8", "root", "root", "chat");
if($conn){
    echo "Database connected" . mysqli_connect_error();
} else {
    echo "Error";
}


?>