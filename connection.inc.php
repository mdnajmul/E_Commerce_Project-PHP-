
<?php
   
   //start session
   session_start();

   //create connection link for connect database with our project
   $con = mysqli_connect("localhost","root","","e_compro_1");



    /*Create Hard Code PATH which we use image file when we add or edit or upload image*/
//===================================================================================================//
     //---------------------------------------------------------------------------------------//
        //create 'SERVER_PATH' that use to create 'PRODUCT_IMAGE_SERVER_PATH' 
        define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/new_project/E_Commerce_Project/');

        ////create 'SITE_PATH' that use to create 'PRODUCT_IMAGE_SITE_PATH'
        define('SITE_PATH','http://www.ovi.com/new_project/E_Commerce_Project/');
    //-----------------------------------------------------------------------------------------//

   
    //-------------------------------------------------------------------------------------//
        //This 'PRODUCT_IMAGE_SERVER_PATH' is use when add/edit/upload image file
        define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');

        //This 'PRODUCT_IMAGE_SITE_PATH' is use when show image file
        define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');
    //-------------------------------------------------------------------------------------//
//=============================================================================================//

?>