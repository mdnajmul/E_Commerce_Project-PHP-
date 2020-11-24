<?php


   //include connection.inc.php file inside this page
   require('connection.inc.php');
   //include function
   require('function.inc.php');
   //include add_to_cart page
   require('add_to_cart.inc.php');

    //hold product id, product quantity, type(add/update/remove)
    $pid=get_safe_value($con,$_POST['pid']);
    $qty=get_safe_value($con,$_POST['qty']);
    $type=get_safe_value($con,$_POST['type']);


    //total sold of product
    $productSoldQtyByProductId = productSoldQtyByProductId($con,$pid);
    //total product quantity
    $productQty = productQty($con,$pid);

    $available_qty = $productQty-$productSoldQtyByProductId;

    if($qty<1){
        //create a object of 'add_to_cart' class from add_to_cart.php page
        $obj = new add_to_cart();
        
        if($type == 'remove'){
            $obj->removeProduct($pid);
        }
        
        
    } else{
        if($qty>$available_qty){
            echo 'not_available';
            die();
        }

        //create a object of 'add_to_cart' class from add_to_cart.php page
        $obj = new add_to_cart();

        if($type == 'add'){
            $obj->addProduct($pid,$qty);
        }

        if($type == 'hover_add'){
            $obj->addProduct($pid,$qty);
        }

        if($type == 'remove'){
            $obj->removeProduct($pid);
        }

        if($type == 'update'){
            $obj->updateProduct($pid,$qty);
        }
        
        //send total product which one is add cart to success function in ajax file
        echo $obj->totalProduct();
    }
    


?>