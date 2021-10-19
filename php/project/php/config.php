<?php
  $hostname = "mysql8";
  $username = "devuser";
  $password = "devpass";
  $dbname = "test_db";

  $conn = new mysqli($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".$conn -> connect_error();
  }
?>