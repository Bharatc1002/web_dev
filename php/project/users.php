<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  } else {
    $statusUpdate = mysqli_query($conn, "UPDATE users SET status = 'Active now' WHERE unique_id = {$_SESSION['unique_id']}");
  }
?>
<?php include_once "header.php"; include_once "php/style.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <div style="position: relative;">
            <img src="php/images/<?php echo $row['img']; ?>" style="<?php echo $my_img ?>" alt="">
            <i class="fa fa-edit" style="<?php echo $edit_style ?>"></i>
          </div>
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
        <i class="fas fa-users" style="display: flex;"></i>
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="grpusers-list">
  
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>
</body>
</html>
