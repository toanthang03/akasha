<?php
include_once "class/DatabaseC.php";
$pdo = DatabaseConnection::getConn();
require_once "class/User.php";

$name = "";
$username = "";
$password = "";
$passwordRepeat = "";
$email = "";
$phone = "";

$nameError = "";
$usernameError = "";
$passwordError = "";
$passwordRepeatError = "";
$emailError = "";
$phoneError = "";
//Kiểm tra form người dùng nhập đã hợp lệ hay chưa?
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $username = $_POST["UserName"];
    $password = $_POST["Password"];
    $passwordRepeat = $_POST["repeat_Password"];
    $email = $_POST["Email"];
    $phone = $_POST["Phone"];

    //ràng buộc tên đăng nhập
    if (empty($name)) {
        $nameError = "Không được để trống";
    }
    if (empty($username)) {
        $usernameError = "Tên đăng nhập không được để trống";
    } else if (strlen($username) < 8 || strlen($username) > 20) {
        $usernameError = "Tên đăng nhập phải từ 8 đến 20 ký tự";
    } else if (User::findUsername($pdo, $username)) {
        $usernameError = "Tên đăng nhập đã tồn tại";
    }
    //validation password
    if (empty($password)) {
        $passwordError = "Không được để trống";
    } else if (strlen($password) < 8 || strlen($password) > 20) {
        $passwordError = "Mật khẩu phải từ 8 đến 20 ký tự!";
    } else if (!preg_match("/[A-Z]/", $password)) {
        $passwordError = "Mật khẩu phải chứa ít nhất một chữ cái viết hoa.";
    } else if (!preg_match("/[a-z]/", $password)) {
        $passwordError = "Mật khẩu phải chứa ít nhất một chữ cái viết thường.";
    } else if (!preg_match("/[0-9]/", $password)) {
        $passwordError = "Mật khẩu phải chứa ít nhất một số.";
    } else if (!preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $password)) {
        $passwordError = "Mật khẩu phải chứa ít nhất một ký tự đặc biệt.";
    }
    // ràng buộc mật khẩu nhập lại phải giống mật khẩu
    if (empty($passwordRepeat)) {
        $passwordRepeatError = "Không được để trống";
    } else if ($passwordRepeat !== $password) {
        $passwordRepeatError = "Mật khẩu nhập lại không trùng khớp";
    }
    //ràng buộc email
    if (empty($email)) {
        $emailError = "Không được để trống";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Email không hợp lệ";
    } else if (!checkdnsrr(substr($email, strrpos($email, '@') + 1), 'MX')) {
        $emailError = "Địa chỉ email không tồn tại.";
    }
    //ràng buộc số điện thoại
    if (empty($phone)) {
        $phoneError = "Không được để trống";
    } else if (!preg_match('/^[0-9]{10,11}$/', $phone)) {
        $phoneError = "Số điện thoại phải có từ 10 đến 11 chữ số.";
    } else if (!preg_replace('/\D/', '', $phone)) {
        $phoneError = "Không được nhập ký tự khác ngoài số";
    }
    //Xử lý đăng ký tài khoản
    if (empty($nameError) && empty($usernameError) && empty($passwordError) && empty($passwordRepeatError) && empty($emailError) && empty($phoneError)) {
        $Hash_Password = password_hash($password, PASSWORD_DEFAULT);

        $user = User::register($pdo, $username, $password, $name, $phone, $email);
        header("location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
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
                                <div class="form-group">
                                    <label>Nhập họ và tên</label>
                                    <input type="text" name="name" class="form-control my-3 py-2" placeholder="Họ tên" />
                                    <span class="text-danger"><?= $nameError ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Nhập email</label>
                                    <input type="email" name="Email" class="form-control my-3 py-2" placeholder="Email" />
                                    <span class="text-danger"><?= $emailError ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Nhập số điện thoại</label>
                                    <input type="phone" name="Phone" class="form-control my-3 py-2" placeholder="Số điện thoại" />
                                    <span class="text-danger"><?= $phoneError ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Nhập tên đăng nhập</label>
                                    <input type="text" name="UserName" class="form-control my-3 py-2" placeholder="Tên đăng nhập" />
                                    <span class="text-danger"><?= $usernameError ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Nhập mật khẩu</label>
                                    <input type="password" name="Password" class="form-control my-3 py-2" placeholder="Mật khẩu" />
                                    <span class="text-danger"><?= $passwordError ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Nhập lại mật khẩu</label>
                                    <input type="password" name="repeat_Password" class="form-control my-3 py-2" placeholder="Nhập lại mật khẩu" />
                                    <span class="text-danger"><?= $passwordRepeatError ?></span>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="register" class="btn btn-primary" style="margin-top: 20px;">Đăng ký tài khoản</button>
                                </div>
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