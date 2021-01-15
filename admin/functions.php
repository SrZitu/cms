     <?php
     function confirmQuery($query)
     {
          global $conn;
          if (!$query) {
               die("Query failed " . mysqli_error($conn));
          }
     }


     function insert_categories()
     {
          // include "../includes/db.php";
          global $conn;
          if (isset($_REQUEST['submit'])) {
               $cat_title = $_REQUEST['cat_title'];
               if ($cat_title == "") {
                    $msg = "<div class='alert alert-warning' role='alert'>All fields required</div>";
               } else {
                    $sql = "INSERT INTO categories(cat_title) VALUES('$cat_title')";
                    $result = $conn->query($sql);
                    if ($result) {
                         $msg = '<div class="alert alert-success" role="alert"> Added Successfully </div>';
                    } else {
                         $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add </div>';
                    }
               }
          }
     }

     function findAllCategories()
     {
          global $conn;
          $sql = "SELECT * FROM categories";
          $result = $conn->query($sql);
          while ($row = $result->fetch_assoc()) {
               $cat_id = $row['cat_id'];
               $cat_title = $row['cat_title'];
               echo "<tr>";
               echo "<td>$cat_id</td>";
               echo "<td>$cat_title</td>";
               echo "<td><a class='btn btn-danger' href='catagory.php?delete={$cat_id}'>Delete</a>
       <a class='btn btn-info' href='catagory.php?edit={$cat_id}'>Edit</a>
       </td>";
               echo "</tr>";
          }
     }

     function deleteCategorites()
     {
          global $conn;
          if (isset($_REQUEST['delete'])) {
               $cat_delete = $_REQUEST['delete'];
               $sql = "DELETE FROM categories WHERE cat_id={$cat_delete}";
               $result = $conn->query($sql);
               header("Location:catagory.php");
          }
     }

     ?>