<?php


   //include connection.inc.php file inside this page
   require('connection.inc.php');
   //include function
   require('function.inc.php');

    //hold product id, product quantity, type(add/update/remove)
    $pid=get_safe_value($con,$_POST['pid']);
    $type=get_safe_value($con,$_POST['type']);


    if(isset($_SESSION['USER_LOGIN'])){
        
        $uid=$_SESSION['USER_ID'];
        
        if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM wishlist WHERE user_id='$uid' AND product_id='$pid'"))>0){
            //echo "Already added!";
        }else{
            //$added_on=date('Y-m-d h:i:s');
            //mysqli_query($con,"INSERT INTO wishlist(user_id,product_id,added_on) VALUES('$uid','$pid','$added_on')");
            wishlist_add($con,$uid,$pid);
        }
        echo $total_record=mysqli_num_rows(mysqli_query($con,"SELECT * FROM wishlist WHERE user_id='$uid'"));
    }else{
        $_SESSION['WISHLIST_ID']=$pid;
        echo "not_login";
    }


?>