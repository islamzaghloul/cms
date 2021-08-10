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
          
if(isset($_GET['edit']))
{
$user_id=$_GET['edit'];
$query="SELECT * from users WHERE user_id ={$user_id}";
$edit=mysqli_query($connection,$query);        
    while($row=mysqli_fetch_assoc($edit))               
     {
                $user_id=$row['user_id'];
                $username=$row['username'];
                $password=$row['user_password'];
                $firstname=$row['user_firstname'];
                $lastname=$row['user_lastname'];
                $email=$row['user_email'];
                $user_role=$row['user_role'];
                //$randsalt=$row['randsalt'];
                //$post_date=$row['post_date'];
                //$post_content=$row['post_content'];  
    }
}
          
 if(isset($_POST['edit_user']))
 {
      $username=$_POST['username'];
      $password=$_POST['password'];
      $firstname=$_POST['firstname'];
      $lastname=$_POST['lastname'];
      $email=$_POST['email'];
     
      $user_role=$_POST['user_role'];
      //$randsalt=$_POST['randsalt'];
      //$post_date=date('d-m-y');
      //$post_comment_count=4;
         $image=$_FILES['user_image']['name'];
     $image_tmp=$_FILES['user_image']['tmp_name'];
     $imsize=$_FILES['user_image']['size'];
     $imerror=$_FILES['user_image']['error'];
     $imtype=$_FILES['user_image']['type'];
     if(!empty($username) && !empty($password) && !empty($firstname) && !empty($lastname) && !empty($email) && !empty($image) && !empty($user_role))
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
 
        
     $hhpassword=password_hash($password,PASSWORD_BCRYPT,array('cost'=>10));
     $nquery="UPDATE users SET username='{$username}',
     user_password='{$hhpassword}',
     user_firstname='{$firstname}',
     user_lastname='{$lastname}',
     user_email ='{$email}',
     user_role='{$user_role}',
     user_image='{$newname}'
      WHERE user_id = {$user_id}"; 
    
     $edituser=mysqli_query($connection,$nquery);
 }}}}}
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
                <label for="username">user name</label>
                <input type="text" class="form-control" name="username" value="<?php if(isset($username)){echo $username;}?>">  
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
                 
                 <div class="form-group">
                <label for="email">email</label>
                <input type="text" class="form-control"  name="email" value="<?php if(isset($email)){echo $email;}?>">  
                </div>
                 
            
          <div class="form-group">
                 <label for="user_role">role</label>
                 <br>
                 <select name= "user_role" id="">
                    <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
                    
                     <?php if($user_role=='subscriber')
                            {
                                echo "<option value='admin'>admin</option>";
                            }
                            else if($user_role=='admin')
                            {
                               echo "<option value='subscriber'>subscriber</option>"; 
                            }
                     else{
                           echo "<option value='subscriber'>subscriber</option>"; 
                                 echo "<option value='admin'>admin</option>";
                     }
                     
                     ?>
                 </select>
             </div>
              
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="edit_user" value="edit user">
                </div>
            </form>
              
</div>         
        
              
            <!-- Page Title Header Starts-->
             <div class="row page-title-header">
              </div>
          <!-- content-wrapper ends -->
<?php include "includes/admin_footer.php"; ?>      
            <!-- partial:partials/_footer.html -->
      