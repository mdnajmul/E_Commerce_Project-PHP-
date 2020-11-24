<?php


   //include connection.inc.php file inside this page
   require('connection.inc.php');
   //include function
   require('function.inc.php');

   
    $email=get_safe_value($con,$_POST['email']);
    $password=get_safe_value($con,$_POST['password']);

    $res = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1");
    $check_data = mysqli_num_rows($res);
    if($check_data>0){
        $row = mysqli_fetch_assoc($res);
        $_SESSION['USER_LOGIN']='yes';
        $_SESSION['USER_ID']=$row['id'];
        $_SESSION['USER_NAME']=$row['name'];
        $_SESSION['USER_MOBILE']=$row['mobile'];
        
        if(isset($_SESSION['WISHLIST_ID']) && $_SESSION['WISHLIST_ID']!=''){
            wishlist_add($con,$_SESSION['USER_ID'],$_SESSION['WISHLIST_ID']);
            unset($_SESSION['WISHLIST_ID']);
        }
            
        echo "valid";
        
    }else{
        echo "wrong";
        
    }






?>