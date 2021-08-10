<?php include "db.php"; ?> 
<?php include "function.php"; ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<?php
include "PHPMailer/src/PHPMailer.php";
include "PHPMailer/src/Exception.php";
include "PHPMailer/src/SMTP.php";
require 'c:\xampp\composer\vendor\autoload.php';
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
    <?php 
    if(isset($_POST['reset']))
    {
        
        $resetemail=$_POST['mail'];
        if(isset($resetemail))
        {
            //validate email form
    if(filter_var($resetemail,FILTER_VALIDATE_EMAIL)==FALSE)
    {
        $message="email adress not valid ";
    
    }else
    {
        //valiate email avilabilty 
      $ch="SELECT  * FROM users WHERE user_email = '{$resetemail}'";
      $chremail=mysqli_query($connection,$ch);
        $result=mysqli_num_rows($chremail);
        
        if($result==0)
        {
            $valid= " this email cannot be found please try again";
           
        }else
        {
            
        $selector=bin2hex(random_bytes(8));
        $token = random_bytes(32);
        $url="http://localhost/cms/includes/enter-new-pass.php?selector={$selector}&validator=".bin2hex($token);
        $expire=date("u")+1800;
        
      
         
        
        $query="DELETE FROM resetpass WHERE reset_email ='{$resetemail}'  ";
        $delete=mysqli_query($connection,$query);
        //CHECK FOR email and requesting 
        if(!$delete )
        {
            echo " there is an error";
        }
        else 
        {
            $hashed=password_hash($token,PASSWORD_DEFAULT);
            $qquery="INSERT INTO resetpass (reset_email,reset_selector,reset_token,reset_expire)
            VALUES ('$resetemail','$selector','$hashed','$expire')";
            $insert=mysqli_query($connection,$qquery);
            
            
    $email  = new PHPMailer\PHPMailer\PHPMailer();
    $email ->isSMTP();
    $email ->SMTPAuth=true;
    $email ->SMTPSecure='ssl';
    $email ->Host = 'smtp.gmail.com';
    $email ->Port ='465';
    $email ->isHTML();
    $email ->Username='workf2135@gmail.com';
    $email ->Password='01156888380';
    $email -> setFrom('workf2135@gmail.com','cms');
    
    
    $email ->addAddress($resetemail,$resetemail);
        
    $email ->Subject='reset';
    
    $email ->Body='we receive request to reset password if you like to reset clik on this link: <a href="'.$url.'">'.$url.'</a>';
    
    $email ->send();

     
        }
    }
            
            
        }

        }
    }else 
    {
       
    }
 
    
    ?>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
              <h2 class="text-center mb-4">reset password</h2>
              <div class="auto-form-wrapper">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                     <h5 class="text-center"> <?php if(isset($message)){ echo  $message; }?></h5>
                    <h4 class="text-center"> you will recive link to reset pass on mail </h4>
                      <div class="input-group">
                      <input type="text" class="form-control" placeholder="email" name="mail">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                          
                      </div>
                          
                    </div>
                  </div>
                    <h5 class="text-center"> <?php if(isset($valid)){ echo  $valid ; }?></h5>
                    
 
      
       
           
                    
                  <div class="form-group">
                    <input class="btn btn-primary submit-btn btn-block" name="reset" type="submit" value="reset">
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