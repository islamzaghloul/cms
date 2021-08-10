<?php include "db.php";
$user=$_SESSION['username'];
$query="SELECT user_image FROM users WHERE username='{$user}'";
$done=mysqli_query($connection,$query);
$im=mysqli_fetch_assoc($done);
//$image=$im[]

?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            
       <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
              <div class="profile-image">
              <img class="img-xs rounded-circle" src="../assets/images/faces/face9.jpg" alt="profile image">
              <div class="dot-indicator bg-success"></div>
              </div>
                 
              <div class="text-wrapper">
              <p class="profile-name"><?php echo $_SESSION['username'] ?></p>
        
             </div>
              </a>
        </li>
            
            
            <li class="nav-item nav-category">Main Menu</li>
            <li class="nav-item">
              <a class="nav-link" href="admin.php">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon typcn typcn-coffee"></i>
                <span class="menu-title">posts</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="posts.php">All posts</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="add_post.php">add new post</a>
                  </li>
                 
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="categories.php">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">categories</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="comments.php">
                <i class="menu-icon typcn typcn-th-large-outline"></i>
                <span class="menu-title">Comments</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile.php">
                <i class="menu-icon typcn typcn-bell"></i>
                <span class="menu-title">profile</span>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="add_user.php"> add new user </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="users.php"> all users </a>
                  </li>
                  
                </ul>
              </div>
            </li>
          

            <li class="nav-item">
                <div class="fixed-bottom">
              <a class="nav-link" href="includes/out.php">
                <i class="menu-icon typcn typcn-bell"></i>
                <span class="menu-title">logout</span>
              </a>
                    </div>
            </li>
           
            
          </ul>
        </nav>
        