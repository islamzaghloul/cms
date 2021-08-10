<?php include "includes/admin_header.php";?>
<?php include "includes/db.php" ; ?>
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
<!--adding category form -->                  
                <div class="col-sm-6">
                    
                   <form action="" method="post">
                       
                     <div class="form-group">
                        <label for="cat_title">add category</label> 
                       <input  type="text" class="form-control" name="cat_title"> 
                     </div>
                       
                    <div class="form-group"> 
                       <input class="btn btn-primary" type="submit" name="submit" value="add category"> 
                    </div>
<!-- adding category -->                       
       <?php  adding_catgeory(); ?>        
<!-- adding  category -->                      
                   </form>
                </div>
    
            
            <!-- editing categories -->                       
   <?php if(isset($_GET['edit']))
        {
         $cat_id=$_GET['edit'];
         include "includes/edit_categories.php";
        
        }
        ?>  
<!--ending editing categories --> 
            
<div class="col-sm-6"> 
    <table class="table">
                        
        <thead>
            <tr>
                <th>id</th>
                <th>category title</th>
            </tr>
       </thead>
                       
       <tbody>
                        
    <!-- show all catgeories on table  -->                       
    
                  
<?php show_catgeories_table(); ?>
                               
<!-- deleting categories -->               
                           
    <?php delete_catgeory(); ?>                       
                           
        </tbody>       
    </table>
</div>
                                      
<!--ending of table showing and deleting -->
                  
                  </div>              
              </div>
            <!-- Page Title Header Starts-->
             <div class="row page-title-header">
              </div>
          <!-- content-wrapper ends -->
<?php include "includes/admin_footer.php"; ?>      
            <!-- partial:partials/_footer.html -->
      