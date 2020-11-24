<?php


   //include connection.inc.php file inside this page
   require('connection.inc.php');
   //include function
   require('function.inc.php');

    $name=get_safe_value($con,$_POST['name']);
    $email=get_safe_value($con,$_POST['email']);
    $mobile=get_safe_value($con,$_POST['mobile']);
    $password=get_safe_value($con,$_POST['password']);

    
    $check_email = mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE email = '$email'"));
    if($check_email>0){
        echo "present";
        
    }else{
        
        $added_on=date('Y-m-d h:i:s');
        mysqli_query($con,"insert into users(name,password,email,mobile,added_on) values('$name','$password','$email','$mobile','$added_on')");
        echo "insert";
        
    }






?>