<?php
  //include header.php page
  require('header.inc.php');

  //check admin or not.If not admin then redirect product page through call isAdmin() function
  isAdmin();
    
  //initialize all data field from product table
  $username ='';
  $password ='';
  $email ='';
  $mobile ='';
  
  $msg ='';

  /**This is for show only that id's data which one user click for Edit inside product section**/
  if(isset($_GET['id']) && $_GET['id']!=''){
      //hold 'id' value & pass it with 'database connection link' through 'get_safe_value()' method in function.inc.php page
      $id = get_safe_value($con, $_GET['id']);
      //write select query for show data from product table which one we want edit
      $sql = "SELECT * FROM admin_users WHERE id='$id'";
      //execute this select query by using 'mysqli_query()' function
      $res = mysqli_query($con, $sql);
      
      /*It hold $check value is 1 if user click valid id number data which are already store into database*/
      $check = mysqli_num_rows($res);
      if($check>0) {
          //hold/put all data from 'product' table by using 'mysqli_fetch_assoc()'
          $row = mysqli_fetch_assoc($res);
          //hold all data from $row array
          $username = $row['username'];  
          $password = $row['password']; 
          $email = $row['email']; 
          $mobile = $row['mobile']; 
      }
      /*if user click unvalid id number data which are not store into database then redirect/transefer user to categories.php page*/
      else{
          //redirect/transfer to categories page of our project by 'header()' function
          ?>
                <script>
                    window.location.href='vendor_management.php';
                </script>
          <?php
          die();
      }
      
  }


  /**This is for when click Submit Button.**/
  if(isset($_POST['submit'])){
      //hold all value & pass it with 'database connection link' through 'get_safe_value()' method in function.inc.php page
      $username = get_safe_value($con, $_POST['username']);
      $password = get_safe_value($con, $_POST['password']);
      $email = get_safe_value($con, $_POST['email']);
      $mobile = get_safe_value($con, $_POST['mobile']);
      
      
      /**Here,When we try to add any data then this section check that data already exist in database.If that data already exists then show a error message**/
      //write select query for check data from product table which one we want to add
      $sql = "SELECT * FROM admin_users WHERE username='$username'";
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
                  $msg ="This username already exist !";
              }
          } else{
             $msg ="This username already exist !"; 
          }   
      }
      
     
         
        //$msg is empty means we edit/update data. If $msg is not empty means we add data
        if($msg==''){
             
           /** This section is validate that when user click Submit Button , Then this data will be Add/Insert or Update **/
           if(isset($_GET['id']) && $_GET['id']!=''){
               
              $update_sql = "UPDATE admin_users SET username='$username',password='$password',email='$email',mobile='$mobile' WHERE id='$id'";
                             
              //execute this update query by using 'mysqli_query()' function
              mysqli_query($con, $update_sql);
              
          } else{
              
              //execute this insert query by using 'mysqli_query()' function
              mysqli_query($con,"insert into admin_users(username,password,role,email,mobile,status) values('$username','$password',1,'$email','$mobile',1)");
          }

              //redirect/transfer to categories page of our project by 'header()' function
              ?>
                <script>
                    window.location.href='vendor_management.php';
                </script>
              <?php
              die();
         }
      }

?> 

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Vendor Management</strong><small> Form</small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">

                            <div class="form-group">
                                <label for="username" class=" form-control-label">Username</label>
                                <input type="text" name="username" placeholder="Enter username*" class="form-control" required value="<?php echo $username; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="password" class=" form-control-label">Password</label>
                                <input type="password" name="password" placeholder="Enter password*" class="form-control" required value="<?php echo $password; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="email" class=" form-control-label">Email</label>
                                <input type="email" name="email" placeholder="Enter email*" class="form-control" required value="<?php echo $email; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="mobile" class=" form-control-label">Mobile</label>
                                <input type="text" name="mobile" placeholder="Enter Mobile*" class="form-control" required pattern="[0]{1}[1]{1}[3-9]{1}[0-9]{8}" value="<?php echo $mobile; ?>">
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


