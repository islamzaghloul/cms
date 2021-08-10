 <!-- editing category -->        
    <?php  
    if(isset($_GET['edit']))
    {
        $cat_id=$_GET['edit'];
        $query="select * from categories where cat_id=$cat_id";               
        $editcategories=mysqli_query($connection,$query);
            
        while($row=mysqli_fetch_assoc($editcategories))               
        {
                $cat_id=$row['cat_id'];
                $cat_tit=$row['cat_tit'];
    
    ?>
            <form action="" method="post">
                <div class="form-group">
                    <label>edit category</label> 
                   <input  value="<?php if(isset($cat_tit)) {echo $cat_tit;} ?>" type="text" class="form-control" name="title"> 
               </div>
                </form>
  <?php }
                if(isset($_POST['update']))
                {
                    $title=$_POST['title'];
                    echo $title;
                    $query="UPDATE categories SET cat_tit = '{$title}' WHERE cat_id ={$cat_id}";
                    $update=mysqli_query($connection,$query);  
                }
                         
    } ?>
            <!-- end of editing category -->
            <div class="col-sm-6">
                    
                   <form action="" method="post">
                        
                     
                       <div class="form-group"> 
                       <input class="btn btn-primary" type="submit" name="update" value="edit category"> 
                     </div>
                </form>
            </div>
   