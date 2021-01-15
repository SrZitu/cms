      <!-- view all posts table -->
      <h1 class="page-header">
        View All Users

      </h1>
      <table class="table table-bordered table-hover">
        <tr>
          <th class="thead">Id</th>
          <th class="thead">User Name</th>
          <th class="thead">First Name</th>
          <th class="thead">Last Name</th>
          <th class="thead">Email</th>
          <th class="thead">Role</th>


        </tr>
        <tbody>
          <?php
          $sql = "SELECT * FROM users";
          $select_users = $conn->query($sql);
          while ($row = $select_users->fetch_assoc()) {
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];

            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$user_name}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";

            echo "<td>{$user_role}</td>";
            echo "<td><a class='btn btn-info' href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
            echo "<td><a class='btn btn-danger' href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
            echo "<td><a class='btn btn-info' href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            echo "<td><a class='btn btn-danger' href='users.php?delete={$user_id}'>Delete</a></td>";

            echo "</tr>";
          }
          ?>

        </tbody>

        <!-- delete categories -->


      </table>

      <?php
      if (isset($_GET['change_to_admin'])) {
        $the_user_id = $_GET['change_to_admin'];
        $sql = "UPDATE users SET user_role='admin' WHERE user_id= {$the_user_id} ";
        $result = $conn->query($sql);
        header("Location:users.php");
      }
      if (isset($_GET['change_to_sub'])) {
        $the_user_id = $_GET['change_to_sub'];
        $sql = "UPDATE users SET user_role='subscriber' WHERE user_id= {$the_user_id} ";
        $result = $conn->query($sql);
        header("Location:users.php");
      }


      if (isset($_GET['delete'])) {
        $the_deleting_user_id = $_GET['delete'];
        $sql = "DELETE FROM users WHERE user_id= {$the_deleting_user_id} ";
        $result = $conn->query($sql);

        if ($result == TRUE) {
          echo "deleted successfully";
          header("Location:users.php");
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
      }
      ?>