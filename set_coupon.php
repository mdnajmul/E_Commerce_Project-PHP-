<?php

    require('connection.inc.php');
    require('function.inc.php');

    //hold coupon code
    $coupon_txt = get_safe_value($con,$_POST['coupon_txt']);

    $res=mysqli_query($con,"SELECT * FROM coupon_master WHERE coupon_code='$coupon_txt' AND status='1'");
    
    $count=mysqli_num_rows($res);

    //create json array for hold multiple error & their value
    $jsonArr=array();

    $cart_total = 0;


    if(isset($_SESSION['COUPON_ID'])){
        
        unset($_SESSION['COUPON_ID']);
        unset($_SESSION['COUPON_CODE']);
        unset($_SESSION['COUPON_VALUE']);
    }



    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $key=>$val){
            $productArr=get_product($con,'','',$key);
            $price = $productArr[0]['selling_price'];
            $qty = $val['qty'];
            $cart_total = $cart_total+($price*$qty);
        }
        $cart_total=$cart_total+25;
    }
    
    if($count>0){
        $row=mysqli_fetch_assoc($res);
        $coupon_id=$row['id'];
        $coupon_code=$row['coupon_code'];
        $coupon_value=$row['coupon_value'];
        $coupon_type=$row['coupon_type'];
        $cart_min_value=$row['cart_min_value'];
        
        
        if($cart_min_value>$cart_total){
            $jsonArr=array('is_error'=>'yes','result'=>$cart_total,'msg'=>'Cart total value must be equal or greater than &#2547;'.$cart_min_value);
        }else{
            if($coupon_type=='Taka'){
               $final_price=$cart_total-$coupon_value;
            }else{
               $final_price=floor($cart_total-(($cart_total*$coupon_value)/100));
            }
            $msg=$cart_total-$final_price;
            //hold coupon apply details into sesssion for update database after paytment submit
            $_SESSION['COUPON_ID']=$coupon_id;
            $_SESSION['FINAL_PRICE']=$final_price;
            $_SESSION['COUPON_VALUE']=$msg;
            $_SESSION['COUPON_CODE']=$coupon_txt;
            
            $jsonArr=array('is_error'=>'no','result'=>$final_price,'msg'=>$msg);
        }
        
    } else{
        $jsonArr=array('is_error'=>'yes','result'=>$cart_total,'msg'=>'Please enter a valid discount code !');
    }
    //encode json array
    echo json_encode($jsonArr);

?>