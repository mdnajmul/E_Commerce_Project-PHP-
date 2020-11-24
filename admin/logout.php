<?php 
    // start session
    session_start();

    //unset login information
    unset($_SESSION['ADMIN_LOGIN']);
    unset($_SESSION['ADMIN_USERNAME']);
    //redirect/transfer to login page of our project by 'header()' function
    header('location:index.php');
    die();

?>