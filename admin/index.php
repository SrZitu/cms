<?php include "includes/header.php";

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
            <small><?php echo $_SESSION['username']; ?></small>
          </h1>

        </div>
      </div>
      <!-- /.row -->
           
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>

                    <!-- number of post counts -->
                    <div class="col-xs-9 text-right">
                          <?php 
                          $sql="SELECT * FROM posts";
                          $result=mysqli_query($conn,$sql);
                          $postcount=mysqli_num_rows($result);
                          echo "<div class='huge'>{$postcount}</div>";
                          ?>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                         <?php 
                          $sql="SELECT * FROM comments";
                          $result=mysqli_query($conn,$sql);
                          $commmentcount=mysqli_num_rows($result);
                          echo "<div class='huge'>{$commmentcount}</div>";
                          ?>
                   
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                         <?php 
                          $sql="SELECT * FROM users";
                          $result=mysqli_query($conn,$sql);
                          $usercount=mysqli_num_rows($result);
                          echo "<div class='huge'>{$usercount}</div>";
                          ?>
                   
                   
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                       <div class="col-xs-9 text-right">
                         <?php 
                          $sql="SELECT * FROM categories";
                          $result=mysqli_query($conn,$sql);
                          $categoriescount=mysqli_num_rows($result);
                          echo "<div class='huge'>{$categoriescount}</div>";
                          ?>
                       
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="catagory.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->

    </div>
        
       <?php 
      $sql="SELECT * FROM posts WHERE post_status='published'";
      $select_all_published_posts=mysqli_query($conn,$sql);
      $all_published_count=mysqli_num_rows($select_all_published_posts);
     
      ?>
    <?php 
      $sql="SELECT * FROM posts WHERE post_status='draft'";
      $select_all_draft=mysqli_query($conn,$sql);
      $all_draft_count=mysqli_num_rows($select_all_draft);
     
      ?>
        <?php 
      $sql="SELECT * FROM comments WHERE comment_status='unapprove'";
      $comment_status=mysqli_query($conn,$sql);
      $all_comment_status_count=mysqli_num_rows($comment_status);
     
      ?>
        <?php 
      $sql="SELECT * FROM users WHERE user_role='subscriber'";
      $user_role=mysqli_query($conn,$sql);
      $all_user_role_count=mysqli_num_rows($user_role);
     
      ?>

                <div class="row">
                    
                    <script type="text/javascript">
      google.load("visualization", "1.1", {packages:["bar"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
            
            <?php
                                      
    $element_text =['all posts','active post','Draft Post','Comments','unapprove comments','Users','Subscriber','Categories'];  
    $element_count = [$postcount,$all_published_count,$all_draft_count,$commmentcount,$all_comment_status_count,$usercount,$all_user_role_count,$categoriescount];


    for($i =0;$i < 8; $i++) {
    
        echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
     
    
    
    }
                                                            
            ?>

               
     
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
    </script>
                   
                   
  <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->
  <?php include "includes/footer.php" ?>