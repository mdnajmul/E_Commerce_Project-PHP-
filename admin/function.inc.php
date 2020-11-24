
<?php

    /** Here we write some common function that we use from different file **/


    //create two basic function name 'pr()' and 'prx()' that return us array value inside <pre> & print_r tag
    function pr($arr){
        echo '<pre>';
        print_r($arr);
    }

    function prx($arr){
        echo '<pre>';
        print_r($arr);
        die();
    }


    //create this function for pass data which comes from input field and 'database connection($con)' through/pass by 'mysqli_real_escape_string()' function
    function get_safe_value($link, $val){
        //validate that data is empty or not
        if($val != ''){
            //remove space from text
            $val = trim($val);
            return strip_tags(mysqli_real_escape_string($link, $val));
        }
    }


    //return total number of quanty sold for given product/product_id
    function productSoldQtyByProductId($con,$pid){
        //
        $sql="SELECT SUM(order_details.qty) as qty FROM order_details,order_tbl WHERE order_tbl.id=order_details.order_id AND order_details.product_id='$pid' AND order_tbl.order_status!=4 AND ((order_tbl.payment_type='online' AND order_tbl.payment_status='Success' AND order_tbl.online_payment_status='VALID') OR (order_tbl.payment_type='cash' AND order_tbl.payment_status!='' AND order_tbl.online_payment_status='No'))";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($res);
        return $row['qty'];
    }



    //check user is admin or multivendor
    function isAdmin(){
        if(!isset($_SESSION['ADMIN_LOGIN'])){
           ?>
                <script>
                    window.location.href='index.php';
                </script>
           <?php 
        }
        if($_SESSION['ADMIN_ROLE']==1){
            ?>
                <script>
                    window.location.href='product.php';
                </script>
            <?php
        }
    }

?>