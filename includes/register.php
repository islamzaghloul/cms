<?php include "db.php"; ?>
<?php
include "PHPMailer/src/PHPMailer.php";
include "PHPMailer/src/Exception.php";
include "PHPMailer/src/SMTP.php";
require 'c:\xampp\composer\vendor\autoload.php';
    ?>
<!DOCTYPE html>
<html lang="en">
    
    <?php 
    if(isset($_POST['submit']))
    {
        
        
     $username=$_POST['user'];
     $firstname=$_POST['fnamee'];
     $secondname=$_POST['sname'];
     $userrole=$_POST['role'];
     $newemail=$_POST['mail'];
     $password=$_POST['pass'];
     $passcon=$_POST['conpass'];
        

if(!empty($username) && !empty($newemail) && !empty($password) && !empty($passcon) && !empty($firstname) && !empty($secondname) && !empty($userrole))
{  
    if(strlen($username)<8 && strlen($password)<8)
    {
    $message="user and password  must be more than 8 char";

    }
    else
    {
 
       if(filter_var($newemail,FILTER_VALIDATE_EMAIL)==FALSE)
        {
        $message="email adress not valid ";
        }
        else 
        {
             $ch="SELECT  * FROM users WHERE user_email = '{$newemail}'";
             $chremail=mysqli_query($connection,$ch);
             $result=mysqli_num_rows($chremail);
            
             $chuser="SELECT  * FROM users WHERE username = '{$username}'";
             $chhh=mysqli_query($connection,$chuser);
             $res=mysqli_num_rows($chhh);
            if($result > 0 || $res > 0 )
            {
            $valid= " this email or user  already used try another one ";
            }
            else
            { 
            
        
     
                    if($password!==$passcon) 
                    {
                        $message="the two password not equal";  
                    }
                    else{
                
             
         
                    $username= mysqli_real_escape_string($connection,$username);
                    $firstname= mysqli_real_escape_string($connection,$firstname);
                    $secondname= mysqli_real_escape_string($connection,$secondname);
                    $userrole= mysqli_real_escape_string($connection,$userrole);
                    $newemail= mysqli_real_escape_string($connection,$newemail);
                    $password= mysqli_real_escape_string($connection,$password);
                    $passcon= mysqli_real_escape_string($connection,$passcon);
     
                    $password=password_hash($password,PASSWORD_BCRYPT,array('cost'=>10));
    // btgeb randsalt mn database bs 
      //  $qQQuery="SELECT randsalt FROM users";
    //    $quersucess=mysqli_query($connection,$qQQuery); 
      //  $row=mysqli_fetch_array($quersucess);
        //  $rand= $row['randsalt'];
        //$password=crypt($password,$rand);
             
         
    // bn3ml add ll new user goa el database 
        $query1="INSERT INTO users (username,
        user_email,
        user_firstname,
        user_lastname,
        user_password,
        user_role) VALUES ('{$username}',
        '{$newemail}',
        '{$firstname}',
        '{$secondname}',
        '{$password}',
        '{$userrole}')";
                    $newuser=mysqli_query($connection,$query1);
                
                    
                    
    
                    $message="check your email to confirm registering ";
                
                    $selector=bin2hex(random_bytes(8));
                    $token = random_bytes(32);
                    $url="http://localhost/cms/includes/validate-regesiter.php?selector1={$selector}&validator1=".bin2hex($token)."&user={$username}&role={$userrole}&mail=$newemail";
                    $expire=date("u")+1800;
        
      
         
        
                    $query2="DELETE FROM resetpass WHERE reset_email ='{$newemail}'  ";
                    $delete=mysqli_query($connection,$query2);
        //CHECK FOR email and requesting 
                    if(!$delete )
                    {
                        echo " there is an error";
                    }
                    else 
                    {
                        $hashed=password_hash($token,PASSWORD_DEFAULT);
                        $qquery="INSERT INTO resetpass (reset_email,reset_selector,reset_token,reset_expire)
                        VALUES ('$newemail','$selector','$hashed','$expire')";
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


                        $email ->addAddress($newemail,$newemail);

                        $email ->Subject='VALIDATE';

                        $email ->Body='we receive request to validate your account click here to valide: <a href="'.$url.'">'.$url.'</a>';

                        $email ->send();


                    }
               
            }//end of else of two passwords
            }//end of else of email repeating validation
        }//end of validation of gmail
    }//end of username validation
}//end of empty fields 
else 
{
    $message="fields cannot be empty";
}
    }//end of isset submitt 
    
    else 
    {
$message=" ";
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
              <h2 class="text-center mb-4">Register</h2>
              <div class="auto-form-wrapper">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                     <h5 class="text-center"> <?php if(isset( $message)) { echo  $message; }?></h5>
                
                      <div class="form-group">
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
                      <input type="text" class="form-control" placeholder="firstname" name="fnamee">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                      </div>
 
                      <div class="form-group">
                      <div class="input-group">
                      <input type="text" class="form-control" placeholder="secondname" name="sname">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                      </div>
                      
                          <div class="form-group">
                      <div class="input-group">
                    <select name="role" id="" >
                    <option value="">select option</option>
                    <option value="admin">admin</option>
                    <option value="subscriber">subscriber</option>
                    
                    </select>
                    
                    </div>
                      </div>
 
                      
                  </div>
                    
                    <div class="form-group">    
                    <div class="input-group">
    <input type="email" class="form-control" name="mail" placeholder="example@gmail.com">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                    <h5 class="text-center"> <?php if(isset($valid)){ echo  $valid ; }?></h5>
                  
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
                    <input class="btn btn-primary submit-btn btn-block" name="submit" type="submit" value="Register">
                  </div>
                    
                  <div class="text-block text-center my-3">
                    <span class="text-small font-weight-semibold">Already have and account ?</span>
                    <a href="login-page.php" class="text-black text-small">Login</a>
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