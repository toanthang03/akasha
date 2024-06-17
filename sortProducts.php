<?php

// Kiểm tra xem có dữ liệu được gửi từ yêu cầu AJAX không
if (isset($_POST['priceRange'])) {
    // Gọi tệp kết nối cơ sở dữ liệu
    include_once "class/DatabaseC.php";

    $pdo = DatabaseConnection::getConn();

    // Lấy thông số priceRange từ yêu cầu Ajax
    $priceRange = $_POST['priceRange'];

    // Xử lý thông số priceRange để tạo câu truy vấn SQL
    $query = "SELECT * FROM products";
    switch ($priceRange) {
        case 'price':
            $query .= " ORDER BY Price ASC";
            break;  
        case 'price-desc':
            $query .= " ORDER BY Price DESC";
            break;
        default:
            // Nếu không có thông số priceRange, truy vấn tất cả các món ăn
            break;
    }

    // Chuẩn bị câu truy vấn
    $stmt = $pdo->prepare($query);

    // Thực hiện truy vấn
    $stmt->execute();

    // Lấy kết quả truy vấn
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $output = '';


    if (count($result) > 0) {
        foreach ($result as $row) {
            $output .= '<div class="product-item wow fadeInUp product-item rows-space-30 col-bg-3 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-ts-6 style-01 post-24 product type-product status-publish has-post-thumbnail product_cat-chair product_cat-table product_cat-new-arrivals product_tag-light product_tag-hat product_tag-sock first instock featured shipping-taxable purchasable product-type-variable has-default-attributes" data-wow-duration="1s" data-wow-delay="0ms" data-wow="fadeInUp">';
            $output .= '<div class="product-inner tooltip-left">';
            $output .= '<div class="product-thumb">';
            $output .= '<a class="thumb-link" href="detail.php?id=' . $row["ID"] . '">';
            $output .= '<img class="img-responsive" src="' . $row["Image"] . '" width="600" height="778">';
            $output .= '</a>';
            $output .= '<div class="flash">';
            $output .= '<span class="onnew"><span class="text">New</span></span>';
            $output .= '</div>';
            $output .= '<div class="group-button">';
            $output .= '<div class="yith-wcwl-add-to-wishlist">';
            $output .= '<div class="yith-wcwl-add-button show">';
            $output .= '<a href="#" class="add_to_wishlist">Add to Wishlist</a>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<div class="akasha product compare-button">';
            $output .= '<a href="#" class="compare button">Compare</a>';
            $output .= '</div>';
            $output .= '<a href="#" class="button yith-wcqv-button">Quick View</a>';
            $output .= '<div class="add-to-cart">';
            $output .= '<a href="#" class="button product_type_variable add_to_cart_button">Select options</a>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<div class="product-info equal-elem">';
            $output .= '<h3 class="product-name product_title">';
            $output .= '<a href="#">' . $row["ProductName"] . '</a>';
            $output .= '</h3>';
            $output .= '<div class="rating-wapper nostar">';
            $output .= '<div class="star-rating"><span style="width:0%">Rated <strong class="rating">0</strong> out of 5</span></div>';
            $output .= '<span class="review">(0)</span>';
            $output .= '</div>';
            $output .= '<span class="price"><span class="akasha-Price-amount amount"><span class="akasha-Price-currencySymbol"></span>' . number_format($row["Price"], 0, ',', '.') . ' VNĐ</span>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</li>';
        }
    } else {
        $output = 'Không tìm thấy món ăn nào';
    }

    // Hiển thị kết quả tìm kiếm
    echo $output;
}