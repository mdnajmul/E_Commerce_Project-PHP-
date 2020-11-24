<?php
    //include header page
    require('top.inc.php');
?>

        <div class="body__overlay"></div>
        <!-- Start Slider Area -->
        <div class="slider__container slider--one bg__cat--3">
            <div class="slide__container slider__activation__wrap owl-carousel">
                <!-- Start Single Slide -->
                <div class="single__slide animation__style01 slider__fixed--height">
                    <div class="container">
                        <div class="row align-items__center">
                            <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                                <div class="slide">
                                    <div class="slider__inner">
                                        <h2>collection 2020</h2>
                                        <h1>Different Clothing</h1>
                                        <div class="cr__btn">
                                            <a href="all_products.php">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                                <div class="slide__thumb">
                                    <img src="images/slider/fornt-img/3.png" alt="slider images">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Slide -->
                <!-- Start Single Slide -->
                <div class="single__slide animation__style01 slider__fixed--height">
                    <div class="container">
                        <div class="row align-items__center">
                            <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                                <div class="slide">
                                    <div class="slider__inner">
                                        <h2>collection 2020</h2>
                                        <h1>Different Smart Phone</h1>
                                        <div class="cr__btn">
                                            <a href="all_products.php">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                                <div class="slide__thumb">
                                    <img src="images/slider/fornt-img/4.png" alt="slider images">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Slide -->
                <!-- Start Single Slide -->
                <div class="single__slide animation__style01 slider__fixed--height">
                    <div class="container">
                        <div class="row align-items__center">
                            <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                                <div class="slide">
                                    <div class="slider__inner">
                                        <h2>collection 2020</h2>
                                        <h1>Different Laptop Brands</h1>
                                        <div class="cr__btn">
                                            <a href="all_products.php">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                                <div class="slide__thumb">
                                    <img src="images/slider/fornt-img/5.png" alt="slider images">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Slide -->
            </div>
        </div>
        <!-- Start Slider Area -->
        <!-- Start Category Area -->
        <section class="htc__category__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">New Arrivals</h2>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="htc__product__container">
                    <div class="row">
                        <div class="product__list clearfix mt--30">
                            <!-- Start foreach loop for show new arival products -->
                            <?php
                               $get_prod = get_product($con,8);
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
        <!-- End Category Area -->
        <!-- Start Product Area -->
        <section class="ftr__product__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">Most Popular</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                   <div class="product__list clearfix mt--30">
                            <!-- Start foreach loop for show new arival products -->
                            <?php
                               $get_prod = get_product($con,8,'','','','','yes');
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
        </section>
        <!-- End Product Area -->

<?php
   //include footer page
   require('foot.inc.php');
?>                
        