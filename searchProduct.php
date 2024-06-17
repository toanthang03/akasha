<?php
// Kiểm tra xem có dữ liệu được gửi từ yêu cầu POST không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kết nối cơ sở dữ liệu
    // require_once "class/DatabaseC.php"; // Thay thế bằng tên tệp kết nối cơ sở dữ liệu của bạn
    include_once "class/DatabaseC.php";


    $pdo = DatabaseConnection::getConn();
    // Lấy dữ liệu tìm kiếm từ form
    $search_query = $_POST['s']; // Tên trường input tìm kiếm là 's'

    // Chuẩn bị truy vấn SQL (ví dụ)
    $sql = "SELECT * FROM products WHERE productName LIKE :search_query";

    // Chuẩn bị và thực thi truy vấn
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search_query', '%' . $search_query . '%', PDO::PARAM_STR);
    $stmt->execute();

    // Lấy kết quả truy vấn
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $output = '';
    // Hiển thị kết quả (ví dụ)
    if ($results !== null && count($results) > 0) {
        foreach ($results as $row) {
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
        $output = 'Không tìm thấy sản phẩm ';
    }

    // Hiển thị kết quả tìm kiếm
    echo $output;
}
