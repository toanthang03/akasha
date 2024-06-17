<?php
// require_once "header.php";
include "header.php";

include_once "class/DatabaseC.php";


// session_start();

// require_once 'class/Database.php';

if (isset($_GET['page'])) {
    $pages = array("products", "cart");

    if (in_array($_GET['page'], $pages)) {
        $_page = $_GET['page'];
    } else {
        $_page = "products";
    }
} else {
    $_page = "products";
}

$pdo = DatabaseConnection::getConn();
$sql = "SELECT * FROM products";
$stmt = $pdo->prepare($sql);


if ($stmt->execute()) {
    $SanPham = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Số sản phẩm trên mỗi trang
$records_per_page = 8;

// Xác định trang hiện tại
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = intval($_GET['page']);
} else {
    $current_page = 1; // Nếu không có trang nào được chỉ định, mặc định là trang 1
}

// Tính toán offset (số bản ghi bắt đầu từ trang hiện tại)
$offset = ($current_page - 1) * $records_per_page;

// Truy vấn SQL với LIMIT và OFFSET
$sql = "SELECT * FROM products LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':limit', $records_per_page, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$SanPham = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamingtheme.kiendaotac.com/html/akasha/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Apr 2024 12:43:36 GMT -->

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
    <title>Bộ sưu tập của chúng tôi </title>
</head>


<body>


    <div class="banner-wrapper has_background">
        <img src="assets/images/banner-for-all2.jpg" class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        <div class="banner-wrapper-inner">
            <h1 class="page-title">Sản phẩm</h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin"><a href="Home.php"><span>Home</span></a></li>
                    <li class="trail-item trail-end active"><span>Sản phẩm</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main-container shop-page no-sidebar">
        <div class="container">
            <div class="row">
                <div class="main-content col-md-12">
                    <div class="shop-control shop-before-control">
                        <form class="akasha-ordering" method="post">
                            <select title="product_cat" name="orderby" class="orderby">
                                <option value="menu_order" selected="all" data-price="all">Default sorting</option>
                                <option value="price" data-price="1">Sort by price: low to high</option>
                                <option value="price-desc" data-price="2">Sort by price: high to low</option>
                            </select>
                        </form>
                    </div>
                    <div class="auto-clear equal-container better-height akasha-products">
                        <ul class="row products columns-3">
                            <?php
                            if (isset($_POST['s']) && !empty($_POST['s'])) {
                                // Nếu có dữ liệu từ kết quả tìm kiếm hoặc sắp xếp, hiển thị danh sách sản phẩm đã được lọc hoặc sắp xếp
                                include('searchProduct.php');
                            } elseif (isset($output) && !empty($output)) {
                                include('sortProducts.php');
                                // Nếu có yêu cầu tìm kiếm và dữ liệu tìm kiếm không rỗng, gửi yêu cầu đến tệp searchProducts.php để xử lý

                            } else {


                                foreach ($SanPham as $sp) {

                            ?>
                            <li class="product-item wow fadeInUp product-item rows-space-30 col-bg-3 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-ts-6 style-01 post-24 product type-product status-publish has-post-thumbnail product_cat-chair product_cat-table product_cat-new-arrivals product_tag-light product_tag-hat product_tag-sock first instock featured shipping-taxable purchasable product-type-variable has-default-attributes"
                                data-wow-duration="1s" data-wow-delay="0ms" data-wow="fadeInUp">
                                <div class="product-inner tooltip-left">
                                    <div class="product-thumb">
                                        <a class="thumb-link" href="detail.php?id=<?= $sp["ID"] ?>">
                                            <img class="img-responsive" src="<?php echo $sp["Image"] ?>" width="600"
                                                height="778">
                                        </a>
                                        <div class="flash">
                                            <span class="onnew"><span class="text">New</span></span>
                                        </div>
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
                                            <!--Nút button thêm sản phẩm vào giỏ hàng-->
                                            <div class="add-to-cart">
                                                <!-- <form method="post" action="Manager_AddToCart.php?id=<?= $sp["ID"] ?>">
                                                    <input type="hidden" name="quantity" value="1" />
                                                    <button tyle="submit" name="addToCart"
                                                        class="button  add_to_cart_button">+</button>
                                                </form> -->
                                                <!-- <a href="#"
                                                    class="button product_type_variable add_to_cart_button">Select
                                                    options
                                                </a> -->
                                                <a href="#" class="button add_to_cart_button"
                                                    data-product-id="<?= $sp["ID"] ?>">+</a>



                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-info equal-elem">
                                        <h3 class="product-name product_title">
                                            <a href="#"><?php echo $sp["ProductName"] ?></a>
                                        </h3>
                                        <div class="rating-wapper nostar">
                                            <div class="star-rating"><span style="width:0%">Rated <strong
                                                        class="rating">0</strong> out of
                                                    5</span></div>
                                            <span class="review">(0)</span>
                                        </div>
                                        <span class="price"><span class="akasha-Price-amount amount"><span
                                                    class="akasha-Price-currencySymbol"></span><?php echo number_format($sp["Price"], 0, ',', '.') ?>
                                                VNĐ</span>
                                    </div>
                                </div>
                            </li>
                            <?php }
                            } ?>


                        </ul>
                    </div>
                    <!--Phần phần trang -->
                    <div class="shop-control shop-after-control">
                        <nav class="akasha-pagination">
                            <?php
                            // Đếm tổng số bản ghi
                            $sql = "SELECT COUNT(*) AS total FROM products";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $total_records = $row['total'];

                            // Tính toán số trang
                            $total_pages = ceil($total_records / $records_per_page);

                            // Hiển thị phân trang
                            for ($i = 1; $i <= $total_pages; $i++) {
                                if ($i == $current_page) {
                                    echo "<span class='page-numbers current'>$i</span> ";
                                } else {
                                    echo "<a class='page-numbers' href='?page=$i'>$i</a> ";
                                }
                            }

                            // Hiển thị liên kết Next
                            if ($current_page < $total_pages) {
                                $next_page = $current_page + 1;
                                echo "<a class='next page-numbers' href='?page=$next_page'>Next</a>";
                            }
                            ?>
                        </nav>
                        <p class="akasha-result-count">
                            <?php
                            // Hiển thị kết quả trang hiện tại và tổng số bản ghi
                            $start_record = ($current_page - 1) * $records_per_page + 1;
                            $end_record = $start_record + count($SanPham) - 1;
                            echo "Showing $start_record–$end_record of $total_records results";
                            ?>
                        </p>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
// Sử dụng jQuery
$('#searchForm').submit(function(event) {
    // Ngăn chặn gửi biểu mẫu một cách truyền thống
    event.preventDefault();

    // Lấy dữ liệu từ trường tìm kiếm
    var searchData = $('#searchInput').val();

    // Gửi yêu cầu Ajax đến tệp PHP xử lý
    $.ajax({
        url: 'searchProduct.php', // Đường dẫn tới tệp PHP xử lý
        type: 'POST',
        data: {
            s: searchData
        }, // Dữ liệu gửi đi
        success: function(response) {
            // Hiển thị kết quả tìm kiếm trên trang web của bạn
            $('.row.products.columns-3').html(
                response);
        },
        error: function(xhr, status, error) {
            // Xử lý lỗi nếu có
            console.log(xhr.responseText);
        }
    });
});
</script>

<script>
$(document).ready(function() {
    $('.orderby').change(function(e) {
        e.preventDefault();

        // Lấy giá trị của select box
        var priceRange = $(this).val();

        // Gửi yêu cầu AJAX
        $.ajax({
            url: 'sortProducts.php', // Thay đổi đường dẫn tới tệp xử lý AJAX
            type: 'POST',
            data: {
                priceRange: priceRange
            },
            success: function(response) {
                // Xử lý kết quả trả về
                $('.row.products.columns-3').html(
                    response); // Thay đổi lớp của phần tử để thay thế nội dung
            },
            error: function(xhr, status, error) {
                console.log(error); // Xử lý lỗi nếu có
            }
        });
    });
});
</script>

<!-- một cách khác để sort sản phẩm -->
<!-- 
<script>
$(document).ready(function() {
    $('.orderby').change(function(e) {
        e.preventDefault();

        // Lấy giá trị của select box
        var priceRange = $(this).val();

        // Gửi yêu cầu AJAX
        $.ajax({
            url: 'sortProducts.php', // Thay đổi đường dẫn tới tệp xử lý AJAX
            type: 'POST',
            data: {
                priceRange: priceRange
            },
            success: function(response) {
                // Xử lý kết quả trả về
                $('.row.products.columns-3').html(
                response); // Thay đổi lớp của phần tử để thay thế nội dung
            },
            error: function(xhr, status, error) {
                console.log(error); // Xử lý lỗi nếu có
            }
        });
    });
});

// Thêm phần tử HTML vào mã JavaScript
var productItemHTML =
    '<div class="product-item wow fadeInUp product-item rows-space-30 col-bg-3 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-ts-6 style-01 post-24 product type-product status-publish has-post-thumbnail product_cat-chair product_cat-table product_cat-new-arrivals product_tag-light product_tag-hat product_tag-sock first instock featured shipping-taxable purchasable product-type-variable has-default-attributes"></div>';

// Sử dụng phần tử HTML đã tạo để thêm vào trang web
// Đặt nó ở đâu bạn muốn, ví dụ:
$('.row.products.columns-3').append(productItemHTML);
</script> -->





<!-- <script>
// Sử dụng jQuery
$('#searchForm').submit(function(event) {
    // Ngăn chặn gửi biểu mẫu một cách truyền thống
    event.preventDefault();

    // Lấy dữ liệu từ trường tìm kiếm
    var searchData = $('#searchInput').val();

    // Gửi yêu cầu Ajax đến tệp PHP xử lý
    $.ajax({
        url: 'searchProduct.php', // Đường dẫn tới tệp PHP xử lý
        type: 'POST',
        data: {
            s: searchData
        }, // Dữ liệu gửi đi
        success: function(response) {
            // Hiển thị kết quả tìm kiếm trên trang web của bạn
            $('#searchResults').html(response);
        },
        error: function(xhr, status, error) {
            // Xử lý lỗi nếu có
            console.log(xhr.responseText);
        }
    });
});
</script> -->
<!-- 
<script>
$(document).ready(function() {
    $('#searchForm').submit(function(e) {
        e.preventDefault();
        var searchQuery = $('input[name="s"]').val();
        $.ajax({
            url: 'searchProducts.php',
            type: 'POST',
            data: {
                s: searchQuery
            },
            success: function(response) {
                $('#product-list').html(response);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
});
</script> -->






<!-- Mirrored from dreamingtheme.kiendaotac.com/html/akasha/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Apr 2024 12:43:39 GMT -->

</html>