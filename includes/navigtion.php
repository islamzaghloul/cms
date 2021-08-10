<?php include "db.php"; ?>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">home</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          
            
        
            <li class="nav-item">
            <a class="nav-link" href="admin/demo_1/admin.php">Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="includes/register.php">registeration</a>
          </li>
          <?php 
            if(isset($_SESSION['username']))
            { 
                echo $_SESSION['username'];
                if(isset($_GET['p_id']))
                {
                    $theid =$_GET['p_id'];
                    
                    echo "   
                    <li class='nav-item'>
              <a class='nav-link' href='../admin/demo_1/edit_post.php?p_id={$theid}'>edit post</a>
          </li>";
                    
                    
                }
                
            }
            ?>
            

        </ul>
      </div>
    </div>
  </nav>