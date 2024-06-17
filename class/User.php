<?php
class User
{
    public $Id;
    public $Name;
    public $Username;
    public $Password;
    public $Email;
    public $Phone;
    public $Role;

    //lấy thông tin user
    public static function getOne($data, $id)
    {
        foreach ($data as $item) {
            if ($item->Id == $id) {
                return $item;
            }
        }
        return null;
    }
    //hàm kiểm tra xem tên đăng nhập đã tồn tại hay chưa
    public static function findUsername($pdo, $username)
    {
        $sql = "SELECT * From `user` where Username = :username";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Trả về người dùng đầu tiên được tìm thấy
            return $stmt->fetch(PDO::FETCH_OBJ);
        } else {
            // Không tìm thấy người dùng
            return null;
        }
    }
    // trả về id của user
    public static function findIdUsername($pdo, $username)
    {
        $sql = "SELECT id From `user` where Username = :username";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Trả về người dùng đầu tiên được tìm thấy
            return $stmt->fetchColumn();
        } else {
            // Không tìm thấy người dùng
            return null;
        }
    }

    //hàm kiểm tra đăng nhập
    public static function checkLogin($pdo, $username, $password)
    {
        $user = User::findUsername($pdo, $username);
        if ($user == null) {
            return false;
        } else {
            if ($user->Role == "admin") {
                if (password_verify($password, $user->Password)) {
                    $_SESSION['login'] = $user->Name;
                    return true;
                }
            } else {
                if (password_verify($password, $user->Password)) {
                    $_SESSION['login'] = $user->Name;
                    return true;
                }
            }
        }
    }
    //hàm đổi mật khẩu
    public static function changePassword($pdo, $username, $password)
    {
        try {
            $user = User::findUsername($pdo, $username);
            if ($user == null) {
                return false;
            } else {
                $sql = "Update user SET Password=:password Where Username =:username";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':username', $username);
                $Hash_password = password_hash($password, PASSWORD_BCRYPT);
                $stmt->bindParam(':password', $Hash_password);
                if ($stmt->execute()){
                    unset( $_SESSION['username']);
                    return true;
                }
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return false;
        }
    }

    //hàm đăng ký tài khoản
    public static function register($pdo, $username, $password, $name, $phone, $email)
    {
        $sql = "INSERT INTO `user`(Name, Username, Password, Email, Phone) VALUES (:name, :username, :password, :email, :phone)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $Hash_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $Hash_password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //Kiểm tra xem username đã tồn tại hay chưa
    public static function usernameExists($pdo, $username)
    {
        $sql = "SELECT COUNT(*) FROM user WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $count = $stmt->execute();

        return $count > 0;
    }
}
