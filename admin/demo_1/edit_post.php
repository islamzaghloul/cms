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
          
if(isset($_GET['edit']))
{
$post_id=$_GET['edit'];
$query="SELECT * from posts WHERE post_id ={$post_id}";
$edit=mysqli_query($connection,$query);        
    while($row=mysqli_fetch_assoc($edit))               
     {
                
                $post_author=$row['post_author'];
                $post_title=$row['post_title'];
                $post_category=$row['post_category_id'];
                $post_status=$row['post_status'];
                $post_imageee=$row['post_image'];
                $post_tags=$row['post_tag'];
                $post_comments=$row['post_comment_count'];
                $post_date=$row['post_date'];
                $post_content=$row['post_content'];  
    }
}
          
 if(isset($_POST['edit_post']))
 {
      $post_title=$_POST['title'];
      $post_category=$_POST['category'];
      $post_author=$_POST['post_author'];
      $post_status=$_POST['post_status'];
      
      $post_tags=$_POST['post_tags'];
      $post_content=$_POST['post_content'];
      $post_date=date('d-m-y');
      $post_comment_count=4;
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
          
if(!empty($post_category) && !empty($post_title) && !empty($post_author) && !empty($newname) && !empty($post_content) && !empty($post_tags)&& !empty($post_status) && !empty($post_status)&& !empty($post_date))
{  
     $query="UPDATE posts SET post_category_id='{$post_category}',post_title='{$post_title}',post_author='{$post_author}',post_date={$post_date},post_image='{$newname}',post_content='{$post_content}',post_tag='{$post_tags}',post_comment_count='{$post_comment_count}',post_status='{$post_status}' WHERE post_id={$post_id}"; 
     $editpost=mysqli_query($connection,$query);
     
     echo " <div class='bg-success'> post updated
     <a href='../../post.php?p_id={$post_id}'>view posts </a> 
     or <a href='posts.php'> add new  </a>
      </div>     
                 ";
 }else { $message= "fields cannot be empty"; }
             }}}}
?>
          

  
          
        <div class="main-panel">
          <div class="content-wrapper">
              <div class="col-sm-6">         
            <form action="" method="post" enctype="multipart/form-data">
                 
                <div class="form-group">
                <label for="title">post title</label>
                <input type="text" class="form-control" name="title" value="<?php if(isset($post_title)){echo $post_title;}?>">  
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
                    
                    
                    <h5><?php if(isset($message)){echo $message;}?></h5>
                <label for="post_author">post_author</label>
                <input type="text" class="form-control" name="post_author" value="<?php if(isset($post_author)){echo $post_author;}?>">  
                </div>     
                 
                <div class="form-group">
                <!-- <label for="post_status">post status</label>
                <input type="text" class="form-control" name="post_status" value="//<?php
//if(isset($post_status)){echo $post_status;}?>">  
-->
                    <select name="post_status" >
                        <option value="<?php{echo $post_status;}?>">
                            <?php if(isset($post_status)){echo $post_status;}?></option>
                        
                       <?php
                        if($post_status=="published")
                        { 
                             echo "<option value='draft'>draft</option>";
                  }
                    else if($post_status=="draft")
                        {
                         
                           echo "<option value='published'>published</option>";
                        }
                        else
                        { 
                            echo "<option value='draft'>draft</option>";
                            echo "<option value='published'>published</option>";
                        } 
                        ?>
                        
                    
                      
                    
                    
                    </select>

</div>     
                 
                <div class="form-group">
                <img src="../../images/<?php echo $post_imageee?>" width="100">
                </div>
                
                 <div class="form-group">
                <label for="post_image">post image</label>
                <input type="file" name="post_image">  
                </div>
                 
                 <div class="form-group">
                <label for="post_tags">post tags</label>
                <input type="text" class="form-control"  name="post_tags" value="<?php if(isset($post_tags)){echo $post_tags;}?>">  
                </div>
                 
                <div class="form-group">
                <label for="post_date">post date</label>
                <input type="date" class="form-control" name="post_date" value="<?php if(isset($post_date)){echo $post_date;}?>">  
                </div>     
                
                <div class="form-group">
                <label for="post_content">post content</label>
                    <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content;?></textarea>  
                </div>
                
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="edit_post" value="edit post">
                </div>
            </form>
              
</div>
            
            <!-- Page Title Header Starts-->
             <div class="row page-title-header">
              </div>
          <!-- content-wrapper ends -->
<?php include "includes/admin_footer.php"; ?>      
            <!-- partial:partials/_footer.html -->