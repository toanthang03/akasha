<?php
require_once "class/DatabaseC.php";
$pdo = DatabaseConnection::getConn();
$sql = "SELECT * FROM user";
$stmt = $pdo->prepare($sql);


if ($stmt->execute()) {
    $taiKhoan = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminPage-Sản Phẩm</title>
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
            <!--  Header Start -->
            <?php
            include "header2.php";
            ?>
            <!--  Header End -->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <h3>Quản lý đăng nhập</h3>
                    </div>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>Vai trò</th>
                        <th>Tên đăng nhập</th>
                        <th>Tên người dùng</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                    </tr>
                    <?php
                    foreach ($taiKhoan as $tk) {
                    ?>
                        <tr>
                            <td><?php echo $tk["Role"] ?></td>
                            <td><?php echo $tk["Username"] ?></td>
                            <td><?php echo $tk["Name"] ?></td>
                            <td><?php echo $tk["Phone"] ?></td>
                            <td><?php echo $tk["Email"] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>