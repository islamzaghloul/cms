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

                 <table class="table">
                      <thead>
                        <tr>
                          <th>id</th>  
                          <th>username</th>
                            <th>firstname</th>
                            <th>lastname</th>
                            <th>email</th>
                            <th>image</th>
                            <th>role</th>
                            
                        </tr>  
                      </thead>
                        
                        <tbody>
    <?php                        
        $query="select * from users";               
        $users=mysqli_query($connection,$query);
            
    while($row=mysqli_fetch_assoc($users))               
     {
                $user_id=$row['user_id'];
                $username=$row['username'];
                $firstname=$row['user_firstname'];
                $lastname=$row['user_lastname'];
                $email=$row['user_email'];
                $image=$row['user_image'];
                $role=$row['user_role'];
        
        
                echo "<tr>";
                echo "<td>{$user_id}</td>";
                echo "<td>{$username}</td>";
                echo "<td>{$firstname}</td>";
                echo "<td>{$lastname}</td>";
                echo "<td>{$email}</td>";
                echo "<td><img src='../../images/{$image}'></td>";
                echo "<td>{$role}</td>";
                
                
 echo "<td><a href='users.php?delete= {$user_id}'>delete</a></td>";
 echo "<td><a href='edit_user.php?edit= {$user_id}'>edit</a></td>";
 echo "<td><a href='users.php?admin= {$user_id}'>admin</a></td>";
 echo "<td><a href='users.php?subscriber= {$user_id}'>subscriber</a></td>";
                echo "</tr>";
      }
  if(isset($_GET['delete']))
     { if(isset($_SESSION['userrole']))
     { if($_SESSION['userrole']=='admin')
     {
         $user_id=$_GET['delete'];
         $query ="DELETE FROM users WHERE user_id ={$user_id}";
         $delete_user=mysqli_query($connection,$query);
         header("location:users.php");
     }}}
                            
if(isset($_GET['admin']))                     
{
  $id=$_GET['admin'];
$newquery="UPDATE users SET user_role='admin' WHERE user_id = {$id}";
$update=mysqli_query($connection,$newquery);
    header("location:users.php");
}
 if(isset($_GET['subscriber']))
{
$iid=$_GET['subscriber'];
$upquery="UPDATE users SET user_role='subscriber' where user_id ={$iid}";
$uupdate=mysqli_query($connection,$upquery);
header("location:users.php");
     
}
  

                              
?>
                        </tbody>
                 
                 
                    </table>
                 
                </div>
              </div>    
                 
            <!-- Page Title Header Starts-->
             <div class="row page-title-header">
              </div>
          <!-- content-wrapper ends -->
<?php include "includes/admin_footer.php"; ?>      
            <!-- partial:partials/_footer.html -->
      