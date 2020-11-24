<?php
    //include header page
    require('top.inc.php');

    if(!isset($_GET['id']) && $_GET['id']!=''){
?>
        <script>
            window.location.href='index.php';
        </script>
<?php
    }
	
	//hold category id & using this id we can see that category products which category is selected
    $cat_id = get_safe_value($con, $_GET['id']);


    //if sub category id found in url then execute this section & hold sub category id from url
    $sub_cat_id='';
    if(isset($_GET['sub_cat_id'])){
        $sub_cat_id = get_safe_value($con, $_GET['sub_cat_id']);
    }

    //* For sorting product *//
    $price_low_selected="";
    $price_high_selected="";
    $new_selected="";
    $old_selected="";
    $sort_order="";
    //if sort is found than hold sort value from url
    if(isset($_GET['sort'])){
        $sort = get_safe_value($con, $_GET['sort']);
        if(trim($sort)=='price_low'){
            $sort_order=' ORDER BY product.selling_price ASC ';
            $price_low_selected="selected";
        }
        if(trim($sort)=='price_high'){
            $sort_order=' ORDER BY product.selling_price DESC '; 
            $price_high_selected="selected";
        }
        if(trim($sort)=='new'){
            $sort_order=' ORDER BY product.id DESC ';
            $new_selected="selected";
        }
        if(trim($sort)=='old'){
            $sort_order=' ORDER BY product.id ASC '; 
            $old_selected="selected";
        }
    }
    //*--------------------------------------*//

	//validation
	if($cat_id>0){
		//hold all products which category is selected
		$get_prod = get_product($con,'',$cat_id,'','',$sort_order,'',$sub_cat_id);
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
                                      <span class="breadcrumb-item active">Products</span>
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
                            <div class="htc__grid__top">
                                <div class="htc__select__option">
                                    <select class="ht__select" onchange="sort_product_drop('<?php echo $cat_id;?>','<?php echo SITE_PATH;?>')" id="sort_product_id">
                                        <option value="">Default softing</option>
                                        <option value="price_low" <?php echo $price_low_selected;?>>Sort by price low to high</option>
                                        <option value="price_high" <?php echo $price_high_selected;?>>Sort by price high to low</option>
                                        <option value="new" <?php echo $new_selected;?>>Sort by new first</option>
                                        <option value="old" <?php echo $old_selected;?>>Sort by old first</option>
                                    </select>
                                </div>
                            </div>
							
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
        