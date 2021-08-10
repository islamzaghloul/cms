<?php include "db.php" ;?>


<?php  
function confirm($result)
{
    global $connection;
    if(!$result)
    {
        die("connection failed .". mysqli_error($connection));
    }
}

?>


<?php 
    
    
function adding_catgeory()
{
    
    global $connection;
    if(isset($_POST['submit']))
    {
         $tit=$_POST['cat_title'];
                           
         if(!$tit || empty($tit))
         {
            echo " please enter a category";
         }
         else
         {                                 
            $query="INSERT INTO categories (cat_tit) VALUES ('{$tit}')";
            $addcat=mysqli_query($connection,$query);
         }
    }
                        
}
?>


<?php 
function show_catgeories_table()
{
        global $connection;
        $query="select * from categories";               
        $categories=mysqli_query($connection,$query);
            
    while($row=mysqli_fetch_assoc($categories))               
     {
                $cat_id=$row['cat_id'];
                $cat_tit=$row['cat_tit'];
    
                echo "<tr>";
                echo "<td>{$cat_id}</td>";
                echo "<td>{$cat_tit}</td>";
                echo "<td><a href='categories.php?delete= {$cat_id}'>delete</a></td>"; echo "<td><a href='categories.php?edit= {$cat_id}'>edit</a></td>";  
                echo "</tr>";
      } 

}
?>


<?php
function delete_catgeory()
{
    global $connection;
    if(isset($_GET['delete']))
     {
         $category_id=$_GET['delete'];
         $query ="DELETE FROM categories WHERE cat_id ={$category_id}";
         $delete_cat=mysqli_query($connection,$query);
         header("location:categories.php");
     } 
    
    
}
?>