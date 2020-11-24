<?php
    //include header page
    require('top.inc.php');
	
	//hold category id & using this id we can see that category products which category is selected
    $str = mysqli_real_escape_string($con, $_GET['str']);
	//validation
	if($str!=''){
		//hold all products which category is selected
		$get_prod = get_product($con,'','','',$str);
    } else{
		?>
		<script>
			window.location.href='index.php';
		</script>
		<?php
	}	
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
                                  <span class="breadcrumb-item active">Search</span>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active"><?php echo $str;?></span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
		
        <!-- Start Product Grid -->
        <section class="htc__product__grid bg__white ptb--100">
            <div class="container">
                <div class="row">
				  <?php if(count($get_prod)>0){?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="htc__product__rightidebar">
							
                            <!-- Start Product View -->
                            <div class="row">
                                <div class="shop__grid__view__wrap">
                                    <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
									
							<!-- Start foreach loop for show products which category is selected -->		
                            <?php
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

                                            <li><a href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id']?>','add')"><i class="icon-handbag icons"></i></a></li>
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
                            <!-- End Product View -->
                        </div>   
                    </div>
				  <?php } else{
					  echo "Products Not Found !";
				  }?>
                    
			   </div>
            </div>
        </section>
        <!-- End Product Grid -->
       
<?php
   //include footer page
   require('foot.inc.php');
?>                
        