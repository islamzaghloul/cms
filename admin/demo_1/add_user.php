<?php include "includes/admin_header.php";?>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
<?php include "includes/admin_navigation.php";?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
<?php include "includes/admin_sidebar.php";?>
        <!-- partial -->
<?php 
 if(isset($_POST['add_user']))
 {
       $username=$_POST['username'];
       $password=$_POST['user_password'];
      $firstname=$_POST['firstname'];
      $lastname=$_POST['lastname'];
      $email=$_POST['user_email']; 
       $role=$_POST['user_role'];

     
      //$randsalt=$_POST['randsalt'];
      //$post_date=date('d-m-y');
      //$post_comment_count=4;
     $image=$_FILES['user_image']['name'];
     $image_tmp=$_FILES['user_image']['tmp_name'];
     $imsize=$_FILES['user_image']['size'];
     $imerror=$_FILES['user_image']['error'];
     $imtype=$_FILES['user_image']['type'];
     
  
     
    
  

if(!empty($username) && !empty($password) && !empty($firstname) && !empty($lastname) && !empty($email) && !empty($image) && !empty( $role))
{     
      if(strlen($username)<8 && strlen($password)<8)
    {
    $message="user and password must be more than 8 char";

    }
    else
    {
 
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
            if($result > 0 || $res > 0 )
            {
            $message= " this email or user  already used try another one ";
            }
            else
            { 
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
             
        
    
         move_uploaded_file($post_image_tmp,"../../images/$newname");
        $password=password_hash($password,PASSWORD_BCRYPT,array('cost'=>10));
     $query="INSERT INTO users (username,user_password,user_firstname,user_lastname,user_email,user_image,user_role) VALUES ('{$username}','{$password}','{$firstname}','{$lastname}','{$email}','{$newname}','{$role}')";
     $insert=mysqli_query($connection,$query);
     confirm($insert);
        
     echo "user created :" ." " . "<a href='users.php'>view users </a>";
     
            }
        }
    }
}

}}
}else {
        $message="please fill all fields";
    }             
     
 }
?>          
        <div class="main-panel">
          <div class="content-wrapper">
              <div class="col-sm-6">         
            <form action="" method="post" enctype="multipart/form-data">
                 <h5 class="text-center"> <?php if(isset( $message)) { echo  $message; }?></h5>
                <div class="form-group">
                <label for="title">Username</label>
                <input type="text" class="form-control" name="username">  
                </div>     
                 
                                
            <!--      <div class="form-group">
                
                    <select id="" name="category">
                    
       // <?php  
                      
         //       $query="select * from categories";            
            //    $categories=mysqli_query($connection,$query);        
              //  while($row=mysqli_fetch_assoc($categories))      
                //{
                //$cat_id=$row['cat_id'];
                //$cat_tit=$row['cat_tit'];
      
                //echo "<option value='$cat_tit'>{$cat_tit}</option>";        
                //}
            //?>
                    </select>
              </div> -->
                <div class="form-group">
                <label for="post_status">password</label>
                <input type="password" class="form-control" name="user_password">  
                </div>
                 
                <div class="form-group">
                <label for="post_author">first name</label>
                <input type="text" class="form-control" name="firstname">  
                </div>     
                
                 
                
                <div class="form-group">
                <label for="post_status">last name</label>
                <input type="text" class="form-control" name="lastname">  
                </div>     
                 
                 <div class="form-group">
                <label for="post_image">image</label>
                <input type="file" name="user_image">  
                </div>
                 
                 <div class="form-group">
                <label for="post_tags">email</label>
                <input type="text" class="form-control"  name="user_email">  
                </div>
                
             <div class="form-group">
                 <label for="user_role">role</label>
                 <br>
                 <select name= "user_role" id="">
                    <option value="subscriber">select option</option>
                     <option value="subscriber">subscriber</option>
                     <option value="admin">admin</option>
             
                 </select>
                </div> 
                
           
                
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="add_user" value="add user">
                </div>
            </form>
                
</div>         
        
              
            <!-- Page Title Header Starts-->
             <div class="row page-title-header">
              </div>
          <!-- content-wrapper ends -->
<?php include "includes/admin_footer.php"; ?>      
            <!-- partial:partials/_footer.html -->
      