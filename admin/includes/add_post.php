<?php
if (isset($_POST['create_post'])) {
  $post_title = $_POST['title'];
  $post_author = $_POST['post_author'];
  $post_category_id = $_POST['post_category'];
  $post_status = $_POST['post_status'];
  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['tmp_name'];


  $post_tags = $_POST['post_tags'];
  $post_content = $_POST['post_content'];
  $post_date = date('d-m-y');
  // $post_comment_count = 4;

  move_uploaded_file($post_image_temp, "../images/$post_image");

  $sql = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) VALUES ({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";



  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}



?>


<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title">
  </div>

  <div class="form-group">
    <label for="post_author">author</label>
    <input type="text" class="form-control" name="post_author">
  </div>


  <div class="form-group">
    <label for="category">Category</label>
    <select name="post_category" id="">
      <?php
      $sql = "SELECT * FROM categories";
      $result = $conn->query($sql);
      confirmQuery($result);
      while ($row = $result->fetch_assoc()) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<td>$cat_id</td>";
        echo "<td>$cat_title</td>";
        echo "<option value='$cat_id'>{$cat_title}</option>";
      }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="post_status">Post Status</label>
    <input type="text" class="form-control" name="post_status">
  </div>

  <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" class="form-control" name="image">
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags">
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea name="post_content" id="body" cols="30" rows="10"></textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="publish post">
  </div>

</form>