<?php



include_once "class/DatabaseC.php";
$pdo =  DatabaseConnection::getConn();
require_once "class/Product.php";

// if (!isset($_SESSION["UserID"])) {
//     // Nếu chưa đăng nhập, bạn có thể thực hiện các hành động tương ứng ở đây (ví dụ: chuyển hướng người dùng đến trang đăng nhập)
//     echo "Vui lòng đăng nhập để thêm sản phẩm.";
//     exit();
// }
$imageError = "";
$nameError = "";
$priceError = "";
$categoryError = "";
$descriptionError = "";
$success = "";

//kiểm tra thông tin người dùng nhập từ form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ProductName = $_POST['ProductName'];
    $Price = $_POST['Price'];
    $Image = $_POST['Image'];
    $CategoryID = $_POST['CategoryID'];
    $Description = $_POST['Description'];


    if (empty($ProductName)) {
        $nameError = "Không được để trống";
    } else if (!preg_match("/^[\p{L}\s-]+$/u", $ProductName)) {
        $nameError = "Không được có ký tự đặc biệt";
    }
    if (empty($Price)) {
        $priceError = "Không được để trống";
    } else if ($price % 1000 != 0) {
        $priceError = "Giá phải chia hết cho 1000";
    }
    if (empty($Image)) {
        $imageError = "Thay thế bằng đường dẫn ảnh";
    }
    if (empty($CategoryID)) {
        $categoryError = "Không được để trống";
    }
    if (empty($Description)) {
        $descriptionError = "Không được để trống";
    }
    if (empty($nameError) && empty($priceError) && empty($imageError) && empty($categoryError) && empty($descriptionError)) {

        $product = Product::addProduct($pdo, $ProductName, $Price, $Image, $CategoryID, $Description);
        header("Location: ProductsAdmin.php");
    } else {
        $success = "Thêm sản phẩm không thành công";
    }
}
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin page</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <?php
        include "navbar.php";
        ?>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header End -->
            <div class="container-fluid">
                <form method="post" style="color: black;">
                    <div class="row my-2">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <label>Tên sản phẩm</label>
                            <input type="text" class="form-control" name="ProductName" placeholder="Tên sản phẩm" />
                            <span class="text-danger"><?= $nameError ?></span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <label>Giá</label>
                            <input type="text" class="form-control" name="Price" placeholder="Giá tiền" />
                            <span class="text-danger"><?= $priceError ?></span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <label>Loại sản phẩm</label>
                            <!-- <input type="text" class="form-control" name="CategoryID" placeholder="Loại sản phẩm" /> -->
                            <span class="text-danger"><?= $categoryError ?></span>
                            <select class="form-select" name="CategoryID" id="validationCustom04" required>
                                <option value="1">Quần áo</option>
                                <option value="2">Túi sách</option>
                                <option value="3">Giày</option>
                                <option value="4">Phụ kiện</option>
                            </select>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <label>Mô tả</label>
                            <input type="text" class="form-control" name="Description">
                            <span class="text-danger"><?= $descriptionError ?></span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <label>Hình ảnh</label>
                            <input type="text" class="form-control" name="Image">
                            <span class="text-danger"><?= $imageError ?></span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                            <span class="text-danger"><?= $success ?></span> &nbsp;
                            <a href="ProductsAdmin.php" class="btn btn-warning">Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>