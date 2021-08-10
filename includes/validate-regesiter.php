<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
 
    
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
              <h2 class="text-center mb-4">valiate</h2>
              <div class="auto-form-wrapper">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                     <h5 class="text-center"> <?php if(isset($message )){echo  $message; }?></h5>
                  </div>
                      <?php 
    if(isset($_GET['selector1']) && isset($_GET['validator1']))
    { $message=" ";
    
        $selector=$_GET['selector1'];
        $validator=$_GET['validator1'];
     if(ctype_xdigit($selector)!==false && ctype_xdigit($validator)!==false)
     {
       ?>
                
                    
        <div class="form-group">
            <input class="btn btn-primary submit-btn btn-block" name="submit2" type="submit" value="confirm regeister">
        </div>
                   
     <?php 
         if(isset($_POST['submit2']))
         { 
            
            
         $currentdate=date("U");
        $query="SELECT * FROM resetpass WHERE reset_expire >='{$currentdate}' AND reset_selector='{$selector}'";
         $gett=mysqli_query($connection,$query);
         $row=mysqli_fetch_assoc($gett);
         $dpmail=$row['reset_email'];
         $dptokenn=$row['reset_token'];
            if($dpmail==null &&$dptokenn == null)
            {
                header("location:register.php?request=failed");
            }
      
             //validate token  (validator )
         if(!password_verify(hex2bin($validator),$dptokenn))
         {
             echo " cannot approve your request";
         }
             // continue executing 
         else
         {
                 $user=$_GET['user'];
                 $role=$_GET['role'];
                 $mail=$_GET['mail'];
        $_SESSION['username']=$user;
        $_SESSION['userrole']=$role;
        $_SESSION['mail']=$mail;
             $query="UPDATE users SET valide ='yes' WHERE username='{$user}' ";
             $valide=mysqli_query($connection,$query);
        
              echo "your account is valide now ";
              echo "<a href='login-page.php'>go to login</a>";
                     
                 
         }
                 
                 
        
            
                    
         }
             
         }
//end check on hex of validator and selector
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