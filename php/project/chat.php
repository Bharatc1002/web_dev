<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php
        
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $_SESSION['user_id'] = $user_id;
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{

            
            // $grpsql = mysqli_query()


            header("location: users.php");
          }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p></p>
        </div>
      </header>
      <div class="chat-box">
        

      </div>
      <form action="#" class="typing-area">
        <?php include_once "php/style.php"; ?>
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <label for="file" <?php echo $input_style ?>>
        <i class="fas fa-ellipsis-h" style="opacity:0.8;width:55px;"></i>
        </label>
        <input type="file" id="file" style="display:none">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>
  <script src="javascript/status.js"></script>
  <script src="javascript/set_readstatus.js"></script>
</body>
</html>
