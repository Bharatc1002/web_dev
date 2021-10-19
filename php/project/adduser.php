<?php
session_start();
include "php/config.php";
include "header.php";
?>
<body>
    <?php
    $cquery = "SELECT * FROM grpadmin WHERE group_id={$_SESSION['user_id']} AND admin_id={$_SESSION['unique_id']}";
    $csql = mysqli_query($conn, $cquery);
    if(mysqli_num_rows($csql) > 0){

    ?>
<section class="users">
    <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
    </div>
    <div class="users-list">
  
    </div>
</section>

<script src="javascript/adduser.js"></script>
<?php 
    } else {
        header("location: users.php");
    }
?>
</body>
</html>