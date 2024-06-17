<?php
include "header.php";
require_once "class/Cart.php";
require_once "class/Product.php";
require_once "class/Order.php";
require_once "class/User.php";
// Tắt hiển thị cảnh báo
error_reporting(E_ERROR | E_PARSE);

$pdo = DatabaseConnection::getConn();

$totalAmount = 0;
if (!isset($_SESSION["UserID"])) {
    // Nếu chưa đăng nhập, bạn có thể thực hiện các hành động tương ứng ở đây (ví dụ: chuyển hướng người dùng đến trang đăng nhập)
    echo "Vui lòng đăng nhập để xem giỏ hàng.";
    exit();
}
$userId = $_SESSION['UserID'];
$total = $cart["quantity"] * $cart["Price"];
$sql = "SELECT * FROM  cart AS c JOIN products AS p ON c.productid = p.Id WHERE c.userid = $userId";
$stmt = $pdo->prepare($sql);
if ($stmt->execute())
    $addCart = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Kiểm tra nếu form đã được gửi đi
if (isset($_POST["akasha_checkout_place_order"])) {
    // Lấy dữ liệu từ form
    $name = $_POST["billing_adchair_1"];
    $phone = $_POST["billing_phone"];
    $address = $_POST["billing_adchair_1"]; // Lấy giá trị của trường Số nhà, Tên đường
    $note = $_POST["order_comments"]; // Lấy giá trị của trường Ghi chú
    $total = $_POST["total_field"];
    // Gọi phương thức processFormData để xử lý đơn hàng
    Order::processFormData($pdo, $phone, $address, $total, $userId, $note);
}

//lấy ra userid trong giỏ hàng
$id = User::findIdUsername($pdo, $username);
//Xử lý giỏ hàng sau khi người dùng thanh toán
if(isset($_POST["akasha_checkout_place_order"])){
    Cart::deleteCartFromUser($pdo, $id);

}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamingtheme.kiendaotac.com/html/akasha/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Apr 2024 12:43:45 GMT -->

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/chosen.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.scrollbar.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/lightbox.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/magnific-popup.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/fonts/flaticon.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/megamenu.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/dreaming-attribute.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <title>Akasha - HTML Template </title>
</head>

<body>
    <div class="banner-wrapper has_background">
        <img src="assets/images/banner-for-all2.jpg" class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        <div class="banner-wrapper-inner">
            <h1 class="page-title">Checkout</h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin"><a href="Home.php"><span>Home</span></a></li>
                    <li class="trail-item trail-end active"><span>Checkout</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <main class="site-main  main-container no-sidebar">
        <div class="container">
            <div class="row">
                <div class="main-content col-md-12">
                    <div class="page-main-content">
                        <div class="akasha">
                            <div class="akasha-notices-wrapper"></div>
                            <form name="checkout" method="post" class="checkout akasha-checkout" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" novalidate="novalidate">

                                <div class="col2-set" id="customer_details">
                                    <div class="col-1">
                                        <div class="akasha-billing-fields">
                                            <h3>Nhập thông tin cá nhân</h3>

                                            <div class="akasha-billing-fields__field-wrapper">
                                                <p class="form-row form-row-wide adchair-field validate-required" id="billing_adchair_1_field" data-priority="50"><label for="billing_adchair_1" class="">Họ tên &nbsp;<abbr class="required" title="required">*</abbr></label><span class="akasha-input-wrapper"><input type="text" class="input-text " name="billing_adchair_1" id="billing_adchair_1" value="<?=$addCart->Name?>" autocomplete="adchair-line1" data-placeholder="House number and street name"></span>
                                                </p>
                                                <p class="form-row form-row-wide validate-required validate-phone" id="billing_phone_field" data-priority="100"><label for="billing_phone" class="">Số điện thoại&nbsp;<abbr class="required" title="required">*</abbr></label><span class="akasha-input-wrapper"><input type="tel" class="input-text " name="billing_phone" id="billing_phone" placeholder="" value="<?=$addCart->Phone?>" autocomplete="tel"></span>
                                                </p>

                                                <p class="form-row form-row-wide adchair-field validate-required" id="billing_adchair_1_field" data-priority="50"><label for="billing_adchair_1" class="">Số nhà, tên
                                                        đường&nbsp;<abbr class="required" title="required">*</abbr></label><span class="akasha-input-wrapper"><input type="text" class="input-text " name="billing_adchair_1" id="billing_adchair_1" placeholder="House number and street name" value="" autocomplete="adchair-line1" data-placeholder="House number and street name"></span>
                                                </p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-2">
                                        <div class="akasha-shipping-fields">
                                        </div>
                                        <div class="akasha-additional-fields">
                                            <div class="akasha-additional-fields__field-wrapper">
                                                <p class="form-row notes" id="order_comments_field" data-priority="">
                                                    <label for="order_comments" class="">Ghi chú &nbsp;<span class="optional">(optional)</span></label><span class="akasha-input-wrapper"><textarea name="order_comments" class="input-text " id="order_comments" placeholder="Notes about your order, e.g. special notes for delivery." rows="2" cols="5"></textarea></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 id="order_review_heading">Giỏ hàng của bạn</h3>
                                <div id="order_review" class="akasha-checkout-review-order">
                                    <table class="shop_table akasha-checkout-review-order-table">
                                        <thead>
                                            <tr>
                                                <th class="product-name">Sản phẩm</th>
                                                <th class="product-total">Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($addCart as $cart) {
                                            ?>
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        <?= $cart["ProductName"] ?> – Pink&nbsp;&nbsp;<strong class="product-quantity">×
                                                            <?= $cart["quantity"] ?></strong></td>
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="akasha-Price-amount amount"><span class="akasha-Price-currencySymbol"></span><?= number_format($cart["quantity"] * $cart["Price"]) ?>
                                                            VNĐ</span>

                                                        <?php

                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php
                                                $totalAmount = $totalAmount + ($cart["quantity"] * $cart["Price"]);
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="order-total">
                                                <th>Tổng thanh toán</th>
                                                <td><strong><span class="akasha-Price-amount amount"><span class="akasha-Price-currencySymbol"></span><?= number_format($totalAmount) ?>
                                                            VNĐ</span></strong>
                                                    <input type="hidden" name="total_field" value="<?= $totalAmount ?>" />
                                                </td>
                                            </tr>
                                        </tfoot>

                                    </table>
                                    <input type="hidden" name="lang" value="en">
                                    <div id="payment" class="akasha-checkout-payment">
                                        <ul class="wc_payment_methods payment_methods methods">
                                            <li class="wc_payment_method payment_method_bacs">
                                                <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="bacs" checked="checked" data-order_button_text="">
                                                <label for="payment_method_bacs">
                                                    Thanh toán khi giao hàng </label>
                                            </li>
                                            <li class="wc_payment_method payment_method_cheque">
                                                <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="cheque" data-order_button_text="">
                                                <label for="payment_method_cheque">
                                                    Chuyển khoản qua ngân hàng </label>
                                            </li>
                                            <li class="wc_payment_method payment_method_cod">
                                                <input id="payment_method_cod" type="radio" class="input-radio" name="payment_method" value="cod" data-order_button_text="">
                                                <label for="payment_method_cod">
                                                    Chuyển khoản qua thẻ ATM </label>
                                                <div class="payment_box payment_method_cod" style="display:none;">
                                                    <p>Pay with cash upon delivery.</p>
                                                </div>
                                            </li>
                                            <li class="wc_payment_method payment_method_paypal">
                                                <input id="payment_method_paypal" type="radio" class="input-radio" name="payment_method" value="paypal" data-order_button_text="Proceed to PayPal">
                                                <label for="payment_method_paypal">
                                                    Thẻ Visa/Master/JCB/... <img src="assets/images/AM_mc_vs_ms_ae_UK.png" alt="PayPal acceptance mark"><a href="#" class="about_paypal">What is
                                                        PayPal?</a> </label>
                                                <div class="payment_box payment_method_paypal" style="display:none;">
                                                    <p>Pay via PayPal; you can pay with your credit card if you don’t
                                                        have a
                                                        PayPal account.</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="form-row place-order">

                                            <button type="submit" class="button alt" name="akasha_checkout_place_order" name="place_order" id="place_order" value="Place order" data-value="Place order">Thanh toán
                                            </button>
                                            <input type="hidden" id="akasha-process-checkout-nonce" name="akasha-process-checkout-nonce" value="634590c981"><input type="hidden" name="_wp_http_referer" value="/akasha/?akasha-ajax=update_order_review">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer id="footer" class="footer style-01">
        <div class="section-001 section-009">
            <div class="container">
                <div class="akasha-newsletter style-01">
                    <div class="newsletter-inner">
                        <div class="newsletter-info">
                            <div class="newsletter-wrap">
                                <h3 class="title">Newsletter</h3>
                                <h4 class="subtitle">Get Discount 30% Off</h4>
                                <p class="desc">Suspendisse netus proin eleifend fusce sollicitudin potenti vel magnis
                                    nascetur</p>
                            </div>
                        </div>
                        <div class="newsletter-form-wrap">
                            <div class="newsletter-form-inner">
                                <input class="email email-newsletter" name="email" placeholder="Enter your email ..." type="email">
                                <a href="#" class="button btn-submit submit-newsletter">
                                    <span class="text">Subscribe</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-010">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p>© Copyright 2020 <a href="#">Akasha</a>. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <div class="akasha-socials style-01">
                            <div class="content-socials">
                                <ul class="socials-list">
                                    <li>
                                        <a href="https://facebook.com/" target="_blank">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/" target="_blank">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/" target="_blank">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.pinterest.com/" target="_blank">
                                            <i class="fa fa-pinterest-p"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="footer-device-mobile">
        <div class="wapper">
            <div class="footer-device-mobile-item device-home">
                <a href="index-2.html">
                    <span class="icon">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </span>
                    Home
                </a>
            </div>
            <div class="footer-device-mobile-item device-home device-wishlist">
                <a href="wishlist.html">
                    <span class="icon">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                    </span>
                    Wishlist
                </a>
            </div>
            <div class="footer-device-mobile-item device-home device-cart">
                <a href="cart.html">
                    <span class="icon">
                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                        <span class="count-icon">
                            0
                        </span>
                    </span>
                    <span class="text">Cart</span>
                </a>
            </div>
            <div class="footer-device-mobile-item device-home device-user">
                <a href="my-account.html">
                    <span class="icon">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </span>
                    Account
                </a>
            </div>
        </div>
    </div>
    <a href="#" class="backtotop active">
        <i class="fa fa-angle-up"></i>
    </a>
    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/chosen.min.js"></script>
    <script src="assets/js/countdown.min.js"></script>
    <script src="assets/js/jquery.scrollbar.min.js"></script>
    <script src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/magnific-popup.min.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/jquery.zoom.min.js"></script>
    <script src="assets/js/threesixty.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/mobilemenu.js"></script>
    <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyC3nDHy1dARR-Pa_2jjPCjvsOR4bcILYsM'></script>
    <script src="assets/js/functions.js"></script>
</body>

<!-- Mirrored from dreamingtheme.kiendaotac.com/html/akasha/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Apr 2024 12:43:46 GMT -->

</html>