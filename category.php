<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>

<?php include "includes/navigtion.php"; ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">
     <?php 
            
           if(isset($_GET['category']))
           {
               $post_category_id=$_GET['category'];
           ?>   <h1 class="my-4"><?php  echo $post_category_id; ?>
          <small>category posts </small>
        </h1>
          <?php
           }
            
           ?>
       

        <!-- Blog Post -->
        <div class="card mb-4">
        
     
            
            
             
        <?php 
           
            
                $query= "select * from posts  WHERE post_category_id='{$post_category_id} '";
          $selectallposts=mysqli_query($connection,$query);
            $count=mysqli_num_rows($selectallposts);
            if($count==0)
               {
                echo "no posts for this category";
                }
            else {
            while($row=mysqli_fetch_assoc($selectallposts))
            {
                
                $post_id=$row['post_id'];
                $post_tit=$row['post_title'];
                $post_author=$row['post_author'];
            $post_content=substr($row['post_content'],0,100);
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
              
            </div>
               <div class="card-footer text-muted">
                    <?php echo $post_date; ?> by
                    <a href="author.php?author=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
                </div>
        
        <?php } }?>
          
          
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