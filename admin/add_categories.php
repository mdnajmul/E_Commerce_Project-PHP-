<?php
  //include header.php page
  require('header.inc.php');

  //check admin or not.If not admin then redirect product page through call isAdmin() function
  isAdmin();

  //initialy $category_name value is null.When click edit button then assigned value in this $category_name variable
  $category_name = '';
  $msg = '';


  /**This is for show only that id's data which one user click for Edit inside categories section**/
  if(isset($_GET['id']) && $_GET['id']!=''){
      //hold 'id' value & pass it with 'database connection link' through 'get_safe_value()' method in function.inc.php page
      $id = get_safe_value($con, $_GET['id']);
      //write select query for show data from categories table which one we want edit
      $sql = "SELECT * FROM categories WHERE id='$id'";
      //execute this select query by using 'mysqli_query()' function
      $res = mysqli_query($con, $sql);
      
      /*It hold $check value is 1 if user click valid id number data which are already store into database*/
      $check = mysqli_num_rows($res);
      if($check>0) {
          //hold/put all data from 'categories' table by using 'mysqli_fetch_assoc()'
          $row = mysqli_fetch_assoc($res);
          //hold only 'category' name from $row array
          $category_name = $row['category'];  
      }
      /*if user click unvalid id number data which are not store into database then redirect/transefer user to categories.php page*/
      else{
          //redirect/transfer to categories page of our project by 'header()' function
          header('location:categories.php');
          die(); 
      }
      
  }


  /**This is for when click Submit Button.**/
  if(isset($_POST['submit'])){
      //hold 'categories' value & pass it with 'database connection link' through 'get_safe_value()' method in function.inc.php page
      $categories = get_safe_value($con, $_POST['categories']);
      
      
      /**Here,When we try to add any data then this section check that data already exist in database.If that data already exists then show a error message**/
      //write select query for check data from categories table which one we want to add
      $sql = "SELECT * FROM categories WHERE category='$categories'";
      //execute this select query by using 'mysqli_query()' function
      $res = mysqli_query($con, $sql); 
      /*It hold $check value is 1 if user click valid id number data which are already store into database*/
      $check = mysqli_num_rows($res);
      //write condition for check data already exist or not in database
      if($check>0){
          //This condition is write for when we edit data.If data was same then don't show error message & redirect to categories page
          if(isset($_GET['id']) && $_GET['id']!=''){
              //fetch all data when we click edit button
              $getData = mysqli_fetch_assoc($res);
              //check edit category id & category id are same.if not same then show error message(It means we do not edit data,we add data.So,data already exist) 
              if($id==$getData['id']){
                  $msg = '';
              } else{
                  $msg ="This Category already exist !";
              }
          } else{
             $msg ="This Category already exist !"; 
          }   
      } 
         
         //$msg is empty means we edit/update data. If $msg is not empty means we add data
         if($msg==''){
          /** This section is validate that when user click Submit Button , Then this data will be Add/Insert or Update **/
          if(isset($_GET['id']) && $_GET['id']!=''){
              //write update query for update category name into database
              $sql ="UPDATE categories SET category='$categories' WHERE id='$id'";
              //execute this update query by using 'mysqli_query()' function
              mysqli_query($con, $sql);
          } else{
              //write insert query for insert categories into database
              $sql ="INSERT INTO categories(category,status) VALUES('$categories', '1')";
              //execute this insert query by using 'mysqli_query()' function
              mysqli_query($con, $sql);
          }

          //redirect/transfer to categories page of our project by 'header()' function
          header('location:categories.php');
          die();
         }
      }

?> 

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Categories</strong><small> Form</small></div>
                        <form method="post">
                            <div class="card-body card-block">
                               <div class="form-group">
                                   <label for="categories" class=" form-control-label">Categories</label>
                                   <input type="text" name="categories" placeholder="Enter categories name" class="form-control" required value="<?php echo $category_name;?>">
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