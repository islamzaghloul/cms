<?php ob_start(); ?> 
<?php  session_start();   ?>

<?php 
if(!isset($_SESSION['userrole']))
{
   header("location:../../index.php"); 
}

?>
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-left">
            
           
          <a class="align-middle navbar-brand brand-logo" href="#">--
            <?php echo $_SESSION['username'] ?></a>
  
        </div>
          <div class="navbar-menu-wrapper d-flex align-items-center">
        
          <ul class="navbar-nav ml-auto">
              
              
                <li class="nav-item">
                    <a class="nav-link" href="../../index.php">home</a>
                </li>
              <li class="nav-item">
                  
                    <a class="nav-link" href="#">users online : <?php if(isset($_SESSION['counter'])){ echo $_SESSION['counter']; }?></a>
                </li>
              
            

            <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="../assets/images/faces/face8.jpg" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="../assets/images/faces/face8.jpg" alt="Profile image">
                  <p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION['username'] ?></p>
                  <p class="font-weight-light text-muted mb-0"><?php echo $_SESSION['mail'] ?></p>
                </div>
                <a href="../../../../cms/admin/demo_1/profile.php" class="dropdown-item">My Profile<i class="dropdown-item-icon ti-dashboard"></i></a>
                
                <a href="includes/out.php" class="dropdown-item">logout<i class="dropdown-item-icon ti-power-off"></i></a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>