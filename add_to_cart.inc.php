<?php


    class add_to_cart{
        
        function addProduct($pid,$qty){
            //add product inside session(add_to_cart)
            $_SESSION['cart'][$pid]['qty']=$qty;
        }
        
        function updateProduct($pid,$qty){
            //if product is present inside session than update product
            if(isset($_SESSION['cart'][$pid])){
              $_SESSION['cart'][$pid]['qty']=$qty;  
            }
        }
        
        function removeProduct($pid){
            //if product is present inside session than remove product
            if(isset($_SESSION['cart'][$pid])){
              unset($_SESSION['cart'][$pid]);
            }
        }
        
        function emptyProduct(){
            //clear all product from session cart
            unset($_SESSION['cart']);
        }
        
        //count total add_to_cart & return that number
        function totalProduct(){
            if(isset($_SESSION['cart'])){
                return count($_SESSION['cart']);
            }else{
                return 0;
            }
        }
    }


?>