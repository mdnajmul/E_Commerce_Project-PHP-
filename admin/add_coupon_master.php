<?php
  //include header.php page
  require('header.inc.php');

  //check admin or not.If not admin then redirect product page through call isAdmin() function
  isAdmin();
    
  //initialize all data field from product table
  $coupon_code ='';
  $coupon_value ='';
  $coupon_type ='';
  $cart_min_value ='';
  
  $msg ='';

  /**This is for show only that id's data which one user click for Edit inside product section**/
  if(isset($_GET['id']) && $_GET['id']!=''){
      //hold 'id' value & pass it with 'database connection link' through 'get_safe_value()' method in function.inc.php page
      $id = get_safe_value($con, $_GET['id']);
      //write select query for show data from product table which one we want edit
      $sql = "SELECT * FROM coupon_master WHERE id='$id'";
      //execute this select query by using 'mysqli_query()' function
      $res = mysqli_query($con, $sql);
      
      /*It hold $check value is 1 if user click valid id number data which are already store into database*/
      $check = mysqli_num_rows($res);
      if($check>0) {
          //hold/put all data from 'product' table by using 'mysqli_fetch_assoc()'
          $row = mysqli_fetch_assoc($res);
          //hold all data from $row array
          $coupon_code = $row['coupon_code'];  
          $coupon_value = $row['coupon_value'];  
          $coupon_type = $row['coupon_type'];  
          $cart_min_value = $row['cart_min_value']; 
      }
      /*if user click unvalid id number data which are not store into database then redirect/transefer user to categories.php page*/
      else{
          //redirect/transfer to categories page of our project by 'header()' function
          header('location:coupon_master.php');
          die(); 
      }
      
  }


  /**This is for when click Submit Button.**/
  if(isset($_POST['submit'])){
      //hold all value & pass it with 'database connection link' through 'get_safe_value()' method in function.inc.php page
      $coupon_code = get_safe_value($con, $_POST['coupon_code']);
      $coupon_value = get_safe_value($con, $_POST['coupon_value']);
      $coupon_type = get_safe_value($con, $_POST['coupon_type']);
      $cart_min_value = get_safe_value($con, $_POST['cart_min_value']);
      
      
      /**Here,When we try to add any data then this section check that data already exist in database.If that data already exists then show a error message**/
      //write select query for check data from product table which one we want to add
      $sql = "SELECT * FROM coupon_master WHERE coupon_code='$coupon_code'";
      //execute this select query by using 'mysqli_query()' function
      $res = mysqli_query($con, $sql); 
      /*It hold $check value is 1 if user click valid id number data which are already store into database*/
      $check = mysqli_num_rows($res);
      //write condition for check data already exist or not in database
      if($check>0){
          //This condition is write for when we edit data.If data was same then don't show error message & redirect to product page
          if(isset($_GET['id']) && $_GET['id']!=''){
              //fetch all data when we click edit button
              $getData = mysqli_fetch_assoc($res);
              //check 'edit product id' & 'category id' are same.if not same then show error message(It means we do not edit data,we add data.So,data already exist) 
              if($id==$getData['id']){
                  
              } else{
                  $msg ="This Coupon Code already exist !";
              }
          } else{
             $msg ="This Coupon Code already exist !"; 
          }   
      }
      
     
         
        //$msg is empty means we edit/update data. If $msg is not empty means we add data
        if($msg==''){
             
           /** This section is validate that when user click Submit Button , Then this data will be Add/Insert or Update **/
           if(isset($_GET['id']) && $_GET['id']!=''){
               
              $update_sql = "UPDATE coupon_master SET coupon_code='$coupon_code',coupon_value='$coupon_value',coupon_type='$coupon_type',cart_min_value='$cart_min_value' WHERE id='$id'";
                             
              //execute this update query by using 'mysqli_query()' function
              mysqli_query($con, $update_sql);
              
          } else{
              
              //execute this insert query by using 'mysqli_query()' function
              mysqli_query($con,"insert into coupon_master(coupon_code,coupon_value,coupon_type,cart_min_value,status) values('$coupon_code','$coupon_value','$coupon_type','$cart_min_value',1)");
          }

              //redirect/transfer to categories page of our project by 'header()' function
              header('location:coupon_master.php');
              die();
         }
      }

?> 

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Coupon</strong><small> Form</small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">

                            <div class="form-group">
                                <label for="coupon_code" class=" form-control-label">Coupon Code</label>
                                <input type="text" name="coupon_code" placeholder="Enter coupon code" class="form-control" required value="<?php echo $coupon_code; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="coupon_value" class=" form-control-label">Coupon Value</label>
                                <input type="text" name="coupon_value" placeholder="Enter coupon value" class="form-control" required value="<?php echo $coupon_value; ?>">
                            </div>

                            <div class="form-group">
                                <label for="coupon_type" class=" form-control-label">Coupon Type</label>
                                <select class="form-control" name="coupon_type" required>
                                    <option value="">Select</option>
                                    <?php
                                          if($coupon_type=='Percentage'){
                                             echo "<option value='Percentage' selected>Percentage</option>
                                                   <option value='Taka'>Taka</option>";
                                          }else if($coupon_type=='Taka'){
                                             echo "<option value='Percentage'>Percentage</option>
                                                   <option value='Taka' selected>Taka</option>";
                                          } else{
                                             echo "<option value='Percentage'>Percentage</option>
                                                   <option value='Taka'>Taka</option>";
                                          }
                                       ?>

                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="cart_min_value" class=" form-control-label">Cart Minimum Value</label>
                                <input type="text" name="cart_min_value" placeholder="Enter cart minimum value" class="form-control" required value="<?php echo $cart_min_value; ?>">
                            </div>

                            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                            <!--========================= Create a <div> for show error message =====================-->
                            <div class="field_error"> <?php echo $msg; ?> </div>
                            <!--===========================================================================================-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
   //include footer.php page
   require('footer.inc.php');
?>


