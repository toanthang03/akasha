<?php
session_start();
include "class/DatabaseC.php";
require_once "class/User.php";
require_once "send-mail.php";
$pdo =  DatabaseConnection::getConn();
$usernameError = "";
$username = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['Username'];
    $user = User::findUsername($pdo, $username);
    if (!$user) {
        $usernameError = "Username không tồn tại";
    } else {
        //tạo mã gồm 6 số ngẫu nhiên
        $verificationCode = mt_rand(100000, 999999);
        $_SESSION['verificationCode'] = $verificationCode;
        $content = "
<html>
<head>
    <style>
        /* Định dạng màu cho các phần tử HTML */
        body {
            font-family: Arial, sans-serif;
            color: #333; /* Màu chữ mặc định */
        }
        .username {
            color: blue; /* Màu chữ cho tên người dùng */
        }
        .code {
            color: red; /* Màu chữ cho mã code */
            font-weight: bold; /* In đậm mã code */
        }
    </style>
</head>
<body>
    <p>Chào <span class=\"username\">$user->Name</span>,</p>
    <p>Bạn đã yêu cầu thay đổi mật khẩu cho tài khoản của mình. Dưới đây là mã xác thực để hoàn thành quy trình này:</p>
    <p><strong>Mã xác thực:</strong> <span class=\"code\">$verificationCode</span></p>
    <p>Vui lòng sao chép mã này và dán vào trang web để tiếp tục quy trình đổi mật khẩu. Lưu ý rằng mã sẽ chỉ có hiệu lực trong một khoảng thời gian nhất định.</p>
    <p>Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email này. Đảm bảo bảo mật thông tin tài khoản của bạn bằng cách không chia sẻ mã xác thực này với bất kỳ ai khác.</p>
    <p>Nếu bạn có bất kỳ câu hỏi hoặc cần hỗ trợ, vui lòng liên hệ với chúng tôi qua email này.</p>
    <p>Trân trọng.</p>
</body>
</html>";
//hàm send Mail
        sendMail($user->Email, $content);
        $_SESSION['username'] = $username;
        header("location: verifiedCode.php");
        exit();
    }
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đổi mật khẩu</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header End -->
            <div class="container-fluid">
                <form method="post" style="color: black;">
                    <div class="row my-2">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <label>Nhập tên đăng nhập</label>
                            <input type="text" class="form-control" value="<?= $username ?>" name="Username" placeholder="Tên đăng nhập" />
                            <span class="text-danger"><?= $usernameError ?></span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <button type="submit" name="form-import" class="btn btn-primary">Tiếp tục</button>
                            <a href="login.php" class="btn btn-warning">Quay lại</a>
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