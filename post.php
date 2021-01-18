<!-- header -->
<?php
include "includes/db.php";
include "includes/header.php";

?>

<!-- Navigation -->
<?php include "includes/nav.php" ?>

<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">
      <?php

      if (isset($_GET['post_id'])) {
        $the_post_id = $_GET['post_id'];
      }
      $sql = "SELECT * FROM posts where post_id={$the_post_id}";
      $result = $conn->query($sql);
      while ($row = $result->fetch_assoc()) {

        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];


      ?>
        <h1 class="page-header">
          Page Heading
          <small>Secondary Text</small>
        </h1>

        <!-- First Blog Post -->
        <h2>
          <a href="#"><?php echo $post_title; ?></a>
        </h2>
        <p class="lead">
          by <a href="index.php"><?php echo $post_author; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
        <hr>
        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">

        <hr>
        <p><?php echo $post_content; ?></p>


        <hr>
      <?php }  ?>


      <!-- Blog Comments -->

      <!-- Comments Form -->
      <div class="well">
        <h4>Leave a Comment:</h4>



        <?php
        if (isset($_POST['create_comment'])) {
          $the_post_id = $_GET['post_id'];
          $comment_author = $_POST['comment_author'];
          $comment_email = $_POST['comment_email'];
          $comment_content = $_POST['comment_content'];

          $sql = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES($the_post_id, '{$comment_author}','{$comment_email}', '{$comment_content}','unapproved', now())";

          $result = $conn->query($sql);

          if (!$result) {
            die('Query Failed' . mysqli_error($conn));
          }
          $update_comment_sql = "UPDATE posts SET post_comment_count=post_comment_count+1 where post_id=$the_post_id";
          $update_comment_result = $conn->query($update_comment_sql);
          header("Location:post.php?post_id=$the_post_id");
        }



        ?>
        <form action="" method="post" role="form">
          <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" name="comment_author">
          </div>
          <div class="form-group">
            <label for="email">email</label>
            <input type="email" class="form-control" name="comment_email">
          </div>
          <div class="form-group">
            <label for="comment">Your Comment</label>
            <textarea class="form-control" rows="3" name="comment_content"></textarea>
          </div>
          <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
        </form>
      </div>

      <hr>

      <!-- Posted Comments -->

      <?php
      $sql = "SELECT * FROM comments where comment_post_id=$the_post_id AND comment_status='approved' order by comment_id DESC";
      $result = $conn->query($sql);
      if (!$result) {
        die('Query Failed' . mysqli_error($conn));
      }
      while ($row = $result->fetch_assoc()) {
        $comment_date = $row['comment_date'];
        $comment_author = $row['comment_author'];
        $comment_content = $row['comment_content'];

      ?>
        <!-- Comment -->
        <div class="media">
          <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
          </a>
          <div class="media-body">
            <h4 class="media-heading"><?php echo $comment_author; ?>
              <small><?php echo  $comment_date; ?></small>
            </h4>
            <?php echo $comment_content; ?>
          </div>
        </div>
      <?php
      } ?>


    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php" ?>

  </div>
  <!-- /.row -->

  <hr>

  <!-- Footer -->
  <?php include "includes/footer.php" ?>