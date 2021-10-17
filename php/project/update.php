<?php 
  session_start();
  include_once "php/config.php";

//   if(isset($_SESSION['unique_id'])){
//     header("location: users.php");
//   }
?>

<?php include_once "header.php"; ?>
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
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
            <p>
                <i class="fas fa-circle" style="font-size: 12px; color: #468669; padding-left: 10px;"></i>
                <?php echo $row['status']; ?>
            </p>
          </div>
        </div>
      </header>
    </section>
    <!-- <section class="users"> -->
    <header>
            <span style="margin-left: 30px; margin-bottom: 0px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px; outline: none">Update Your Details</span>
      </header>
    <!-- </section> -->
    <section class="form signup">
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="<?php echo $row['fname']; ?>" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="<?php echo $row['lname']; ?>" required>
          </div>
        </div>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg">
        </div>
        <div class="field button" style="display: flex; align-items: stretch;">
          <input type="submit" class="update" style="width:40%;" name="submit" value="Update Details">
        </div>
      </form>
      <input type="submit" class="back" style="width:40%; height: 45px;
                                                border: none;
                                                color: #fff;
                                                font-size: 17px;
                                                background: #333;
                                                border-radius: 5px;
                                                cursor: pointer;
                                                margin-top: 13px;" name="Back" value="Back To Chat">

    </section>
  </div>
    
  <script src="javascript/update.js"></script>

</body>
</html>
