<?php


   //include connection.inc.php file inside this page
   require('connection.inc.php');
   //include function
   require('function.inc.php');

   
        unset($_SESSION['USER_LOGIN']);
        unset($_SESSION['USER_ID']);
        unset($_SESSION['USER_NAME']);

        header('location:index.php');
        die();
       





?>