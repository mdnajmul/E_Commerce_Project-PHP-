<?php
    //include header page
    require('top.inc.php');
	
    if(isset($_GET['id'])){
        //hold category id & using this id we can see that category products which category is selected
        $product_id = mysqli_real_escape_string($con, $_GET['id']);

        //validation
        if($product_id>0){
            //hold all products which category is selected
            $get_prod = get_product($con,'','',$product_id);
        } else {
?>
            <script>
                window.location.href='index.php';
            </script>
<?php
         }
    } else {
?>
        <script>
            window.location.href='index.php';
        </script>
<?php
    }
?>

       <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/3.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <a class="breadcrumb-item" href="categories.php?id=<?php echo $get_prod['0']['categories_id']?>"><?php echo $get_prod['0']['category']?></a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active"><?php echo $get_prod['0']['name']?></span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Details Area -->
        <section class="htc__product__details bg__white ptb--100">
            <!-- Start Product Details Top -->
            <div class="htc__product__details__top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                            <div class="htc__product__details__tab__content">
                                <!-- Start Product Big Images -->
                                <div class="product__big__images">
                                    <div class="portfolio-full-image tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                            <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_prod['0']['image']?>" alt="full-image">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Big Images -->
                                
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                            <div class="ht__product__dtl">
                                <h2><?php echo $get_prod['0']['name']?></h2>
                                <ul  class="pro__prize">
                                    <li class="old__prize">&#2547; <del><?php echo $get_prod['0']['mrp']?></del></li>
                                    <li>&#2547; <?php echo $get_prod['0']['selling_price']?></li>
                                </ul>
                                <p class="pro__info"><?php echo $get_prod['0']['short_desc']?></p>
                                <div class="ht__pro__desc">
                                    <div class="sin__desc">
                                        <?php
                                            
                                            $productSoldQtyByProductId = productSoldQtyByProductId($con,$get_prod['0']['id']);
                                     
                                            $available_qty = $get_prod['0']['qty']-$productSoldQtyByProductId;
                                     
                                            $cart_show='yes';
                                            if($get_prod['0']['qty']>$productSoldQtyByProductId){
                                                $stock='In_Stock';
                                            }else{
                                                $stock='Out_of_Stock';
                                                $cart_show='';
                                            }
                                     
                                            if($stock=='In_Stock'){
                                        ?>
                                                <p><span>Availability: </span><span style="background-color:green; color:white; padding:5px;">In Stock</span></p>
                                      <?php } else { ?>
                                                <p><span>Availability: </span><span style="background-color:red; color:white; padding:5px;">Out of Stock</span></p>
                                      <?php } ?>                   
                                      
                                    </div>
                                    <div class="sin__desc">
                                        <?php 
                                            if($cart_show!=''){
                                        ?>
                                            <p><span>Qty:</span> 
                                            <select id="qty">
                                                <?php 
                                                    for($i=1;$i<=$available_qty;$i++){
                                                        echo "<option>$i</option>";
                                                    }      
                                                ?>        
                                            </select>
                                            </p>
                                        <?php } ?>    
                                    </div>
                                    <div class="sin__desc align--left">
                                        <p><span>Categories:</span></p>
                                        <ul class="pro__cat__list">
                                            <li><a href="categories.php?id=<?php echo $get_prod['0']['categories_id']?>"><?php echo $get_prod['0']['category']?></a></li>
                                        </ul>
                                    </div>
                                    
                                    </div>
                                    <?php 
                                        if($cart_show!=''){
                                    ?>
									        <a class="fr__btn" href="javascript:void(0)" onclick="manage_cart('<?php echo $get_prod['0']['id']?>','add')">Add to cart</a>
                                   <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Details Top -->
        </section>
        <!-- End Product Details Area -->
		
		<!-- Start Product Description -->
        <section class="htc__produc__decription bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- Start List And Grid View -->
                        <ul class="pro__details__tab" role="tablist">
                            <li role="presentation" class="description active"><a href="#description" role="tab" data-toggle="tab">description</a></li>
                        </ul>
                        <!-- End List And Grid View -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="ht__pro__details__content">
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
                                <div class="pro__tab__content__inner">
                                    <?php echo $get_prod['0']['description']?>
                                </div>
                            </div>
                            <!-- End Single Content -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product Description -->
       
<?php
   //include footer page
   require('foot.inc.php');
?>                
        