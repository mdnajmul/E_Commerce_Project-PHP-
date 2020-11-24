<?php
  //include connection.inc.php file inside this header page
   require('connection.inc.php');

   //include function.inc.php file inside this header page
   require('function.inc.php');

 
   
   //This is for login access if user give correct information & stop access by giving url
   if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){
       
   } else{
          //If any one try to access categories.php page by write url then redirect to login page (not access categories page by using url)
          //redirect/transfer to categories page of our project by 'header()' function
           header('location:login.php');
           die();
   }

  $categories_id = get_safe_value($con, $_POST['categories_id']);
  $sub_cat_id = get_safe_value($con, $_POST['sub_cat_id']);

  $res=mysqli_query($con,"SELECT * FROM sub_categories WHERE category_id='$categories_id' AND status='1'");

  if(mysqli_num_rows($res)>0){
      $html="";
      while($row=mysqli_fetch_assoc($res)){
         //write if condition for show selected sub category name. if $sub_cat_id == id(sub_categories table) then selected that sub category name
         if($sub_cat_id==$row['id']){
            $html .="<option value=".$row['id']." selected>".$row['sub_category']."</option>";
         }else{
            $html .="<option value=".$row['id'].">".$row['sub_category']."</option>"; 
         }  
      }
      echo $html;
  }else{
      echo "<option value=''>No sub categories found</option>";
  }

?>  