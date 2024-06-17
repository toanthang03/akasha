<?php
session_start();

// Xóa session đang đăng nhập
session_unset();
session_destroy();
header("location: Home.php");
exit;
?>