<?php
  //include header.php page
  require('header.inc.php');

 //check admin or not.If not admin then redirect product page through call isAdmin() function
 isAdmin();

  //initialy $categories name value & $sub_categories name value is null.When click edit button then assigned value in this $categories,$sub_categories variable
  $categories = '';
  $msg = '';
  $sub_categories = '';


  /**This is for show only that id's data which one user click for Edit inside sub categories section**/
  if(isset($_GET['id']) && $_GET['id']!=''){
      //hold 'id' value & pass it with 'database connection link' through 'get_safe_value()' method in function.inc.php page
      $id = get_safe_value($con, $_GET['id']);
      //write select query for show data from sub_categories table which one we want edit
      $sql = "SELECT * FROM sub_categories WHERE id='$id'";
      //execute this select query by using 'mysqli_query()' function
      $res = mysqli_query($con, $sql);
      
      /*It hold $check value is 1 if user click valid id number data which are already store into database*/
      $check = mysqli_num_rows($res);
      if($check>0) {
          //hold/put all data from 'sub_categories' table by using 'mysqli_fetch_assoc()'
          $row = mysqli_fetch_assoc($res);
          //hold 'sub_category' & 'category_id' from $row array
          $sub_categories = $row['sub_category'];  
          $categories = $row['category_id'];  
      }
      /*if user click unvalid id number data which are not store into database then redirect/transefer user to sub_categories.php page*/
      else{
          //redirect/transfer to sub_categories page of our project by 'header()' function
          header('location:sub_categories.php');
          die(); 
      }
      
  }


  /**This is for when click Submit Button.**/
  if(isset($_POST['submit'])){
      //hold 'categories_id' value , 'sub_categories' value & pass it with 'database connection link' through 'get_safe_value()' method in function.inc.php page
      $categories = get_safe_value($con, $_POST['categories_id']);
      $sub_categories = get_safe_value($con, $_POST['sub_categories']);
      
      
      /**Here,When we try to add any data then this section check that data already exist in database.If that data already exists then show a error message**/
      //write select query for check data from sub_categories table which one we want to add
      $sql = "SELECT * FROM sub_categories WHERE category_id='$categories' AND sub_category='$sub_categories'";
      //execute this select query by using 'mysqli_query()' function
      $res = mysqli_query($con, $sql); 
      /*It hold $check value is 1 if user click valid id number data which are already store into database*/
      $check = mysqli_num_rows($res);
      //write condition for check data already exist or not in database
      if($check>0){
          //This condition is write for when we edit data.If data was same then don't show error message & redirect to sub_categories page
          if(isset($_GET['id']) && $_GET['id']!=''){
              //fetch all data when we click edit button
              $getData = mysqli_fetch_assoc($res);
              //check edit category id & category id are same.if not same then show error message(It means we do not edit data,we add data.So,data already exist) 
              if($id==$getData['id']){
                  $msg = '';
              } else{
                  $msg ="This Sub Category already exist !";
              }
          } else{
             $msg ="This Sub Category already exist !"; 
          }   
      } 
         
         //$msg is empty means we edit/update data. If $msg is not empty means we add data
         if($msg==''){
          /** This section is validate that when user click Submit Button , Then this data will be Add/Insert or Update **/
          if(isset($_GET['id']) && $_GET['id']!=''){
              //write update query for update category name & sub category name into database
              $sql ="UPDATE sub_categories SET category_id='$categories',sub_category='$sub_categories' WHERE id='$id'";
              //execute this update query by using 'mysqli_query()' function
              mysqli_query($con, $sql);
          } else{
              //write insert query for insert sub_categories into database
              $sql ="INSERT INTO sub_categories(category_id,sub_category,status) VALUES('$categories','$sub_categories', '1')";
              //execute this insert query by using 'mysqli_query()' function
              mysqli_query($con, $sql);
          }

          //redirect/transfer to sub categories page of our project by 'header()' function
          header('location:sub_categories.php');
          die();
         }
      }

?> 

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Sub Categories</strong><small> Form</small></div>
                        <form method="post">
                            <div class="card-body card-block">
                                  <div class="form-group">
                                       <label for="categories" class=" form-control-label">Categories</label>
                                       <select name="categories_id" class="form-control" required>
                                           <option value="">Select Categories</option>
                                           <?php
                                              $res=mysqli_query($con,"SELECT * FROM categories WHERE status='1'");
                                              while($row=mysqli_fetch_assoc($res)){
                                                  if($row['id']==$categories){
                                                      echo "<option value=".$row['id']." selected>".$row['category']."</option>";
                                                  } else{
                                                      echo "<option value=".$row['id'].">".$row['category']."</option>";
                                                  }
                                              }
                                           ?>
                                       </select>
                                   </div>
                                   
                                   <div class="form-group">
                                       <label for="categories" class=" form-control-label">Sub Categories</label>
                                       <input type="text" name="sub_categories" placeholder="Enter sub category" class="form-control" required value="<?php echo $sub_categories; ?>">
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