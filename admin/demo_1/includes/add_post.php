<?php include "admin_header.php";?>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
<?php include "admin_navigation.php";?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
<?php include "admin_sidebar.php";?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">             
            <div class="row">
             <div class="col-lg-12">
                 <h1 class="page-header">
                 welcome to admin
                 <small>author</small>
                 </h1>
        <div class="col-sm-6">         
            <form action="" method="post" enctype="multipart/form-data">
                 
                <div class="form-group">
                <label for="title">post title</label>
                <input type="text" class="form-control" name="title">  
                </div>     
                 
                <div class="form-group">
                <label for="category_id">post category id</label>
                <input type="text" class="form-control"  name="category_id">  
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
                 
                 <div class="form-group">
                <label for="post_tags">post tags</label>
                <input type="text" class="form-control"  name="post_tags">  
                </div>
                
                <div class="form-group">
                <label for="post_content">post content</label>
                    <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>  
                </div>
            </form>               
                 </div>         
                                  
                </div>
              </div>    
                 
            <!-- Page Title Header Starts-->
             <div class="row page-title-header">
              </div>
          <!-- content-wrapper ends -->
<?php include "admin_footer.php"; ?>      
            <!-- partial:partials/_footer.html -->
      