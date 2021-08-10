<?php include "includes/admin_header.php";?>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
<?php include "includes/admin_navigation.php";?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
<?php include "includes/admin_sidebar.php";?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">             
            <div class="row">
             <div class="col-lg-12">
                 <h1 class="page-header">
                 welcome to admin
                 <small>author</small>
                 </h1> 
<script type="text/javascript">
$(document).ready(function(){
$('#selectallboxes').click(function(event){
    if(this.checked){
        $('.checkboxes').each(function(){
            this.checked =true;
        });
    }
});    
    
});    

    
</script>
<?php                 
        if(isset($_POST['checkboxarray']))
        {
            
            
            foreach($_POST['checkboxarray'] as $value)
            {
             $optionval=$_POST['options'];
                
                switch ($optionval)
                {
                    case 'published':
                        $query="update posts SET post_status='{$optionval}' WHERE post_id='{$value}'";
                        $updatestat=mysqli_query($connection,$query);
                        
                        break;
                  case 'draft':
                        $qquery="update posts SET post_status='{$optionval}' WHERE post_id='{$value}'";
                        $updatestatus=mysqli_query($connection,$qquery);
                        break;
                 case 'delete':
                        $qqquery="DELETE FROM posts   WHERE post_id='{$value}'";
                        $updatestatdel=mysqli_query($connection,$qqquery);
                        break;
                    case 'colone':
            $query="select * from posts WHERE post_id='{$value}'";             
        $posts=mysqli_query($connection,$query);
            
    while($row=mysqli_fetch_assoc($posts))               
     {
                $post_id=$row['post_id'];
                $post_author=$row['post_author'];
                $post_title=$row['post_title'];
                $post_category=$row['post_category_id'];
                $post_status=$row['post_status'];
                $post_content=$row['post_content'];
                $post_image=$row['post_image'];
                $post_tags=$row['post_tag'];
                $post_comments=$row['post_comment_count'];
                $post_date=$row['post_date'];
        
    }
    $query="INSERT INTO posts (post_category_id,post_title,post_author,post_date,post_image,post_content,post_tag,post_status) VALUES ('{$post_category}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
     $insert=mysqli_query($connection,$query);
                        break;
                        
                }
                
            }
            
        }   
                 
                 
      ?>           
                 <table class="table">
                     
                     
<form class="form-control" action="" method="post">
         <div class="form-group">        
        <div id="bulkOptionContainer" class="col-xs-4">
            <select class="form-control" name="options" id="">
               <option value="">select option</option>
               <option value="published">published</option>
               <option value="draft">draft</option>
                <option value="delete">delete</option>
                <option value="colone">colone</option>
            </select>
            </div>
             <br>
           
               <input type="submit" value="apply" class="btn btn-
            success" name="submit">
            <a class="btn btn-primary" href="add_post.php">add new </a>
          
            
        </div>

                <br>          
                      <thead>
                        <tr>
                        <th> <input name="selectallboxes" type="checkbox"> </th>     
                          <th>id</th>  
                          <th>author</th>
                            <th>title</th>
                            <th>category</th>
                            <th>status</th>
                            <th>image</th>
                            <th>tags</th>
                            <th>comments</th>
                            <th>date</th>
                        </tr>  
                      </thead>
                        
                        <tbody>
    <?php                        
        $query="select * from posts ORDER BY post_id DESC";               
        $posts=mysqli_query($connection,$query);
            
    while($row=mysqli_fetch_assoc($posts))               
     {
                $post_id=$row['post_id'];
                $post_author=$row['post_author'];
                $post_title=$row['post_title'];
                $post_category=$row['post_category_id'];
                $post_status=$row['post_status'];
                $post_image=$row['post_image'];
                $post_tags=$row['post_tag'];
                $post_comments=$row['post_comment_count'];
                $post_date=$row['post_date'];
        
        
                echo "<tr>";
        ?>
<td> <input class="checkboxes" type="checkbox" name="checkboxarray[]" value='<?php echo $post_id; ?>' >  </td>  
    <?php                         
               $query="SELECT * FROM comments WHERE comment_post_id='$post_id'";
              $insertqur=mysqli_query($connection,$query);
                $counter=mysqli_num_rows($insertqur);
        
                echo "<td>{$post_id}</td>";
                echo "<td>{$post_author}</td>";
                echo "<td>{$post_title}</td>";
                echo "<td>{$post_category}</td>";
                echo "<td>{$post_status}</td>";
                echo "<td><img src='../../images/{$post_image}'></td>";
                echo "<td>{$post_tags}</td>";
                echo "<td><a href='postcomment.php?id={$post_id}'>{$counter}</a></td>";
                echo "<td>{$post_date}</td>";
                
                echo "<td><a href='posts.php?delete= {$post_id}'>delete</a></td>"; 
        
                echo "<td><a href='edit_post.php?edit= {$post_id}'>edit</a></td>";  
                
                echo "<td><a href='../../post.php?p_id= {$post_id}'> view post</a></td>";  
                
        
        
        echo "</tr>";
                
                
      }
  if(isset($_GET['delete']))
     {
         $post_id=$_GET['delete'];
         $query ="DELETE FROM posts WHERE post_id ={$post_id}";
         $delete_post=mysqli_query($connection,$query);
         header("location:posts.php");
     }
  

                              
?>
                        
   
    </tbody>
    </form>             
                 
                    </table>
                 
                </div>
              </div>    
                 
            <!-- Page Title Header Starts-->
             <div class="row page-title-header">
              </div>
          <!-- content-wrapper ends -->
<?php include "includes/admin_footer.php"; ?>      
            <!-- partial:partials/_footer.html -->
      