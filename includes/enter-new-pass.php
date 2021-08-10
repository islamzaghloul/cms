<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
    <?php 
    if(isset($_GET['selector']) && isset($_GET['validator']))
    { $message="";
    
        $selector=$_GET['selector'];
        $validator=$_GET['validator'];
     //check for hex of selector and validator 
     if(ctype_xdigit($selector)!==false && ctype_xdigit($validator)!==false)
     {
         
     }
    }
    else
    {
        echo "can not validate your request";
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
              <h2 class="text-center mb-4">new password</h2>
              <div class="auto-form-wrapper">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                     <h5 class="text-center"> <?php echo  $message; ?></h5>
                  </div>
                      <?php 
    if(isset($_GET['selector']) && isset($_GET['validator']))
    { $message=" ";
    
        $selector=$_GET['selector'];
        $validator=$_GET['validator'];
     if(ctype_xdigit($selector)!==false && ctype_xdigit($validator)!==false)
     {
       ?>
                <div class="form-group">    
                  <div class="input-group">
                    <input type="text" class="form-control" name="mail"  placeholder="example@gmail.com">
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
           <div class="input-group">
               <input type="password" class="form-control" placeholder="Confirm Password" name="conpass">
                <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                </div>
            </div>
        </div>
                  <div class="form-group d-flex justify-content-center">
                  
                  </div>
                    
        <div class="form-group">
            <input class="btn btn-primary submit-btn btn-block" name="submittt" type="submit" value="Reset password">
        </div>
                    <a href="login-page.php"
     <?php 
         if(isset($_POST['submittt']))
         { 
            
            $email=$_POST['mail'];
             $pass=$_POST['pass'];
             $conpass=$_POST['conpass'];
         $currentdate=date("U");
        $query="SELECT * FROM resetpass WHERE reset_expire >='{$currentdate}' AND reset_selector='{$selector}'";
         $gett=mysqli_query($connection,$query);
         $row=mysqli_fetch_assoc($gett);
         $dpmail=$row['reset_email'];
         $dptokenn=$row['reset_token'];
            if($dpmail==null &&$dptokenn == null)
            {
                header("location:login-page.php?request=failed");
            }
      
             //validate token  (validator )
         if(!password_verify(hex2bin($validator),$dptokenn))
         {
             echo " cannot approve your request";
         }
             // continue executing 
         else
         {
             if(empty($pass) || empty($conpass))
             {
                echo "enter the password please";
             }
             else if($pass!== $conpass)
             {
                 echo  "the two passwords not the same ";
             }
             else
             {
                 $password=password_hash($pass,PASSWORD_BCRYPT,array('cost'=>10));
                 $upquery="UPDATE users SET user_password='{$password}' WHERE user_email='{$email}'";
                 $updatenew=mysqli_query($connection,$upquery);
                 if(!$updatenew)
                 {
                     echo "try again later";
                 }
                 else
                 {
                     echo "the password reseted";
                     echo "<a href='login-page.php'>go to login</a>";
                     
                 }
             }
                 
                 
        
            
                    
         }
             
         }
//end check on hex of validator and selector
     }
    }
    else
    {
        echo "can not validate your request";
    }
        
     ?>
   
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