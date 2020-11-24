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

  //initialize all data field from product table
  $categories_id ='';
  $name ='';
  $mrp ='';
  $selling_price ='';
  $qty ='';
  $image ='';
  $short_desc ='';
  $description ='';
  $meta_title ='';
  $meta_desc ='';
  $meta_keyword ='';
  $best_seller ='';
  $sub_categories_id ='';
  
  $msg ='';
  $image_required='required';

  /**This is for show only that id's data which one user click for Edit inside product section**/
  if(isset($_GET['id']) && $_GET['id']!=''){
      //when user click edit button or get id url then we change image required value is null.
      $image_required='';
      //hold 'id' value & pass it with 'database connection link' through 'get_safe_value()' method in function.inc.php page
      $id = get_safe_value($con, $_GET['id']);
      //write select query for show data from product table which one we want edit
      $sql = "SELECT * FROM product WHERE id='$id' $condition_sql";
      //execute this select query by using 'mysqli_query()' function
      $res = mysqli_query($con, $sql);
      
      /*It hold $check value is 1 if user click valid id number data which are already store into database*/
      $check = mysqli_num_rows($res);
      if($check>0) {
          //hold/put all data from 'product' table by using 'mysqli_fetch_assoc()'
          $row = mysqli_fetch_assoc($res);
          //hold all data from $row array
          $categories_id = $row['categories_id'];  
          $sub_categories_id = $row['sub_categories_id'];  
          $name = $row['name'];  
          $mrp = $row['mrp'];  
          $selling_price = $row['selling_price'];  
          $qty = $row['qty'];  
          $short_desc = $row['short_desc'];  
          $description = $row['description'];  
          $meta_title = $row['meta_title'];  
          $meta_desc = $row['meta_desc'];  
          $meta_keyword = $row['meta_keyword'];
          $best_seller = $row['best_seller'];
      }
      /*if user click unvalid id number data which are not store into database then redirect/transefer user to categories.php page*/
      else{
          //redirect/transfer to categories page of our project by 'header()' function
          header('location:product.php');
          die(); 
      }
      
  }


  /**This is for when click Submit Button.**/
  if(isset($_POST['submit'])){
      //hold all value & pass it with 'database connection link' through 'get_safe_value()' method in function.inc.php page
      $categories_id = get_safe_value($con, $_POST['categories_id']);
      $sub_categories_id = get_safe_value($con, $_POST['sub_categories_id']);
      $name = get_safe_value($con, $_POST['name']);
      $mrp = get_safe_value($con, $_POST['mrp']);
      $selling_price = get_safe_value($con, $_POST['selling_price']);
      $qty = get_safe_value($con, $_POST['qty']);
      $short_desc = get_safe_value($con, $_POST['short_desc']);
      $description = get_safe_value($con, $_POST['description']);
      $meta_title = get_safe_value($con, $_POST['meta_title']);
      $meta_desc = get_safe_value($con, $_POST['meta_desc']);
      $meta_keyword = get_safe_value($con, $_POST['meta_keyword']);
      if($_SESSION['ADMIN_ROLE']!=1){
        $best_seller = get_safe_value($con, $_POST['best_seller']);
      }
      
      
      
      /**Here,When we try to add any data then this section check that data already exist in database.If that data already exists then show a error message**/
      //write select query for check data from product table which one we want to add
      $sql = "SELECT * FROM product WHERE name='$name' $condition_sql";
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
                  $msg ="This Product already exist !";
              }
          } else{
             $msg ="This Product already exist !"; 
          }   
      }
      
      
      if(isset($_GET['id']) && $_GET['id']==0){
          //varification that only jpg/jpeg/png file we can upload
          if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
                $msg="Please select only png,jpg and jpeg image formate";
          }
      } else {
          if($_FILES['image']['type']!=''){
             //varification that only jpg/jpeg/png file we can upload
             if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
                 $msg="Please select only png,jpg and jpeg image formate";
              } 
          }
      }
      
         
        //$msg is empty means we edit/update data. If $msg is not empty means we add data
        if($msg==''){
             
           /** This section is validate that when user click Submit Button , Then this data will be Add/Insert or Update **/
           if(isset($_GET['id']) && $_GET['id']!=''){
              
              //***============================This is for when we click edit button & Check image is change or not ===============================***//
              if($_FILES['image']['name']!=''){
                  //**Check ========== If we select or change image , then this image updated inside database ==============**//
                  //hold image inside $image variable
                  $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                  //upload image file inside product folder
                  move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
                  $update_sql = "UPDATE product SET categories_id='$categories_id',sub_categories_id='$sub_categories_id',name='$name',mrp='$mrp',selling_price='$selling_price',qty='$qty',short_desc='$short_desc',description='$description',best_seller='$best_seller',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',image='$image' WHERE id='$id'";
                  //**=====================================================================================================**//
              } else{
                  //**Check ===== If we do not select or change image , previous image has no change inside database ======**//
                  $update_sql = "UPDATE product SET categories_id='$categories_id',sub_categories_id='$sub_categories_id',name='$name',mrp='$mrp',selling_price='$selling_price',qty='$qty',short_desc='$short_desc',description='$description',best_seller='$best_seller',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword' WHERE id='$id'";
                  //**=====================================================================================================**//
              }
              //***===============================================================================================================================***//
              
              //execute this update query by using 'mysqli_query()' function
              mysqli_query($con, $update_sql);
              
          } else{
              
              //hold image inside $image variable
              $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
              //upload image file inside product folder
              move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
               
              //
              if($_SESSION['ADMIN_ROLE']==1){
                  $best_seller=0;
              }    
              
              //execute this insert query by using 'mysqli_query()' function
              mysqli_query($con,"insert into product(categories_id,sub_categories_id,name,mrp,selling_price,qty,short_desc,description,best_seller,meta_title,meta_desc,meta_keyword,added_by_user_id,status,image) values('$categories_id','$sub_categories_id','$name','$mrp','$selling_price','$qty','$short_desc','$description','$best_seller','$meta_title','$meta_desc','$meta_keyword','$admin_id',1,'$image')");
          }
          ?>
            <script>
                window.location.href='product.php';
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
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="card-body card-block">
                                  
                               <div class="form-group">
                                   <label for="categories" class=" form-control-label">Categories</label>
                                   <select class="form-control" name="categories_id" id="categories_id" onchange="get_sub_category('')" required>
                                       <option>Select Category</option>
                                       <!--== Write while loop for show all category name from categories table ==-->
                                       <?php
                                          //write select query to get id & category name from categories table
                                          $sql = "SELECT id,category FROM categories ORDER BY category ASC";
                                          //execute this select query by using 'mysqli_query()' function
                                          $res = mysqli_query($con, $sql);
                                          //hold/put all id & category name inside $row array by using 'mysqli_fetch_assoc()' function 
                                          while($row=mysqli_fetch_assoc($res)){
                                              //show selected category name inside category field when click edit button
                                              if($row['id']==$categories_id){
                                                  //show selected category name inside category field when click edit button
                                                  echo "<option selected value=".$row['id'].">".$row['category']."</option>";
                                              } else{
                                                  //show category name & hold id number
                                                  echo "<option value=".$row['id'].">".$row['category']."</option>";
                                              }
                                          }
                                       ?>
                                   </select>
                               </div>
                               
                               <div class="form-group">
                                   <label for="categories" class=" form-control-label">Sub Categories</label>
                                   <select class="form-control" name="sub_categories_id" id="sub_categories_id">
                                       <option>Select Sub Category</option>
                                   </select>
                               </div>
                               
                               <div class="form-group">
                                   <label for="categories" class=" form-control-label">Product Name</label>
                                   <input type="text" name="name" placeholder="Enter product name" class="form-control" required value="<?php echo $name; ?>">
                               </div>
                               
                               <?php if($_SESSION['ADMIN_ROLE']!=1) { ?>
                                   <div class="form-group">
                                       <label for="categories" class=" form-control-label">Most Popular</label>
                                       <select class="form-control" name="best_seller" required>
                                            <option value=''>Select</option>

                                         <?php
                                                 if($best_seller==1){
                                                    echo "<option value='1' selected>Yes</option>
                                                          <option value='0'>No</option>";
                                                 }else if($best_seller==0){
                                                    echo "<option value='1'>Yes</option>
                                                          <option value='0' selected>No</option>";
                                                 } else{
                                                     echo "<option value='1'>Yes</option>
                                                          <option value='0'>No</option>";
                                                 }

                                           ?>


                                       </select>
                                   </div>
                               <?php } ?>
                               
                               <div class="form-group">
                                   <label for="categories" class=" form-control-label">Product MRP</label>
                                   <input type="text" name="mrp" placeholder="Enter product mrp" class="form-control" required value="<?php echo $mrp; ?>">
                               </div>
                               
                               <div class="form-group">
                                   <label for="categories" class=" form-control-label">Product Selling Price</label>
                                   <input type="text" name="selling_price" placeholder="Enter product selling price" class="form-control" required value="<?php echo $selling_price; ?>">
                               </div>
                               
                               <div class="form-group">
                                   <label for="categories" class=" form-control-label">Qty</label>
                                   <input type="text" name="qty" placeholder="Enter product qty" class="form-control" required value="<?php echo $qty; ?>">
                               </div>
                               
                               <div class="form-group">
                                   <label for="categories" class=" form-control-label">Product Image</label>
                                   <input type="file" name="image" class="form-control" <?php echo $image_required;?> >
                               </div>
                               
                               <div class="form-group">
                                   <label for="categories" class=" form-control-label">Short Description</label>
                                   <textarea name="short_desc" placeholder="Enter product short description" class="form-control" required ><?php echo $short_desc;?></textarea>
                               </div>
                               
                               <div class="form-group">
                                   <label for="categories" class=" form-control-label">Description</label>
                                   <textarea name="description" placeholder="Enter product description" class="form-control" required ><?php echo $description;?></textarea>
                               </div>
                               
                               <div class="form-group">
                                   <label for="categories" class=" form-control-label">Meta Title</label>
                                   <textarea name="meta_title" placeholder="Enter product meta title" class="form-control" ><?php echo $meta_title;?></textarea>
                               </div>
                               
                               <div class="form-group">
                                   <label for="categories" class=" form-control-label">Meta Description</label>
                                   <textarea name="meta_desc" placeholder="Enter product meta description" class="form-control" ><?php echo $meta_desc;?></textarea>
                               </div>
                               
                               <div class="form-group">
                                   <label for="categories" class=" form-control-label">Meta Keyword</label>
                                   <textarea name="meta_keyword" placeholder="Enter product meta keyword" class="form-control" ><?php echo $meta_keyword;?></textarea>
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
         
         <script>
             function get_sub_category(sub_cat_id){
                 var categories_id=jQuery('#categories_id').val();
                 jQuery.ajax({
                     url:'get_sub_category.php',
                     type:'post',
                     data:'categories_id='+categories_id+'&sub_cat_id='+sub_cat_id,
                     success:function(result){
                         jQuery('#sub_categories_id').html(result);
                     }
                 });
             }
         </script>

<?php
   //include footer.php page
   require('footer.inc.php');
?>

<script>
    //*This section is write for show sub category which one selected when we edit any product*//
    <?php
            //if id found when click edit button then call 'get_sub_category()' javascript function for show subcategory name
            if(isset($_GET['id'])){
    ?>
                //call get_sub_category() function & pass $sub_categories_id through this function 
                get_sub_category('<?php echo $sub_categories_id;?>'); 
    
    <?php   } ?>
</script>


