      <!-- view all posts table -->

      <table class="table table-bordered table-hover">
        <tr>
          <th class="thead">Id</th>
          <th class="thead">Author</th>
          <th class="thead">Title</th>
          <th class="thead">Category</th>
          <th class="thead">Status</th>
          <th class="thead">Image</th>
          <th class="thead">Post Content</th>
          <th class="thead">Tags</th>
          <th class="thead">Comments</th>
          <th class="thead">Date</th>
          <th class="thead">Edit</th>
          <th class="thead">Delete</th>
        </tr>
        <tbody>
          <?php
          $sql = "SELECT * FROM posts";
          $select_posts = $conn->query($sql);
          while ($row = $select_posts->fetch_assoc()) {
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];

            echo "<tr>";
            echo "<td>{$post_id}</td>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";

            $upsql = "SELECT * FROM categories WHERE cat_id={$post_category_id}";
            $result2 = $conn->query($upsql);
            while ($row2 = $result2->fetch_assoc()) {
              $cat_id = $row2['cat_id'];
              $cat_title = $row2['cat_title'];

              echo "<td>{$cat_title}</td>";
            }
            echo "<td>{$post_status}</td>";
            echo "<td><img width='100%'src='../images/{$post_image}' alt='image' > </td>";
            echo "<td>{$post_content}</td>";
            echo "<td>{$post_tags}</td>";
            echo "<td>{$post_comment_count}</td>";
            echo "<td>{$post_date}</td>";
            echo "<td><a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            echo "<td><a class='btn btn-danger' href='posts.php?delete={$post_id}'>Delete</a></td>";

            echo "</tr>";
          }
          ?>

        </tbody>

        <!-- delete categories -->


      </table>

      <?php
      if (isset($_GET['delete'])) {
        $post_delete = $_GET['delete'];
        $sql = "DELETE FROM posts WHERE post_id= {$post_delete} ";
        $result = $conn->query($sql);

        if ($result == TRUE) {
          echo "deleted successfully";
          header("Location:posts.php");
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
      }
      ?>