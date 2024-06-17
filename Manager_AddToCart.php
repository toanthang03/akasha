<?php
session_start();
include_once "class/DatabaseC.php";
require_once "class/User.php";
$pdo = DatabaseConnection::getConn();
// Trong Manager_AddToCart.php


if (isset($_SESSION["UserName"])) {
    $username = $_SESSION["UserName"];
    $user = User::findUserName($pdo, $username);

    $userid = User::findIdUsername($pdo, $username);

    if (isset($_POST["addToCart"])) {
        $productId = $_GET["id"];
        $quantity = $_POST["quantity"];

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $sql = "SELECT * FROM cart WHERE productid = ? AND userid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$productId, $userid]);
        $existingCartItem = $stmt->fetch();

        if ($existingCartItem) {
            // Nếu sản phẩm đã tồn tại, cập nhật số lượng
            $newQuantity = $existingCartItem['quantity'] + $quantity;
            $sql = "UPDATE cart SET quantity = ? WHERE productid = ? AND userid = ?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$newQuantity, $productId, $userid])) {
                header("location: cart.php");
                exit();
            } else {
                echo "Đã xảy ra lỗi";
            }
        } else {
            // Nếu sản phẩm chưa tồn tại, thêm vào giỏ hàng
            $sql = "INSERT INTO `cart` (`productid`, `quantity`, `userid`, `username`) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$productId, $quantity, $userid, $username])) {
                header("location: cart.php");
                exit();
            } else {
                echo "Đã xảy ra lỗi";
            }
        }
    }
} else {
    header("location: login.php");
    echo "Vui lòng đăng nhập!";
}


//Kiểm tra phiên đăng nhập để gán mỗi user 1 giỏ hàng riêng biệt
// if (isset($_SESSION["UserName"])) {
//     $username = $_SESSION["UserName"];
//     $user = User::findUserName($pdo, $username);

//     //Xử lý để lấy được id của user đó
//     // $userid = $user->userid;
//     //Phát sửa 
//     $userid = User::findIdUsername($pdo, $username);
    

//     //Xử lý thêm vào giỏ hàng
//     if (isset($_POST["addToCart"])) {
//         $productId = $_GET["id"];
//         $quantity = $_POST["quantity"];

//         if($productId == )
        
//         $sql = "INSERT INTO `cart` (`productid`, `quantity`, `userid`, `username`) VALUES (?, ?, ?, ?)";
//         $stmt = $pdo->prepare($sql);
//         if ($stmt->execute([$productId, $quantity, $userid, $username])) {
//             header("location: cart.php");
//             exit();
//         } else {
//             echo "Đã xảy ra lỗi";
//         }
//     }
// } else {
//     //Nếu chưa đăng nhập thì chuyển đến trang đăng nhập
//     header("location: login.php");
//     echo "Vui lòng đăng nhập!";
// }