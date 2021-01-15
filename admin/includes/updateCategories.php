<!-- update -->
<form action="" method="POST">
 <div class="form-group">
  <label for="cat_title">Edit Category</label>
  <?php
  if (isset($_GET['edit'])) {
   $edit_id = $_GET['edit'];
   $upsql = "SELECT * FROM categories WHERE cat_id={$edit_id}";
   $result2 = $conn->query($upsql);
   while ($row2 = $result2->fetch_assoc()) {
    $cat_id = $row2['cat_id'];
    $cat_title = $row2['cat_title'];
  ?>
    <input value="<?php echo $cat_title; ?>" type="text" class="form-control" name="cat_title">

  <?php }
  } ?>

  <?php
  if (isset($_REQUEST['update_categories'])) {
   $update_title = $_REQUEST['cat_title'];
   $sql = "UPDATE categories SET cat_title='{$update_title}' WHERE cat_id={$cat_id}";
   $update_result = $conn->query($sql);
   header("Location:catagory.php");
   if (!$update_result) {
    die("Query failed" . mysqli_error($conn));
   }
  } ?>

 </div>
 <div class="form-group">

  <input type="submit" class="btn btn-success" name="update_categories" value="update categories">
 </div>

</form>