<?php
class DatabaseConnection
{
    //Phương thức của Thắng
    public static function getConn()
    {

        $db_host = "localhost";
        $db_name = "fashionshop1";
        $db_user = "root";
        $db_pass = "mysql";

        $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";

        try {
            $pdo = new PDO($dsn, $db_user, $db_pass);
            return $pdo;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return null;
        }
    }
}
    //Phương thức của Phát
    // public static function getConn()
    // {
    //     $db_host = "127.0.0.1";
    //     $db_name = "ql_ban_sua_moi";
    //     $db_user = "root";
    //     $db_pass = "";

    //     $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";

    //     try {
    //         $pdo = new PDO($dsn, $db_user, $db_pass);
    //         return $pdo;
    //     } catch (PDOException $ex) {
    //         echo $ex->getMessage();
    //         return null;
    //     }
    // }