<?php
  //include header.php page
  require('header.inc.php');

  //check admin or not.If not admin then redirect product page through call isAdmin() function
  isAdmin();

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
          $update_status_sql = "UPDATE coupon_master SET status='$status' WHERE id='$id'";
          //execute this update query by using 'mysqli_query()' function
          mysqli_query($con, $update_status_sql);
      }
      
      
      //This is for Delete option
      if($type=='delete'){
          //hold 'id' that we pass when click Delete Button & pass these data with 'Database connection link' through 'get_safe_value()' function
          $id = get_safe_value($con, $_GET['id']);
          //write delete query for delete data
          $delete_sql = "DELETE FROM coupon_master WHERE id='$id'";
          //execute this delete query by using 'mysqli_query()' function
          mysqli_query($con, $delete_sql);
      }
  }

  //write join select query for show data from 'product & categories' table
  $sql = "SELECT * FROM coupon_master ORDER BY id DESC";
  //execute this $sql query through by 'mysqli_query(database_connection, query)' function
  $res = mysqli_query($con, $sql);

?> 

<div class="content pb-0">
    <div class="orders">
       <div class="row">
          <div class="col-xl-12">
             <div class="card">
                <div class="card-body">
                   <h4 class="box-title">Coupon Master </h4>
                   <h4 class="box-link"><a href="add_coupon_master.php">Add Coupon</a></h4>
                </div>
                <div class="card-body--">
                   <div class="table-stats order-table ov-h">
                      <table class="table ">
                         <thead>
                            <tr>
                               <th class="serial">#</th>
                               <th width="2%">ID</th>
                               <th width="20%">Coupon Code</th>
                               <th width="20%">Coupon Value</th>
                               <th width="20%">Coupon Type</th>
                               <th width="15%">Cart Min Value</th>
                               <th width="23%"></th>
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
                               <td><?php echo $row['coupon_code']; ?></td>
                               <td><?php echo $row['coupon_value']; ?></td>
                               <td><?php echo $row['coupon_type']; ?></td>
                               <td>&#2547; <?php echo $row['cart_min_value']; ?></td>
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
                                      echo "<span class='badge badge-edit'><a href='add_coupon_master.php?id=".$row['id']."'>Edit</a></span>&nbsp;"; 
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