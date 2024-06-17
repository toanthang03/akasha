<?php
session_start();

require_once "class/DatabaseC.php";
require_once "class/Product.php";
$pdo =  DatabaseConnection::getConn();
$data = Product::getAll($pdo);
$success = "";
$id = isset($_GET['id']) ? $_GET['id'] : null;
if (empty($id)) {
    die("Sản phẩm không tồn tại");
}
$product = Product::getOne($data, $id);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (Product::delete($pdo, $id)) {
        header("Location: ProductsAdmin.php");
        exit();
    } else {
        $success = "Xóa không thành công";
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
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <label>Giá</label>
                            <input type="text" class="form-control" name="price" value="<?= $product->Price ?>"
                                placeholder="Giá tiền" />
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <label>Loại sản phẩm</label>
                            <input type="text" style=" pointer-events: none;" class="form-control" name="categoryID"
                                value="<?= $product->CategoryID ?>">
                            <!-- <select name="categoryID" class="form-select" id="validationCustom04" required>
                                <option value="1">Quần áo</option>
                                <option value="2">Giày dép</option>
                                <option value="3">Túi sách</option>
                                <option value="4">Phụ kiện</option>
                            </select> -->
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <label>Mô tả</label>
                            <input type="text" class="form-control" name="description"
                                value="<?= $product->Description ?>">
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <label>Hình ảnh</label>
                            <input type="text" class="form-control" name="image" value="<?= $product->Image ?>">
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary">Xóa</button> &nbsp;
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