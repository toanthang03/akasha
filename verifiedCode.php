<?php
//require_once"header.php";
session_start();
$verificationError = "";
//Xử lý code được gửi đến mail 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['verify-code'])) {
        $inputCode = $_POST['verificationCode'];
        $sessionCode = $_SESSION['verificationCode'];
        // Kiểm tra mã xác thực
        if ($inputCode == $_SESSION['verificationCode']) {
            header("location: changePassword.php");
            exit();
        } else {
            $verificationError = "Mã xác thực không đúng. Vui lòng thử lại.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Xác thực mã</title>
    <link rel="stylesheet" href="style.css"> <!-- Bao gồm CSS nếu có -->
</head>

<body>
    <div class="container" style="padding-top:150px; padding-left:500px;">
        <h2>Nhập mã xác thực</h2>
        <form  method="post">
            <div class="form-group">
                <label for="verificationCode">Mã xác thực:</label>
                <input type="text" name="verificationCode" id="verificationCode" required>
            </div>
            <?php if ($verificationError) : ?>
                <p class="error"><?php echo $verificationError; ?></p>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary" name="verify-code">Xác thực</button>
            <a href="login.php" class="btn btn-warning">Quay lại</a>
        </form>
    </div>
</body>

</html>