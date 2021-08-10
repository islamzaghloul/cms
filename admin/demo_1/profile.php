<?php include "includes/db.php";?>
<?php include "includes/admin_header.php";?>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
<?php include "includes/admin_navigation.php";?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
<?php include "includes/admin_sidebar.php";?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">             
            <div class="row">
             <div class="col-lg-12">
                 <h1 class="page-header">
                 welcome to admin
                 <small>author</small>
                 </h1> 
 <?php
        if(isset($_SESSION['username'])) 
        {
    $user_namee=$_SESSION['username'];
              
$equery="SELECT * from users WHERE username ='{$user_namee}'";
$pro=mysqli_query($connection,$equery);        
    while($rrow=mysqli_fetch_array($pro))               
     {
                $user_id=$rrow['user_id'];
                $username=$rrow['username'];
                $password=$rrow['user_password'];
                $firstname=$rrow['user_firstname'];
                $lastname=$rrow['user_lastname'];
                $email=$rrow['user_email'];
                $user_role=$rrow['user_role'];
               
                //$post_date=$row['post_date'];
                //$post_content=$row['post_content'];  
    }
         }        
                 
                 
                 
    if(isset($_POST['edit_profile']))
 {
      $username=$_POST['username'];
      $password=$_POST['password'];
      $firstname=$_POST['firstname'];
      $lastname=$_POST['lastname'];
      $email=$_POST['email'];
      $user_role=$_POST['userrole'];    
   
        
      $image=$_FILES['user_image']['name'];
      $image_tmp=$_FILES['user_image']['tmp_name'];
     $imsize=$_FILES['user_image']['size'];
     $imerror=$_FILES['user_image']['error'];
     $imtype=$_FILES['user_image']['type'];
     
     $fileext=explode('.',$image);
     $actulext=strtolower(end($fileext));
     $allowed= array('jpg','jpeg','png','pdf');
     if(!in_array($actulext,$allowed))
     {
         $message="this image type not allowed";
     }
     else
     {
         if($imerror!==0)
         {
             $message =" there is an error";
         }
         else
         {
            if($imsize>10000000)
            {
                $message="this file is to big cannot be uploaded";
            }
             else
             {
        $newname=uniqid('',true).".".$actulext;
             
        
     move_uploaded_file($image_tmp,"../../images/$newname");
     $_SESSION['image']=$newname;

      //$post_date=date('d-m-y');
      //$post_comment_count=4;
     //move_uploaded_file($post_image_tmp,"../images/$post_image");
if(!empty($username) && !empty($password) && !empty($firstname) && !empty($lastname) && !empty($email)  && !empty($image) && !empty($user_role) )
{    
    $password=password_hash($password,PASSWORD_BCRYPT,array('cost'=>10));    
     if(strlen($username>8))
     {
        echo " username cannot be less than 8 litters"; 
     }
    else{
        if(filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE)
        {
        $message="email adress not valid ";
        }
        else 
        {
        $ch="SELECT  * FROM users WHERE user_email = '{$email}'";
             $chremail=mysqli_query($connection,$ch);
             $result=mysqli_num_rows($chremail);
            
             $chuser="SELECT  * FROM users WHERE username = '{$username}'";
             $chhh=mysqli_query($connection,$chuser);
             $res=mysqli_num_rows($chhh);
            //if($result > 0 || $res > 0 )
            //{
            //$valid= " this email or user  already used try another one ";
            //}
            //else
            //{ 
                     $nquery="UPDATE users SET username='{$username}',
                     user_password='{$password}',
                     user_firstname='{$firstname}',
                     user_lastname='{$lastname}',
                     user_email ='{$email}',
                     user_role='{$user_role}' ,
                     user_image='{$newname}'  WHERE user_id ='{$user_id}'"; 

                     $edituser=mysqli_query($connection,$nquery);
            //}
        }
    }
    }//end of empty check
    else {
        $message="please fill all fields";
    }             
        }}}}
                 ?>

        <div class="main-panel">
          <div class="content-wrapper">
              <div class="col-sm-6">         
            <form action="" method="post" enctype="multipart/form-data">
                 
                <div class="form-group">
                <label for="username">user name</label>
                <input type="text" class="form-control" name="username" value="<?php if(isset($username)){echo $username;}?>">  
                </div>     
                 
      <div class="form-group">
                 <label for="userrole">role</label>
                 <br>
                 <select name= "userrole" id="">
                    <option value=""><?php echo $user_role; ?></option>
                    
                     <?php if($user_role=='subscriber')
                            {
                                echo "<option value='admin'>admin</option>";
                            }
                            else if($user_role=='admin')
                            {
                               echo "<option value='subscriber'>subscriber</option>"; 
                            }
                            else
                            {
                               echo "<option value='admin'>admin</option>";
                               echo "<option value='subscriber'>subscriber</option>"; 
                            }
                     
                     ?>
                 </select>
             </div>
              
        
                 
                <div class="form-group">
                <label for="password">password</label>
                <input type="password" class="form-control" name="password" value="">  
                </div>     
                 
                <div class="form-group">
                <label for="firstname">first name </label>
                <input type="text" class="form-control" name="firstname" value="<?php if(isset($firstname)){echo $firstname;}?>">  
                </div>
                
                <div class="form-group">
                <label for="lastname">last name </label>
                <input type="text" class="form-control" name="lastname" value="<?php if(isset($lastname)){echo $lastname;}?>">  
                </div>
                
                 <div class="form-group">
                <label for="user_image">user image</label>
                <input type="file" name="user_image">  
                </div>
                     <h5><?php if(isset($message)) {echo $message; }  ?>       </h5>
                 
                 <div class="form-group">
                <label for="email">email</label>
                <input type="text" class="form-control"  name="email" value="<?php if(isset($email)){echo $email;}?>">  
                </div>
                 
           
                
               
                
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="edit_profile" value="edit profile">
                </div>
            </form>
        
                </div>
              </div>    
                 
            <!-- Page Title Header Starts-->
             <div class="row page-title-header">
              </div>
          <!-- content-wrapper ends -->
<?php include "includes/admin_footer.php"; ?>      
            <!-- partial:partials/_footer.html -->
      