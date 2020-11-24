<?php
  //include header.php page
  require('header.inc.php');

  //check admin or not.If not admin then redirect product page through call isAdmin() function
  isAdmin();
      
  
  //hold order id
  $order_id = get_safe_value($con,$_GET['id']);

  //fetch coupon details from database
    $coupon_details=mysqli_fetch_assoc(mysqli_query($con,"SELECT coupon_value FROM order_tbl WHERE id='$order_id'"));
  //hold coupon value
    $coupon_value=$coupon_details['coupon_value'];


  //update order status
  if(isset($_POST['update_order_status'])){
      $update_order_status=$_POST['update_order_status'];
      mysqli_query($con,"UPDATE order_tbl SET order_status='$update_order_status' WHERE id='$order_id'");
  }

  //update payment status
  if(isset($_POST['update_payment_status'])){
      $update_payment_status=$_POST['update_payment_status'];
      mysqli_query($con,"UPDATE order_tbl SET payment_status='$update_payment_status' WHERE id='$order_id'");
  }

?> 

<div class="content pb-0">
    <div class="orders">
       <div class="row">
          <div class="col-xl-12">
             <div class="card">
                <div class="card-body">
                   <h4 class="box-title">Order Details</h4>
                </div>
                <div class="card-body--">
                   <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-name">Product Name</th>
                                    <th class="product-thumbnail"><span class="nobr">Product Image</span></th>
                                    <th class="product-name"><span class="nobr"> Qty </span></th>
                                    <th class="product-price"><span class="nobr">Price</span></th>
                                    <th class="product-price"><span class="nobr">Total Price</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $res = mysqli_query($con, "SELECT distinct(order_details.id),order_details.*,product.name,product.image,order_tbl.address,order_tbl.city,order_tbl.post_code FROM order_details,product,order_tbl WHERE order_details.order_id='$order_id' AND order_details.product_id=product.id");
                                    $total_price=0;
                                    while($row=mysqli_fetch_assoc($res)){
                                        $address=$row['address'];
                                        $city=$row['city'];
                                        $post=$row['post_code'];
                                        $total_price=$total_price+($row['qty']*$row['price']);
                                ?>
                                <tr>
                                    <td class="product-name"><?php echo $row['name'];?></td>
                                    <td class="product-thumbnail"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>"></td>
                                    <td class="product-name"><?php echo $row['qty'];?></td>
                                    <td class="product-price">&#2547; <?php echo $row['price'];?></td>
                                    <td class="product-price">&#2547; <?php echo $row['qty']*$row['price'];?></td>
                                </tr>
                                <?php } ?>
                                
                                  <tr>
                                        <td colspan="3"></td>
                                        <td class="product-price">Total </td>
                                        <td class="product-price">&#2547; <?php echo $total_price;?></td>
                                  </tr>
                                   <tr>
                                        <td colspan="3"></td>
                                        <td class="product-price">Delivery Charge </td>
                                        <td class="product-price">&#2547; 25</td>
                                   </tr>
                                   <tr>
                                        <td colspan="3"></td>
                                        <td class="product-price">Grand Total </td>
                                        <td class="product-price">&#2547; <?php echo $total_price+25;?></td>
                                   </tr>
                                   <?php
                                        if($coupon_value!=''){
                                    ?>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="product-price">Coupon Discount Value </td>
                                                <td class="product-price">&#2547; <?php echo $coupon_value;?></td>
                                            </tr>  
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="product-price">Final Grand Total </td>
                                                <td class="product-price">&#2547; <?php echo ($total_price+25)-$coupon_value;?></td>
                                            </tr>
                                   <?php } ?> 
                                     
                            </tbody>
                       </table>
                       <div id="address_details">
                           <strong>Address: </strong>
                           <?php echo $address;?>, <?php echo $city;?>, <?php echo $post;?><br/><br/>
                           <strong>Order Status: </strong>
                           <?php
                                //hold order status
                                $order_status_arr=mysqli_fetch_assoc(mysqli_query($con,"SELECT order_status.name FROM order_status,order_tbl WHERE order_tbl.id='$order_id' AND order_tbl.order_status=order_status.id"));
                                //show order status
                                echo $order_status_arr['name']."<br/><br/>";
                           ?>
                           
                           <strong>Payment Status: </strong>
                           <?php
                                //hold payment status
                                $payment_status_arr=mysqli_fetch_assoc(mysqli_query($con,"SELECT payment_status FROM order_tbl WHERE id='$order_id'"));
                                //show payment status
                                echo $payment_status_arr['payment_status']."<br/><br/>";
                           ?>
                           
                           <div class="form-group">
                               <form method="post">
                                   <select class="form-control" name="update_order_status">
                                       <option>Select Status</option>
                                       <!--== Write while loop for show all category name from categories table ==-->
                                       <?php
                                          //write select query to get all data from order_status table
                                          $sql = "SELECT * FROM order_status";
                                          //execute this select query by using 'mysqli_query()' function
                                          $res = mysqli_query($con, $sql);
                                          //hold/put all id & status name inside $row array by using 'mysqli_fetch_assoc()' function 
                                          while($row=mysqli_fetch_assoc($res)){
                                                  //show category name & hold id number
                                                  echo "<option value=".$row['id'].">".$row['name']."</option>";
                                              
                                          }
                                       ?>
                                   </select>
                                   <input type="submit" class="btn btn-lg btn-info btn-block" value="Update Order Status">
                               </form>
                           </div>
                           
                           
                           <div class="form-group">
                               <form method="post">
                                   <select class="form-control" name="update_payment_status">
                                       <option>Select Status</option>
                                       <option value="Pending">Pending</option>
                                       <option value="Success">Success</option>
                                       <option value="Failed">Failed</option>
                                   </select>
                                   <input type="submit" class="btn btn-lg btn-info btn-block" value="Update Payment Status">
                               </form>
                           </div>
                           
                           
                       </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>

<?php
   //include footer.php page
   require('footer.inc.php');
?>