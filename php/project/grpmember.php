<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  } else {
    $statusUpdate = $conn -> query("CALL spUpdateStatus({$_SESSION['unique_id']})");
  }
  function clearResult($con){
    while($con -> next_result()){
        if($result = $con -> store_result()){
            $result -> free();
        }
    }
}
?>
<?php include_once "header.php"; include_once "php/style.php"; ?>
<body>
<div class="wrapper users-wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = $conn -> query("SELECT * FROM grpadmin WHERE group_id={$_SESSION['user_id']}");
            clearResult($conn);
            if($sql -> num_rows > 0){
              $row = $sql -> fetch_assoc();
            }
          ?>
          <div style="position: relative;">
            <img src="php/images/<?php echo $row['img_name']; ?>" class="user-img" alt="">
            <i class="fa fa-edit"></i>
          </div>
          <div class="details">
            <span><?php echo $row['group_name']; ?></span>
          </div>
        </div>
      </header>
      <div class="search">
        <span class="text">Find user from group</span>
        <button><i class="fas fa-search"></i></button>
        <input type="text" placeholder="Enter name to search...">
      </div>
      <div class="column">
        <div class="users-list">
    
        </div>
      </div>
    </section>
    <a href='users.php?user_id=<?php echo $_SESSION['user_id'] ?>'>
    <button type="submit" class="back back-btn" name="Back">Back To Chat</button>
    </a>
  </div>

  <script src="javascript/grpmember.js"></script>
  
</body>
</html>
