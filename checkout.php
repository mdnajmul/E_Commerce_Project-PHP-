<?php
    //include header page
    require('top.inc.php');
//Here we check that if cart is empty than redirect to index page
    if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
?>

    <script>
        window.location.href = 'index.php';
    </script>
        
<?php
    
    }
$cart_total = 0;
    


    //holl data for 'order_tbl' table from checkout.php page
    if(isset($_POST['submit'])){
        $address = get_safe_value($con, $_POST['address']);
        $city = get_safe_value($con, $_POST['city']);
        $post_code = get_safe_value($con, $_POST['post_code']);
        $payment_type = get_safe_value($con, $_POST['payment_type']);
        $user_id = $_SESSION['USER_ID'];
        
        //hold total price
        foreach($_SESSION['cart'] as $key=>$val){
            $productArr=get_product($con,'','',$key);
            $price = $productArr[0]['selling_price'];
            $qty = $val['qty'];
            $cart_total = $cart_total+($price*$qty);
        }
        $delivery_charge=25;
        $cart_total = $cart_total+$delivery_charge;
        $total_price = $cart_total;
        $payment_status = 'Pending';
        $order_status = '1';
        $added_on=date('Y-m-d h:i:s');
        
        $txnid = "SSLCZ_TEST_".uniqid();
        $pay_id = "";
        $online_payment_status = "INVALID";
        $payment_method='';
        if(trim($payment_type)=='cash'){
            $payment_method="CASH";
            $online_payment_status = "No";
            $txnid='';
        }
        
        if(isset($_SESSION['COUPON_ID'])){
            $coupon_id=$_SESSION['COUPON_ID'];
            $coupon_code=$_SESSION['COUPON_CODE'];
            $coupon_value=$_SESSION['COUPON_VALUE'];
            $total_price=$total_price-$coupon_value;
            
            unset($_SESSION['COUPON_ID']);
            unset($_SESSION['COUPON_CODE']);
            unset($_SESSION['COUPON_VALUE']);
        }else{
            $coupon_id=0;
            $coupon_code='';
            $coupon_value='';
        }
        
        //execute insert query
        mysqli_query($con, "INSERT INTO order_tbl(user_id,address,city,post_code,payment_type,total_price,payment_status,order_status,txnid,pay_id,online_payment_status,payment_method,coupon_id,coupon_code,coupon_value,added_on) VALUES('$user_id','$address','$city','$post_code','$payment_type','$total_price','$payment_status','$order_status','$txnid','$pay_id','$online_payment_status','$payment_method','$coupon_id','$coupon_code','$coupon_value','$added_on')");
        
        
        //hold current order_id
        $order_id = mysqli_insert_id($con);
        
        //send data to 'order_details' table
        foreach($_SESSION['cart'] as $key=>$val){
            $productArr=get_product($con,'','',$key);
            $price = $productArr[0]['selling_price'];
            $qty = $val['qty'];
            
            //execute insert query
            mysqli_query($con, "INSERT INTO order_details(order_id,product_id,qty,price) VALUES('$order_id','$key','$qty','$price')");
        }
        unset($_SESSION['cart']);

        
        if(trim($payment_type)=='online'){
            /* PHP */
            
            $userArr=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id='$user_id'"));
            
            $post_data = array();
            $post_data['store_id'] = "oviit5f1d140c9d4c7";
            $post_data['store_passwd'] = "oviit5f1d140c9d4c7@ssl";
            $post_data['total_amount'] = $total_price;
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = $txnid;
            $post_data['success_url'] = "http://www.ovi.com/new_project/E_Commerce_Project/success.php";
            $post_data['fail_url'] = "http://www.ovi.com/new_project/E_Commerce_Project/fail.php";
            $post_data['cancel_url'] = "http://localhost/new_sslcz_gw/cancel.php";
            # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

            # EMI INFO
            $post_data['emi_option'] = "1";
            $post_data['emi_max_inst_option'] = "9";
            $post_data['emi_selected_inst'] = "9";

            # CUSTOMER INFORMATION
            $post_data['cus_name'] = $userArr['name'];
            $post_data['cus_email'] = $userArr['email'];
            $post_data['cus_add1'] = $address;
            $post_data['cus_add2'] = $address;
            $post_data['cus_city'] = $city;
            $post_data['cus_state'] = $city;
            $post_data['cus_postcode'] = $post_code;
            $post_data['cus_country'] = "Bangladesh";
            $post_data['cus_phone'] = $userArr['mobile'];
            $post_data['cus_fax'] = "01711111111";

            # SHIPMENT INFORMATION
            $post_data['ship_name'] = "testoviitvujj";
            $post_data['ship_add1 '] = $address;
            $post_data['ship_add2'] = $address;
            $post_data['ship_city'] = $city;
            $post_data['ship_state'] = $city;
            $post_data['ship_postcode'] = $post_code;
            $post_data['ship_country'] = "Bangladesh";

            # OPTIONAL PARAMETERS
            $post_data['value_a'] = "ref001";
            $post_data['value_b '] = "ref002";
            $post_data['value_c'] = "ref003";
            $post_data['value_d'] = "ref004";

            # CART PARAMETERS
            $post_data['cart'] = json_encode(array(
                array("product"=>"DHK TO BRS AC A1","amount"=>"200.00"),
                array("product"=>"DHK TO BRS AC A2","amount"=>"200.00"),
                array("product"=>"DHK TO BRS AC A3","amount"=>"200.00"),
                array("product"=>"DHK TO BRS AC A4","amount"=>"200.00")
            ));
            $post_data['product_amount'] = "100";
            $post_data['vat'] = "5";
            $post_data['discount_amount'] = "5";
            $post_data['convenience_fee'] = "3";
            
            
            
            # REQUEST SEND TO SSLCOMMERZ
            $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";

            $handle = curl_init();
            curl_setopt($handle, CURLOPT_URL, $direct_api_url );
            curl_setopt($handle, CURLOPT_TIMEOUT, 30);
            curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($handle, CURLOPT_POST, 1 );
            curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


            $content = curl_exec($handle );

            $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

            if($code == 200 && !( curl_errno($handle))) {
                curl_close( $handle);
                $sslcommerzResponse = $content;
            } else {
                curl_close( $handle);
                echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
                exit;
            }

            # PARSE THE JSON RESPONSE
            $sslcz = json_decode($sslcommerzResponse, true );

            if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
                    # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
                    # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
                echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
                # header("Location: ". $sslcz['GatewayPageURL']);
                exit;
            } else {
                echo "JSON Data parsing error!";
            }

        } else{
            //call sentInvoice() function for sent Invoice to user email when order place 
            sentInvoice($con,$order_id);    
            
?>

        <script>
            window.location.href = 'thank_you.php';
        </script>
        
<?php
        }
        
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
                                  <span class="breadcrumb-item active">checkout</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="checkout-wrap ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="checkout__inner">
                            <div class="accordion-list">
                                <div class="accordion">
                                   <?php 
                                        $accordion_class = 'accordion__title';
                                        if(!isset($_SESSION['USER_LOGIN'])){
                                            $accordion_class = 'accordion__hide';
                                    ?>
                                    <div class="accordion__title">
                                        Checkout Method
                                    </div>
                                    <div class="accordion__body">
                                        <div class="accordion__body__form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form id="checkout_login_form" method="post">
                                                            <h5 class="checkout-method__title">Login</h5>
                                                            <div class="single-input">
                                                                <input type="text" name="checkout_login_email" id="checkout_login_email" placeholder="Your Email*" style="width:100%">
                                                                <span class="field_error" id="checkout_login_email_error"></span>
                                                            </div>
                                                            <div class="single-input">
                                                                <input type="password" name="checkout_login_password" id="checkout_login_password" placeholder="Your Password*" style="width:100%">
                                                                <span class="field_error" id="checkout_login_password_error"></span>
                                                                <p class="require" style="float:right;">* Required fields</p>
                                                            </div>
 
                                                            <div class="contact-btn">
                                                                <button type="button" class="fv-btn" onclick="checkout_login()">Login</button>
                                                            </div>
                                                            
                                                            <div class="form-output login_msg">
                                                                <p class="form-messege field_error"></p>
                                                            </div>
                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form id="register-form" method="post">
                                                            <h5 class="checkout-method__title">Register</h5>
                                                            <div class="single-input">
                                                                <input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
                                                                <span class="field_error" id="name_error"></span>
                                                            </div>
															<div class="single-input">
                                                                <input type="text" name="email" id="email" placeholder="Your email*" style="width:100%">
                                                                <span class="field_error" id="email_error"></span>
                                                            </div>
															
                                                            <div class="single-input">
                                                                <input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:100%" pattern="[0]{1}[1]{1}[3-9]{1}[0-9]{8}">
                                                                <span class="field_error" id="mobile_error"></span>
                                                            </div>
                                                            
                                                            <div class="single-input">
                                                                <input type="password" name="password" id="password" minlength="4" placeholder="Your Password*" style="width:100%">
                                                                <span class="field_error" id="password_error"></span>
                                                            </div>
                                                            
                                                            <div class="contact-btn">
                                                                <button type="button" onclick="user_register()" class="fv-btn">REGISTER</button>
                                                            </div>
                                                            
                                                            <div class="form-output register_msg">
                                                                <p class="form-messege"></p>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="<?php echo $accordion_class;?>">
                                        Address Information
                                    </div>
                                    <?php if($accordion_class=='accordion__title'){?>
                                    <form method="post">
                                        <div class="accordion__body">
                                            <div class="bilinfo">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="single-input">
                                                                <input type="text" name="address" placeholder="Street Address" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="single-input">
                                                                <input type="text" name="city" placeholder="City/State" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="single-input">
                                                                <input type="text" name="post_code" placeholder="Post code/ zip" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                          </div>
                                          <?php }?>
                                          <div class="<?php echo $accordion_class;?>">
                                             payment information
                                          </div>
                                          <?php if($accordion_class=='accordion__title'){?>
                                          <div class="accordion__body">
                                             <div class="paymentinfo">
                                                 <div class="single-method">
                                                    Cash ON Delivery <input type="radio" name="payment_type" value="cash" required>
                                                    &nbsp;&nbsp;Online Payment <input type="radio" name="payment_type" value="online" required>
                                                 </div>
                                             </div>
                                          </div>
                                          <input type="submit" name="submit" value="ORDER PLACE" class="fv-btn">
                                     </form>
                                     <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="order-details">
                            <h5 class="order-details__title">Your Order</h5>
                            <div class="order-details__item">
                                <?php
                                //hold all cart values which are add inside session variables
                                if(isset($_SESSION['cart'])){
                                    $cart_total = 0;
                                    foreach($_SESSION['cart'] as $key=>$val){
                                        $productArr=get_product($con,'','',$key);
                                        $pname = $productArr[0]['name'];
                                        $mrp = $productArr[0]['mrp'];
                                        $price = $productArr[0]['selling_price'];
                                        $image = $productArr[0]['image'];
                                        $qty = $val['qty'];
                                        $cart_total = $cart_total+($price*$qty);
                                ?>
                                <div class="single-item">
                                    <div class="single-item__thumb">
                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image;?>" />
                                    </div>
                                    <div class="single-item__content">
                                        <a href="#"><?php echo $pname; ?></a>
                                        <span class="price">&#2547; <?php echo $price*$qty;?></span>
                                    </div>
                                    <div class="single-item__remove">
                                        <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="icon-trash icons"></i></a>
                                    </div>
                                </div>
                                <?php } } ?>
                            </div>
                            <div class="order-details__count">
                                <div class="order-details__count__single">
                                    <h5>Order Total</h5>
                                    <span class="price">&#2547; <?php echo $cart_total;?></span>
                                </div>
                                <div class="order-details__count__single">
                                    <h5>Delivery Charge</h5>
                                    <span class="price">&#2547; 25</span>
                                </div>
                            </div>
                            
                            <div class="order_cupon_details" id="coupon_box">
                                <h5>Coupon Value</h5>
                                <span class="c_price" id="coupon_discount_price"></span>
                            </div>
                            <div class="ordre-details__total">
                                <h5>Grand Total</h5>
                                <span class="price" id="order_total_price">&#2547; <?php echo $cart_total+25;?></span>
                            </div>
                            
                            <div class="single-contact-form">
                                <label for="discount" class=" form-control-label discount_txt">Coupon Code?</label>
                                <div class="contact-box name">
                                    <input type="text" id="coupon_str" name="discount" placeholder="Enter coupon" class="form-control discount_input" required>
                                    <button type="button" onclick="set_coupon()" class="fv-btn discount_btn">APPLY COUPON</button>
                                </div>
                                <span class="field_error" id="coupon_result" style="margin-left:12px;"></span>
				            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->
        
        <script>
            function set_coupon(){
                var coupon_txt = jQuery('#coupon_str').val();
                if(coupon_txt!=''){
                    jQuery('#coupon_result').html('');
                    jQuery.ajax({
                        url:'set_coupon.php',
                        type:'post',
                        data:'coupon_txt='+coupon_txt,
                        success:function(result){
                            //decode result value from json format
                            var data = jQuery.parseJSON(result);
                            if(data.is_error=='yes'){
                                jQuery('#coupon_box').hide();
                                jQuery('#coupon_result').html(data.msg);
                                jQuery('#order_total_price').html(data.result);
                            }
                            if(data.is_error=='no'){
                                jQuery('#coupon_box').show();
                                jQuery('#coupon_box').css({"display":"-moz-flex","display":"-ms-flex","display":"-o-flex","display":"flex"});
                                jQuery('#coupon_discount_price').html('&#2547; '+data.msg);
                                jQuery('#order_total_price').html('&#2547; '+data.result);
                            }
                        }
                    });
                }else{
                    jQuery('#coupon_result').html('Please enter a discount code !');
                }
            }
        </script>
       
<?php
//If we apply coupon code but not submit payment form & we reload the page. That time previous coupon details will be clear but coupon_details inside session is not clear.For this reason we unset coupon details from session after page reload

if(isset($_SESSION['COUPON_ID'])){
        
    unset($_SESSION['COUPON_ID']);
    unset($_SESSION['COUPON_CODE']);
    unset($_SESSION['COUPON_VALUE']);
}


   //include footer page
   require('foot.inc.php');


?>                
        