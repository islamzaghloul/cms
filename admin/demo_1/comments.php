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
                            <th>postid</th>
                          <th>author</th>
                            <th>email</th>
                            <th>comment</th>
                            <th>status</th>
                            <th>date</th>
                            <th>in response to</th>
                            <th>delete</th>
                            <th>approved</th>
                            <th>unapproved</th>
                            
                        </tr>  
                      </thead>
                        
                        <tbody>
    <?php                        
        $query="select * from comments";               
        $posts=mysqli_query($connection,$query);
            
    while($row=mysqli_fetch_assoc($posts))               
     {
                $comment_id=$row['comment_id'];
                $comment_post_id=$row['comment_post_id'];
                $comment_author=$row['comment_author'];
                $comment_email=$row['comment_email'];
                $comment_content=$row['comment_content'];
                $comment_status=$row['comment_status'];
                $comment_date=$row['comment_date'];
        
                echo "<tr>";
                echo "<td>{$comment_id}</td>";
                echo "<td>{$comment_post_id}</td>";
                echo "<td>{$comment_author}</td>";
                echo "<td>{$comment_email}</td>";
                echo "<td>{$comment_content}</td>";
                echo "<td>{$comment_status}</td>";
                echo "<td>{$comment_date}</td>";
        $query="select * from posts where post_id=$comment_post_id";
        $response=mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($response))
        {
            $post_id=$row['post_id'];
            $post_title=$row['post_title'];
            echo "<td><a href='../../post.php?p_id=$post_id'>{$post_title}</a></td>";
        }
                
        echo "<td><a href='comments.php?delete= {$comment_id}'>delete</a></td>"; 
        echo "<td><a href='comments.php?approve= {$comment_id}'>approve</a></td>";  
        
    echo "<td><a href='comments.php?unapprove={$comment_id}'>unapprove</a></td>";  
    
                echo "</tr>";
      }
  
                            
     if(isset($_GET['approve']))
     {
         $post_id=$_GET['approve'];
         $query ="UPDATE comments SET comment_status='approve' WHERE comment_id ={$comment_id}";
         $delete_post=mysqli_query($connection,$query);
         header("location:comments.php");
     }
                            
    if(isset($_GET['unapprove']))
     {
         $post_id=$_GET['unapprove'];
         $query ="UPDATE comments SET comment_status='unapprove' WHERE comment_id ={$comment_id}";
         $delete_post=mysqli_query($connection,$query);
         header("location:comments.php");
     }
                            
    if(isset($_GET['delete']))
     {
         $post_id=$_GET['delete'];
         $query ="DELETE FROM comments WHERE comment_id ={$comment_id}";
         $delete_post=mysqli_query($connection,$query);
         header("location:comments.php");
         $query_count="update posts set post_comment_count=post_comment_count-1 where post_id = $comment_post_id";
     $counter=mysqli_query($connection,$query_count);
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
      