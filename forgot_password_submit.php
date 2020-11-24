<?php

   //include connection.inc.php file inside this page
   require('connection.inc.php');
   //include function
   require('function.inc.php');

   
    $email=get_safe_value($con,$_POST['email']);
    
    $res=mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");
    $check_email = mysqli_num_rows($res);
    if($check_email>0){
        
        //fetch all data from user table for '$email' id 
        $row=mysqli_fetch_assoc($res);
        //hold password
        $pass=$row['password'];
        
        $subject="Your Password";
        $html="Your password is: <strong>$pass</strong>";
        
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
            echo 'no';
        }
        
    }else{
        echo 'not_present';
        die();
    }


    

?>