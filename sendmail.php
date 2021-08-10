<?php 
include "PHPMailer/src/PHPMailer.php";
include "PHPMailer/src/Exception.php";
include "PHPMailer/src/SMTP.php";
require 'c:\xampp\composer\vendor\autoload.php';

    $email  = new PHPMailer\PHPMailer\PHPMailer();
    $email ->isSMTP();
    $email ->SMTPAuth=true;
    $email ->SMTPSecure='ssl';
    $email ->Host = 'smtp.gmail.com';
    $email ->Port ='465';
    $email ->isHTML();
    $email ->Username='islamramadan.fcis.asu.2019@gmail.com';
    $email ->Password='01156888380';
    
    $email -> setFrom('islamramadan.fcis.asu.2019@gmail.com','islamramadan');
    
    
    $email ->addAddress('islamramadan26@gmail.com','islamm');
        
    $email ->Subject='Force';
    
    $email ->Body='There is a great disturbance in the Force';
    
    $email ->send();


?>