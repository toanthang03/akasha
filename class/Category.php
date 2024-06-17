<?php
class Category
{
    public $ID;
    public $CategoryName;

    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM categories";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Category');
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
}
