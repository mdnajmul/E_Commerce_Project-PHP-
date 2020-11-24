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

    //hold order id
    $order_id = get_safe_value($con,$_GET['id']);

    //fetch coupon details from database
    $coupon_details=mysqli_fetch_assoc(mysqli_query($con,"SELECT coupon_value FROM order_tbl WHERE id='$order_id'"));
    //hold coupon value
    $coupon_value=$coupon_details['coupon_value'];
?>



      <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/3.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Order Details</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- wishlist-area start -->
        <div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
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
                                                $uid = $_SESSION['USER_ID'];
                                                $res = mysqli_query($con, "SELECT distinct(order_details.id),order_details.*,product.name,product.image FROM order_details,product,order_tbl WHERE order_details.order_id='$order_id' AND order_tbl.user_id='$uid' AND order_details.product_id=product.id");
                                                $total_price=0;
                                                while($row=mysqli_fetch_assoc($res)){
                                                    $total_price=$total_price+($row['qty']*$row['price']);
                                            ?>
                                            <tr>
                                                <td class="product-name"><?php echo $row['name'];?></td>
                                                <td class="product-thumbnail"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>"></td>
                                                <td class="product-name"><?php echo $row['qty'];?></td>
                                                <td class="product-price">&#2547; <?php echo $row['price'];?></td>
                                                <td class="product-price">&#2547; <?php echo $row['qty']*$row['price'];?></td>
                                            </tr>
                                            <?php }  ?>
                                            
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
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- wishlist-area end -->


<?php
   //include footer page
   require('foot.inc.php');
?> 