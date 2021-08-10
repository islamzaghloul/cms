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
          
         
          
          
        if(isset($_POST['submit']))
        {
            $search= $_POST['search'];
             $query="SELECT * FROM posts WHERE post_tag LIKE '%$search%' ";
            $tag=mysqli_query($connection,$query);
            if(!$tag)
            {
              die("not connected". mysqli_error($connection));
            }
            
            $count=mysqli_num_rows($tag);
            
              if($count == 0)
            {
                echo "<h3>no result</h3>";     
            }
            else 
            {
            
                $query= "SELECT * FROM posts WHERE post_tag LIKE '%$search%'";
                $selectallposts=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($selectallposts))
            {
                $post_id=$row['post_id'];
                $post_tit=$row['post_title'];
                $post_author=$row['post_author'];
                $post_content=$row['post_content'];
                $post_date=$row['post_date'];
                $post_image=$row['post_image'];
            
            
           ?> 
                <a href="post.php?p_id=<?php echo $post_id; ?>">
            <img class="card-img-top" src="images/<?php echo $post_image?>" alt="Card image cap">
                </a>    
            <div class="card-body">
              <h2 class="card-title">
                <a href="post.php?p_id=<?php echo $post_id; ?>">    
                    <?php echo $post_tit; ?> </a>
                </h2>
               
                <p class="card-text"><?php echo $post_content ?></p>
              <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>"> Read more <span class="glyphicon gyphicon-chevron-right"></span> </a>
            </div>
                <div class="card-footer text-muted">
                    <?php echo $post_date ?> by
                    <a href="#"><?php echo $post_author ?></a>
                </div>
        
        <?php } 
             
            }
              
        }
          ?>
           
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