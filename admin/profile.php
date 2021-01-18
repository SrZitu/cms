
<?php 
include "functions.php";
include "includes/header.php";?>
<?php
if(isset($_SESSION['username'])){
  $username= $_SESSION['username'];
  $sql="SELECT * FROM users WHERE user_name='{$username}'";
  $result=$conn->query($sql);
  while($row=$result->fetch_assoc()){
      $user_id = $row['user_id'];
     $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_role = $row['user_role'];
    $user_name = $row['user_name'];
    $user_email = $row['user_email'];
    $user_password = $row['user_password'];
  }


}
?>
<?php

    if (isset($_POST['update_profile'])) {

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $query = "UPDATE users SET ";
    $query .= "user_firstname  = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "user_name   = '{$user_name}', ";
    $query .= "user_email= '{$user_email}', ";
    $query .= "user_password  = '{$user_password}' ";
    $query .= "WHERE user_name = '{$username}' ";

    $update_user = $conn->query($query);
    confirmQuery($update_user);
  }
?>


<div id="wrapper">

  <!-- Navigation -->
  <?php include "includes/nav.php" ?>

  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">

               <h1 class="page-header">View User Profile </h1>
  

  <form action="" method="post" enctype="multipart/form-data">



  <div class="form-group">
    <label for="firstname">FirstName</label>
    <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
  </div>
  <div class="form-group">
    <label for="LastName">LastName</label>
    <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
  </div>


  <div class="form-group">
    <label for="role">role</label>
    <select name="user_role" id="">
      <option value="subscriber"><?php echo $user_role; ?></option>
      <?php
      if ($user_role == 'admin') {
        echo "<option value='subscriber'>Subscriber</option>";
      } else {
        echo "<option value='admin'>Admin</option>";
      }
      ?>


    </select>
  </div>

  <div class="form-group">
    <label for="UserName">UserName</label>
    <input type="text" class="form-control" name="user_name" value="<?php echo $user_name; ?>">
  </div>

  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
  </div>
  <div class="form-group">
    <label for="user_password">User password</label>
    <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
  </div>

  <!-- <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" class="form-control" name="image">
  </div> -->


  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">

  </div>
  <?php if (isset($msg)) {
    echo $msg;
  } ?>
</form>
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }  
</script>

        </div>
        <!-- /.row -->

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    <?php include "includes/footer.php" ?>