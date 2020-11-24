<?php
  //include header.php page
  require('header.inc.php');

  //check admin or not.If not admin then redirect product page through call isAdmin() function
  isAdmin();

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
                                    <th class="product-name"><span class="nobr">Order Date</span></th>
                                    <th class="product-price"><span class="nobr"> Address </span></th>
                                    <th class="product-add-to-cart"><span class="nobr">Payment Type</span></th>
                                    <th class="product-add-to-cart"><span class="nobr">Payment Status</span></th>
                                    <th class="product-add-to-cart"><span class="nobr">Order Status</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $res = mysqli_query($con, "SELECT order_tbl.*,order_status.name as order_status_str FROM order_tbl,order_status WHERE order_status.id=order_tbl.order_status ORDER BY order_tbl.id DESC");
                                    while($row=mysqli_fetch_assoc($res)){
                                ?>
                                <tr>
                                    <td class="product-add-to-cart">
                                        <a href="order_master_details.php?id=<?php echo $row['id'];?>"><?php echo $row['id'];?></a><br/><br/>
                                        <a href="../order_pdf.php?id=<?php echo $row['id'];?>">Pdf</a>
                                    </td>
                                    <td class="product-name"><?php echo $row['added_on'];?></td>
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