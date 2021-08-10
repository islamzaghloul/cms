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
             $countquery= "select * from posts";
            $countposts=mysqli_query($connection,$countquery);
            $counter=mysqli_num_rows($countposts);    
            $count=ceil($counter/5);
            
           if(isset($_GET['page']))
            {
                
                $page=$_GET['page'];
                
            }
            else 
            {
                $page="";   
            }
            if($page=="" || $page==1)
                {
                    $page_1=0;
                $perpage=5;
                }
                else
                {
               $page_1=($page * 5)-5;
                $perpage=5;  
                }
               
            
            
                $query= "select * from posts LIMIT $page_1,$perpage";
                $selectallposts=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($selectallposts))
            {
                $post_id=$row['post_id'];
                $post_tit=$row['post_title'];
                $post_author=$row['post_author'];
                $post_status=$row['post_status'];
                $post_content=substr($row['post_content'],0,100);
                $post_date=$row['post_date'];
                $post_image=$row['post_image'];
            if($post_status !=="published")
            {
                
            }
            else
            { 
        ?>
            <a href="post.php?p_id=<?php echo $post_id; ?>">
            <img class="card-img-top" src="images/<?php echo $post_image; ?>" alt="Card image cap">
            </a>
            <div class="card-body">
                
                <h2 class="card-title">
                <a href="post.php?p_id=<?php echo $post_id; ?>">    
                    <?php echo $post_tit; ?> </a>
                </h2>
               
                <p Class="card-text"><?php echo $post_content; ?></p>
                
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>"> Read more <span class="glyphicon gyphicon-chevron-right"></span> </a>
            
            
            </div>
                <div class="card-footer text-muted">
                    <?php echo $post_date; ?> by
                    <a href="author.php?author=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
                </div>
        
        <?php }} ?>
          
          
          </div>
<!-- Pagination -->
        <hr>
      <ul class="pagination justify-content-center mb-4" class="new" >
        <?php
          
          for($i=1; $i<=$count;$i++)
          {
          
              if($i==$page)
              {
            echo "<li class='page-item active'>
            <a class='page-link' href='index.php?page=$i'>$i</a> </li>"; 
                  
              }
              else 
              {
            echo "<li class='page-item'>
            <a class='page-link' href='index.php?page=$i'>$i</a> </li>"; 
            }
          }
          
          ?>
      
             
      </ul>  
          
          
     
      </div>
      <!-- Sidebar Widgets Column -->
<?php include "includes/sidebar.php"; ?>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
<?php include "includes/footer.php"; ?>