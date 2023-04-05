<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ql_mayanh');

class Database {
    private $conn;

    public function __construct() {
        $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$this->conn) {
            die('Không thể kết nối CSDL');
        }
        mysqli_set_charset($this->conn, 'utf8');
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
