<?php
    //include header page
    require('top.inc.php');

    if(!isset($_SESSION['USER_LOGIN'])){
?>
        <script>
           window.location.href='index.php';
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
                                  <span class="breadcrumb-item active">Profile</span>
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
									<h2 class="title__line--6">Profile</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form method="post" id="login-form">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="name" id="name" placeholder="Your Name*" value="<?php echo $_SESSION['USER_NAME'];?>" style="width:100%">
										</div>
										<span class="field_error" id="name_error"></span>
									</div>
									
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" value="<?php echo $_SESSION['USER_MOBILE'];?>" style="width:100%" pattern="[0]{1}[1]{1}[3-9]{1}[0-9]{8}">
										</div>
										<span class="field_error" id="mobile_error"></span>
									</div>
									
                                    <div>
                                        <span class="field_correct" id="success_msg_profile"></span>
                                    </div>
									
									<div class="contact-btn">
										<button type="button" class="fv-btn" onclick="update_profile()" id="btn_submit">Update</button>
									</div>
								</form>
								
							</div>
						</div> 
                
				    </div>
               
               
                    <div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Change Password</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="frmPassword" method="post">
									<div class="single-contact-form">
									    <label class="password_label">Current Password</label>
										<div class="contact-box name">
											<input type="password" name="current_password" id="current_password" placeholder="Password*" style="width:100%">
										</div>
										<span class="field_error" id="current_password_error"></span>
									</div>
									
									<div class="single-contact-form">
									    <label class="password_label">New Password</label>
										<div class="contact-box name">
											<input type="password" name="new_password" id="new_password" placeholder="Password*" style="width:100%">
										</div>
										<span class="field_error" id="new_password_error"></span>
									</div>
									
									<div class="single-contact-form">
									    <label class="password_label">Confirm New Password</label>
										<div class="contact-box name">
											<input type="password" name="confirm_new_password" id="confirm_new_password" placeholder="Password*" style="width:100%">
										</div>
										<span class="field_error" id="confirm_new_password_error"></span>
									</div>
									
                                    <div>
                                        <span class="field_correct" id="success_msg_password"></span>
                                    </div>
									
									<div class="contact-btn">
										<button type="button" class="fv-btn" onclick="update_password()" id="btn_update_password">Update</button>
									</div>
								</form>
								
							</div>
						</div> 
                
				    </div>
                </div>
                 
                 
                  
            </div>
            
        </section>
        <!-- End Contact Area -->
        
        <script>
            
            function update_profile(){
                $('.field_error').html('');
                $('.field_correct').html('');
                
                var name = $('#name').val();
                var mobile = $('#mobile').val();
                var is_error='';
                
                if(name==''){
                    $('#name_error').html('Please enter your name !');
                    is_error='yes';
                }
                if(mobile==''){
                    $('#mobile_error').html('Please enter your mobile number !');
                    is_error='yes';
                }
                if(is_error==''){
                    $('#btn_submit').html('Please Wait...');
                    $('#btn_submit').attr('disabled',true);
                    $.ajax({
                        url:'update_profile.php',
                        type:'post',
                        data:'name='+name+'&mobile='+mobile,
                        success:function(result){
                            $('#btn_submit').html('Update');
                            $('#btn_submit').attr('disabled',false);
                            if($.trim(result)=='update'){
                                $('#success_msg_profile').html('Your profile updated successfully !');
                            }
                        }
                    });
                }
            }
            
            
            
             function update_password(){
                $('.field_error').html('');
                $('.field_correct').html('');
                 
                var current_password = $('#current_password').val();
                var new_password = $('#new_password').val();
                var confirm_new_password = $('#confirm_new_password').val();
                var is_error='';
                 
                if(current_password==''){
                    $('#current_password_error').html('Please enter your current password !');
                    is_error='yes';
                }
                if(new_password==''){
                    $('#new_password_error').html('Please enter your new password !');
                    is_error='yes';
                }
                if(confirm_new_password==''){
                    $('#confirm_new_password_error').html('Please enter your new password again to confirm!');
                    is_error='yes';
                }
                if(new_password!='' && confirm_new_password!='' && new_password!=confirm_new_password){
                    $('#confirm_new_password_error').html('Please enter same password!');
                    is_error='yes';
                }
                if(is_error==''){
                    $('#btn_update_password').html('Please Wait...');
                    $('#btn_update_password').attr('disabled',true);
                    $.ajax({
                        url:'update_password.php',
                        type:'post',
                        data:'current_password='+current_password+'&new_password='+new_password,
                        success:function(result){
                            $('#btn_update_password').html('Update');
                            $('#btn_update_password').attr('disabled',false);
                            if($.trim(result)=='wrong_pass'){
                                $('#current_password_error').html('Please enter your current valid password!');
                            }
                            if($.trim(result)=='pass_update'){
                                $('#success_msg_password').html('Your password updated successfully !');
                            }
                            $('#frmPassword')[0].reset();
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
        