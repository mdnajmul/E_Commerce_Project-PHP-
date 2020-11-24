<?php
  //include header.php page
  require('header.inc.php');

  //check admin or not.If not admin then redirect product page through call isAdmin() function
  isAdmin();
      
  /**This is for Delete Button.**/
  if(isset($_GET['type']) && $_GET['type']!=''){
      $type = get_safe_value($con, $_GET['type']);	  
      //check user click delete button
      if($type=='delete'){
          //hold 'id' that we pass when click Delete Button & pass these data with 'Database connection link' through 'get_safe_value()' function
          $id = get_safe_value($con, $_GET['id']);
          //write delete query for delete data
          $delete_sql = "DELETE FROM users WHERE id='$id'";
          //execute this delete query by using 'mysqli_query()' function
          mysqli_query($con, $delete_sql);
      }
  }

      //write select query for show data from 'users' table
      $sql = "SELECT * FROM users ORDER BY id DESC";
      //execute this $sql query through by 'mysqli_query(database_connection, query)' function
      $res = mysqli_query($con, $sql);

?> 

<div class="content pb-0">
    <div class="orders">
       <div class="row">
          <div class="col-xl-12">
             <div class="card">
                <div class="card-body">
                   <h4 class="box-title">Users List</h4>
                </div>
                <div class="card-body--">
                   <div class="table-stats order-table ov-h">
                      <table class="table ">
                         <thead>
                            <tr>
                               <th class="serial">#</th>
                               <th>ID</th>
                               <th>Name</th>
                               <th>Email</th>
                               <th>Mobile</th>
                               <th>Date</th>
                               <th></th>
                            </tr>
                         </thead>
                         <tbody>
                           <!-- Write while loop to show data from database 'users' table -->
                           <?php 
                              //create a variable for show serial number
                              $i = 1;
                              //hold/put all data from 'users' table by using 'mysqli_fetch_assoc()'
                              while($row=mysqli_fetch_assoc($res)){ ?>
                            <tr>
                               <td class="serial"><?php echo $i; ?></td>
                               <td><?php echo $row['id']; ?></td>
                               <td><?php echo $row['name']; ?></td>
                               <td style="text-transform:lowercase;"><?php echo $row['email']; ?></td>
                               <td><?php echo $row['mobile']; ?></td>
                               <td><?php echo $row['added_on']; ?></td>
                               <td>
                                   <?php 
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