//contact form
function send_message(){
    $(".msg_err").hide();
    $(".msg_corr").hide();
	var name=$("#c_name").val();
	var email=$("#c_email").val();
	var mobile=$("#c_mobile").val();
	var message=$("#c_message").val();
    var is_error = false;
	
	if(name==""){
        $(".msg_err").show();
        $(".msg_err").html('Please enter name!');
        is_error = true;
	}else if(email==""){
        $(".msg_err").show();
        $(".msg_err").html('Please enter email!');
        is_error = true;
	}else if(mobile==""){
        $(".msg_err").show();
        $(".msg_err").html('Please enter mobile!');
        is_error = true;
	}else if(message==""){
        $(".msg_err").show();
        $(".msg_err").html('Please enter message!');
        is_error = true;
	}else if(is_error == false){
		$.ajax({
			url:'send_message.php',
			type:'post',
			data:'name='+name+'&email='+email+'&mobile='+mobile+'&message='+message,
			success:function(result){
				$(".msg_corr").show();
				$(".msg_corr").html(result);
			},
            complete: function(){
                $("#contact-form").each(function(){
                    this.reset();   //Here form fields will be cleared.
                });
            }
		});
	}
}




//registration form
function user_register(){
    $(".field_error").html("");
    $('.email_sent_otp').show();
    $('.email_sent_otp').html('Send OTP');
    $('.email_verify_otp').hide();
    $('#email_otp_msg').html('');
    
    
	var name=$("#name").val();
	var email=$("#email").val();
	var mobile=$("#mobile").val();
	var password=$("#password").val();
    var is_error='';
    
	
	if(name==""){
        $("#name_error").html("Please enter your name!");
        is_error='yes';
	}
    if(email==""){
        $("#email_error").html("Please enter your email!");
        is_error='yes';
	}
    if(mobile==""){
        $("#mobile_error").html("Please enter your mobile!");
        is_error='yes';
	}
    if(password==""){
        $("#password_error").html("Please enter your password!");
        is_error='yes';
	}
    if(is_error==''){
		$.ajax({
			url:'register_submit.php',
			type:'post',
			data:'name='+name+'&email='+email+'&mobile='+mobile+'&password='+password,
			success:function(result){
                if($.trim(result).toUpperCase()=='INSERT'){
                   $('#email').attr('disabled',false);
                    $('.email_sent_otp').attr('disabled',false);
                   $('.register_msg p').html("Thank you for registration.");
                }
                
			},
            complete: function(result){
                    $("#register-form").each(function(){
                        this.reset();   //Here form fields will be cleared.
                    });
            }
            
		});
 }
}



//login form
function user_login(){
    $(".field_error").html("");
    
	var email=$("#login_email").val();
	var password=$("#login_password").val();
    var is_error='';
    
	
	
    if(email==""){
        $("#login_email_error").html("Please enter your email!");
        is_error='yes';
	}
    if(password==""){
        $("#login_password_error").html("Please enter your password!");
        is_error='yes';
	}
    if(is_error==''){
		$.ajax({
			url:'login_submit.php',
			type:'post',
			data:'email='+email+'&password='+password,
			success:function(result){
				 
                if($.trim(result).toUpperCase() == "WRONG"){
                   $('.login_msg p').html('Please enter valid login details!');
                }
                   
                if($.trim(result).toUpperCase() == "VALID"){
                    window.location.href='index.php';
                }
                
			},
            complete: function(){
                $("#login-form").each(function(){
                    this.reset();   //Here form fields will be cleared.
                });
            }
            
		});
 }
}


//checkout login form
function checkout_login(){
    $(".field_error").html("");
    
	var email=$("#checkout_login_email").val();
	var password=$("#checkout_login_password").val();
    var is_error='';
    
	
	
    if(email==""){
        $("#checkout_login_email_error").html("Please enter your email!");
        is_error='yes';
	}
    if(password==""){
        $("#checkout_login_password_error").html("Please enter your password!");
        is_error='yes';
	}
    if(is_error==''){
		$.ajax({
			url:'login_submit.php',
			type:'post',
			data:'email='+email+'&password='+password,
			success:function(result){
				 
                if($.trim(result).toUpperCase() == "WRONG"){
                   $('.login_msg p').html('Please enter valid login details!');
                }
                   
                if($.trim(result).toUpperCase() == "VALID"){
                    window.location.href=window.location.href;
                }
                
			},
            complete: function(){
                $("#checkout_login_form").each(function(){
                    this.reset();   //Here form fields will be cleared.
                });
            }
            
		});
 }
}



//product add,update,remove inside cart handle using ajax
function manage_cart(pid,type){
    
    if(type=='update'){
	   var qty=$("#"+pid+"qty").val();
    }else if(type=='add'){
       var qty=$("#qty").val();
    }
    else if(type=='hover_add'){
       var qty=1;   
    }
	
		$.ajax({
			url:'manage_cart.php',
			type:'post',
			data:'pid='+pid+'&qty='+qty+'&type='+type,
			success:function(result){
                //if type is update than redirect cart page
                if(type=='update' || type=='remove'){
                    //riderect to current/own page
				    window.location.href=window.location.href;
                }
                if($.trim(result)=='not_available'){
                    alert('Given quantity is not available !');
                }else{
                   //show total cart
                    $('.htc__qua').html(result); 
                }
                
                
                
			}
            
		});
}
    


//product add inside wishlist when user is login handle using ajax
function wishlist_manage(pid,type){
	
        //check user login or not
		$.ajax({
			url:'wishlist_manage.php',
			type:'post',
			data:'pid='+pid+'&type='+type,
			success:function(result){
                //if type is update than redirect cart page
                if($.trim(result)=='not_login'){
                    //riderect to login page
				    window.location.href='login.php';
                }else{
                    $('.htc__wishlist').html(result);
                }
                
                
			}
            
		});
}




//sort product by low_price/high_price/old_product/new_product
function sort_product_drop(cat_id,site_path){
    var sort_product_id=jQuery('#sort_product_id').val();
	window.location.href=site_path+"categories.php?id="+cat_id+"&sort="+sort_product_id;
}



