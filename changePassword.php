<?php
require_once "header.php";
require_once "class/DatabaseC.php";
require_once "class/User.php";


$pdo = DatabaseConnection::getConn();
$error = "";
//Lấy ra user đã nhập trong file forgorPassword.php
$username = $_SESSION['username'];
$password = "";
$passwordError = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['change-password'])) {
        $password = $_POST['newPassword'];
        $passwordRepeat = $_POST['confirmPassword'];
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
        if (empty($passwordRepeat)) {
            $passwordRepeatError = "Không được để trống";
        } else if ($passwordRepeat !== $password) {
            $passwordRepeatError = "Mật khẩu nhập lại không trùng khớp";
        }
        if(empty($passwordError)){
            $user = User::changePassword($pdo, $username, $password);
            var_dump($user);
            echo"Đổi thành công";
        }else{
            echo"Đổi mật khẩu thất bại!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đổi mật khẩu</title>
    <link rel="stylesheet" href="style.css"> <!-- Bao gồm CSS nếu có -->
</head>

<body>
    <div class="container" style="padding-top:150px; padding-left:200px;">
        <h2>Đổi mật khẩu</h2>
        <form action="changePassword.php" method="post">
            <div class="form-group">
                <label for="newPassword">Mật khẩu mới:</label>
                <input type="password" name="newPassword" id="newPassword" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Xác nhận mật khẩu:</label>
                <input type="password" name="confirmPassword" id="confirmPassword" required>
            </div>
            <?php if ($error) : ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <button type="submit" name="change-password">Đổi mật khẩu</button>
        </form>
    </div>
</body>

</html>