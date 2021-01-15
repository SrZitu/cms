<h1>Edit User</h1>
<?php
if (isset($_GET['edit_user'])) {

  // Assigning User Values to Variable

  $edit_id = $_GET['edit_user'];
  $sql = "SELECT * FROM users WHERE user_id =$edit_id";
  $select_users = $conn->query($sql);
  while ($row = $select_users->fetch_assoc()) {
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_role = $row['user_role'];
    $user_name = $row['user_name'];
    $user_email = $row['user_email'];
    $user_password = $row['user_password'];
  }
  if (isset($_POST['update_user'])) {
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
    $query .= "WHERE user_id = {$edit_id} ";

    $update_user = $conn->query($query);
    confirmQuery($update_user);
  }
}




?>


<form action="" method="post" enctype="multipart/form-data">



  <div class="form-group">
    <label for="firstname">FirstName</label>
    <input type="text" class="form-control" name="user_firstname" value=<?php echo $user_firstname; ?>>
  </div>
  <div class="form-group">
    <label for="LastName">LastName</label>
    <input type="text" class="form-control" name="user_lastname" value=<?php echo $user_lastname; ?>>
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
    <input type="text" class="form-control" name="user_name" value=<?php echo $user_name; ?>>
  </div>

  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" class="form-control" name="user_email" value=<?php echo $user_email; ?>>
  </div>
  <div class="form-group">
    <label for="user_password">User password</label>
    <input type="password" class="form-control" name="user_password" value=<?php echo $user_password; ?>>
  </div>

  <!-- <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" class="form-control" name="image">
  </div> -->


  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_user" value="submit">

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