<?php
  //include header.php page
  require('header.inc.php');

  //hold login user/admin id from session for using only show those products which are added by that user 
  $admin_id=$_SESSION['ADMIN_ID'];

?> 

<div class="content pb-0">
    <div class="orders">
       <div class="row">
          <div class="col-xl-12">
             <div class="card">
                <div class="card-body">
                   <h4 class="box-title">Order List</h4>
                </div>
                <div class="card-body--">
                   <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Order ID</th>
                                    <th class="product-name"><span class="nobr">Product Name</span></th>
                                    <th class="product-name"><span class="nobr">Qty</span></th>
                                    <th class="product-price"><span class="nobr"> Address </span></th>
                                    <th class="product-add-to-cart"><span class="nobr">Payment Type</span></th>
                                    <th class="product-add-to-cart"><span class="nobr">Payment Status</span></th>
                                    <th class="product-add-to-cart"><span class="nobr">Order Status</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $res = mysqli_query($con, "SELECT order_details.qty,product.name,order_tbl.*,order_status.name as order_status_str FROM order_details,product,order_tbl,order_status WHERE order_status.id=order_tbl.order_status AND product.id=order_details.product_id AND order_tbl.id=order_details.order_id AND product.added_by_user_id='$admin_id' ORDER BY order_tbl.id DESC");
                                    while($row=mysqli_fetch_assoc($res)){
                                ?>
                                <tr>
                                    <td class="product-add-to-cart">
                                        <?php echo $row['id'];?>
                                    </td>
                                    <td class="product-name"><?php echo $row['name'];?></td>
                                    <td class="product-name"><?php echo $row['qty'];?></td>
                                    <td class="product-name">
                                        <?php echo $row['address'];?><br/>
                                        <?php echo $row['city'];?><br/>
                                        <?php echo $row['post_code'];?>
                                    </td>
                                    <td class="product-name"><?php echo $row['payment_type'];?></td>
                                    <td class="product-price"><?php echo $row['payment_status'];?></td>
                                    <td class="product-price"><?php echo $row['order_status_str'];?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                       </table>
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