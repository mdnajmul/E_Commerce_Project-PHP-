<?php
  //include connection.inc.php file inside this header page
   require('connection.inc.php');
  //include function.inc.php file inside this header page
   require('function.inc.php');
  //include add_to_cart page
   require('add_to_cart.inc.php');

   //fetch all data from categories table which are active(status)
   $category_res = mysqli_query($con,"SELECT * FROM categories WHERE status=1 ORDER BY category ASC");

   //create an array
   $cat_arr = array();
   //write while loop for put all data inside array
   while($row=mysqli_fetch_assoc($category_res)){
       //put data inside array
       $cat_arr[] = $row;
   }

 //create a object of 'add_to_cart' class from add_to_cart.php page
 $obj = new add_to_cart();
 //hold total product which one is add cart
 $totalProduct = $obj->totalProduct();
 

 //if user login than execute sql query
 if(isset($_SESSION['USER_LOGIN'])){
     
     $uid=$_SESSION['USER_ID'];
     
     //delete data from wishlist
     if(isset($_GET['wishlist_id'])){
        $wid=get_safe_value($con,$_GET['wishlist_id']);
        mysqli_query($con,"DELETE FROM wishlist WHERE id='$wid' AND user_id='$uid'");
     }
     
     /*--- write sql query to show number of products in whishlist icon ---*/
     //count number of products in wishlist
     $wishlist_count=mysqli_num_rows(mysqli_query($con,"SELECT product.name,product.image,product.mrp,product.selling_price,wishlist.id FROM product,wishlist WHERE wishlist.product_id=product.id AND wishlist.user_id='$uid'"));
 }
    /*--------------------------*/

//this is for hold page name path//
    $script_name=$_SERVER['SCRIPT_NAME'];
    //explode/break page path name where we found '/'
    $script_name_arr=explode('/',$script_name);
    //hold my page name
    $mypage_name=$script_name_arr[count($script_name_arr)-1];

//--------------------------------//

$title="E-SHOP Online";
$meta_title="Trusted Online Shopping in Bangladesh";
$meta_desc="E-SHOP Online";
$meta_keyword="ESHOP Online";


//if page name is product.php than execute this code
if($mypage_name=='product.php'){
    $product_id=get_safe_value($con,$_GET['id']);
    $product_meta=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM product WHERE id='$product_id'"));

    $title=$product_meta['name'];
    $meta_title=$product_meta['meta_title'];
    $meta_desc=$product_meta['meta_desc'];
    $meta_keyword=$product_meta['meta_keyword'];
}

//if page name is contuct.php than execute this code
if($mypage_name=='contact.php'){

    $title="Contuct Us";
}

?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $title;?></title>
    <meta name="title" content="<?php echo $meta_title;?>">
    <meta name="description" content="<?php echo $meta_desc;?>">
    <meta name="keywords" content="<?php echo $meta_keyword;?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owl Carousel min css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">

	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start Header Style -->
        <header id="htc__header" class="htc__header__area header--one">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5"> 
                                <div class="logo">
                                     <a href="index.php"><img src="images/logo/1.png" alt="logo images"></a>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-5 col-sm-5 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="index.php">Home</a></li>
                                        <!--Show all category which are Active -->
                                        <?php
                                           foreach($cat_arr as $list){
                                               ?>
                                               <li class="drop">
                                                   <a href="categories.php?id=<?php echo $list['id'];?>"><?php echo $list['category'];?></a>
                                                   <?php
                                                      //hold category id & fetch all data from sub_categories table through this id
                                                      $cat_id=$list['id'];
                                                      $sub_cat_res=mysqli_query($con,"SELECT * FROM sub_categories WHERE status='1' AND category_id='$cat_id'");
                                                      //if data found then execute dropdown section
                                                      if(mysqli_num_rows($sub_cat_res)>0){
                                                   ?>
                                                           <ul class="dropdown">
                                                                <?php
                                                                    //write while loop for show sub category name when hover any categories
                                                                    while($sub_cat_rows=mysqli_fetch_assoc($sub_cat_res)){
                                                                        echo "<li><a href='categories.php?id=".$list['id']."&sub_cat_id=".$sub_cat_rows['id']."'>".$sub_cat_rows['sub_category']."</a></li>";
                                                                    }
                                                                ?>
                                                           </ul>
                                                   <?php } ?>
                                               </li>
                                               <?php
                                           }
                                        ?>
                                        <li class="drop"><a href="contact.php">contact</a></li>
                                     </ul>
                                 </nav>

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <!--Show all category which are Active -->
                                            <?php
                                               foreach($cat_arr as $list){
                                                   ?>
                                                   <li><a href="categories.php?id=<?php echo $list['id'];?>"><?php echo $list['category'];?></a></li>
                                                   <?php
                                               }
                                            ?>
                                            <li><a href="contact.php">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>  
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-4 col-xs-4">
                                <div class="header__right">
                                    <?php 
                                        $class="mr15";
                                        if(isset($_SESSION['USER_LOGIN'])){
                                            $class="";
                                        }
									?>
                                    <!-- search option -->
                                    <div class="header__search search search__open <?php echo $class?>">
                                        <a href="#"><i class="icon-magnifier icons"></i></a>
                                    </div>
                                    <!-------------------->
                                    <div class="header__account">
                                       <?php 
                                            if(isset($_SESSION['USER_LOGIN'])){
                                        ?>        
                                              <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                                    <span class="navbar-toggler-icon"></span>
                                                  </button>

                                                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                                    <ul class="navbar-nav mr-auto">
                                                       <li class="nav-item dropdown">
                                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Hi ! <span style="color:green; font-weight:bold; text-transform:capitalize;"><?php echo $_SESSION['USER_NAME'];?></span>
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                              <a class="dropdown-item" href="profile.php">Profile</a>
                                                              <a class="dropdown-item" href="my_order.php">Order</a>
                                                              <div class="dropdown-divider"></div>
                                                              <a class="dropdown-item" href="logout.php">Logout</a>
                                                            </div>
                                                        </li>
                                                     </ul>
                                                   </div>
                                                </nav>
                                        <?php       
                                            }else{
                                                echo '<a href="login.php">Login/Register</a>';
                                            }
                                        ?>
                                        
                                    </div>
                                    <div class="htc__shopping__cart">
                                      
                                        <!--wishlist icon show when user is login-->
                                        <?php 
                                            if(isset($_SESSION['USER_ID'])){
                                        ?>
                                                <a href="wishlist.php"><i class="icon-heart icons"></i></a>
                                                <a href="wishlist.php"><span class="htc__wishlist"><?php echo $wishlist_count;?></span></a>
                                        <?php } ?>
                                       
                                        <a href="cart.php"><i class="icon-handbag icons"></i></a>
                                        <a href="cart.php"><span class="htc__qua"><?php echo $totalProduct;?></span></a>
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Area -->
        
        <!-- search box open -->
        <div class="body__overlay"></div>
		<div class="offset__wrapper">
            <div class="search__area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search__inner">
                                <form action="search.php" method="get">
                                    <input placeholder="Search here... " type="text" name="str">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-------------------->