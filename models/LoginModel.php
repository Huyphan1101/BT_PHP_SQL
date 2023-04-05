<?php
require_once 'config.php';
require_once 'User.php';

class UserModel {
    private $conn;

    public function __construct() {
        $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die ('Không thể kết nối CSDL');
        mysqli_set_charset($this->conn, 'utf8');

    }

    public function checkUser($username, $password) {
        $stmt = $this->conn->prepare('SELECT * FROM taikhoan WHERE name = ? AND pass = ?');
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return new User($row['id'], $row['name'], $row['pass'], $row['role']);
        } else {
            return null;
        }
    }
}
?>
