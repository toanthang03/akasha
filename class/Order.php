<?php
class Order
{
    public static function processFormData($pdo, $phone, $address, $total, $userId, $note)
    {
        $sql = "INSERT INTO `order` (Phone, ShippingAddress, total, CustomerID, Notes) VALUES (:phone, :address, :total, :userId, :note)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':note', $note);

        if ($stmt->execute()) {
            echo "Đơn hàng của bạn đã được xử lý thành công.";
        } else {
            echo "Đã xảy ra lỗi khi xử lý đơn hàng.";
        }
    }
}



    // {
    //     $sql = "SELECT * FROM orders"; // Thay đổi từ 'cart' sang 'orders'
    //     $stmt = $pdo->prepare($sql);
    //     if ($stmt->execute()) {
    //         $stmt->setFetchMode(PDO::FETCH_CLASS, 'Order'); // Thay đổi từ 'Cart' sang 'Order'
    //         return $stmt->fetchAll();
    //     }
    // }