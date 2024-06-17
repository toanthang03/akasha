<?php

include "header.php";
require_once "class/Product.php";
require_once "class/Cart.php";
$pdo = DatabaseConnection::getConn();
if (!isset($_SESSION["UserID"])) {
    // Nếu chưa đăng nhập, bạn có thể thực hiện các hành động tương ứng ở đây (ví dụ: chuyển hướng người dùng đến trang đăng nhập)
    echo "Vui lòng đăng nhập để xem giỏ hàng.";
    exit();
}
$userId = $_SESSION['UserID'];
//Xử lý View vào giỏ hàng
$total = 0;

$sql = "SELECT * FROM  cart AS c JOIN products AS p ON c.productid = p.Id WHERE c.userid = $userId";
$stmt = $pdo->prepare($sql);
if ($stmt->execute())
    $addCart = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Xử lý xóa sản phẩm trong giỏ hàng
if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $id = $_GET['id'];
    Cart::deleteCart($pdo, $id);
}
if (isset($_POST["update_cart"])) {
    // Lấy dữ liệu từ form
    $cart_id = $_POST["cart_id"];
    $quantity = $_POST["quantity"];

    // Gọi phương thức updateQuantity để cập nhật số lượng
    Cart::updateQuantity($pdo, $quantity, $cart_id);
}



?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamingtheme.kiendaotac.com/html/akasha/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Apr 2024 12:43:45 GMT -->

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap"
        rel="stylesheet">
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
            <h1 class="page-title">Cart</h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin"><a href="Home.php"><span>Home</span></a></li>
                    <li class="trail-item trail-end active"><span>Cart</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <main class="site-main main-container no-sidebar">
        <div class="container">
            <div class="row">
                <div class="main-content col-md-12">
                    <div class="page-main-content">
                        <div class="akasha">
                            <div class="akasha-notices-wrapper"></div>
                            <!-- <form class="akasha-cart-form" method="post" action="Manager_AddToCart.php"> -->
                            <table class="shop_table shop_table_responsive cart akasha-cart-form__contents"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="product-name">Hình ảnh</th>
                                        <th class="product-name">Sản phẩm</th>
                                        <th class="product-price">Giá</th>
                                        <th class="product-quantity">Số lượng</th>
                                        <th class="product-subtotal">Tổng</th>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumbnail">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--Lấy thông tin đã thêm vào bảng để hiển thị ra View-->
                                    <?php
                                    foreach ($addCart as $cart) {
                                    ?>
                                    <tr class="akasha-cart-form__cart-item cart_item">
                                        <td class="product-thumbnail">
                                            <a href="#"><img src="<?= $cart["Image"] ?>"
                                                    class="attachment-akasha_thumbnail size-akasha_thumbnail" alt="img"
                                                    width="600" height="778"></a>
                                        </td>
                                        <td class="product-name" data-title="Product">
                                            <a href="#"><?= $cart["ProductName"] ?></a>
                                        </td>
                                        <td clas="product-price" data-title="Price">
                                            <span class="akasha-Price-amount amount">
                                                <span class="akasha-Price-currencySymbol">
                                                    <?= number_format($cart["Price"], 0, ',', '.') ?>
                                                </span>
                                            </span>
                                        </td>
                                        <form method="post">
                                            <td class="product-quantity" data-title="Quantity">
                                                <a class="btn-number qtyminus quantity-minus" href="#">-</a>
                                                <input id="quantity" value="<?= $cart["quantity"] ?>" type="text"
                                                    data-step="1" min="0" max="" name="quantity" title="Qty"
                                                    class="input-qty input-text qty text" size="4" pattern="[0-9]*"
                                                    inputmode="numeric">
                                                <a class="btn-number qtyplus quantity-plus" href="#">+</a>
                                                <input type="hidden" name="cart_id" value="<?= $cart["id"] ?>">
                                                <button type="submit" name="update_cart">Cập nhật giỏ hàng</button>
                                            </td>
                                        </form>

                                        <td class="product-subtotal" data-title="Total">
                                            <span class="akasha-Price-amount amount">
                                                <span class="akasha-Price-currencySymbol">
                                                    <?= number_format($cart["quantity"] * $cart["Price"]) ?> VNĐ
                                                </span>
                                            </span>
                                        </td>
                                        <td class="product-remove">
                                            <form method="post">
                                                <a href="cart.php?action=delete&id=<?= $cart["id"] ?>" class="btn btn-danger">Xóa</a>
                                            </form>

                                        </td>
                                    </tr>
                                    <?php
                                        $total = $total + ($cart["quantity"] * $cart["Price"]);
                                    }
                                    ?>
                                </tbody>
                            </table>


                            <div class="cart-collaterals">
                                <div class="cart_totals ">
                                    <h2>Cart totals</h2>
                                    <table class="shop_table shop_table_responsive" cellspacing="0">
                                        <tbody>
                                            <tr class="order-total">
                                                <th>Tổng tiền</th>
                                                <td data-title="Total">
                                                    <strong>
                                                        <span class="akasha-Price-amount amount">
                                                            <span class="akasha-Price-currencySymbol">
                                                                <?= number_format($total) ?> VNĐ
                                                            </span>
                                                        </span>
                                                    </strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="akasha-proceed-to-checkout">
                                        <a href="checkout.php" class="checkout-button button alt akasha-forward">
                                            THANH TOÁN</a>
                                            <a href="Product.php" class="checkout-button button alt akasha-forwar">TIẾP TỤC MUA HÀNG</a>
                                    </div>
                                </div>
                            </div>
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
                                <input class="email email-newsletter" name="email" placeholder="Enter your email ..."
                                    type="email">
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

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Lấy tất cả các nút giảm và tăng số lượng
    var minusButtons = document.querySelectorAll(".quantity-minus");
    var plusButtons = document.querySelectorAll(".quantity-plus");
    var quantityInputs = document.querySelectorAll(".input-qty");

    // Hàm để cập nhật số lượng
    function updateQuantity(input, change) {
        var currentQuantity = parseInt(input.value);
        var newQuantity = currentQuantity + change;

        // Kiểm tra giá trị min và max nếu cần
        var min = parseInt(input.getAttribute("min")) || 0;
        var max = parseInt(input.getAttribute("max")) || Infinity;

        if (newQuantity >= min && newQuantity <= max) {
            input.value = newQuantity;
        }
    }

    // Gán sự kiện cho tất cả các nút giảm
    minusButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            var input = this.nextElementSibling;
            updateQuantity(input, -1);
        });
    });

    // Gán sự kiện cho tất cả các nút tăng
    plusButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            var input = this.previousElementSibling;
            updateQuantity(input, 1);
        });
    });
});
document.addEventListener("DOMContentLoaded", function() {
    // Lấy tất cả các input số lượng
    var quantityInputs = document.querySelectorAll(".input-qty");

    // Sử dụng vòng lặp để thêm sự kiện lắng nghe cho mỗi input
    quantityInputs.forEach(function(input) {
        input.addEventListener("change", function(event) {
            var productId = this.closest('tr').dataset
                .productId; // Lấy ID sản phẩm từ thuộc tính data của hàng chứa input
            var quantity = this.value; // Lấy số lượng mới từ input

            // Gửi số lượng mới và ID sản phẩm đi thông qua AJAX
            $.ajax({
                url: 'Manager_AddToCart.php',
                method: 'POST',
                data: {
                    productId: productId,
                    quantity: quantity
                },
                success: function(response) {
                    // Xử lý phản hồi từ PHP nếu cần
                    console.log(response);
                }
            });
        });
    });
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script>
$(document).ready(function() {
    $('.input-qty').on('change', function() {
        var productId = $(this).closest('tr').data('product-id');
        var quantity = $(this).val();

        $.ajax({
            url: 'Manager_AddToCart.php',
            method: 'POST',
            data: {
                productId: productId,
                quantity: quantity
            },
            success: function(response) {
                // Cập nhật giao diện người dùng với kết quả trả về nếu cần
                console.log(response);
            }
        });
    });
});
</script> -->

<!-- Mirrored from dreamingtheme.kiendaotac.com/html/akasha/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Apr 2024 12:43:45 GMT -->

</html>