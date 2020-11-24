<?php
  //include header.php page
  require('header.inc.php');

  //hold login user/admin id from session for using only show those products which are added by that user 
  $admin_id=$_SESSION['ADMIN_ID'];

  //admin can see,delete,update all products but user can see,update,delete only his products which are he added
  $condition_sql='';
  $condition_sql_update_or_delete='';
  if($_SESSION['ADMIN_ROLE']==1){
      $condition_sql=" AND product.added_by_user_id='$admin_id'";
      $condition_sql_update_or_delete=" AND added_by_user_id='$admin_id'";
  }


  //This is for Active & Deactive Button.
  if(isset($_GET['type']) && $_GET['type']!=''){
      //hold 'type' value & pass it with 'database connection link' through 'get_safe_value()' method in function.inc.php page
      $type = get_safe_value($con, $_GET['type']);
      if($type=='status'){
          //hold all data(operation,id) that we pass when click Active or Deactive Button & pass these data with 'Database connection link' through 'get_safe_value()' function
          $operation = get_safe_value($con, $_GET['operation']);
          $id = get_safe_value($con, $_GET['id']);
          //update depends on operation
          if($operation=='active'){
              $status='1';
          } else{
              $status='0';
          }
          //write update query for update status
          $update_status_sql = "UPDATE product SET status='$status' WHERE id='$id' $condition_sql_update_or_delete";
          //execute this update query by using 'mysqli_query()' function
          mysqli_query($con, $update_status_sql);
      }
      
      
      //This is for Delete option
      if($type=='delete'){
          //hold 'id' that we pass when click Delete Button & pass these data with 'Database connection link' through 'get_safe_value()' function
          $id = get_safe_value($con, $_GET['id']);
          //write delete query for delete data
          $delete_sql = "DELETE FROM product WHERE id='$id' $condition_sql_update_or_delete";
          //execute this delete query by using 'mysqli_query()' function
          mysqli_query($con, $delete_sql);
      }
  }


  //write join select query for show data from 'product & categories' table
  $sql = "SELECT product.*,categories.category FROM product,categories WHERE product.categories_id=categories.id $condition_sql ORDER BY product.id DESC";
  //execute this $sql query through by 'mysqli_query(database_connection, query)' function
  $res = mysqli_query($con, $sql);

?> 

<div class="content pb-0">
    <div class="orders">
       <div class="row">
          <div class="col-xl-12">
             <div class="card">
                <div class="card-body">
                   <h4 class="box-title">Products </h4>
                   <h4 class="box-link"><a href="add_product.php">Add Product</a></h4>
                </div>
                <div class="card-body--">
                   <div class="table-stats order-table ov-h">
                      <table class="table ">
                         <thead>
                            <tr>
                               <th class="serial" width="5%">#</th>
                               <th width="5%">ID</th>
                               <th width="5%">Category</th>
                               <th width="13%">Name</th>
                               <th width="13%">Image</th>
                               <th width="10%">MRP</th>
                               <th width="10%">Selling Price</th>
                               <th width="15%">Qty</th>
                               <th width="29%"></th>
                            </tr>
                         </thead>
                         <tbody>
                           <!-- Write while loop to show data from database 'product' table -->
                           <?php 
                              //create a variable for show serial number
                              $i = 1;
                              //hold/put all data from 'product' table by using 'mysqli_fetch_assoc()'
                              while($row=mysqli_fetch_assoc($res)){ ?>
                            <tr>
                               <td class="serial"><?php echo $i; ?></td>
                               <td><?php echo $row['id']; ?></td>
                               <td><?php echo $row['category']; ?></td>
                               <td><?php echo $row['name']; ?></td>
                               <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'];?>"></td>
                               <td>&#2547; <?php echo $row['mrp']; ?></td>
                               <td>&#2547; <?php echo $row['selling_price']; ?></td>
                               <td>
                                   <span style="background-color:blue; color:white; padding:3px 2px; margin-right:3px; border-radius:5px;">Total </span><?php echo $row['qty']; ?><br/><br/>
                                   <?php
                                        $productSoldQtyByProductId = productSoldQtyByProductId($con,$row['id']);
                                        if($productSoldQtyByProductId==''){
                                            $productSoldQtyByProductId=0;
                                        }                           
                                        $available_qty = $row['qty']-$productSoldQtyByProductId;                            
                                   ?>
                                   <span style="background-color:red; color:white; padding:3px 2px; margin-right:3px;border-radius:5px;">Order/Sold </span><?php echo $productSoldQtyByProductId;?><br/><br/>
                                   <span style="background-color:green; color:white; padding:3px 2px; margin-right:3px;border-radius:5px;">Available </span><?php echo $available_qty;?>
                               </td>
                               <td>
                                   <?php 
                                      if($row['status']==1){
                                          //This is for when click Active button then it's Activate
                                          echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
                                      } else{
                                          //This is for when click Deactive button then it's Deactivate
                                          echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
                                      }
                                      //This is for click Edit Button                               
                                      echo "<span class='badge badge-edit'><a href='add_product.php?id=".$row['id']."'>Edit</a></span>&nbsp;"; 
                                      //This is for click Delete Button                               
                                      echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";                              
                                    ?>
                               </td>
                            </tr>
                            <?php $i++; } ?>
                            
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