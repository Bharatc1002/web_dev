<?php
  $hostname = "mysql8";
  $username = "devuser";
  $password = "devpass";
  $dbname = "test_db";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>
