<?php
   //include connection.inc.php file inside this header page
   require('connection.inc.php');
   //include function.inc.php file inside this header page
   require('function.inc.php');

    echo "Transaction Succeeded!<br/><br/>";

    
    $val_id=urlencode($_POST['val_id']);
    $store_id=urlencode("oviit5f1d140c9d4c7");
    $store_passwd=urlencode("oviit5f1d140c9d4c7@ssl");
    $requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=".$val_id."&store_id=".$store_id."&store_passwd=".$store_passwd."&v=1&format=json");

    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $requested_url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

    $result = curl_exec($handle);

    $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

    if($code == 200 && !( curl_errno($handle)))
    {

        # TO CONVERT AS ARRAY
        # $result = json_decode($result, true);
        # $status = $result['status'];

        # TO CONVERT AS OBJECT
        $result = json_decode($result);

        # TRANSACTION INFO
        $status = $result->status;
        $tran_date = $result->tran_date;
        $tran_id = $result->tran_id;
        $val_id = $result->val_id;
        $amount = $result->amount;
        $store_amount = $result->store_amount;
        $bank_tran_id = $result->bank_tran_id;
        $card_type = $result->card_type;

        # EMI INFO
        $emi_instalment = $result->emi_instalment;
        $emi_amount = $result->emi_amount;
        $emi_description = $result->emi_description;
        $emi_issuer = $result->emi_issuer;

        # ISSUER INFO
        $card_no = $result->card_no;
        $card_issuer = $result->card_issuer;
        $card_brand = $result->card_brand;
        $card_issuer_country = $result->card_issuer_country;
        $card_issuer_country_code = $result->card_issuer_country_code;

        # API AUTHENTICATION
        $APIConnect = $result->APIConnect;
        $validated_on = $result->validated_on;
        $gw_version = $result->gw_version;
        
        mysqli_query($con,"UPDATE order_tbl SET online_payment_status='$status', pay_id='$val_id',payment_method='$card_type' WHERE txnid='$tran_id'");
        
        //hold order id from order table for using invoice sent to user email
        $order_details=mysqli_fetch_assoc(mysqli_query($con,"SELECT id FROM order_tbl WHERE txnid='$tran_id'"));
        
        //call sentInvoice() function for sent Invoice to user email when order place 
        sentInvoice($con,$order_details['id']); 
        ?>
        <script>
            window.location.href='thank_you.php';
        </script>
        <?php

    } else {

        mysqli_query($con,"UPDATE order_tbl SET online_payment_status='$status', pay_id='$val_id',payment_method='$card_type' where txnid='$tran_id'");
        ?>
        <script>
            window.location.href='fail.php';
        </script>
        <?php
    }

?>