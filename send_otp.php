<?php

   //include connection.inc.php file inside this page
   require('connection.inc.php');
   //include function
   require('function.inc.php');

   
    $email=get_safe_value($con,$_POST['email']);

    $check_email = mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE email = '$email'"));
    if($check_email>0){
        echo "present";
        die();
        
    }

    //generate random 4 digit OTP code
    $otp = rand(1111,9999);
    $subject="OTP Verification";
    $html="Your OTP verification code is: ".$otp;
    $_SESSION['Email']=$email;
    $_SESSION['Email_OTP']=$otp;

    include('smtp/class.phpmailer.php');
    $mail = new PHPMailer(); 
    $mail->IsSMTP(); 
    $mail->SMTPDebug = 1; 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'ssl'; 
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; 
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Username = "neberhossain7@gmail.com";
    $mail->Password = "01823260474";
    $mail->SetFrom("neberhossain7@gmail.com");
    $mail->Subject = $subject;
    $mail->Body =$html;
    $mail->AddAddress($email);
    if($mail->Send()){
        echo 'yes';
    }else{
        
    }

    



?>