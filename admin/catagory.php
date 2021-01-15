<?php include "../includes/db.php"; ?>
<?php include  "functions.php";
include "includes/header.php";
?>

<div id="wrapper">

 <!-- Navigation -->
 <?php include "includes/nav.php" ?>

 <div id="page-wrapper">

  <div class="container-fluid">

   <!-- Page Heading -->
   <div class="row">
    <div class="col-lg-12">
     <h1 class="page-header">
      Welcome to Admin
      <small>author</small>
     </h1>

     <div class="col-lg-6 col-md-6 col-sm-12">

      <!-- add categories -->
      <?php insert_categories(); ?>

      <form action="" method="POST">
       <div class="form-group">
        <label for="cat_title">Add Category</label>
        <input type="text" class="form-control" name="cat_title">
       </div>
       <div class="form-group">
        <button type="submit" class="btn btn-primary" name="submit">Add Category</button>
       </div>
       <?php if (isset($msg)) echo "$msg"; ?>
      </form>

      <?php
      if (isset($_REQUEST['edit'])) {
       $cat_id = $_REQUEST['edit'];
       include "includes/updateCategories.php";
      }
      ?>

     </div>
     <!-- add category col end -->
     <div class="col-lg-6 col-md-6 col-sm-12">
      <table class="table table-bordered table-hover">
       <tr>
        <th class="thead">Id</th>
        <th class="thead">Category Title</th>
        <th class="thead">Action</th>
       </tr>
       <tbody>

        <!-- //find all categories query -->
        <?php findAllCategories(); ?>
       </tbody>

       <!-- delete categories -->
       <?php deleteCategorites(); ?>

      </table>
     </div>

    </div>
   </div>
   <!-- /.row -->

  </div>
  <!-- /.container-fluid -->

 </div>
 <!-- /#page-wrapper -->
 <?php include "includes/footer.php" ?>