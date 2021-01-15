<h1>Add User</h1>
<?php
if (isset($_POST['create_user'])) {
  // Checking for Empty Fields
  if (($_POST['user_firstname'] == "") || ($_POST['user_lastname'] == "") || ($_POST['user_role'] == "") || ($_POST['user_name'] == "") || ($_POST['user_email'] == "") || ($_POST['user_password'] == "")) {
    // msg displayed if required field missing
    $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    // Assigning User Values to Variable

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    // $post_date = date('d-m-y');


    // move_uploaded_file($post_image_temp, "../images/$post_image");

    $sql = "INSERT INTO users (user_firstname,user_lastname,user_role,user_name,user_email,user_password) VALUES ('{$user_firstname}','{$user_lastname}','{$user_role}','{$user_name}','{$user_email}','{$user_password}')";



    if ($conn->query($sql) === TRUE) {
      $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Added Successfully </div>';
    } else {
      $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add </div>';
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}



?>


<form action="" method="post" enctype="multipart/form-data">



  <div class="form-group">
    <label for="firstname">FirstName</label>
    <input type="text" class="form-control" name="user_firstname">
  </div>
  <div class="form-group">
    <label for="LastName">LastName</label>
    <input type="text" class="form-control" name="user_lastname">
  </div>


  <div class="form-group">
    <label for="role">role</label>
    <select name="user_role" id="">
      <option value="subscriber">Select Options</option>
      <option value="admin">Admin</option>
      <option value="subscriber">Subscriber</option>
    </select>
  </div>

  <div class="form-group">
    <label for="UserName">UserName</label>
    <input type="text" class="form-control" name="user_name">
  </div>

  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" class="form-control" name="user_email">
  </div>
  <div class="form-group">
    <label for="user_password">User password</label>
    <input type="password" class="form-control" name="user_password">
  </div>

  <!-- <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" class="form-control" name="image">
  </div> -->


  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_user" value="Add User">

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