<?php
include_once "class/DatabaseC.php";
$pdo = DatabaseConnection::getConn();
$sql = "SELECT * FROM products";
$stmt = $pdo->prepare($sql);


if ($stmt->execute()) {
    $SanPham = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Số sản phẩm trên mỗi trang
$records_per_page = 3;

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

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminPage-Sản Phẩm</title>

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
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <?php
        include "navbar.php";
        ?>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <?php
            include "header2.php";
            ?>
            <!--  Header End -->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <h3>Sản phẩm</h3>
                    </div>
                </div>
                <h5><a href="AddProduct.php">Bấm vào đây để thêm sản phẩm</a></h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Mã sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Mô tả</th>
                        <th>Phân loại</th>
                        <th>Chỉnh sửa</th>
                    </tr>


                    <?php
                    if ($stmt->rowCount() > 0) {
                        foreach ($SanPham as $sp) {
                            echo "<tr>";
                            echo "<td>{$sp['ID']}</td>";
                            echo "<td><img src='{$sp['Image']}' width='150px'/></td>";
                            echo "<td>{$sp['ProductName']}</td>";
                            echo "<td>" . number_format($sp['Price'], 0, ',', '.') . " VND</td>";
                            echo "<td>{$sp['Description']}</td>";
                            echo "<td>{$sp['CategoryID']}</td>";
                            echo "<td><a href='edit.php?id={$sp['ID']}'>Sửa</a> | <a href='delete.php?id={$sp['ID']}'>Xóa</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "Không có dữ liệu.";
                    }
                    ?>
                </table>

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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>