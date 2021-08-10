<?php include "includes/admin_header.php";?>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
<?php include "includes/admin_navigation.php";?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
<?php include "includes/admin_sidebar.php";?>
        <!-- partial -->
<?php 
 if(isset($_POST['create_post']))
 {
       $post_title=$_POST['title'];
       $post_category=$_POST['category'];
      $post_author=$_POST['post_author'];
      $post_status=$_POST['post_status'];
  
      $post_tags=$_POST['post_tags'];
      $post_content=$_POST['post_content'];
      $post_date=date('d-m-y');
      //$post_comment_count=4;
  
         $post_image=$_FILES['post_image']['name'];
      $post_image_tmp=$_FILES['post_image']['tmp_name'];
     $imsize=$_FILES['post_image']['size'];
     $imerror=$_FILES['post_image']['error'];
     $imtype=$_FILES['post_image']['type'];
     
     $fileext=explode('.',$post_image);
     $actulext=strtolower(end($fileext));
     $allowed= array('jpg','jpeg','png','pdf');
     if(!in_array($actulext,$allowed))
     {
         $message="this image type not allowed";
     }
     else
     {
         if($imerror!==0)
         {
             $message =" there is an error";
         }
         else
         {
            if($imsize>10000000)
            {
                $message="this file is to big cannot be uploaded";
            }
             else
             {
        $newname=uniqid('',true).".".$actulext;
             
        
     move_uploaded_file($post_image_tmp,"../../images/$newname");
     
if(!empty($post_category) && !empty($post_title) && !empty($post_author) && !empty($newname) && !empty($post_content) && !empty($post_tags)&& !empty($post_status))
{     
     $query="INSERT INTO posts (post_category_id,post_title,post_author,post_date,post_image,post_content,post_tag,post_status) VALUES ('{$post_category}','{$post_title}','{$post_author}',now(),'{$newname}','{$post_content}','{$post_tags}','{$post_status}')";
     $insert=mysqli_query($connection,$query);
     confirm($insert);
     $post_id=mysqli_insert_id($connection);
  //      echo " <div class='bg-success'> post updated
    // <a href='../../post.php?p_id={$post_id}'>view posts </a>  
     //or <a href='posts.php'>add new</a>
      //</div>     
        //         ";
 
 }//end of empty check 
 else {
        $message="please fill all fields";
      }     
             }//end of else of size check  
         }//end of  else of error check
     }//end of else of type check 
 }//end of isset  add post bottom 
          
     
?>          
        <div class="main-panel">
          <div class="content-wrapper">
              <div class="col-sm-6">         
            <form action="" method="post" enctype="multipart/form-data">
                 
                <div class="form-group">
                <label for="title">post title</label>
                <input type="text" class="form-control" name="title">  
                </div>     
                 
                                
                <div class="form-group">
                
                    <select id="" name="category">
                    
            <?php  
                      
                $query="select * from categories";            
                $categories=mysqli_query($connection,$query);        
                while($row=mysqli_fetch_assoc($categories))      
                {
                $cat_id=$row['cat_id'];
                $cat_tit=$row['cat_tit'];
      
                echo "<option value='$cat_tit'>{$cat_tit}</option>";        
                }
            ?>
                    </select>
                </div>
                
                 
                <div class="form-group">
                <label for="post_author">post_author</label>
                <input type="text" class="form-control" name="post_author">  
                </div>     
                 
           <div class="form-group">
              
             
                <select name="post_status" id="" >
                    <option value="draft">post status</option>
                    <option value="published">published</option>
                    <option value="draft">draft</option>
                    </select>
                </div> 
                 
                 <div class="form-group">
                <label for="post_image">post image</label>
                <input type="file" name="post_image">  
                </div>
                <h5><?php if(isset($message)) {echo $message; }  ?>       </h5>
                 
                 <div class="form-group">
                <label for="post_tags">post tags</label>
                <input type="text" class="form-control"  name="post_tags">  
                </div>
                
                <div class="form-group">
                <label for="post_content">post content</label>
                    <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>  
                </div>
                
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="create_post" value="publish post">
                </div>
            </form>
                
</div>         
        
              
            <!-- Page Title Header Starts-->
             <div class="row page-title-header">
              </div>
          <!-- content-wrapper ends -->
<?php include "includes/admin_footer.php"; ?>      
            <!-- partial:partials/_footer.html -->
      