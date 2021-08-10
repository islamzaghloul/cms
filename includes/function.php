<?php 
include "db.php";
function check_user($user,$mail)
{
    $query="SELECT  * users where username = '$user'";
    $squery="SELECT  * users where user_email = '$mail'";
    $chuser=mysqli_query($connection,$query);
    $chmail=mysqli_query($connection,$squery);
    if(mysqli_num_rows($chuser)>0)
    {
        echo "this user is already used try another one";
    }
    else if (mysqli_num_rows($chmail)>0)
    {
        echo "this mail is already exist try another on or login with this ";
    }
        

    
}

function vali_mail($re_mail)
{if(isset($re_mail))
  {  
     $query="SELECT  * users where user_email = '$re_mail'";
      $chremail=mysqli_query($connection,$query);
    if(isset($chremail))
    {
        if(mysqli_num_rows($chremail)!==null)
        {
            echo "this email not exist on our system";
        }
       
    }
}}
?>