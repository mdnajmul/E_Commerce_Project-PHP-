<?php
    //include header page
    require('top.inc.php');

    if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']=='yes'){
?>
        <script>
            window.location.href='my_order.php';
        </script>
<?php
    }
?>

    <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/3.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Login/Register</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Login</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="login-form" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
										</div>
										<span class="field_error" id="login_email_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
										</div>
										<span class="field_error" id="login_password_error"></span>
									</div>
									
									<div class="forget_password">
                                        <a href="forgot_password.php">Forgot password?</a>
                                    </div>
									
									<div class="contact-btn">
										<button type="button" class="fv-btn" onclick="user_login()">Login</button>
									</div>
								</form>
								<div class="form-output login_msg">
									<p class="form-messege field_error"></p>
								</div>
							</div>
						</div> 
                
				</div>
				

					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Register</h2>
								</div>
							</div>
				          <div class="col-xs-12">
								<form id="register-form" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">	
										</div>
										<span class="field_error" id="name_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="email" name="email" id="email" placeholder="Your email*" style="width:50%">
											
											<button type="button" onclick="email_sent_otp()" class="fv-btn email_sent_otp height_60px">Send OTP</button>
											
											<input type="text" id="email_otp" placeholder="OTP*" style="width:25%" class="email_verify_otp">
											
											<button type="button" onclick="email_verify_otp()" class="fv-btn email_verify_otp height_60px">Verify OTP</button>
											
											<span id="email_otp_msg" style="color:green;"></span>
										</div>
										<span class="field_error" id="email_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:100%" pattern="[0]{1}[1]{1}[3-9]{1}[0-9]{8}">
										</div>
										<span class="field_error" id="mobile_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="password" id="password" minlength="4" placeholder="Your Password*" style="width:100%">
										</div>
										<span class="field_error" id="password_error"></span>
									</div>	
									
									<div class="contact-btn">
										<button type="button" onclick="user_register()" class="fv-btn" disabled id="register_btn">REGISTER</button>
									</div>
								</form>
								<div class="form-output register_msg">
									<p class="form-messege"></p>
								</div>
						</div> 
                
				  </div>
              
               </div>	
               
              </div>
              
            </div>
            
        </section>
        <!-- End Contact Area -->
        
        <input type="hidden" id="is_email_verified">
        
        <script>
            
            function email_sent_otp(){
                $('#email_error').html('');
                var email = $('#email').val();
                if(email==''){
                    $('#email_error').html('Please enter your email!');
                }else{
                    $('.email_sent_otp').html('Processing...');
                    $('.email_sent_otp').attr('disabled',true);
                    $('.email_sent_otp');
                    $.ajax({
                        url:'send_otp.php',
                        type:'post',
                        data:'email='+email,
                        success:function(result){
                            if($.trim(result)=='yes'){
                                $('#email').attr('disabled',true);
                                $('.email_verify_otp').show();
                                $('.email_sent_otp').hide();
                            }else if($.trim(result)=='present'){
                                $('.email_sent_otp').html('Send OTP');
                                $('.email_sent_otp').attr('disabled',false);
                                $('#email_error').html('Email already exists!');                         
                            }else{
                                $('.email_sent_otp').html('Send OTP');
                                $('.email_sent_otp').attr('disabled',false);
                                $('#email_error').html('Please try after sometime!');
                            }
                        }
                    });
                    
                }
            }
            
            function email_verify_otp(){
                $('#email_error').html('');
                var email_otp = $('#email_otp').val();
                if(email_otp==''){
                    $('#email_error').html('Please enter OTP!');
                }else{
                    $.ajax({
                        url:'check_otp.php',
                        type:'post',
                        data:'otp='+email_otp,
                        success:function(result){
                            if($.trim(result)=='done'){
                                $('.email_verify_otp').hide();
                                $('#email_otp_msg').html('Email id verified!');
                                $('#is_email_verified').val('1');
                            }else{
                                $('#email_error').html('Please enter valid OTP!');
                                $('#is_email_verified').val('0');
                            }
                        
                            if($('#is_email_verified').val()==1){
                                $('#register_btn').attr('disabled',false);
                            }
                        }
                    });
                    
                }
            }
        </script>
        
        
	     <!-- Main js file that contents all jQuery plugins activation. 
         <script type="text/javascript" src="js/main.js"></script> -->
	
<?php
   //include footer page
   require('foot.inc.php');
?>                
        