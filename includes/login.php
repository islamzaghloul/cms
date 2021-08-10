<?php include "db.php"; ?>
<?php session_start(); ?>

<?php



if(isset($_POST['login']))
{
   
     $username=$_POST['username'];
     $password=$_POST['password'];
    
    $usename=mysqli_real_escape_string($connection,$username);
    $password=mysqli_real_escape_string($connection,$password);
    
    $query="select * from users where username = '{$username}'";
    $get=mysqli_query($connection,$query);
    while ($row=mysqli_fetch_array($get))
    {
     $id=$row['user_id'];
     $dbusername=$row['username'];
     $mail=$row['user_email'];    
     $dbpassword=$row['user_password'];
     $userrole=$row['user_role'];
     $vali=$row['valide'];   
         
    }
   // $password=crypt($password,$dbpassword);
    
   
     if(password_verify($password,$dbpassword))
    { //$query="select *  from users where username='{$dbusername}'";
     //$chvalide=mysqli_query($connection,$query);
     //$row=mysqli_fetch_assoc($chvalide);
     $action= "no";
     if($vali == $action)
     {
        echo " cannot login your account not validated"; 
     }
     else 
     {
         if($userrole=="subscriber")
         {
             echo " you are only subscriber cannot access admin ";
         }
         else
         {
     
        header("location:../admin/demo_1/admin.php");
        $_SESSION['username']=$dbusername;
        $_SESSION['userrole']=$userrole;
        $_SESSION['mail']=$mail;
        }}
    }
    else {header("location:../index.php");}
    
}  