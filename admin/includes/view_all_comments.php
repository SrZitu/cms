      <!-- view all posts table -->

      <table class="table table-bordered table-hover">
        <tr>
          <th class="thead">Id</th>
          <th class="thead">Author</th>
          <th class="thead">Comment</th>
          <th class="thead">Email</th>
          <th class="thead">Status</th>
          <th class="thead">In response to</th>
          <th class="thead">Date</th>
          <th class="thead">Approve</th>
          <th class="thead">UnApprove</th>
          <th class="thead">Delete</th>

        </tr>
        <tbody>
          <?php
          $sql = "SELECT * FROM comments";
          $select_comments = $conn->query($sql);
          while ($row = $select_comments->fetch_assoc()) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];

            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";
            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_status}</td>";

            $sql = "SELECT * FROM posts WHERE post_id={$comment_post_id}";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
              $post_id = $row['post_id'];
              $post_title = $row['post_title'];

              echo "<td><a href='../post.php?post_id={$post_id}'>{$post_title}</a></td>";
            }


            echo "<td>{$comment_date}</td>";
            echo "<td><a class='btn btn-info' href='comments.php?approved={$comment_id}'>Approve</a></td>";
            echo "<td><a class='btn btn-danger' href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
            echo "<td><a class='btn btn-danger' href='comments.php?delete={$comment_id}'>Delete</a></td>";

            echo "</tr>";
          }
          ?>

        </tbody>

        <!-- delete categories -->


      </table>

      <?php
      if (isset($_GET['approved'])) {
        $the_comment_id = $_GET['approved'];
        $sql = "UPDATE comments SET comment_status='approved' WHERE comment_id= {$the_comment_id} ";
        $result = $conn->query($sql);
        header("Location:comments.php");
      }
      if (isset($_GET['unapprove'])) {
        $the_comment_id = $_GET['unapprove'];
        $sql = "UPDATE comments SET comment_status='unapprove' WHERE comment_id= {$the_comment_id} ";
        $result = $conn->query($sql);
        header("Location:comments.php");
      }


      if (isset($_GET['delete'])) {
        $the_comment_id = $_GET['delete'];
        $sql = "DELETE FROM comments WHERE comment_id= {$the_comment_id} ";
        $result = $conn->query($sql);

        if ($result == TRUE) {
          echo "deleted successfully";
          header("Location:comments.php");
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
      }
      ?>