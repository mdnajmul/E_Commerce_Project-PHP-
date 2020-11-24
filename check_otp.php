<?php

   //include connection.inc.php file inside this page
   require('connection.inc.php');
   //include function
   require('function.inc.php');

   
    $otp=get_safe_value($con,$_POST['otp']);
    $session_otp=$_SESSION['Email_OTP'];

    if(trim($otp)==trim($session_otp)){
        echo 'done';
    }else{
        echo 'not_done';
    }
    



?>