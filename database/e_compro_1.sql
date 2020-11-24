-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2020 at 02:02 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_compro_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `role`, `email`, `mobile`, `status`) VALUES
(1, 'admin', 'admin', 0, '', '', 1),
(2, 'najmul', 'najmul', 1, 'najmulovi999@gmail.com', '01883791806', 1),
(3, 'nibir', 'nibir', 1, 'neberhossain@gmail.com', '01712345678', 1),
(5, 'juwel', 'juwel', 1, 'juwel@gmail.com', '01754321561', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `status`) VALUES
(16, 'MOBILE', 1),
(14, 'MEN', 1),
(15, 'WOMEN', 1),
(17, 'LAPTOP', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `comment`, `added_on`) VALUES
(34, 'Rana', 'rana@gmail.com', '01812345643', 'Select City', '2020-08-14 09:34:30'),
(33, 'iqbal', 'iqbal@gmail.com', '01812345678', 'very nice', '2020-07-23 01:41:44'),
(32, 'kazi', 'batper@gmail.com', '01812345678', 'I Love You', '2020-07-23 01:23:59');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_master`
--

CREATE TABLE `coupon_master` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_value` int(11) NOT NULL,
  `coupon_type` varchar(20) NOT NULL,
  `cart_min_value` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon_master`
--

INSERT INTO `coupon_master` (`id`, `coupon_code`, `coupon_value`, `coupon_type`, `cart_min_value`, `status`) VALUES
(1, 'ESHOP100', 100, 'Taka', 500, 1),
(2, 'ESHOP10', 10, 'Percentage', 1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `qty`, `price`) VALUES
(114, 67, 30, 2, 780),
(113, 67, 25, 2, 1790),
(112, 67, 29, 1, 1960),
(111, 67, 42, 3, 980),
(110, 67, 41, 2, 1080),
(109, 66, 38, 1, 60000),
(108, 65, 26, 2, 950),
(107, 65, 41, 1, 1080),
(106, 65, 42, 3, 980);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Canceled'),
(5, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `post_code` int(11) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `total_price` float NOT NULL,
  `payment_status` varchar(30) NOT NULL,
  `order_status` int(11) NOT NULL,
  `txnid` varchar(50) NOT NULL,
  `pay_id` varchar(50) NOT NULL,
  `online_payment_status` varchar(20) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_value` varchar(50) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`id`, `user_id`, `address`, `city`, `post_code`, `payment_type`, `total_price`, `payment_status`, `order_status`, `txnid`, `pay_id`, `online_payment_status`, `payment_method`, `coupon_id`, `coupon_code`, `coupon_value`, `added_on`) VALUES
(67, 22, '394/5,Gawair Bazar,Dakshinkhan', 'Dhaka', 1230, 'online', 11002, 'Pending', 1, 'SSLCZ_TEST_5f4c9fe2493fe', '20083113002398O0sgg72MCYhYu', 'VALID', 'BKASH-BKash', 2, 'ESHOP10', '1223', '2020-08-31 12:59:46'),
(66, 34, '293,Gaowair,Daskhinkhan', 'Dhaka', 1230, 'cash', 54022, 'Pending', 1, '', '', 'No', 'CASH', 2, 'ESHOP10', '6003', '2020-08-28 05:01:28'),
(65, 34, '293,Gaowair,Daskhinkhan', 'Dhaka', 1230, 'online', 5350, 'Pending', 1, 'SSLCZ_TEST_5f48e3851ff8e', '200828165954acBrtHKWHIEmVcM', 'VALID', 'BKASH-BKash', 2, 'ESHOP10', '595', '2020-08-28 04:59:17');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `sub_categories_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `selling_price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `best_seller` int(11) NOT NULL,
  `meta_title` varchar(2000) NOT NULL,
  `meta_desc` text NOT NULL,
  `meta_keyword` varchar(2000) NOT NULL,
  `added_by_user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_id`, `sub_categories_id`, `name`, `mrp`, `selling_price`, `qty`, `image`, `short_desc`, `description`, `best_seller`, `meta_title`, `meta_desc`, `meta_keyword`, `added_by_user_id`, `status`) VALUES
(31, 15, 9, 'Full Sleeve T-shirt', 520, 450, 6, '483859591_8.jpg', 'Presenting this Fashionable Full Sleeve T-shirt for Women - SW4836T, a western tops. In very reasonable and effort able price. So, grab this beautiful western tops in Indian style at our PriyoShop.com.', '<h2>Fashionable Full Sleeve T-shirt for Women - SW4836T</h2><br/>\r\n<b>Product Type:</b> T-shirt.<br/>\r\n<b>Gender:</b> For Women.<br/>\r\n<b>Fabric:</b> 100 % Cotton.<br/>\r\n<b>Stylish & comfortable.</b><br/>\r\n<b>Perfect for this winter.</b><br/>\r\n<b>Type :</b> Round Neck.<br/>\r\n<b>GSM:</b> 180 GSM.<br/>\r\n<b>Size:</b> L.<br/>\r\n<b>Measurement (In inch):</b> L (Length 27", Chest: 36").<br/>', 1, 'Trusted Online Shopping in Bangladesh', 'Presenting this Fashionable Full Sleeve T-shirt for Women - SW4836T, a western tops. In very reasonable and effort able price. So, grab this beautiful western tops in Indian style.', 'Fashionable Full Sleeve T-shirt for Women - SW4835T, full sleeve tops online, buy t-shirt for women online in best price, Fashionable Full Sleeve T-shirt for Women price at online, Fashionable Full Sleeve T-shirt for Women in best price at online, t-shirt for ladies, t-shirt', 1, 1),
(30, 15, 7, 'Tangail Cotton Saree', 890, 780, 24, '589572482_7.jpg', 'Tangail Cotton Saree M-321 is an evergreen choice when the mercury rises. With its unending advantages, managing a cotton saree in all its crispness is totally worth the effort. Decorate yourself with Bangladeshi look with this cordial cotton saree.', '<h2>Tangail Cotton Saree M-321.</h2><br/>\r\n<b>Product Type:</b> Saree.<br/>\r\n<b>Material:</b> Cotton.<br/>\r\n<b>Occasion:</b> Formal Events & Festivals.<br/>\r\n<b>Easy to carry.</b><br/>\r\n<b>Size:</b> 13.5 Hands Long.<br/>\r\n<b>Blouse Piece Included.</b><br/>\r\n<b>Color:</b> As same as picture.<br/>\r\n<b>Disclaimer:</b> Product color may slightly vary due to photographic lighting sources or your monitor settings.', 1, 'Trusted Online Shopping in Bangladesh', 'Tangail Cotton Saree M-321 is an evergreen choice when the mercury rises. With its unending advantages, managing a cotton saree in all its crispness is totally worth the effort. Decorate yourself with Bangladeshi look with this cordial cotton saree.', 'Tangail Cotton Saree M-321, buy Tangail Cotton Saree M-321 online, Tangail Cotton Saree M-321 price, saree, saree price, buy saree online, tangail saree price', 1, 1),
(24, 14, 4, 'Half Sleeve Polo Tâ€“Shirt', 490, 440, 10, '764973958_1.jpg', 'Half Sleeve Polo Tâ€“Shirt for Men â€“ BN 04 is exclusive wear and more colorful to see. It, moreover, makes you smarter and looks gorgeous. It has an extraordinary design and is good looking too. So, you will get a perfect look.', '<h2>Half Sleeve Polo Tâ€“Shirt for Men â€“ BN 04.</h2><br/>\r\n<b>Product Type:</b> Polo Tâ€“Shirt.<br/>\r\n<b>Sleeve:</b> Half sleeve.<br/>\r\n<b>Fabrication:</b> Main Materials Cotton.<br/>\r\n<b>Gender:</b> Men.<br/>\r\n<b>Export Quality Fabric.</b><br/>\r\n<b>GSM:</b> 200.<br/>\r\n<b>Size:</b> M, L, XL.<br/>\r\n<b>Size Measurement (In Inch):</b> M (Chest: 36", Length: 27"); L (Chest: 38", Length: 28"); XL (Chest: 40", Length: 29").<br/>\r\n<b>Color:</b> As same as the picture.<br/>\r\n<b>Disclaimer:</b> Due to the light and screen difference, the item\'s color may be slightly different from the pictures.', 1, 'Trusted Online Shopping in Bangladesh', 'Half Sleeve Polo TTâ€“Shirt for Men Tâ€“ BN 04 is exclusive wear and more colorful to see. It, moreover, makes you smarter and looks gorgeous. It has an extraordinary design and is good looking too. So, you will get a perfect look.', 'Half Sleeve Polo TTâ€“Shirt for Men Tâ€“ BN 04, Half Sleeve Polo Shirt for Men, Half Sleeve Polo Shirt for Men price, Half Sleeve Polo Shirt for Men online price, Half Sleeve Polo Shirt', 1, 1),
(25, 14, 6, 'Kabli Set', 1900, 1790, 20, '376953124_2.jpg', 'This Kabli Set for Men Tâ€“ 106454 looks absolutely gorgeous and is comfortable to wear. It is perfect and suitable for all traditional occasions. It, as a result, is able to make sure of a positive experience.', '<h2>Kabli Set for Men Tâ€“ 106454</h2><br/>\r\n<b>Product type:</b> Kabli Set.<br/>\r\n<b>Material:</b> Linen (Imported).<br/>\r\n<b>Regular fit.</b><br/>\r\n<b>Kabli Size:</b> 38, 40, 42, 44, 46.<br/>\r\n<b>Kabli Measurement (In Inch):</b> 38 (Length 38â€³, Chest 38â€³); 40 (Length 40â€³, Chest 40â€³); 42 (Length 42â€³, Chest 42â€³); 44 (Length 44â€³, Chest 44â€³); 46 (Length 46â€³, Chest 46â€³).<br/>\r\n<b>Payjama:</b> Waist is adjustable (à¦«à¦¿à¦¤à¦¾ à¦¸à¦¿à¦¸à§à¦Ÿà§‡à¦®).<br/>\r\n<b>Color:</b> As same as picture.<br/>', 1, 'Trusted Online Shopping in Bangladesh', 'This Kabli Set for Men Tâ€“ 106454 looks absolutely gorgeous and is comfortable to wear. It is perfect and suitable for all traditional occasions. It, as a result, is able to make sure of a positive experience.', 'Cotton kabli, kabil, kabli for men, buy online kabli, Kabli Set for Men Tâ€“ 106454', 1, 1),
(26, 14, 6, 'Semi Long Cotton Punjabi', 1050, 950, 2, '565158420_3.jpg', 'This Semi Long Cotton Punjabi for Men - 106448 is very comfortable to wear and also helps to express to yourself in so many ways. You are feeling perfect and comfortable to wear this long-sleeve Punjabi. You can wear any traditional program or any type of occasion and weekend.', '<h2>Semi Long Cotton Punjabi for Men - 106448.</h2><br/>\r\n<b>Product Type: Punjabi.</b><br/>\r\n<b>Gender: Men.</b><br/>\r\n<b>Stylish & Comfortable.</b><br/>\r\n<b>Fabric: Indian Cotton.</b><br/>\r\n<b>Size: 40, 42, 44.</b><br/>\r\n<b>Measurement (In Inch):</b> 40 (Chest 40, Length 40"), 42 (Chest 42", Length 42"), 44 (Chest 44", Length 44").<br/>\r\n<b>Color:</b> As same as picture.<br/>\r\n<b>Disclaimer:</b> Product color may slightly vary due to photographic lighting sources or your monitor settings.', 1, 'Trusted Online Shopping in Bangladesh', 'This Semi Long Cotton Punjabi for Men - 106448 is very comfortable to wear and also helps to express to yourself in so many ways. You are feeling perfect and comfortable to wear this long-sleeve Punjabi. You can wear any traditional program or any type of occasion and weekend.', 'Semi Long Cotton Punjabi for Men - 106448, buy Semi Long Cotton Punjabi for Men - 106448 online, Semi Long Cotton Punjabi for Men - 106448 price, punjabi, punjabi price, buy punjabi online', 1, 1),
(27, 14, 5, 'Premium Denim Pant', 1890, 1590, 20, '189697265_4.jpg', 'Premium Denim Pant for Men - LC51461B export quality exclusive jeans pant for men in a complete super style. Available in cool color. The perfect blending of fashion and comfort.', '<h2>Premium Denim Pant for Men - LC51461B</h2><br/>\r\n<b>Brand:</b> SaRa Lifestyle.<br/>\r\n<b>Product type:</b> Denim pant.<br/>\r\n<b>Main material:</b> 98% Cotton, 2% Spandex.<br/>\r\n<b>Pocket:</b> 2 Side pocket, 2 Back pocket.<br/>\r\n<b>Slim fit.</b><br/>\r\n<b>Gender:</b> Men.<br/>\r\n<b>Size:</b> 30, 32, 34.<br/>\r\n<b>Measurement (In Inch):</b> 30 (Waist: 30", Length: 30"), 32 (Waist: 32", Length: 32"), 34 (Waist: 34", Length: 34").<br/>\r\n<b>Comfortable casual wear.<b><br/>\r\n<b>Export quality.</b><br/>\r\n<b>Color:</b> Indigo.', 1, 'Trusted Online Shopping in Bangladesh', 'Premium Denim Pant for Men - LC51461B export quality exclusive jeans pant for men in a complete super style. Available in cool color. The perfect blending of fashion and comfort.', 'Premium Denim Pant for Men - LC51461B, jeans pant, pant, denim pant, menâ€™s pant, denim pant price in bd', 1, 1),
(28, 14, 5, 'Stretch Denim Jeans', 1550, 1400, 18, '867214626_5.jpg', 'Buy Stretch Denim Jeans Pant for Men â€“ DMDEN48 from PriyoShop from anywhere in the country at the best price. Export quality with super style. Available in cool color. A perfect blending of fashion and comfort.', '<h2>Stretch Denim Jeans Pant for Men â€“ DMDEN48.</h2><br/>\r\n<b>Product Type:</b> Denim Jeans Pant.<br/>\r\n<b>Stylish and Fashionable.</b><br/>\r\n<b>Gender:</b> Men.<br/>\r\n<b>Fabric:</b> Denim.<br/>\r\n<b>Size:</b> 28, 29, 30, 31, 32, 33, 34, 35.<br/>\r\n<b>Measurement (In Inch):</b> 28 (Waist 28", Length 40"), 29 (Waist 29", Length 40"), 30 (Waist 30", Length 40"), 31 (Waist 31â€, Length 40â€), 32 (Waist 32", Length 40"), 33 (Waist 33", Length 40"), 34 (Waist 34", Length 40"), 35 (Waist 35", Length 40").<br/>\r\n<b>Color:</b> As same as picture.<br/>\r\n<b>Disclaimer:</b> Product color may slightly vary due to photographic lighting sources or your monitor settings.', 0, 'Trusted Online Shopping in Bangladesh', 'Buy Stretch Denim Jeans Pant for Men â€“ DMDEN48 from PriyoShop from anywhere in the country at the best price. Export quality with super style. Available in cool color. A perfect blending of fashion and comfort.', 'Stretch Denim Jeans Pant for Men â€“ DMDEN48, buy Stretch Denim Jeans Pant for Men â€“ DMDEN48 online, Stretch Denim Jeans Pant for Men â€“ DMDEN48 price, denim pant, denim pant for men, menâ€™s denim pant', 1, 1),
(29, 15, 8, 'Georgette Indian Designer', 2590, 1960, 12, '939263237_6.jpg', 'Buy fashionable and trendy un-stitched embroidery three piece set. Extraordinary design with quality finishing. Grab the latest designer collection. High quality imported replica version.', '<h2>High quality replica embroidery three piece set.</h2><br/>\r\n<b>Size:</b> Free size; Un-stitched.<br/>\r\n<b>Color:</b> Same as picture.<br/>\r\n<b>Dress:</b> Soft cotton , Heavy Embroidery Work.<br/>\r\n<b>Salwar:</b> Santon.<br/>\r\n<b>Dupatta:</b> Chiffon Georgette.<br/>\r\n<b>Disclaimer:</b> Product color may slightly vary due to photography, lighting sources or your monitor settings.', 1, 'Trusted Online Shopping in Bangladesh', 'Buy fashionable and trendy un-stitched embroidery three piece set. Extraordinary design with quality finishing. Grab the latest designer collection. High quality imported replica version.', 'salwar kamiz, 3 piece, 3 pc set, ladies dress, buy salwar kamiz online, indian dress, replica dress, original indian dress', 1, 1),
(32, 15, 8, 'Indian Designer Embroidery', 2490, 2260, 12, '561686197_9.jpg', 'Buy fashionable and trendy un-stitched embroidery dress set. Extraordinary design with quality finishing. Grab the latest designer collection. High quality imported replica version.', '<h2><b>High quality imported replica embroidery three piece set.</b></h2><br/>\r\n<b>Size:</b> Free size; Semi-stitched.<br/>\r\n<b>Color:</b> Same as picture.<br/>\r\n<b>Dress:</b> Georgette, Heavy Embroidery Work.<br/>\r\n<b>Salwar:</b> Soft Silk.<br/>\r\n<b>Dupatta:</b> Chiffon Georgette.<br/>\r\n<b>Disclaimer:</b> Product color/design may slightly vary due to replica version, photography, lighting sources or your monitor settings.', 1, 'Trusted Online Shopping in Bangladesh', 'Buy fashionable and trendy un-stitched embroidery three piece set. Extraordinary design with quality finishing. Grab the latest designer collection. High quality imported replica version.', 'salwar kamiz, indian three piece set, original indian dress, Georgette dress', 1, 1),
(33, 16, 15, 'Huawei Y7p 4GB/64GB', 20990, 18999, 10, '781358506_10.jpg', 'This Huawei Y7p 4GB/64GB Smartphone is equipped with 6.39" Fullview Display, Triple AI Camera & 120Â° Wide Angle Lens. Android 9 + EMUI9.1.1. Super Night Shot. 6.39" Punch Display. 8MP Front Camera. 4GB Memory + 64GB ROM. 480fps Slow-Motion Mode. Eye Comfort & Night Mode.', '<b>BODY</b></br> \r\n Â Â <b>Dimensions:</b> 159.8 x 76.1 x 8.1 mm (6.29 x 3.00 x 0.32 in).<br/>\r\nÂ Â <b>Weight:</b> 176 g (6.21 oz).<br/>\r\nÂ Â <b>Build:</b> Glass front, plastic back, plastic frame.<br/>\r\nÂ Â <b>SIM:</b> Hybrid Dual SIM (Nano-SIM, dual stand-by).<br/>\r\n<b>DISPLAY</b><br/>\r\nÂ Â <b>Type:</b> IPS LCD capacitive touchscreen, 16M colors.>br/>\r\nÂ Â <b>Size:</b> 6.39 inches, 100.2 cm2 (~82.4% screen-to-body ratio).<br/>\r\nÂ Â <b>Resolution:</b> 720 x 1560 pixels, 19.5:9 ratio (~269 ppi density).<br/>\r\n<b>PLATFORM</b><br/>\r\nÂ Â <b>OS:</b> Android 9.0 (Pie) (AOSP + HMS), EMUI 9.1.<br/>\r\nÂ Â <b>Chipset:</b> Hisilicon Kirin 710F (12 nm).<br/>\r\nÂ Â <b>CPU:</b> Octa-core (4x2.2 GHz Cortex-A73 & 4x1.7 GHz Cortex-A53).<br/>\r\nÂ Â <b>GPU:</b> Mali-G51 MP4.<br/>\r\n<b>MEMORY</b><br/>\r\nÂ Â <b>Card Slot:</b> microSDXC (uses shared SIM slot).<br/>\r\nÂ Â <b>Internal:</b> 64GB ROM, 4GB RAM.<br/>\r\n<b>MAIN CAMERA</b><br/>\r\nÂ Â <b>Triple:</b> 48 MP, f/1.8, 27mm (wide), 1/2.0", 0.8Âµm, PDAF.\r\n8 MP, f/2.4, (ultrawide), 1/4.0", 1.12Âµm.\r\n2 MP, f/2.4, (depth).\r\nÂ Â <b>Features:</b> LED flash, HDR, panorama.<br/>\r\nÂ Â <b>Video:</b> 1080p@30fps.<br/>\r\n<b>SELFIE CAMERA</b><br/>\r\nÂ Â <b>Single:</b> 8 MP, f/2.0.<br/>\r\nÂ Â <b>Features:</b> HDR.<br/>\r\nÂ Â <b>Video:</b> 1080p@30fps.<br/>\r\nÂ Â <b>SOUNDLoudspeaker:</b> Yes.<br/>\r\nÂ Â <b>3.5mm jack:</b> Yes.<br/>\r\n<b>COMMS</b>\r\nÂ Â <b>WLAN:</b> Wi-Fi 802.11 b/g/n, Wi-Fi Direct, hotspot.<br/>\r\nÂ Â <b>Bluetooth:</b> 5.0, A2DP, LE.<br/>\r\nÂ Â <b>GPS:</b> Yes, with A-GPS, GLONASS, GALILEO, BDS.<br/>\r\nÂ Â <b>Radio:</b> FM radio.<br/>\r\nÂ Â <b>USB:</b> microUSB 2.0.<br/>\r\n<b>FEATURES</b><br/>\r\nÂ Â <b>Sensors:</b> Fingerprint (rear-mounted), accelerometer, proximity, compass.<br/>\r\nÂ Â <b>BATTERY:</b> Non-removable Li-Po 4000 mAh battery.<br/>\r\n<b>COLORS</b><br/>\r\nÂ Â <b>Midnight Black.</b><br/>\r\n<b>Warranty</b><br/>\r\nÂ Â <b>1 Year Brand Warranty.</b><br/>\r\nÂ Â <b>Note:</b> Full Advance Payment Is Required.', 0, 'Trusted Online Shopping in Bangladesh', 'This Huawei Y7p 4GB/64GB Smartphone is equipped with 6.39" Fullview Display, Triple AI Camera & 120Â° Wide Angle Lens. Android 9 + EMUI9.1.1. Super Night Shot. 6.39" Punch Display. 8MP Front Camera. 4GB Memory + 64GB ROM. 480fps Slow-Motion Mode. Eye Comfort & Night Mode.', 'Huawei Y7p 4GB/64GB Smartphone, buy Huawei Y7p 4GB/64GB Smartphone online, Huawei Y7p 4GB/64GB Smartphone price, Huawei y7p price, Huawei y7p price in bd', 1, 1),
(34, 16, 19, 'Vivo S1 Pro 8GB/128GB', 28990, 26990, 12, '114067925_11.jpg', 'Vivo S1 Pro 8GB/128GB Smartphone enjoys a 6.38-inch super AMOLED display with a 90% screen-to-body ratio, 1080P resolution, and magnificent color harmonization. Sit back and indulge in a cinematic visual experience.', '<b>BODY</b></br> \r\n Â Â <b>Dimensions:</b> 159.8 x 76.1 x 8.1 mm (6.29 x 3.00 x 0.32 in).<br/>\r\nÂ Â <b>Weight:</b> 176 g (6.21 oz).<br/>\r\nÂ Â <b>Build:</b> Glass front, plastic back, plastic frame.<br/>\r\nÂ Â <b>SIM:</b> Hybrid Dual SIM (Nano-SIM, dual stand-by).<br/>\r\n<b>DISPLAY</b><br/>\r\nÂ Â <b>Type:</b> IPS LCD capacitive touchscreen, 16M colors.>br/>\r\nÂ Â <b>Size:</b> 6.39 inches, 100.2 cm2 (~82.4% screen-to-body ratio).<br/>\r\nÂ Â <b>Resolution:</b> 720 x 1560 pixels, 19.5:9 ratio (~269 ppi density).<br/>\r\n<b>PLATFORM</b><br/>\r\nÂ Â <b>OS:</b> Android 9.0 (Pie) (AOSP + HMS), EMUI 9.1.<br/>\r\nÂ Â <b>Chipset:</b> Hisilicon Kirin 710F (12 nm).<br/>\r\nÂ Â <b>CPU:</b> Octa-core (4x2.2 GHz Cortex-A73 & 4x1.7 GHz Cortex-A53).<br/>\r\nÂ Â <b>GPU:</b> Mali-G51 MP4.<br/>\r\n<b>MEMORY</b><br/>\r\nÂ Â <b>Card Slot:</b> microSDXC (uses shared SIM slot).<br/>\r\nÂ Â <b>Internal:</b> 64GB ROM, 4GB RAM.<br/>\r\n<b>MAIN CAMERA</b><br/>\r\nÂ Â <b>Triple:</b> 48 MP, f/1.8, 27mm (wide), 1/2.0", 0.8Âµm, PDAF.\r\n8 MP, f/2.4, (ultrawide), 1/4.0", 1.12Âµm.\r\n2 MP, f/2.4, (depth).\r\nÂ Â <b>Features:</b> LED flash, HDR, panorama.<br/>\r\nÂ Â <b>Video:</b> 1080p@30fps.<br/>\r\n<b>SELFIE CAMERA</b><br/>\r\nÂ Â <b>Single:</b> 8 MP, f/2.0.<br/>\r\nÂ Â <b>Features:</b> HDR.<br/>\r\nÂ Â <b>Video:</b> 1080p@30fps.<br/>\r\nÂ Â <b>SOUNDLoudspeaker:</b> Yes.<br/>\r\nÂ Â <b>3.5mm jack:</b> Yes.<br/>\r\n<b>COMMS</b>\r\nÂ Â <b>WLAN:</b> Wi-Fi 802.11 b/g/n, Wi-Fi Direct, hotspot.<br/>\r\nÂ Â <b>Bluetooth:</b> 5.0, A2DP, LE.<br/>\r\nÂ Â <b>GPS:</b> Yes, with A-GPS, GLONASS, GALILEO, BDS.<br/>\r\nÂ Â <b>Radio:</b> FM radio.<br/>\r\nÂ Â <b>USB:</b> microUSB 2.0.<br/>\r\n<b>FEATURES</b><br/>\r\nÂ Â <b>Sensors:</b> Fingerprint (rear-mounted), accelerometer, proximity, compass.<br/>\r\nÂ Â <b>BATTERY:</b> Non-removable Li-Po 4000 mAh battery.<br/>\r\n<b>COLORS</b><br/>\r\nÂ Â <b>Midnight Black.</b><br/>\r\n<b>Warranty</b><br/>\r\nÂ Â <b>1 Year Brand Warranty.</b><br/>\r\nÂ Â <b>Note:</b> Full Advance Payment Is Required.', 0, 'Trusted Online Shopping in Bangladesh', 'Vivo S1 Pro 8GB/128GB Smartphone enjoys a 6.38-inch super AMOLED display with a 90% screen-to-body ratio, 1080P resolution, and magnificent color harmonization. Sit back and indulge in a cinematic visual experience.', 'Vivo S1 Pro 8GB/128GB Smartphone, phone, mobile, smartphone, vivo mobile, buy Vivo S1 Pro 8GB/128GB Smartphone, Vivo S1 Pro 8GB/128GB Smartphone price in bd', 1, 1),
(35, 16, 14, 'Samsung Galaxy M31', 24999, 22999, 10, '254394531_12.jpg', 'Samsung smartphones are considered to be one of the best devices as they come with the latest and greatest features and specifications. That is why, PriyoShop has brought you the Samsung Galaxy M31 Mega Monster 6GB/64GB Smartphone.', '<b>BODY</b></br> \r\n   <b>Dimensions:</b> 159.8 x 76.1 x 8.1 mm (6.29 x 3.00 x 0.32 in).<br/>\r\n  <b>Weight:</b> 176 g (6.21 oz).<br/>\r\n  <b>Build:</b> Glass front, plastic back, plastic frame.<br/>\r\n  <b>SIM:</b> Hybrid Dual SIM (Nano-SIM, dual stand-by).<br/>\r\n<b>DISPLAY</b><br/>\r\n  <b>Type:</b> IPS LCD capacitive touchscreen, 16M colors.>br/>\r\n  <b>Size:</b> 6.39 inches, 100.2 cm2 (~82.4% screen-to-body ratio).<br/>\r\n  <b>Resolution:</b> 720 x 1560 pixels, 19.5:9 ratio (~269 ppi density).<br/>\r\n<b>PLATFORM</b><br/>\r\n  <b>OS:</b> Android 9.0 (Pie) (AOSP + HMS), EMUI 9.1.<br/>\r\n  <b>Chipset:</b> Hisilicon Kirin 710F (12 nm).<br/>\r\n  <b>CPU:</b> Octa-core (4x2.2 GHz Cortex-A73 & 4x1.7 GHz Cortex-A53).<br/>\r\n  <b>GPU:</b> Mali-G51 MP4.<br/>\r\n<b>MEMORY</b><br/>\r\n  <b>Card Slot:</b> microSDXC (uses shared SIM slot).<br/>\r\n  <b>Internal:</b> 64GB ROM, 4GB RAM.<br/>\r\n<b>MAIN CAMERA</b><br/>\r\n  <b>Triple:</b> 48 MP, f/1.8, 27mm (wide), 1/2.0", 0.8Âµm, PDAF.\r\n8 MP, f/2.4, (ultrawide), 1/4.0", 1.12Âµm.\r\n2 MP, f/2.4, (depth).\r\n  <b>Features:</b> LED flash, HDR, panorama.<br/>\r\n  <b>Video:</b> 1080p@30fps.<br/>\r\n<b>SELFIE CAMERA</b><br/>\r\n  <b>Single:</b> 8 MP, f/2.0.<br/>\r\n  <b>Features:</b> HDR.<br/>\r\n  <b>Video:</b> 1080p@30fps.<br/>\r\n  <b>SOUNDLoudspeaker:</b> Yes.<br/>\r\n  <b>3.5mm jack:</b> Yes.<br/>\r\n<b>COMMS</b>\r\n  <b>WLAN:</b> Wi-Fi 802.11 b/g/n, Wi-Fi Direct, hotspot.<br/>\r\n  <b>Bluetooth:</b> 5.0, A2DP, LE.<br/>\r\n  <b>GPS:</b> Yes, with A-GPS, GLONASS, GALILEO, BDS.<br/>\r\n  <b>Radio:</b> FM radio.<br/>\r\n  <b>USB:</b> microUSB 2.0.<br/>\r\n<b>FEATURES</b><br/>\r\n  <b>Sensors:</b> Fingerprint (rear-mounted), accelerometer, proximity, compass.<br/>\r\n  <b>BATTERY:</b> Non-removable Li-Po 4000 mAh battery.<br/>\r\n<b>COLORS</b><br/>\r\n  <b>Midnight Black.</b><br/>\r\n<b>Warranty</b><br/>\r\n  <b>1 Year Brand Warranty.</b><br/>\r\n  <b>Note:</b> Full Advance Payment Is Required.', 0, 'Trusted Online Shopping in Bangladesh', 'Samsung smartphones are considered to be one of the best devices as they come with the latest and greatest features and specifications. That is why, PriyoShop has brought you the Samsung Galaxy M31 Mega Monster 6GB/64GB Smartphone.', 'Samsung Galaxy M31 Mega Monster 6GB/64GB Smartphone, buy Samsung Galaxy M31 6GB/64GB Smartphone online, Samsung Galaxy M31 6GB/64GB Smartphone price, smartphone, Samsung smartphone, M31, Samsung galaxy M31', 1, 1),
(36, 16, 17, 'Nokia 5310 DS', 4499, 4099, 8, '419786241_13.jpg', 'The Nokia 5310 DS XpressMusic (2020) Feature Phone is one of HMD Global\'s refreshed classic Nokia phones, but is only a basic feature phone by modern standards. It has bright red strips on the sides, similar to its namesake, with volume and playback controls.', '<b>BODY</b></br> \r\n   <b>Dimensions:</b> 159.8 x 76.1 x 8.1 mm (6.29 x 3.00 x 0.32 in).<br/>\r\n  <b>Weight:</b> 176 g (6.21 oz).<br/>\r\n  <b>Build:</b> Glass front, plastic back, plastic frame.<br/>\r\n  <b>SIM:</b> Hybrid Dual SIM (Nano-SIM, dual stand-by).<br/>\r\n<b>DISPLAY</b><br/>\r\n  <b>Type:</b> IPS LCD capacitive touchscreen, 16M colors.>br/>\r\n  <b>Size:</b> 6.39 inches, 100.2 cm2 (~82.4% screen-to-body ratio).<br/>\r\n  <b>Resolution:</b> 720 x 1560 pixels, 19.5:9 ratio (~269 ppi density).<br/>\r\n<b>PLATFORM</b><br/>\r\n  <b>OS:</b> Android 9.0 (Pie) (AOSP + HMS), EMUI 9.1.<br/>\r\n  <b>Chipset:</b> Hisilicon Kirin 710F (12 nm).<br/>\r\n  <b>CPU:</b> Octa-core (4x2.2 GHz Cortex-A73 & 4x1.7 GHz Cortex-A53).<br/>\r\n  <b>GPU:</b> Mali-G51 MP4.<br/>\r\n<b>MEMORY</b><br/>\r\n  <b>Card Slot:</b> microSDXC (uses shared SIM slot).<br/>\r\n  <b>Internal:</b> 64GB ROM, 4GB RAM.<br/>\r\n<b>MAIN CAMERA</b><br/>\r\n  <b>Triple:</b> 48 MP, f/1.8, 27mm (wide), 1/2.0", 0.8Âµm, PDAF.\r\n8 MP, f/2.4, (ultrawide), 1/4.0", 1.12Âµm.\r\n2 MP, f/2.4, (depth).\r\n  <b>Features:</b> LED flash, HDR, panorama.<br/>\r\n  <b>Video:</b> 1080p@30fps.<br/>\r\n<b>SELFIE CAMERA</b><br/>\r\n  <b>Single:</b> 8 MP, f/2.0.<br/>\r\n  <b>Features:</b> HDR.<br/>\r\n  <b>Video:</b> 1080p@30fps.<br/>\r\n  <b>SOUNDLoudspeaker:</b> Yes.<br/>\r\n  <b>3.5mm jack:</b> Yes.<br/>\r\n<b>COMMS</b>\r\n  <b>WLAN:</b> Wi-Fi 802.11 b/g/n, Wi-Fi Direct, hotspot.<br/>\r\n  <b>Bluetooth:</b> 5.0, A2DP, LE.<br/>\r\n  <b>GPS:</b> Yes, with A-GPS, GLONASS, GALILEO, BDS.<br/>\r\n  <b>Radio:</b> FM radio.<br/>\r\n  <b>USB:</b> microUSB 2.0.<br/>\r\n<b>FEATURES</b><br/>\r\n  <b>Sensors:</b> Fingerprint (rear-mounted), accelerometer, proximity, compass.<br/>\r\n  <b>BATTERY:</b> Non-removable Li-Po 4000 mAh battery.<br/>\r\n<b>COLORS</b><br/>\r\n  <b>Midnight Black.</b><br/>\r\n<b>Warranty</b><br/>\r\n  <b>1 Year Brand Warranty.</b><br/>\r\n  <b>Note:</b> Full Advance Payment Is Required.', 0, 'Trusted Online Shopping in Bangladesh', 'The Nokia 5310 DS XpressMusic (2020) Feature Phone is one of HMD Global\'s refreshed classic Nokia phones, but is only a basic feature phone by modern standards. It has bright red strips on the sides, similar to its namesake, with volume and playback controls.', 'Nokia 5310 DS XpressMusic (2020) Feature Phone, buy Nokia 5310 XpressMusic (2020) Feature Phone online, Nokia 5310 XpressMusic (2020) Feature Phone price, nokia feature phone, feature phone price, buy feature phone online', 1, 1),
(37, 17, 10, 'Dell Inspiron 15 5593', 96800, 91000, 12, '975911458_14.jpg', 'PriyoShop is presenting to you the Dell Inspiron 15 5593 Core i7 10th Gen GeForce MX230 15.6 Inch FHD Laptop. It comes with Intel Core i7-1065G7 Processor (8M Cache, 1.30 GHz up to 3.90 GHz), 8GB DDR-4 2666MHz Ram, 512GB NVMe SSD, and 15.6" FHD (1920 x 1080) Display.', '<b>Basic Information</b><br/>\r\nÂ Â Â <b>Processor:</b> Intel Core i7-1065G7 Processor (8M Cache, 1.30 GHz up to 3.90 GHz).<br/>\r\nÂ Â Â <b>Display:</b> 15.6-inch FHD (1920x1080) Anti-Glare LED-Backlit Non-touch Display Narrow Border.<br/>\r\nÂ Â Â <b>Memory:</b> 8 GB, 1 x 8 GB, DDR4, 2666 MHz.<br/>\r\nÂ Â Â <b>Storage:</b> 512GB M.2 PCIe NVMe Solid State Drive.<br/>\r\nÂ Â Â <b>Graphics:</b> NVIDIA GeForce MX 230 with 4GB GDDR5.<br/>\r\nÂ Â Â <b>Chipset:</b> Integrated with the Processor.<br/>\r\nÂ Â Â <b>Operating System:</b> Windows 10.<br/>\r\nÂ Â Â <b>Battery:</b> 3-Cell, 42 WHr, Integrated battery.<br/>\r\nÂ Â Â <b>Audio:</b> 2 tuned speakers with Waves MaxxAudio Pro.<br/>\r\nÂ Â Â <b>Special Feature:</b> Finger Print Reader.<br/>\r\n<b>Input Devices</b><br/>\r\nÂ Â Â <b>Keyboard:</b> Backlit Keyboard, English.<br/>\r\nÂ Â Â <b>Optical Drive:</b> No.<br/>\r\nÂ Â Â <b>WebCam:</b> Integrated widescreen HD (720p) Webcam with Single Digital Microphone.<br/>\r\nÂ Â Â <b>Card Reader:</b> 1 SD Media Card Reader (SD, SDHC, SDXC).<br/>\r\n<b>Network & Wireless Connectivity</b><br/>\r\nÂ Â Â <b>LAN:</b> 1 RJ45 - 10/100Mbps.<br/>\r\nÂ Â Â <b>Wi-Fi:</b> 802.11ac.<br/>\r\nÂ Â Â <b>Bluetooth:</b> Bluetooth 4.1.<br/>\r\n<b>Ports, Connectors & Slots</b><br/>\r\nÂ Â Â <b>USB (s):</b> 2 USB 3.1 Gen 1, 1 USB2.0.<br/>\r\nÂ Â Â <b>HDMI:</b> 1 HDMI.<br/>\r\nÂ Â Â <b>Audio Jack Combo:</b> 1 combo headphone / microphone jack.<br/>\r\n<b>Physical Specification</b><br/>\r\nÂ Â Â <b>Dimensions (W x D x H):</b> 19.9 x 363.96 x 249 mm.<br/>\r\nÂ Â Â <b>Weight:</b> 1.83kg.<br/>\r\n<b>Warranty</b><br/>\r\nÂ Â Â <b>Manufacturing Warranty:</b> 2 Year Warranty with Battery and Adaptor.<br/>\r\n<b>Color</b><br/>\r\nÂ Â Â <b>Midnight Blue, Platinum Silver.</b><br/>\r\n<b>Note</b><br/>\r\nÂ Â Â <b>Full Advance Payment Is Required.</b>', 0, 'Trusted Online Shopping in Bangladesh', 'PriyoShop is presenting to you the Dell Inspiron 15 5593 Core i7 10th Gen GeForce MX230 15.6 Inch FHD Laptop. It comes with Intel Core i7-1065G7 Processor (8M Cache, 1.30 GHz up to 3.90 GHz), 8GB DDR-4 2666MHz Ram, 512GB NVMe SSD, and 15.6" FHD (1920 x 1080) Display.', 'Dell Inspiron 15 5593 Core i7 10th Gen GeForce MX230 15.6 Inch FHD Laptop, buy Dell Inspiron 15 5593 Core i7 10th Gen GeForce MX230 15.6 Inch FHD Laptop online, Dell Inspiron 15 5593 Core i7 10th Gen GeForce MX230 15.6 Inch FHD Laptop price, dell laptop, dell laptop price, buy dell laptop online', 1, 1),
(38, 17, 11, 'HP Pavilion 14-ce2095TX', 63250, 60000, 5, '375895182_15.jpg', 'HP Pavilion 14-ce2095TX is of the best creation of pavilion series. It has a 14â€ Full HD LED (1920 x 1080) Display. Its FHD display increases the enjoyment of watching. This laptop is powered by Intel Core i5 8265U (8th Gen) processor which cache memory 6M and clock speed up to 3.90 GHz. It comes with 4GB RAM with 2 ram slot.', '<b>Basic Information</b><br/>\r\nÂ Â Â <b>Processor:</b> Intel Core i7-1065G7 Processor (8M Cache, 1.30 GHz up to 3.90 GHz).<br/>\r\nÂ Â Â <b>Display:</b> 15.6-inch FHD (1920x1080) Anti-Glare LED-Backlit Non-touch Display Narrow Border.<br/>\r\nÂ Â Â <b>Memory:</b> 8 GB, 1 x 8 GB, DDR4, 2666 MHz.<br/>\r\nÂ Â Â <b>Storage:</b> 512GB M.2 PCIe NVMe Solid State Drive.<br/>\r\nÂ Â Â <b>Graphics:</b> NVIDIA GeForce MX 230 with 4GB GDDR5.<br/>\r\nÂ Â Â <b>Chipset:</b> Integrated with the Processor.<br/>\r\nÂ Â Â <b>Operating System:</b> Windows 10.<br/>\r\nÂ Â Â <b>Battery:</b> 3-Cell, 42 WHr, Integrated battery.<br/>\r\nÂ Â Â <b>Audio:</b> 2 tuned speakers with Waves MaxxAudio Pro.<br/>\r\nÂ Â Â <b>Special Feature:</b> Finger Print Reader.<br/>\r\n<b>Input Devices</b><br/>\r\nÂ Â Â <b>Keyboard:</b> Backlit Keyboard, English.<br/>\r\nÂ Â Â <b>Optical Drive:</b> No.<br/>\r\nÂ Â Â <b>WebCam:</b> Integrated widescreen HD (720p) Webcam with Single Digital Microphone.<br/>\r\nÂ Â Â <b>Card Reader:</b> 1 SD Media Card Reader (SD, SDHC, SDXC).<br/>\r\n<b>Network & Wireless Connectivity</b><br/>\r\nÂ Â Â <b>LAN:</b> 1 RJ45 - 10/100Mbps.<br/>\r\nÂ Â Â <b>Wi-Fi:</b> 802.11ac.<br/>\r\nÂ Â Â <b>Bluetooth:</b> Bluetooth 4.1.<br/>\r\n<b>Ports, Connectors & Slots</b><br/>\r\nÂ Â Â <b>USB (s):</b> 2 USB 3.1 Gen 1, 1 USB2.0.<br/>\r\nÂ Â Â <b>HDMI:</b> 1 HDMI.<br/>\r\nÂ Â Â <b>Audio Jack Combo:</b> 1 combo headphone / microphone jack.<br/>\r\n<b>Physical Specification</b><br/>\r\nÂ Â Â <b>Dimensions (W x D x H):</b> 19.9 x 363.96 x 249 mm.<br/>\r\nÂ Â Â <b>Weight:</b> 1.83kg.<br/>\r\n<b>Warranty</b><br/>\r\nÂ Â Â <b>Manufacturing Warranty:</b> 2 Year Warranty with Battery and Adaptor.<br/>\r\n<b>Color</b><br/>\r\nÂ Â Â <b>Midnight Blue, Platinum Silver.</b><br/>\r\n<b>Note</b><br/>\r\nÂ Â Â <b>Full Advance Payment Is Required.</b>', 0, 'Trusted Online Shopping in Bangladesh', 'HP Pavilion 14-ce2095TX is of the best creation of pavilion series. It has a 14â€ Full HD LED (1920 x 1080) Display. Its FHD display increases the enjoyment of watching. This laptop is powered by Intel Core i5 8265U (8th Gen) processor which cache memory 6M and clock speed up to 3.90 GHz. It comes with 4GB RAM with 2 ram slot.', 'HP Pavilion 14-ce2095TX Core i5 8th Gen MX130 14 inch Full HD Laptop, buy HP Pavilion 14-ce2095TX Core i5 8th Gen MX130 14 inch Full HD Laptop online, HP Pavilion 14-ce2095TX Core i5 8th Gen MX130 14 inch Full HD Laptop price, buy laptop, laptop, buy laptop online', 1, 1),
(39, 17, 18, 'Walton Laptop WTEX4107SL', 72990, 70990, 5, '960232204_16.jpg', 'Walton Laptop Core i7 WTEX4107SL 14 Inch Silver (EX710G). It comes with 35.56cm (14.0") FHD Matte LED Backlit Display, 10TH Generation Processor, IntelÂ® Coreâ„¢ i7-10510U 1.8GHz up to 4.9GHz, 8MB Smart Cache, IntelÂ® UHD Graphics 620, 512GB SATAIII M.2 2280 SSD, 8GB DDR4 2666MHz RAM, LED illuminated Keyboard, 802.11ac WLAN + BT 5.0.', '<b>Basic Information</b><br/>\r\nÂ Â Â <b>Processor:</b> Intel Core i7-1065G7 Processor (8M Cache, 1.30 GHz up to 3.90 GHz).<br/>\r\nÂ Â Â <b>Display:</b> 15.6-inch FHD (1920x1080) Anti-Glare LED-Backlit Non-touch Display Narrow Border.<br/>\r\nÂ Â Â <b>Memory:</b> 8 GB, 1 x 8 GB, DDR4, 2666 MHz.<br/>\r\nÂ Â Â <b>Storage:</b> 512GB M.2 PCIe NVMe Solid State Drive.<br/>\r\nÂ Â Â <b>Graphics:</b> NVIDIA GeForce MX 230 with 4GB GDDR5.<br/>\r\nÂ Â Â <b>Chipset:</b> Integrated with the Processor.<br/>\r\nÂ Â Â <b>Operating System:</b> Windows 10.<br/>\r\nÂ Â Â <b>Battery:</b> 3-Cell, 42 WHr, Integrated battery.<br/>\r\nÂ Â Â <b>Audio:</b> 2 tuned speakers with Waves MaxxAudio Pro.<br/>\r\nÂ Â Â <b>Special Feature:</b> Finger Print Reader.<br/>\r\n<b>Input Devices</b><br/>\r\nÂ Â Â <b>Keyboard:</b> Backlit Keyboard, English.<br/>\r\nÂ Â Â <b>Optical Drive:</b> No.<br/>\r\nÂ Â Â <b>WebCam:</b> Integrated widescreen HD (720p) Webcam with Single Digital Microphone.<br/>\r\nÂ Â Â <b>Card Reader:</b> 1 SD Media Card Reader (SD, SDHC, SDXC).<br/>\r\n<b>Network & Wireless Connectivity</b><br/>\r\nÂ Â Â <b>LAN:</b> 1 RJ45 - 10/100Mbps.<br/>\r\nÂ Â Â <b>Wi-Fi:</b> 802.11ac.<br/>\r\nÂ Â Â <b>Bluetooth:</b> Bluetooth 4.1.<br/>\r\n<b>Ports, Connectors & Slots</b><br/>\r\nÂ Â Â <b>USB (s):</b> 2 USB 3.1 Gen 1, 1 USB2.0.<br/>\r\nÂ Â Â <b>HDMI:</b> 1 HDMI.<br/>\r\nÂ Â Â <b>Audio Jack Combo:</b> 1 combo headphone / microphone jack.<br/>\r\n<b>Physical Specification</b><br/>\r\nÂ Â Â <b>Dimensions (W x D x H):</b> 19.9 x 363.96 x 249 mm.<br/>\r\nÂ Â Â <b>Weight:</b> 1.83kg.<br/>\r\n<b>Warranty</b><br/>\r\nÂ Â Â <b>Manufacturing Warranty:</b> 2 Year Warranty with Battery and Adaptor.<br/>\r\n<b>Color</b><br/>\r\nÂ Â Â <b>Midnight Blue, Platinum Silver.</b><br/>\r\n<b>Note</b><br/>\r\nÂ Â Â <b>Full Advance Payment Is Required.</b>', 0, 'Trusted Online Shopping in Bangladesh', 'Walton Laptop Core i7 WTEX4107SL 14 Inch Silver (EX710G). It comes with 35.56cm (14.0") FHD Matte LED Backlit Display, 10TH Generation Processor, IntelÂ® Coreâ„¢ i7-10510U 1.8GHz up to 4.9GHz, 8MB Smart Cache, IntelÂ® UHD Graphics 620, 512GB SATAIII M.2 2280 SSD, 8GB DDR4 2666MHz RAM, LED illuminated Keyboard, 802.11ac WLAN + BT 5.0.', 'Walton Laptop Core i7 WTEX4107SL 14 Inch Silver (EX710G), buy Walton Laptop Core i7 WTEX4107SL 14 Inch Silver (EX710G) online, Walton Laptop Core i7 WTEX4107SL 14 Inch Silver (EX710G) price, walton core i5 laptop, laptop, laptop price', 1, 1),
(40, 17, 12, 'Asus VivoBook S15 S532FL', 99990, 93000, 7, '250189887_17.jpg', 'Asus VivoBook S15 S532FL Core i7 10th Gen Nvidia MX250 Graphics 15.6 Inch FHD Laptop. It comes with Intel Core i7-10510U Processor (8M Cache, 1.80GHz up to 4.90 GHz), 8GB RAM + 512GB SSD, Nvidia MX250 2GB Graphics, and 15.6â€ FHD+ (2160 x 1080) Super IPS Display.', '<b>Basic Information</b><br/>\r\nÂ Â Â <b>Processor:</b> Intel Core i7-1065G7 Processor (8M Cache, 1.30 GHz up to 3.90 GHz).<br/>\r\nÂ Â Â <b>Display:</b> 15.6-inch FHD (1920x1080) Anti-Glare LED-Backlit Non-touch Display Narrow Border.<br/>\r\nÂ Â Â <b>Memory:</b> 8 GB, 1 x 8 GB, DDR4, 2666 MHz.<br/>\r\nÂ Â Â <b>Storage:</b> 512GB M.2 PCIe NVMe Solid State Drive.<br/>\r\nÂ Â Â <b>Graphics:</b> NVIDIA GeForce MX 230 with 4GB GDDR5.<br/>\r\nÂ Â Â <b>Chipset:</b> Integrated with the Processor.<br/>\r\nÂ Â Â <b>Operating System:</b> Windows 10.<br/>\r\nÂ Â Â <b>Battery:</b> 3-Cell, 42 WHr, Integrated battery.<br/>\r\nÂ Â Â <b>Audio:</b> 2 tuned speakers with Waves MaxxAudio Pro.<br/>\r\nÂ Â Â <b>Special Feature:</b> Finger Print Reader.<br/>\r\n<b>Input Devices</b><br/>\r\nÂ Â Â <b>Keyboard:</b> Backlit Keyboard, English.<br/>\r\nÂ Â Â <b>Optical Drive:</b> No.<br/>\r\nÂ Â Â <b>WebCam:</b> Integrated widescreen HD (720p) Webcam with Single Digital Microphone.<br/>\r\nÂ Â Â <b>Card Reader:</b> 1 SD Media Card Reader (SD, SDHC, SDXC).<br/>\r\n<b>Network & Wireless Connectivity</b><br/>\r\nÂ Â Â <b>LAN:</b> 1 RJ45 - 10/100Mbps.<br/>\r\nÂ Â Â <b>Wi-Fi:</b> 802.11ac.<br/>\r\nÂ Â Â <b>Bluetooth:</b> Bluetooth 4.1.<br/>\r\n<b>Ports, Connectors & Slots</b><br/>\r\nÂ Â Â <b>USB (s):</b> 2 USB 3.1 Gen 1, 1 USB2.0.<br/>\r\nÂ Â Â <b>HDMI:</b> 1 HDMI.<br/>\r\nÂ Â Â <b>Audio Jack Combo:</b> 1 combo headphone / microphone jack.<br/>\r\n<b>Physical Specification</b><br/>\r\nÂ Â Â <b>Dimensions (W x D x H):</b> 19.9 x 363.96 x 249 mm.<br/>\r\nÂ Â Â <b>Weight:</b> 1.83kg.<br/>\r\n<b>Warranty</b><br/>\r\nÂ Â Â <b>Manufacturing Warranty:</b> 2 Year Warranty with Battery and Adaptor.<br/>\r\n<b>Color</b><br/>\r\nÂ Â Â <b>Midnight Blue, Platinum Silver.</b><br/>\r\n<b>Note</b><br/>\r\nÂ Â Â <b>Full Advance Payment Is Required.</b>', 0, 'Trusted Online Shopping in Bangladesh', 'Asus VivoBook S15 S532FL Core i7 10th Gen Nvidia MX250 Graphics 15.6 Inch FHD Laptop. It comes with Intel Core i7-10510U Processor (8M Cache, 1.80GHz up to 4.90 GHz), 8GB RAM + 512GB SSD, Nvidia MX250 2GB Graphics, and 15.6â€ FHD+ (2160 x 1080) Super IPS Display.', 'Asus VivoBook S15 S532FL Core i7 10th Gen Nvidia MX250 Graphics 15.6 Inch FHD Laptop, buy Asus VivoBook S15 S532FL Core i7 10th Gen Nvidia MX250 Graphics 15.6 Inch FHD Laptop online, Asus VivoBook S15 S532FL Core i7 10th Gen Nvidia MX250 Graphics 15.6 Inch FHD Laptop price, laptop, asus laptop, laptop, asus laptop price', 1, 1),
(41, 15, 7, 'Tangail Half Silk Saree', 1190, 1080, 10, '798258463_1.jpeg', 'Tangail Half Silk Saree M-300 is an evergreen choice when the mercury rises. With its unending advantages, managing a cotton saree in all its crispness is totally worth the effort. Decorate yourself with Bangladeshi look with this cordial cotton saree.', '<h2><b>Tangail Half Silk Saree M-300.</b></h2><br/><br/>\r\n<b>Product Type:</b> Saree.<br/>\r\n<b>Material:</b> Half Silk.<br/>\r\n<b>Occasion:</b> Formal Events & Festivals.<br/>\r\n<b>Easy to carry.</b><br/>\r\n<b>Size:</b> 13.5 Hands Long.<br/>\r\n<b>Blouse Piece Included.</b><br/>\r\n<b>Color:,/b> As same as picture.<br/>\r\n<b>Disclaimer:</b> Product color may slightly vary due to photographic lighting sources or your monitor settings.', 0, 'Trusted Online Shopping in Bangladesh', 'Tangail Half Silk Saree M-300 is an evergreen choice when the mercury rises. With its unending advantages, managing a cotton saree in all its crispness is totally worth the effort. Decorate yourself with Bangladeshi look with this cordial cotton saree.', 'Tangail Half Silk Saree M-300, buy Tangail Half Silk Saree M-300 online, Tangail Half Silk Saree M-300 price, saree, saree price, buy saree online, tangail saree price', 2, 1),
(42, 14, 21, 'Full Sleeve Shirt', 1090, 980, 7, '747829861_2.jpeg', 'Full Sleeve Shirt for Men - SF 5014 in cool color that will satisfy your mind. Nice shirt with best quality cotton fabrics. Grab this fashionable shirt at the best price. Combination of style and comfort.', '<b>Product Type:</b> Slim Fit Full Sleeve Shirt for Men.<br/>\r\n<b>Sleeve:</b> Full sleeve. <br/>\r\n<b>100% Authentic Product.</b><br/>\r\n<b>Material:</b> 95% Cotton & 5% Mixed.<br/>\r\n<b>Unique design.</b><br/>\r\n<b>Pattern:</b> Slim fit.<br/>\r\n<b>For an effortlessly trendy look.</b><br/>\r\n<b>Color:</b> As same as picture.<br/>\r\n<b>Size:</b>  M, L, XL.<br/>\r\n<b>Size Measurement (In Inch):</b>  M (Chest 42", Length 29", Collar 15.5"); L (Chest 44", Length 30", Collar 16"); XL (Chest 46", Length: 31", Collar 16.5").', 1, 'Trusted Online Shopping in Bangladesh', 'Full Sleeve Shirt for Men - SF 5014 in cool color that will satisfy your mind. Nice shirt with best quality cotton fabrics. Grab this fashionable shirt at the best price. Combination of style and comfort.', 'Full Sleeve Shirt for Men - SF 5014, Casual Shirt for Men, casual shirt, cotton shirt, menâ€™s shirt, casual shirt price in bd, Formal Shirt for Men available at online, Casual Shirt for Men available in BD', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `sub_category`, `status`) VALUES
(5, 14, 'Jeans Pant', 1),
(4, 14, 'T-Shirt', 1),
(6, 14, 'Punjabi', 1),
(7, 15, 'Saree', 1),
(8, 15, 'Three-Piece', 1),
(9, 15, 'T-Shirt', 1),
(10, 17, 'Dell', 1),
(11, 17, 'HP', 1),
(12, 17, 'Asus', 1),
(13, 17, 'Acer', 1),
(14, 16, 'Samsung', 1),
(15, 16, 'Huawei', 1),
(16, 16, 'Oppo', 1),
(17, 16, 'Nokia', 1),
(18, 17, 'Walton', 1),
(19, 16, 'Vivo', 1),
(20, 17, 'Apple', 1),
(21, 14, 'Shirt', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `mobile`, `added_on`) VALUES
(2, 'Md. Juwel Rana', '1234', 'juwel@gmail.com', '01769184729', '2020-06-23 04:15:07'),
(22, 'ovi', '123456', 'iamovi104@gmail.com', '01812345678', '2020-07-22 11:46:27'),
(26, 'Najmeen', '1234567', 'najmeen@gmail.com', '01812345671', '2020-07-22 03:38:29'),
(28, 'nibir', '123456', 'nibir@gmail.com', '01812345678', '2020-07-23 08:02:31'),
(34, 'Md. Najmul Ovi', '123456', 'najmulovi999@gmail.com', '01812345678', '2020-08-02 06:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_master`
--
ALTER TABLE `coupon_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `coupon_master`
--
ALTER TABLE `coupon_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
