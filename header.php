<?php
session_start();
require_once "class/DatabaseC.php";
require_once "class/User.php";

$pdo = DatabaseConnection::getConn();
?>
<!DOCTYPE html>
<html lang="en">

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
    <title>AKASHA - CỬA HÀNG THỜI TRANG </title>
</head>

<body>
    <header id="header" class="header style-02 header-dark header-transparent header-sticky">
        <div class="header-wrap-stick">
            <div class="header-position">
                <div class="header-middle">
                    <div class="akasha-menu-wapper"></div>
                    <div class="header-middle-inner">
                        <div class="header-search-menu">
                            <div class="block-menu-bar">
                                <a class="menu-bar menu-toggle" href="#">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                            </div>
                        </div>
                        <div class="header-logo-nav">
                            <div class="header-logo">
                                <a href="Home.php"><img alt="Akasha" src="assets/images/logo.png" class="logo"></a>
                            </div>
                            <div class="box-header-nav menu-nocenter">
                                <ul id="menu-primary-menu" class="clone-main-menu akasha-clone-mobile-menu akasha-nav main-menu">
                                    <li id="menu-item-228" class="menu-item menu-item-type-post_type menu-item-object-megamenu menu-item-228 parent parent-megamenu item-megamenu menu-item-has-children">
                                        <a class="akasha-menu-item-title" title="Shop" href="Product.php">Sản phẩm</a>
                                        <span class="toggle-submenu"></span>
                                        <div class="submenu megamenu megamenu-shop">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="akasha-listitem style-01">
                                                        <div class="listitem-inner">
                                                            <h4 class="title">Phân loại</h4>
                                                            <ul class="listitem-list">
                                                                <li>
                                                                    <a href="Product.php" target="_self"> Quần áo </a>
                                                                </li>
                                                                <li>
                                                                    <a href="Product.php" target="_self">Túi sách</a>
                                                                </li>
                                                                <li>
                                                                    <a href="Product.php" target="_self">Giày</a>
                                                                </li>
                                                                <li>
                                                                    <a href="Product.php" target="_self">Phụ kiện</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="akasha-listitem style-01">
                                                        <div class="listitem-inner">
                                                            <h4 class="title">
                                                                Bộ sưu tập </h4>
                                                            <ul class="listitem-list">
                                                                <li>
                                                                    <a href="single-product-simple.php" target="_self">
                                                                        The Raw MySelf </a>
                                                                </li>
                                                                <li>
                                                                    <a href="single-product.php" target="_self">
                                                                        <span class="image"><img src="assets/images/label-hot.jpg" class="attachment-full size-full" alt="img"></span>
                                                                        Love Is In The Air </a>
                                                                </li>
                                                                <li>
                                                                    <a href="single-product-external.php" target="_self">
                                                                        Panorama Dimand </a>
                                                                </li>
                                                                <li>
                                                                    <a href="single-product-group.php" target="_self">
                                                                        Magic Show </a>
                                                                </li>
                                                                <li>
                                                                    <a href="single-product-outofstock.php" target="_self">
                                                                        Out Of Stock </a>
                                                                </li>
                                                                <li>
                                                                    <a href="single-product-onsale.php" target="_self">
                                                                        On Sale </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li id="menu-item-229" class="menu-item menu-item-type-post_type menu-item-object-megamenu menu-item-229 parent parent-megamenu item-megamenu menu-item-has-children">
                                        <a class="akasha-menu-item-title" title="Elements" href="#">Thiết kế</a>
                                        <span class="toggle-submenu"></span>
                                        <div class="submenu megamenu megamenu-elements">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="akasha-listitem style-01">
                                                        <div class="listitem-inner">
                                                            <h4 class="title">
                                                                Element </h4>
                                                            <ul class="listitem-list">
                                                                <li>
                                                                    <a href="client.php" target="_self">
                                                                        Thương hiệu cộng tác </a>
                                                                </li>
                                                                <li>
                                                                    <a href="banner.php" target="_self">
                                                                        Các sản phẩm nổi bật </a>
                                                                </li>
                                                                <li>
                                                                    <a href="iconbox.php" target="_self">
                                                                        Hộp Icon </a>
                                                                </li>
                                                                <li>
                                                                    <a href="team.php" target="_self">
                                                                        Nhà sáng lập </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li id="menu-item-996" class="menu-item menu-item-type-post_type menu-item-object-megamenu menu-item-996 parent parent-megamenu item-megamenu menu-item-has-children">
                                        <a class="akasha-menu-item-title" title="Blog" href="#">Blog</a>
                                        <span class="toggle-submenu"></span>
                                        <div class="submenu megamenu megamenu-blog">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="akasha-listitem style-01">
                                                        <div class="listitem-inner">
                                                            <h4 class="title">
                                                                Post Layout </h4>
                                                            <ul class="listitem-list">
                                                                <li>
                                                                    <a href="single-post.php" target="_self"> Đánh giá
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="instagram-feed.php" target="_self">
                                                                        <span class="image">
                                                                            <img src="assets/images/label-hot.jpg" class="attachment-full size-full" alt="img">
                                                                        </span>
                                                                        Instagram In Post
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="single-post-gallery.php" target="_self">
                                                                        <span class="image">
                                                                            <img src="assets/images/label-new.jpg" class="attachment-full size-full" alt="img">
                                                                        </span>
                                                                        Product In Post
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="akasha-listitem style-01">
                                                        <div class="listitem-inner">
                                                            <h4 class="title">
                                                                Post Format </h4>
                                                            <ul class="listitem-list">
                                                                <li>
                                                                    <a href="testimonials.php" target="_self">Standard
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="single-post-video.php" target="_self">
                                                                        <span class="image">
                                                                            <img src="assets/images/label-hot.jpg" class="attachment-full size-full" alt="img">
                                                                        </span>
                                                                        Video
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li id="menu-item-237" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-237 parent">
                                        <a class="akasha-menu-item-title" title="Pages" href="#">Liên hệ</a>
                                        <span class="toggle-submenu"></span>
                                        <ul role="menu" class="submenu">
                                            <li id="menu-item-987" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-987">
                                                <a class="akasha-menu-item-title" title="About" href="about.php">About</a>
                                            </li>
                                            <li id="menu-item-988" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-988">
                                                <a class="akasha-menu-item-title" title="Contact" href="contact.php">Contact</a>
                                            </li>
                                            <li id="menu-item-990" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-990">
                                                <a class="akasha-menu-item-title" title="Page 404" href="404.php">Page
                                                    404</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li id="menu-item-237" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-237 parent">
                                        <a class="akasha-menu-item-title" title="Pages" href="order.php">Tra cứu đơn
                                            hàng</a>
                                        <span class="toggle-submenu"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="header-control">
                            <div class="header-control-inner">
                                <div class="meta-dreaming">
                                    <div class="header-search akasha-dropdown">
                                        <div class="header-search-inner" data-akasha="akasha-dropdown">
                                            <a href="#" class="link-dropdown block-link">
                                                <span class="flaticon-magnifying-glass-1"></span>
                                            </a>
                                        </div>
                                        <div class="block-search">
                                            <form role="search" method="post" class="form-search block-search-form akasha-live-search-form">
                                                <div class="form-content search-box results-search">
                                                    <div class="inner">
                                                        <input autocomplete="off" class="searchfield txt-livesearch input" name="s" value="" placeholder="Search here..." type="text">
                                                    </div>
                                                </div>
                                                <input name="post_type" value="product" type="hidden">
                                                <input name="taxonomy" value="product_cat" type="hidden">
                                                <button type="submit" class="btn-submit">
                                                    <span class="flaticon-magnifying-glass-1"></span>
                                                </button>
                                            </form><!-- block search -->
                                        </div>
                                    </div>
                                    <div class="akasha-dropdown-close">x</div>
                                    <?php
                                    if (isset($_SESSION["UserName"])) {
                                        $username = $_SESSION["UserName"];
                                        $user = User::findUsername($pdo, $username);
                                    ?>
                                        <div class="menu-item block-user block-dreaming akasha-dropdown">
                                            <a class="block-link" href="#">
                                                <span class="flaticon-profile"></span>
                                            </a>

                                            <ul class="sub-menu">
                                                <li class="menu-item akasha-MyAccount-navigation-link akasha-MyAccount-navigation-link--edit-account">
                                                    <p>
                                                        <?= $user->Name ?>
                                                    </p>
                                                </li>
                                                <li class="menu-item akasha-MyAccount-navigation-link akasha-MyAccount-navigation-link--edit-account">
                                                    <a href="my-account.php">Thông tin</a>
                                                </li>
                                                <li class="menu-item akasha-MyAccount-navigation-link akasha-MyAccount-navigation-link--customer-logout">
                                                    <a href="logout.php">Đăng xuất</a>
                                                </li>
                                            </ul>
                                        </div>


                                    <?php
                                    } else {
                                    ?>
                                        <div class="menu-item block-user block-dreaming akasha-dropdown">
                                            <a class="block-link" href="#">
                                                <span class="flaticon-profile"></span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li class="menu-item akasha-MyAccount-navigation-link akasha-MyAccount-navigation-link--customer-logout">
                                                    <a href="login.php">Đăng nhập</a>
                                                </li>
                                                <li class="menu-item akasha-MyAccount-navigation-link akasha-MyAccount-navigation-link--customer-logout">
                                                    <a href="register.php">Đăng ký</a>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                    <div class="block-minicart block-dreaming akasha-mini-cart akasha-dropdown">
                                        <div class="shopcart-dropdown block-cart-link">
                                            <a class="block-link link-dropdown" href="cart.php">
                                                <span class="flaticon-bag"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="footer-device-mobile">
        <div class="wapper">
            <div class="footer-device-mobile-item device-home">
                <a href="Home.php">
                    <span class="icon">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </span>
                    Trang Chủ
                </a>
            </div>
            <div class="footer-device-mobile-item device-home device-wishlist">
                <a href="Product.php">
                    <span class="icon">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                    </span>
                    Sản Phẩm
                </a>
            </div>
            <div class="footer-device-mobile-item device-home device-cart">
                <a href="cart.php">
                    <span class="icon">
                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                        <span class="count-icon">
                            0
                        </span>
                    </span>
                    <span class="text">Giỏ hàng</span>
                </a>
            </div>
            <?php
            if (isset($_SESSION["UserName"])) {
                $username = $_SESSION["UserName"];
                $user = User::findUsername($pdo, $username);
            ?>
                <div class="footer-device-mobile-item device-home device-user">
                        <span class="icon">
                            <i class="fa fa-user" aria-hidden="true"> <?= $user->Name ?></i>
                        </span>
                    <a href="logout.php">Đăng xuất</a>
                </div>
            <?php
            } else {
            ?>
                <div class="footer-device-mobile-item device-home device-user">
                    <a href="login.php">
                        <span class="icon">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                        Đăng nhập
                    </a>
                </div>
                <div class="footer-device-mobile-item device-home device-user">
                    <a href="register.php">
                        <span class="icon">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                        Đăng ký tài khoản
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</html>