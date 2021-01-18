<?php include "db.php";
session_start();
?>

<?php
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $username = mysqli_escape_string($conn, $username);
  $password = mysqli_escape_string($conn, $password);

  $sql = "SELECT * FROM users WHERE user_name ='{$username}'  AND user_password= '{$password}'";
  $result = $conn->query($sql);
  if (!$result) {
    die("Query failed" . mysqli_error($conn));
  }
  while ($row = $result->fetch_assoc()) {
    $db_user_id = $row['user_id'];
    $db_user_name = $row['user_name'];
    $db_user_password = $row['user_password'];
    $db_user_firstname = $row['user_firstname'];
    $db_user_lastname = $row['user_lastname'];
    $db_user_role = $row['user_role'];
  }

  if ($username === $db_user_name && $password === $db_user_password) {

    $_SESSION['username'] = $db_user_name;
    $_SESSION['firstname'] = $db_user_firstname;
    $_SESSION['lastname'] = $db_user_lastname;
    $_SESSION['user_role'] = $db_user_role;
    header("Location: ../admin");
  } else {
    header("Location: ../index.php");
  }
}
?>