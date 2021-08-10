<?php include "db.php"; ?>        
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
    <?php 
  


  if(isset($_POST['submitt']))
    {

   
     $username=$_POST['user'];
     $password=$_POST['pass'];
    
    $usename=mysqli_real_escape_string($connection,$username);
    $password=mysqli_real_escape_string($connection,$password);
    if(!empty($username) && !empty($password))
    {
        if(strlen($username)<8)
        {
           $message="username cannot be less than 8"; 
        }
        else
        {
            //$message="";
    $query="select * from users where username = '{$username}'";
    $get=mysqli_query($connection,$query);
    while ($row=mysqli_fetch_array($get))
    {
     $id=$row['user_id'];
     $dbusername=$row['username'];
     $mail=$row['user_email'];    
     $dbpassword=$row['user_password'];
     $userrole=$row['user_role'];    
         
    }
   // $password=crypt($password,$dbpassword);
    
   
     if(password_verify($password,$dbpassword))
    {
        header("location:../admin/demo_1/admin.php");
        $_SESSION['username']=$dbusername;
        $_SESSION['userrole']=$userrole;
        $_SESSION['mail']=$mail;
        
    }
    else {$message="username or password is wrong";   }
    }}
      else{
          $message="fields cannot be empty";
      }
}
    else
    {
       // $message=" ";
    }
        ?>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin Premium Bootstrap Admin Dashboard Template</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../admin/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
      
    <link rel="stylesheet" href="../admin/assets/vendors/iconfonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="../admin/assets/vendors/iconfonts/typicons/src/font/typicons.css">
    <link rel="stylesheet" href="admin/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../admin/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../admin/assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../admin/assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../admin/assets/css/demo_1/style.css">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="../admin/assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
              <h2 class="text-center mb-4">Login</h2>
              <div class="auto-form-wrapper">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                      <h5 class="text-center"> <?php if(isset($message)){ echo  $message; }?></h5>
                     <h5 class="text-center"> <?php 
if(isset($_GET['request']))
{
    echo " failed to reset password try again or try to login";
} ?></h5>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Username" name="user">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                    
 
                  <div class="form-group">
                    <div class="input-group">
    <input type="password" class="form-control" name="pass" placeholder="Password">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                    </div>
       
           
                    
                  <div class="form-group">
                    <input class="btn btn-primary submit-btn btn-block" name="submitt" type="submit" value="login">
                  </div>
                    
                    <div class="text-block text-center my-3">
                    <span class="text-small font-weight-semibold">forget pssword ?</span>
                    <a href="reset-password.php" class="text-black text-small">reset</a>
                  </div>
                 
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../admin/assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="../admin/assets/js/shared/off-canvas.js"></script>
    <script src="../admin/assets/js/shared/misc.js"></script>
    <!-- endinject -->
  </body>
</html>