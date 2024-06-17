<?php
session_start();

include "class/DatabaseC.php";
require_once "class/Product.php";
$pdo =  DatabaseConnection::getConn();
$data = Product::getAll($pdo);
$success = "";
$id = $_GET['id'];
if (empty($id)) {
    die("Sản phẩm không tồn tại");
}
$product = Product::getOne($data, $id);
$name = "";
$price = 0;
$image = "";
$category = "";
$description = "";
$nameError = "";
$priceError = "";
$imageError = "";
$categoryError = "";
$descriptionError = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $categoryID = $_POST['categoryID'];
    $description = $_POST['description'];
    if (empty($name)) {
        $nameError = "Không được để trống";
    } else if (!preg_match("/^[\p{L}\s-]+$/u", $name)) {
        $nameError = "Không được có ký tự đặc biệt";
    }
    if (empty($price)) {
        $priceError = "Không được để trống";
    } else if ($price % 1000 !== 0) {
        $priceError = "Giá phải chia hết cho 1000";
    }
    if (empty($image)) {
        $imageError = "Không được để trống";
    }
    if (empty($categoryID)) {
        $categoryError = "Không được để trống";
    }
    if (empty($description)) {
        $descriptionError = "Không được để trống";
    }
    if (empty($nameError) && empty($priceError) && empty($imageError) && empty($categoryError) && empty($descriptionError)) {
        if (Product::update($pdo, $id, $name, $price, $image, $categoryID, $description)) {
            header("Location: ProductsAdmin.php");
            exit();
        } else {
            $success = "Sửa không thành công";
        }
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
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
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
                            <input type="text" class="form-control" name="name" value="<?= $product->ProductName ?>"
                                placeholder="Tên sản phẩm" />
                            <span class="text-danger"><?= $nameError ?></span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <label>Giá</label>
                            <input type="text" class="form-control" name="price" value="<?= $product->Price ?>"
                                placeholder="Giá tiền" />
                            <span class="text-danger"><?= $priceError ?></span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <label>Loại sản phẩm</label>

                            <select name="categoryID" class="form-select" id="validationCustom04" required>
                                <option value="1">Quần áo</option>
                                <option value="2">Túi sách</option>
                                <option value="3">Giày dép</option>
                                <option value="4">Phụ kiện</option>
                            </select>
                            <span class="text-danger"><?= $categoryError ?></span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <label>Mô tả</label>
                            <input type="text" class="form-control" name="description"
                                value="<?= $product->Description ?>">
                            <span class="text-danger"><?= $descriptionError ?></span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <label>Hình ảnh</label>
                            <input type="text" class="form-control" name="image" value="<?= $product->Image ?>">
                            <span class="text-danger"><?= $image ?></span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary">Lưu</button> &nbsp;
                            <span class="text-danger"><?= $success ?></span> &nbsp;
                            <a href="ProductsAdmin.php" class="btn btn-warning">Quay lại</a>
                        </div>
                    </div>
                </form>
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