<?php
   //include connection.inc.php file inside this login page
   require('connection.inc.php');

   //include function.inc.php file inside this login page
   require('function.inc.php');
   //create a $msg variable for show message
   $msg = '';

   //When click Signin button then username & password information comes here & we hold these information
   if(isset($_POST['submit'])){
       //hold/put username by $_POST['username'] and call 'get_safe_value()' function 
       $userName = get_safe_value($con, $_POST['username']);
       //hold/put password by $_POST['password'] and call 'get_safe_value()' function
       $pass = get_safe_value($con, $_POST['password']);
       
       //write select query for fetch all username & password data from 'admin_users' database table
       $sql = "SELECT * FROM admin_users WHERE username='$userName' and password='$pass'";
       
       //execute this $sql query through by 'mysqli_query(database_connection, query)' function
       $res = mysqli_query($con, $sql);
       
       
       //check these $res data store inside database table by 'mysqli_num_rows()' function. If data are found then $count value is greater than 0.
       $count = mysqli_num_rows($res);
       if($count>0) {
           
           //write this for hold admin role & id
           $row=mysqli_fetch_assoc($res);
           if($row['status']==0){
               $msg = "Your Account Deactivated By Admin !";
           } else {
               //value transfer into session & admin login the site
               $_SESSION['ADMIN_LOGIN']='yes';
               $_SESSION['ADMIN_ID']=$row['id'];
               $_SESSION['ADMIN_USERNAME']=$userName;
               $_SESSION['ADMIN_ROLE']=$row['role'];

               //redirect/transfer to categories page of our project by 'header()' function
               header('location:dashboard.php');
               die();
           }
           
       } else{
           
           //if data not found then show this message
           $msg = "Please Enter Correct Login Details !";
       }
   }
?>

<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body class="bg-dark">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-form mt-150">
                    <!--====================== Create Login Form  ==========================-->
                    <form method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                    </form>
                    <!--==========================================================================-->
                    
                    
                    <!--========================= Create a <div> for show login error message =====================-->
                    <div class="field_error"> <?php echo $msg; ?> </div>
                    <!--===========================================================================================-->
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="assets/js/popper.min.js" type="text/javascript"></script>
    <script src="assets/js/plugins.js" type="text/javascript"></script>
    <script src="assets/js/main.js" type="text/javascript"></script>
</body>

</html>
