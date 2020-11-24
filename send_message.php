<?php
   //include connection.inc.php file inside this page
   require('connection.inc.php');
   //include function
   require('function.inc.php');
   
    $name=get_safe_value($con,$_POST['name']);
    $email=get_safe_value($con,$_POST['email']);
    $mobile=get_safe_value($con,$_POST['mobile']);
    $comment=get_safe_value($con,$_POST['message']);
    $added_on=date('Y-m-d h:i:s');
           
    //execute insert query
    mysqli_query($con, "INSERT INTO contact_us(name,email,mobile,comment,added_on) VALUES('$name','$email','$mobile','$comment','$added_on')");
    echo "Message send successfully!";
?>