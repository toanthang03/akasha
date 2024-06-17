<?php
class Cart
{
    public $id;
    public $productid;
    public $quantity;
    public $userid;
    public $username;

    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM cart";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
            return $stmt->fetchAll();
        }
    }

    public static function getOne($data, $id)
    {
        foreach ($data as $item) {
            if ($item->id == $id) {
                return $item;
            }
        }
        return null;
    }
    public static function getCartByUserId($pdo, $userid)
    {
        $sql = "SELECT * FROM cart WHERE userid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userid]);
        $cart = $stmt->fetch(PDO::FETCH_ASSOC);
        return $cart;
    }

    public static function deleteCart($pdo, $id)
    {
        $sql = "DELETE FROM cart WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute())
            return true;
        return false;
    }

    public static function deleteCartFromUser($pdo, $id)
    {
        $sql = "DELETE FROM cart WHERE userid = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute())
            return true;
        return false;
    }

    //Phương thức kiểm tra nếu sản phẩm đã tồn tại hay chưa 
    public static function checkItem($pdo, $productid)
    {
        $sql = "Select * From Cart WHERE productid = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $productid);
        $stmt->execute();
        if ($stmt->rowCount() > 0)
            return $stmt->fetch(PDO::FETCH_ASSOC);
        else
            return null;
    }
    //Phương thức cập nhập lại số lượng nếu sản phẩm đã tồn tại
    public static function updateQuantity($pdo, $quantity, $id)
    {
        $sql = "UPDATE `cart` SET quantity= :quantity WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':quantity', $quantity);
        if ($stmt->execute())
            return true;
        return false;
    }
}