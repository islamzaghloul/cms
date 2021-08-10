<?php include "db.php"; ?>
<div class="col-md-4">

       
          
        <!-- Search Widget -->
          <form action="search.php" method="post">
                <div class="card my-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                <div class="input-group">
                <input name="search" type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit" name="submit">Go!</button>
              </span>
            </div>
          </div>
        </div>
              </form>
    
    
    
    
    
    
    <form action="includes/login.php" method="post">
                <div class="card my-4">
                <h5 class="card-header">login AS  admin </h5>
                <div class="card-body">
                    
                <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="username">
                    <br>
                    </div>
                   
                    <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="password">
                        </div>
                    
              <span class="form-group">
                <button class="btn btn-secondary" type="submit" name="login">login</button>
              </span>
            </div>
          </div>
        
              </form>
    


        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                    
        <?php
            $query="SELECT * FROM categories";
            $categories=mysqli_query($connection,$query);
            
            while($row=mysqli_fetch_assoc($categories))
            {   $cat_tit=$row['cat_tit'];
              
                echo "<li><a href='category.php?category=$cat_tit'>{$cat_tit}</a></li>";
            }
    ?>
            
                </ul>
              </div>
              </div>
            </div>
         
        </div>

        <!-- Side Widget -->
         
      </div>
