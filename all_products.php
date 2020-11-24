<?php
    //include header page
    require('top.inc.php');
?>

        <div class="body__overlay"></div>
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
                                      <span class="breadcrumb-item active">All Products</span>
                                 </nav>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
        <!-- End Bradcaump area -->
        
        <!-- Start Category Area -->
        <section class="htc__category__area ptb--100">
            <div class="container">
                <div class="htc__product__container">
                    <div class="row">
                        <div class="product__list clearfix mt--30">
                            <!-- Start foreach loop for show new arival products -->
                            <?php
                               $get_prod = get_product($con);
                               foreach($get_prod as $list){
                            ?>
                            <!-- Start Single Category -->
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                                    <div class="ht__cat__thumb">
                                        <a href="product.php?id=<?php echo $list['id']?>">
                                            <img style="width:260px;height:280px;" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image']?>" alt="product images">
                                        </a>
                                    </div>
                                    
                                    <div class="fr__hover__info">
                                        <ul class="product__action">
                                            <li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id']?>','add')"><i class="icon-heart icons"></i></a></li>

                                            <li><a href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id']?>','hover_add')"><i class="icon-handbag icons"></i></a></li>
                                        </ul>
                                    </div>
                                    
                                    <div class="fr__product__inner">
                                        <h4>
                                            <a href="product.php?id=<?php echo $list['id']?>">
                                                <?php echo $list['name']?>
                                            </a>
                                        </h4>
                                        <ul class="fr__pro__prize">
                                            <li class="old__prize">&#2547; <del><?php echo $list['mrp']?></del></li>
                                            <li>&#2547; <?php echo $list['selling_price']?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                            <!-- End foreach loop -->
                            <!-- End Single Category -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        

<?php
   //include footer page
   require('foot.inc.php');
?>                
        