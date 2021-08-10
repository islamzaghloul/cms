<?php include "includes/admin_header.php";?>
<?php include "includes/db.php";?>
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
              
     <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container bootstrap snippets bootdey">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="panel panel-dark panel-colorful">
                <div class="panel-body text-center">
                	<p class="text-uppercase mar-btm text-sm">users</p>
                	<i class="fa fa-users fa-5x"></i>
                	<hr>
                    <?php
                    $query="select * from users";
                    $users=mysqli_query($connection,$query);
                    $usercount=mysqli_num_rows($users);
                    
                    
                    
                    
                    
                    ?>
                	<p class="h2 text-thin"><?php echo  $usercount; ?></p>
                	<small><span class="text-semibold"></span><a href="users.php">view details</a></small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
        	<div class="panel panel-danger panel-colorful">
        		<div class="panel-body text-center">
        			<p class="text-uppercase mar-btm text-sm">Comments</p>
        			<i class="fa fa-comment fa-5x"></i>
        			<hr>
                    
                    <?php
                    $query="select * from comments";
                    $allcomments=mysqli_query($connection,$query);
                    $comments_count=mysqli_num_rows($allcomments);
                    
                    ?>
        			<p class="h2 text-thin"><?php echo $comments_count; ?> </p>
        			<small><span class="text-semibold"><i class="fa fa-unlock-alt fa-fw"></i></span><a href="comments.php">view details</a></small>
        		</div>
        	</div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
        	<div class="panel panel-primary panel-colorful">
        		<div class="panel-body text-center">
        			<p class="text-uppercase mar-btm text-sm">posts</p>
        		
                    <i class="fa fa-file-text fa-5x"></i>
        			
                    <hr>
                                    
                    <?php
                    $query="select * from posts";
                    $allposts=mysqli_query($connection,$query);
                    $posts_count=mysqli_num_rows($allposts);
                    
                    ?>
        			<p class="h2 text-thin"><?php echo $posts_count; ?></p>
        			<small><span class="text-semibold"><i class="fa fa-file-text fa-fw "></i></span><a href="posts.php">view details</a></small>
        		</div>
        	</div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
        	<div class="panel panel-info panel-colorful">
        		<div class="panel-body text-center">
        			<p class="text-uppercase mar-btm text-sm">categories</p>
        			<i class="fa fa-navicon fa-5x"></i>
        			<hr>
                            <?php
                    $query="select * from categories";
                    $allcat=mysqli_query($connection,$query);
                    $cat_count=mysqli_num_rows($allcat);
                    
                    ?>
        			<p class="h2 text-thin"><?php echo $cat_count; ?></p>
        			
        			<small><span class="text-semibold"><i class="fa fa-navicon fa-fw"></i> </span><a href="categories.php">view details</a> </small>
        		</div>
        	</div> 
        </div>        
	</div>
</div>
     <style type="text/css">          
              body{
    background:#eee;
    margin-top:20px;
}

.panel {
  box-shadow: 0 2px 0 rgba(0,0,0,0.05);
  border-radius: 0;
  border: 0;
  margin-bottom: 24px;
}

.panel-dark.panel-colorful {
  background-color: #3b4146;
  border-color: #3b4146;
  color: #fff;
}

.panel-danger.panel-colorful {
  background-color: #f76c51;
  border-color: #f76c51;
  color: #fff;
}

.panel-primary.panel-colorful {
  background-color: #5fa2dd;
  border-color: #5fa2dd;
  color: #fff;
}

.panel-info.panel-colorful {
  background-color: #4ebcda;
  border-color: #4ebcda;
  color: #fff;
}

.panel-body {
  padding: 25px 20px;
}

.panel hr {
  border-color: rgba(0,0,0,0.1);
}

.mar-btm {
  margin-bottom: 15px;
}

h2, .h2 {
  font-size: 28px;
}

.small, small {
  font-size: 85%;
}

.text-sm {
  font-size: .9em;
}

.text-thin {
  font-weight: 300;
}

.text-semibold {
  font-weight: 600;
}
         
         
         
          </style>
<div class="row">
              
              
        <?php
    
    
                $session=session_id();
                $time=time();
                $timeout=$time-60;
            $query="select * from user_online  WHERE session='$session'";
            $ses=mysqli_query($connection,$query);
            $count=mysqli_num_rows($ses);
            if($count==null)
            {
                $aquery="insert into user_online(session,time) values ('$session','$time')";
                $insertses=mysqli_query($connection,$aquery);
            }
            else 
            {
                $updateonline=mysqli_query($connection,"UPDATE user_online SET time='$time' WHERE session='$session'");
            }
            $online=mysqli_query($connection,"select * from user_online where time >'$timeout'");
            $countusers=mysqli_num_rows($online);
    if(isset($countusers))
    {
        $_SESSION['counter']=$countusers;
    }
    else
    {
      $_SESSION['counter']=0;  
    }
            
             
            
            
    
    $query="select * from users where user_role = 'subscriber' ";
    $subscriber=mysqli_query($connection,$query);
    $sub_count = mysqli_num_rows($subscriber);
    
     
    $query="select * from comments where comment_status = 'unapproved' ";
    $status=mysqli_query($connection,$query);
    $status_count = mysqli_num_rows($status);
    
     
    $query="select * from posts where post_status = 'draft' ";
    $posts=mysqli_query($connection,$query);
    $posts_draft = mysqli_num_rows($posts);
    
     $query="select * from posts where post_status = 'published' ";
    $posts=mysqli_query($connection,$query);
    $posts_active = mysqli_num_rows($posts);
    
    ?>
                   
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['data', 'count'],
            
            
            <?php
            
         $elements=['users',
                    'subscriber users',
                    'posts',
                    'drafted posts',
                    'published posts',
                    'comments',
                    'categories',
                    'unapproved comments'];
            
        
        $elements_count=[$usercount,
                $sub_count,         
                $posts_count,
                $posts_draft,
                $posts_active,         
                $comments_count,
                $cat_count,
                $status_count];
            for($i=0;$i < 8;$i++)
            {    
                
                echo "['{$elements[$i]}'". "," ."{$elements_count[$i]}] ,"; 
                
            }
            
        
            
            ?>
            
            
       //   ["users", 44],
         // ["Queen's pawn (d4)", 31],
          //["Knight to King 3 (Nf3)", 12],
          //["Queen's bishop pawn (c4)", 10],
       
            
            
            
            
            
            
            
        ]);

        var options = {
          width: 1000 ,
          legend: { position: 'none' },
          chart: {
            title: '',
            subtitle: '' },
          axes: {
            x: {
              0: { side: 'top', label: 'work performance'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(  options));
      };
    </script>
          
          <div id="top_x_div" style="width:'auto'; height: 600px;"></div>
              </div>
            <!-- Page Title Header Starts-->
             <div class="row page-title-header">
              </div>
          <!-- content-wrapper ends -->
<?php include "includes/admin_footer.php"; ?>      
            <!-- partial:partials/_footer.html -->
      