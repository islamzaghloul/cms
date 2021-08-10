<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>

<?php include "includes/navigtion.php"; ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

      <h1 class="my-4">welcome for cms 
          <small></small>
        </h1>

        <!-- Blog Post -->
        <div class="card mb-4">
        
            
            <?php
            if(isset($_GET['p_id']))
            {
                $theid=$_GET['p_id'];
            }
             ?> 
        <?php 
                $query= "select * from posts WHERE post_id=$theid";
                $selectallposts=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($selectallposts))
            {
                $post_tit=$row['post_title'];
                $post_author=$row['post_author'];
                $post_content=$row['post_content'];
                $post_date=$row['post_date'];
                $post_image=$row['post_image'];
            
            
           ?> 
            <img class="card-img-top" src="images/<?php echo $post_image?>" alt="Card image cap">
            <div class="card-body">
                <h2 class="card-title"><?php echo $post_tit ?></h2>
                <p class="card-text"><?php echo $post_content ?></p>
                
            </div>
                <div class="card-footer text-muted">
                    <?php echo $post_date ?> by
                    <a href="author.php?author=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
                </div>
        
        <?php } ?>
    <?php 
    if(isset($_POST['create_comment']))
    {     $theid=$_GET['p_id'];
          $comment_author=$_POST['author'];
            $comment_email=$_POST['email'];
            $comment_content=$_POST['comment'];
     
     if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content) )
     {     
        $query = "INSERT INTO comments (comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) VALUES ({$theid},'{$comment_author}','{$comment_email}','{$comment_content}','unapproved',now())  ";
        $insert=mysqli_query($connection,$query);    

     $query_count="update posts set post_comment_count=post_comment_count+1 where post_id = $theid";
     $counter=mysqli_query($connection,$query_count);
    }
     else
     {
       echo "<script>alert('fields cannot be empty') </script>";  
     }
     }
            
    
    ?>        
        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <form action="" method="post" role="form">
                
                
                <div class="form-group">
                    <label for="author">author</label>
                    <input class="form-control" type="text" name="author">
                </div>
                <div class="form-group">
                    <label for="email">email</label>
                    <input class="form-control" type="text" name="email">
                </div>
                
              <div class="form-group">
                  <label for="comment">comment here</label>
                <textarea class="form-control" name="comment" rows="3"></textarea>
              </div>
                
              <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>

                      
  <?php         
            
    $theid=$_GET['p_id'];
        $comment_query="select * from comments WHERE comment_post_id ={$theid} and comment_status='approve' ORDER BY comment_id DESC";
         $show=mysqli_query($connection,$comment_query);   
            while($row=mysqli_fetch_assoc($show))
            {
                $comment_author=$row['comment_author'];
                $comment_content=$row['comment_content'];
                $comment_date=$row['comment_date']
            ?>
            
     
    

        <!-- Single Comment -->
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="media-heading"><?php echo $comment_author;?>
              <small><?php echo $comment_date ;?></small>
              </h5>
            <?php echo $comment_content; ?>
          </div>
        </div>
<?php   } ?>
        <!-- Comment with nested comments -->
        
          </div>

          
          
          <!-- Pagination -->

      </div>

      <!-- Sidebar Widgets Column -->
<?php include "includes/sidebar.php"; ?>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
<?php include "includes/footer.php"; ?>