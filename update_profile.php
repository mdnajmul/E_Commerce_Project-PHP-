<?php

   //include connection.inc.php file inside this page
   require('connection.inc.php');
   //include function
   require('function.inc.php');

   if(!isset($_SESSION['USER_LOGIN'])){
?>
    <script>
       window.location.href='index.php';
    </script>
<?php
    }

   
    $name=get_safe_value($con,$_POST['name']);
    $mobile=get_safe_value($con,$_POST['mobile']);
    $uid=$_SESSION['USER_ID'];
    mysqli_query($con,"UPDATE users SET name='$name',mobile='$mobile' WHERE id='$uid'");
    $_SESSION['USER_NAME']=$name;
    $_SESSION['USER_MOBILE']=$mobile;
    echo 'update';
    
    



?>