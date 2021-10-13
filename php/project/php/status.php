<?php 
  session_start();
  include_once "config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>

<?php
if(isset($_SESSION['unique_id'])){
    include_once "config.php";
    $user_id = $_SESSION['user_id'];
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
        } else {
              
        }
        echo $row['status'];
} else{
    header("location: ../login.php");
}

?>