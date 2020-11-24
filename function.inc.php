
<?php

    /** Here we write some common function that we use from different file **/


    //create two basic function name 'pr()' and 'prx()' that return us array value inside <pre> & print_r tag
    function pr($arr){
        echo '<pre>';
        print_r($arr);
    }

    function prx($arr){
        echo '<pre>';
        print_r($arr);
        die();
    }

    
	
	
	//create this function for pass data which comes from input field and 'database connection($con)' through/pass by 'mysqli_real_escape_string()' function
    function get_safe_value($link, $val){
        //validate that data is empty or not
        if($val != ''){
            //remove space from text
            $val = trim($val);
            return strip_tags(mysqli_real_escape_string($link, $val));
        }
    }
	
	
	
	
    //**This function used for collect/fetch product from database**//
    function get_product($con,$limit='',$cat_id='',$product_id='',$search_str='',$sort_order='',$is_best_seller='',$sub_cat_id=''){
        //write select query to fetch data from product table
        $sql="SELECT product.*,categories.category FROM product,categories WHERE product.status=1 ";
		//show those products which category is selected
		if($cat_id!=''){
			$sql.=" AND product.categories_id='$cat_id' ";
		}
        //product details
		if($product_id!=''){
			$sql.=" AND product.id='$product_id' ";
		}
        //if subcategory id found then execute this section/query
        if($sub_cat_id!=''){
			$sql.=" AND product.sub_categories_id='$sub_cat_id' ";
		}
        //if most populer value is yes then execute this section
		if($is_best_seller!=''){
			$sql.=" AND product.best_seller=1 ";
		}
        //show those products which categories_id(product table) and id(categories table) are same
		$sql.=" AND product.categories_id=categories.id ";
        //search details
        if($search_str!=''){
		    $sql.=" AND (product.name LIKE '%$search_str%' or product.description LIKE '%$search_str%') ";
	    }
        //sort 
        if($sort_order!=''){
		  $sql.=$sort_order;
	    }else{
		  $sql.=" ORDER BY product.id DESC ";
        }
        //when limit value is not null,then show number of product is equal to limit value 
        if($limit!=''){
            $sql.=" LIMIT $limit";
        }
        
        $res=mysqli_query($con,$sql);
        $data=array();
        while($row=mysqli_fetch_assoc($res)){
            $data[]=$row;
        }
        return $data;
    }



    //add product inside wishlist
    function wishlist_add($con,$uid,$pid){
        $added_on=date('Y-m-d h:i:s');
        mysqli_query($con,"INSERT INTO wishlist(user_id,product_id,added_on) VALUES('$uid','$pid','$added_on')");
    }




    //return total number of quanty sold for given product/product_id
    function productSoldQtyByProductId($con,$pid){
        //
        $sql="SELECT SUM(order_details.qty) as qty FROM order_details,order_tbl WHERE order_tbl.id=order_details.order_id AND order_details.product_id='$pid' AND order_tbl.order_status!=4 AND ((order_tbl.payment_type='online' AND order_tbl.payment_status='Success' AND order_tbl.online_payment_status='VALID') OR (order_tbl.payment_type='cash' AND order_tbl.payment_status!='' AND order_tbl.online_payment_status='No'))";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($res);
        return $row['qty'];
    }


    
    //return total product quantity
    function productQty($con,$pid){
        //
        $sql="SELECT qty FROM product WHERE id='$pid'";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($res);
        return $row['qty'];
    }






    //sent invoice to user email
    function sentInvoice($con,$order_id){
        $res = mysqli_query($con, "SELECT distinct(order_details.id),order_details.*,product.name,product.image FROM order_details,product,order_tbl WHERE order_details.order_id='$order_id' AND order_details.product_id=product.id");

        $user_order=mysqli_fetch_assoc(mysqli_query($con,"SELECT order_tbl.*,users.name,users.email FROM order_tbl,users WHERE order_tbl.user_id=users.id AND order_tbl.id='$order_id'"));

        $total_price='';


        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html>
              <head>
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <meta name="x-apple-disable-message-reformatting" />
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title></title>
                <style type="text/css" rel="stylesheet" media="all">
                /* Base ------------------------------ */

                @import url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap");
                body {
                  width: 100% !important;
                  height: 100%;
                  margin: 0;
                  -webkit-text-size-adjust: none;
                }

                a {
                  color: #3869D4;
                }

                a img {
                  border: none;
                }

                td {
                  word-break: break-word;
                }

                .preheader {
                  display: none !important;
                  visibility: hidden;
                  mso-hide: all;
                  font-size: 1px;
                  line-height: 1px;
                  max-height: 0;
                  max-width: 0;
                  opacity: 0;
                  overflow: hidden;
                }
                /* Type ------------------------------ */

                body,
                td,
                th {
                  font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
                }

                h1 {
                  margin-top: 0;
                  color: #333333;
                  font-size: 22px;
                  font-weight: bold;
                  text-align: left;
                }

                h2 {
                  margin-top: 0;
                  color: #333333;
                  font-size: 16px;
                  font-weight: bold;
                  text-align: left;
                }

                h3 {
                  margin-top: 0;
                  color: #333333;
                  font-size: 14px;
                  font-weight: bold;
                  text-align: left;
                }

                td,
                th {
                  font-size: 16px;
                }

                p,
                ul,
                ol,
                blockquote {
                  margin: .4em 0 1.1875em;
                  font-size: 16px;
                  line-height: 1.625;
                }

                p.sub {
                  font-size: 13px;
                }
                /* Utilities ------------------------------ */

                .align-right {
                  text-align: right;
                }

                .align-left {
                  text-align: left;
                }

                .align-center {
                  text-align: center;
                }
                /* Buttons ------------------------------ */

                .button {
                  background-color: #3869D4;
                  border-top: 10px solid #3869D4;
                  border-right: 18px solid #3869D4;
                  border-bottom: 10px solid #3869D4;
                  border-left: 18px solid #3869D4;
                  display: inline-block;
                  color: #FFF;
                  text-decoration: none;
                  border-radius: 3px;
                  box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
                  -webkit-text-size-adjust: none;
                  box-sizing: border-box;
                }

                .button--green {
                  background-color: #22BC66;
                  border-top: 10px solid #22BC66;
                  border-right: 18px solid #22BC66;
                  border-bottom: 10px solid #22BC66;
                  border-left: 18px solid #22BC66;
                }

                .button--red {
                  background-color: #FF6136;
                  border-top: 10px solid #FF6136;
                  border-right: 18px solid #FF6136;
                  border-bottom: 10px solid #FF6136;
                  border-left: 18px solid #FF6136;
                }

                @media only screen and (max-width: 500px) {
                  .button {
                    width: 100% !important;
                    text-align: center !important;
                  }
                }
                /* Attribute list ------------------------------ */

                .attributes {
                  margin: 0 0 21px;
                }

                .attributes_content {
                  background-color: #F4F4F7;
                  padding: 16px;
                }

                .attributes_item {
                  padding: 0;
                }
                /* Related Items ------------------------------ */

                .related {
                  width: 100%;
                  margin: 0;
                  padding: 25px 0 0 0;
                  -premailer-width: 100%;
                  -premailer-cellpadding: 0;
                  -premailer-cellspacing: 0;
                }

                .related_item {
                  padding: 10px 0;
                  color: #CBCCCF;
                  font-size: 15px;
                  line-height: 18px;
                }

                .related_item-title {
                  display: block;
                  margin: .5em 0 0;
                }

                .related_item-thumb {
                  display: block;
                  padding-bottom: 10px;
                }

                .related_heading {
                  border-top: 1px solid #CBCCCF;
                  text-align: center;
                  padding: 25px 0 10px;
                }
                /* Discount Code ------------------------------ */

                .discount {
                  width: 100%;
                  margin: 0;
                  padding: 24px;
                  -premailer-width: 100%;
                  -premailer-cellpadding: 0;
                  -premailer-cellspacing: 0;
                  background-color: #F4F4F7;
                  border: 2px dashed #CBCCCF;
                }

                .discount_heading {
                  text-align: center;
                }

                .discount_body {
                  text-align: center;
                  font-size: 15px;
                }
                /* Social Icons ------------------------------ */

                .social {
                  width: auto;
                }

                .social td {
                  padding: 0;
                  width: auto;
                }

                .social_icon {
                  height: 20px;
                  margin: 0 8px 10px 8px;
                  padding: 0;
                }
                /* Data table ------------------------------ */

                .purchase {
                  width: 100%;
                  margin: 0;
                  padding: 35px 0;
                  -premailer-width: 100%;
                  -premailer-cellpadding: 0;
                  -premailer-cellspacing: 0;
                }

                .purchase_content {
                  width: 100%;
                  margin: 0;
                  padding: 25px 0 0 0;
                  -premailer-width: 100%;
                  -premailer-cellpadding: 0;
                  -premailer-cellspacing: 0;
                }

                .purchase_item {
                  padding: 10px 0;
                  color: #51545E;
                  font-size: 15px;
                  line-height: 18px;
                }

                .purchase_heading {
                  padding-bottom: 8px;
                  border-bottom: 1px solid #EAEAEC;
                }

                .purchase_heading p {
                  margin: 0;
                  color: #85878E;
                  font-size: 12px;
                }

                .purchase_footer {
                  padding-top: 15px;
                  border-top: 1px solid #EAEAEC;
                }

                .purchase_total {
                  margin: 0;
                  text-align: right;
                  font-weight: bold;
                  color: #333333;
                }

                .purchase_total--label {
                  padding: 0 15px 0 0;
                }

                body {
                  background-color: #F4F4F7;
                  color: #51545E;
                }

                p {
                  color: #51545E;
                }

                p.sub {
                  color: #6B6E76;
                }

                .email-wrapper {
                  width: 100%;
                  margin: 0;
                  padding: 0;
                  -premailer-width: 100%;
                  -premailer-cellpadding: 0;
                  -premailer-cellspacing: 0;
                  background-color: #F4F4F7;
                }

                .email-content {
                  width: 100%;
                  margin: 0;
                  padding: 0;
                  -premailer-width: 100%;
                  -premailer-cellpadding: 0;
                  -premailer-cellspacing: 0;
                }
                /* Masthead ----------------------- */

                .email-masthead {
                  padding: 25px 0;
                  text-align: center;
                }

                .email-masthead_logo {
                  width: 94px;
                }

                .email-masthead_name {
                  font-size: 16px;
                  font-weight: bold;
                  color: #A8AAAF;
                  text-decoration: none;
                  text-shadow: 0 1px 0 white;
                }
                /* Body ------------------------------ */

                .email-body {
                  width: 100%;
                  margin: 0;
                  padding: 0;
                  -premailer-width: 100%;
                  -premailer-cellpadding: 0;
                  -premailer-cellspacing: 0;
                  background-color: #FFFFFF;
                }

                .email-body_inner {
                  width: 570px;
                  margin: 0 auto;
                  padding: 0;
                  -premailer-width: 570px;
                  -premailer-cellpadding: 0;
                  -premailer-cellspacing: 0;
                  background-color: #FFFFFF;
                }

                .email-footer {
                  width: 570px;
                  margin: 0 auto;
                  padding: 0;
                  -premailer-width: 570px;
                  -premailer-cellpadding: 0;
                  -premailer-cellspacing: 0;
                  text-align: center;
                }

                .email-footer p {
                  color: #6B6E76;
                }

                .body-action {
                  width: 100%;
                  margin: 30px auto;
                  padding: 0;
                  -premailer-width: 100%;
                  -premailer-cellpadding: 0;
                  -premailer-cellspacing: 0;
                  text-align: center;
                }

                .body-sub {
                  margin-top: 25px;
                  padding-top: 25px;
                  border-top: 1px solid #EAEAEC;
                }

                .content-cell {
                  padding: 35px;
                }
                /*Media Queries ------------------------------ */

                @media only screen and (max-width: 600px) {
                  .email-body_inner,
                  .email-footer {
                    width: 100% !important;
                  }
                }

                @media (prefers-color-scheme: dark) {
                  body,
                  .email-body,
                  .email-body_inner,
                  .email-content,
                  .email-wrapper,
                  .email-masthead,
                  .email-footer {
                    background-color: #333333 !important;
                    color: #FFF !important;
                  }
                  p,
                  ul,
                  ol,
                  blockquote,
                  h1,
                  h2,
                  h3 {
                    color: #FFF !important;
                  }
                  .attributes_content,
                  .discount {
                    background-color: #222 !important;
                  }
                  .email-masthead_name {
                    text-shadow: none !important;
                  }
                }
                </style>
                <!--[if mso]>
                <style type="text/css">
                  .f-fallback  {
                    font-family: Arial, sans-serif;
                  }
                </style>
              <![endif]-->
              </head>
              <body>
                <span class="preheader">This is an invoice for your purchase on '.$user_order['added_on'].'. </span>
                <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                  <tr>
                    <td align="center">
                      <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                        <tr>
                          <td class="email-masthead">
                            <a href="http://www.ovi.com/new_project/E_Commerce_Project/" class="f-fallback email-masthead_name">
                            E-Shop Ltd.
                          </a>
                          </td>
                        </tr>
                        <!-- Email Body -->
                        <tr>
                          <td class="email-body" width="100%" cellpadding="0" cellspacing="0">
                            <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                              <!-- Body content -->
                              <tr>
                                <td class="content-cell">
                                  <div class="f-fallback">
                                    <h1>Hi ! '.$user_order['name'].',</h1>
                                    <p>Thanks for using E-Shop Ltd. This is an invoice for your recent purchase.</p>
                                    <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                      <tr>
                                        <td class="attributes_content">
                                          <table width="100%" cellpadding="0" cellspacing="0" role="presentation">';

                                        if($user_order['payment_type']=='online'){
                                            $html.='<tr>
                                                       <td class="attributes_item">
                                                         <span class="f-fallback">
                                                           <strong>Amount Paid:</strong> &#2547; '.$user_order['total_price'].'
                                                         </span>
                                                       </td>
                                                     </tr>
                                                     <tr>
                                                       <td class="attributes_item">
                                                         <span class="f-fallback">
                                                           <strong>Payment Method: </strong>'.$user_order['payment_method'].'
                                                         </span>
                                                       </td>
                                                     </tr>
                                                     <tr>
                                                       <td class="attributes_item">
                                                         <span class="f-fallback">
                                                           <strong>Payment ID: </strong>'.$user_order['pay_id'].'
                                                         </span>
                                                       </td>
                                                     </tr>
                                                     <tr>
                                                      <td class="attributes_item">
                                                        <span class="f-fallback">
                                                          <strong>Transaction ID: </strong>'.$user_order['txnid'].'
                                                        </span>
                                                      </td>
                                                    </tr>';
                                        }else{
                                            $html.='<tr>
                                                       <td class="attributes_item">
                                                         <span class="f-fallback">
                                                           <strong>Amount Due:</strong> &#2547; '.$user_order['total_price'].'
                                                         </span>
                                                       </td>
                                                    </tr>
                                                    <tr>
                                                      <td class="attributes_item">
                                                        <span class="f-fallback">
                                                          <strong>Payment Method: </strong>'.$user_order['payment_method'].'
                                                        </span>
                                                      </td>
                                                    </tr>';
                                        }


                                          $html.='</table>
                                        </td>
                                      </tr>
                                    </table>
                                    <!-- Action -->

                                    <table class="purchase" width="100%" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td>
                                          <h3>Order Id: '.$user_order['id'].'</h3>
                                        </td>
                                        <td>
                                          <h3 class="align-right">Order Date: '.$user_order['added_on'].'</h3>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td colspan="2">
                                          <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <th class="purchase_heading" align="left">
                                                <p class="f-fallback">Description</p>
                                              </th>
                                              <th class="purchase_heading" align="right">
                                                <p class="f-fallback">Amount</p>
                                              </th>
                                            </tr>
                                            Invoice Details';

                                            while($row=mysqli_fetch_assoc($res)){
                                                $total_price=$total_price+($row['qty']*$row['price']);
                                                $html.='<tr>
                                                          <td width="20%" class="purchase_item"><span class="f-fallback">'.$row['name'].'</span></td>
                                                          <td width="80%" class="align-right" class="purchase_item"><span class="f-fallback">'.$row['qty'].'x&#2547;'.$row['price'].' = &#2547;'.$row['qty']*$row['price'].'</span></td>
                                                        </tr>';

                                            }
                                            $delivery=25;
                                            $grand_price=$total_price+$delivery;
                                            $coupon_value=$user_order['coupon_value'];
                                            $final_price=$grand_price-$coupon_value;

                                            $html.='<tr>
                                              <td width="80%" class="purchase_footer" valign="middle">
                                                <p class="f-fallback purchase_total purchase_total--label">Total</p>
                                              </td>
                                              <td width="20%" class="purchase_footer" valign="middle">
                                                <p class="f-fallback purchase_total">&#2547; '.$total_price.'</p>
                                              </td>
                                            </tr>

                                            <tr>
                                              <td width="80%" class="purchase_footer" valign="middle">
                                                <p class="f-fallback purchase_total purchase_total--label">Delivery Charge</p>
                                              </td>
                                              <td width="20%" class="purchase_footer" valign="middle">
                                                <p class="f-fallback purchase_total">&#2547; '.$delivery.'</p>
                                              </td>
                                            </tr>

                                            <tr>
                                              <td width="80%" class="purchase_footer" valign="middle">
                                                <p class="f-fallback purchase_total purchase_total--label">Grand Total</p>
                                              </td>
                                              <td width="20%" class="purchase_footer" valign="middle">
                                                <p class="f-fallback purchase_total">&#2547; '.$grand_price.'</p>
                                              </td>
                                            </tr>';

                                        if($coupon_value!=''){
                                            $html.='<tr>
                                                          <td width="80%" class="purchase_footer" valign="middle">
                                                            <p class="f-fallback purchase_total purchase_total--label">Coupon Discount Value</p>
                                                          </td>
                                                          <td width="20%" class="purchase_footer" valign="middle">
                                                            <p class="f-fallback purchase_total">&#2547; '.$coupon_value.'</p>
                                                          </td>
                                                    </tr>
                                                    <tr>
                                                          <td width="80%" class="purchase_footer" valign="middle">
                                                            <p class="f-fallback purchase_total purchase_total--label">Final Grand Total</p>
                                                          </td>
                                                          <td width="20%" class="purchase_footer" valign="middle">
                                                            <p class="f-fallback purchase_total">&#2547; '.$final_price.'</p>
                                                          </td>
                                                    </tr>';
                                        }

                                        $html.='
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                    <p>If you have any questions about this invoice, simply reply to this email or reach out to our <a href="{{support_url}}">support team</a> for help.</p>
                                    <p>Cheers,
                                      <br>The E-Shop Online Team</p>
                                    <!-- Sub copy -->

                                  </div>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                              <tr>
                                <td class="content-cell" align="center">
                                  <p class="f-fallback sub align-center">&copy; 2020 E-Shop Ltd. All rights reserved.</p>
                                  <p class="f-fallback sub align-center">
                                    [E-Shop Ltd]
                                    <br>Lalbagh Rd, Lalbagh Fort.
                                    <br>Dhaka 1211
                                  </p>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </body>
            </html>';
        
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
            $mail->AddAddress($user_order['email']);
            if($mail->Send()){
                //echo 'yes';
            }else{
                //echo 'no';
            }
    }

?>