<?php
class Product
{
    public $ID;
    public $ProductName;
    public $Price;
    public $Image;
    public $CategoryID;
    public $Description;


    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM products";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        }
    }

    public static function getOne($data, $id)
    {
        foreach ($data as $item) {
            if ($item->ID == $id) {
                return $item;
            }
        }
        return null;
    }


    public static function addProduct($pdo, $ProductName, $Price, $Image, $CategoryID, $Description)
    {
        $sql = "INSERT INTO `products`(`ProductName`, `Description`, `Price`, `Image`, `CategoryID`) VALUES (:name, :description, :price, :image, :categoryID)";
        $stmt = $pdo->prepare($sql);
        echo $ProductName;
        echo $Price;
        echo $Image;
        echo $CategoryID;
        echo $Description;
        $stmt->bindParam(':name', $ProductName);
        $stmt->bindParam(':description', $Description);
        $stmt->bindParam(':price', $Price);
        $stmt->bindParam(':image', $Image);
        $stmt->bindParam(':categoryID', $CategoryID);
        if ($stmt->execute())
            return true;
        return false;
    }
    public static function delete($pdo, $id)
    {
        $sql = "DELETE FROM products WHERE ID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute())
            return true;
        return false;
    }
    public static function update($pdo, $id, $name, $price, $image, $category, $description)
    {
        $sql = "UPDATE products SET ProductName=:name, Price=:price, Image=:image, CategoryID=:category, Description=:description WHERE ID=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':description', $description);
        if ($stmt->execute())
            return true;
        return false;
    }

    public static function getProductWithCategory($pdo)
    {
        try {
            $sql = "SELECT products.*, categories.CategoryName FROM products, categories WHERE categories.ID = products.CategoryID;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "Lỗi", $ex->getMessage();
            return null;
        }
    }
}
