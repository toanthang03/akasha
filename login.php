<?php
session_start();
include "class/DatabaseC.php";
include "class/User.php";

$pdo = DatabaseConnection::getConn();

// Xử lý đăng nhập khi người dùng gửi form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lưu ý 
    // $user_id = $_POST["ID"]; // cái này tầm bậy vì đây là dữ liệu lấy từ form đăng nhập
    //chứ không phải từ database
    // Kiểm tra thông tin đăng nhập
    $username = $_POST["UserName"];
    $password = $_POST["Password"];

    // Thực hiện truy vấn để lấy ID từ cơ sở dữ liệu
    $user = User::findUsername($pdo, $username);
    $user_id = User::findIdUsername($pdo, $username);

    // Kiểm tra xem người dùng có tồn tại không và mật khẩu có đúng không
    if ($user !== null && User::checkLogin($pdo, $username, $password)) {
        // Lưu thông tin đăng nhập vào session
        $_SESSION["UserName"] = $username;
        $_SESSION["UserID"] = $user_id; // Gán giá trị ID từ kết quả truy vấn cho session
        $_Session["Role"] = $role;
        if ($user->Role == "admin") {
            header("location: HomeAdmin.php");
        } else {
            header("location: Home.php");
        }
        exit(); // Sau khi chuyển hướng, dừng kịch bản
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>JUNO - CỬA HÀNG THỜI TRANG </title>
</head>

<body>
    <!--Login Form-->
    <section>
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="text-center">
                                <svg class="mx-auto my-3" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill=" currentColor" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                            </div>
                            <form method="post">
                                <input type="text" name="UserName" class="form-control my-3 py-2" placeholder="Tên đăng nhập" />
                                <input type="password" name="Password" class="form-control my-3 py-2" placeholder="Mật khẩu" />
                                <label class="akasha-form__label akasha-form__label-for-checkbox inline">
                                    <input class="akasha-form__input akasha-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever">
                                    <span>Nhớ mật khẩu</span>
                                </label>
                                <div class="text-center">
                                    <button type="submit" name="login" class="btn btn-primary" style="margin-top: 20px;">Đăng nhập</button>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="akasha-LostPassword lost_password">
                                            <a href="forgotPassword.php">Quên mật khẩu</a>
                                        </p>
                                    </div>
                                </div>
                                <p style="color: red;"><?php if (isset($error)) {
                                                            echo $error;
                                                        } ?></p>
                            </form>
                            <div class="col-md-6">
                                <p class="akasha-LostPassword lost_password">
                                    <a href="Home.php">Quay lại trang chủ</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>