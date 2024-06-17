<?php

ini_set('display_errors', 0);

// Đặt cấu hình cảnh báo
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include "header.php";
include_once "class/DatabaseC.php";
require_once "class/Product.php";

$pdo = DatabaseConnection::getConn();

$data = Product::getAll($pdo, $userid);
$userid = $_SESSION["UserID"];
$id = $_GET['id'];
$product = Product::getOne($data, $id, $userid);
$current_product_id = $id;
if (!$product) {
    echo "Không tìm thấy sản phẩm";
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamingtheme.kiendaotac.com/html/akasha/single-product-simple.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Apr 2024 12:43:46 GMT -->

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

<body class="single single-product">
    <div class="banner-wrapper no_background">
        <div class="banner-wrapper-inner">
            <nav class="akasha-breadcrumb"><a href="index-2.html">Home</a><i class="fa fa-angle-right"></i><a
                    href="#">Shop</a>
                <i class="fa fa-angle-right"></i>Single Product
            </nav>
        </div>
    </div>
    <div class="single-thumb-vertical main-container shop-page no-sidebar">
        <div class="container">
            <div class="row">
                <div class="main-content col-md-12">
                    <div class="akasha-notices-wrapper"></div>
                    <div id="product-27"
                        class="post-27 product type-product status-publish has-post-thumbnail product_cat-table product_cat-new-arrivals product_cat-lamp product_tag-table product_tag-sock first instock shipping-taxable purchasable product-type-variable has-default-attributes">
                        <!-- Hiển thị sản phẩm -->
                        <div class="main-contain-summary">
                            <div class="contain-left has-gallery">
                                <div class="single-left">
                                    <div
                                        class="akasha-product-gallery akasha-product-gallery--with-images akasha-product-gallery--columns-4 images">
                                        <a href="#" class="akasha-product-gallery__trigger">
                                            <img draggable="false" class="emoji" alt="🔍"
                                                src="https://s.w.org/images/core/emoji/11/svg/1f50d.svg"></a>
                                        <div class="flex-viewport">
                                            <figure class="akasha-product-gallery__wrapper">
                                                <div>
                                                    <img alt="img" src="<?= $product->Image ?>">
                                                </div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                                <div class="summary entry-summary">
                                    <div class="flash">
                                        <span class="onnew"><span class="text">New</span></span>
                                    </div>
                                    <h1 class="product_title entry-title"><?= $product->ProductName ?></h1>
                                    <p class="price"><span class="akasha-Price-amount amount"><span
                                                class="akasha-Price-currencySymbol"></span><?= number_format($product->Price) ?>
                                            VNĐ</span>
                                    <p class="stock in-stock">
                                        Availability: <span> Sẵn hàng </span>
                                    </p>
                                    <div class="akasha-product-details__short-description">
                                        <p><?= $product->Description ?></p>
                                    </div>
                                    <!-- Form xử lý thông tin khi nhấn nút thêm giỏ hàng -->
                                    <form method="post" action="Manager_AddToCart.php?id=<?= $product->ID ?>"
                                        class="variations_form cart">
                                        <div class="cart">
                                            <div class="akasha-variation single_variation"></div>
                                            <div
                                                class="akasha-variation-add-to-cart variations_button akasha-variation-add-to-cart-disabled">
                                                <div class="quantity">
                                                    <span class="qty-label">Quantity:</span>
                                                    <div class="control">
                                                        <a class="btn-number qtyminus quantity-minus" href="#">-</a>
                                                        <input value="1" type="text" data-step="1" min="0" max=""
                                                            name="quantity" title="Qty"
                                                            class="input-qty input-text qty text" size="4"
                                                            pattern="[0-9]*" inputmode="numeric">
                                                        <a class="btn-number qtyplus quantity-plus" href="#">+</a>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="ID" value="<?= $product->ID ?>" />
                                                <input type="hidden" name="ProductName"
                                                    value="<?= $product->ProductName ?>" />
                                                <input type="hidden" name="Price" value="<?= $product->Price ?>" />

                                                <button type="submit" name="addToCart">Thêm sản phẩm</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <div class="yith-wcwl-add-button show">
                                            <a href="#" rel="nofollow" data-product-id="27" data-product-type="variable"
                                                class="add_to_wishlist">
                                                Add to Wishlist</a>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="product_meta">
                                        <span class="sku_wrapper">SKU: <span class="sku">885B712</span></span>
                                        <span class="posted_in">Categories: <a href="#" rel="tag">Bags</a>, <a href="#"
                                                rel="tag">New arrivals</a>, <a href="#" rel="tag">Summer Sale</a></span>
                                        <span class="tagged_as">Tags: <a href="#" rel="tag">Bags</a>, <a href="#"
                                                rel="tag">Sock</a></span>
                                    </div>
                                </div>
                                <div class="akasha-share-socials">
                                    <h5 class="social-heading">Share: </h5>
                                    <a target="_blank" class="facebook" href="#">
                                        <i class="fa fa-facebook-f"></i>
                                    </a>
                                    <a target="_blank" class="twitter" href="#"><i class="fa fa-twitter"></i>
                                    </a>
                                    <a target="_blank" class="pinterest" href="#"> <i class="fa fa-pinterest"></i>
                                    </a>
                                    <a target="_blank" class="googleplus" href="#"><i class="fa fa-google-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Mô tả sản phẩm (Chỉ hiển thị cho đẹp)-->
                    <div class="akasha-tabs akasha-tabs-wrapper">
                        <ul class="tabs dreaming-tabs" role="tablist">
                            <li class="description_tab active" id="tab-title-description" role="tab"
                                aria-controls="tab-description">
                                <a href="#tab-description">Description</a>
                            </li>
                            <li class="additional_information_tab" id="tab-title-additional_information" role="tab"
                                aria-controls="tab-additional_information">
                                <a href="#tab-additional_information">Additional information</a>
                            </li>
                            <li class="reviews_tab" id="tab-title-reviews" role="tab" aria-controls="tab-reviews">
                                <a href="#tab-reviews">Reviews (0)</a>
                            </li>
                        </ul>
                        <div class="akasha-Tabs-panel akasha-Tabs-panel--description panel entry-content akasha-tab"
                            id="tab-description" role="tabpanel" aria-labelledby="tab-title-description">
                            <h2>Description</h2>
                            <div class="container-table">
                                <div class="container-cell">
                                    <h2 class="az_custom_heading">Platea viverra aenean<br>dictumst</h2>
                                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit
                                        scelerisque integer, quam dapibus per risus donec semper
                                        vulputate interdum, imperdiet mus rhoncus commodo ultricies
                                        class urna tincidunt. Imperdiet vitae lacus etiam metus ut nisl
                                        curae, conubia enim scelerisque quis facilisis torquent,
                                        ultricies orci faucibus dictumst mauris curabitur. Massa risus
                                        nec sociosqu fames montes accumsan iaculis justo turpis
                                        luctus</p>
                                </div>
                                <div class="container-cell">
                                    <div class="az_single_image-wrapper az_box_border_grey">
                                        <img src="assets/images/single-pro1.jpg"
                                            class="az_single_image-img attachment-full" alt="img">
                                    </div>
                                </div>
                            </div>
                            <div class="container-table">
                                <div class="container-cell">
                                    <div class="az_single_image-wrapper az_box_border_grey">
                                        <img src="assets/images/single-pro2.jpg"
                                            class="az_single_image-img attachment-full" alt="img">
                                    </div>
                                </div>
                                <div class="container-cell">
                                    <h2 class="az_custom_heading">
                                        Potenti praesent molestie<br>
                                        at viverra</h2>
                                    <p>This generator uses a dictionary of Latin words to construct
                                        passages of Lorem Ipsum text that meet your desired length. The
                                        sentence and paragraph durations and punctuation dispersal are
                                        calculated using Gaussian distribution, based on statistical
                                        analysis of real world texts. This ensures that the generated
                                        Lorem Ipsum text is unique, free of repetition and also
                                        resembles readable text as much as possible.</p>
                                </div>
                            </div>
                        </div>
                        <div class="akasha-Tabs-panel akasha-Tabs-panel--additional_information panel entry-content akasha-tab"
                            id="tab-additional_information" role="tabpanel"
                            aria-labelledby="tab-title-additional_information">
                            <h2>Additional information</h2>
                        </div>
                        <div class="akasha-Tabs-panel akasha-Tabs-panel--reviews panel entry-content akasha-tab"
                            id="tab-reviews" role="tabpanel" aria-labelledby="tab-title-reviews">
                            <div id="reviews" class="akasha-Reviews">
                                <div id="comments">
                                    <h2 class="akasha-Reviews-title">Reviews</h2>
                                    <p class="akasha-noreviews">There are no reviews yet.</p>
                                </div>
                                <div id="review_form_wrapper">
                                    <div id="review_form">
                                        <div id="respond" class="comment-respond">
                                            <span id="reply-title" class="comment-reply-title">Be the first to review
                                                “T-shirt with skirt”</span>
                                            <form id="commentform" class="comment-form">
                                                <p class="comment-notes"><span id="email-notes">Your email adchair will
                                                        not be published.</span>
                                                    Required fields are marked <span class="required">*</span></p>
                                                <p class="comment-form-author">
                                                    <label for="author">Name&nbsp;<span
                                                            class="required">*</span></label>
                                                    <input id="author" name="author" value="" size="30" required=""
                                                        type="text">
                                                </p>
                                                <p class="comment-form-email"><label for="email">Email&nbsp;
                                                        <span class="required">*</span></label>
                                                    <input id="email" name="email" value="" size="30" required=""
                                                        type="email">
                                                </p>
                                                <div class="comment-form-rating"><label for="rating">Your rating</label>
                                                    <p class="stars">
                                                        <span>
                                                            <a class="star-1" href="#">1</a>
                                                            <a class="star-2" href="#">2</a>
                                                            <a class="star-3" href="#">3</a>
                                                            <a class="star-4" href="#">4</a>
                                                            <a class="star-5" href="#">5</a>
                                                        </span>
                                                    </p>
                                                    <select title="product_cat" name="rating" id="rating" required=""
                                                        style="display: none;">
                                                        <option value="">Rate…</option>
                                                        <option value="5">Perfect</option>
                                                        <option value="4">Good</option>
                                                        <option value="3">Average</option>
                                                        <option value="2">Not that bad</option>
                                                        <option value="1">Very poor</option>
                                                    </select>
                                                </div>
                                                <p class="comment-form-comment"><label for="comment">Your
                                                        review&nbsp;<span class="required">*</span></label><textarea
                                                        id="comment" name="comment" cols="45" rows="8"
                                                        required=""></textarea></p><input name="wpml_language_code"
                                                    value="en" type="hidden">
                                                <p class="form-submit"><input name="submit" id="submit" class="submit"
                                                        value="Submit" type="submit"> <input name="comment_post_ID"
                                                        value="27" id="comment_post_ID" type="hidden">
                                                    <input name="comment_parent" id="comment_parent" value="0"
                                                        type="hidden">
                                                </p>
                                            </form>
                                        </div><!-- #respond -->
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 dreaming_related-product">
                <div class="block-title">
                    <h2 class="product-grid-title">
                        <span>Related Products</span>
                    </h2>
                </div>
                <div class="owl-slick owl-products equal-container better-height"
                    data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;slidesToShow&quot;:4}"
                    data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
                    <?php
                    foreach ($data as $item) {
                        if ($item->ID != $current_product_id) {
                    ?>
                    <div
                        class="product-item style-01 post-27 product type-product status-publish has-post-thumbnail product_cat-table product_cat-new-arrivals product_cat-lamp product_tag-table product_tag-sock  instock shipping-taxable purchasable product-type-variable has-default-attributes ">
                        <div class="product-inner tooltip-left">
                            <div class="product-thumb">
                                <a class="thumb-link" href="detail.php?id=<?= $item->ID ?>" tabindex="0">
                                    <img class="img-responsive" src="<?= $item->Image ?>" width="600" height="778">
                                </a>
                                <div class="flash"><span class="onnew"><span class="text">New</span></span></div>
                                <div class="group-button">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <div class="yith-wcwl-add-button show">
                                            <a href="#" class="add_to_wishlist">Add to Wishlist</a>
                                        </div>
                                    </div>
                                    <div class="akasha product compare-button">
                                        <a href="#" class="compare button">Compare</a>
                                    </div>
                                    <a href="#" class="button yith-wcqv-button">Quick View</a>
                                    <div class="add-to-cart">
                                        <a href="#" class="button product_type_variable add_to_cart_button">Add to
                                            cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-info equal-elem">
                                <h3 class="product-name product_title">
                                    <a href="detail.php?id=<?= $item->ID ?>" tabindex="0"><?= $item->ProductName ?></a>
                                </h3>
                                <div class="rating-wapper nostar">
                                    <div class="star-rating"><span style="width:0%">Rated <strong
                                                class="rating">0</strong> out of 5</span></div>
                                    <span class="review">(0)</span>
                                </div>
                                <span class="price"><span class="akasha-Price-amount amount"><span
                                            class="akasha-Price-currencySymbol"></span><?= number_format($item->Price) ?></span>VNĐ</span>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
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

<!-- Mirrored from dreamingtheme.kiendaotac.com/html/akasha/single-product-simple.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Apr 2024 12:43:46 GMT -->

</html>