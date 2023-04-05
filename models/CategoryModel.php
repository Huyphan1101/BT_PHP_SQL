<?php
require_once 'config.php';
require_once 'User.php';
class TheLoaiModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die ('Không thể kết nối CSDL');
        mysqli_set_charset($this->conn, 'utf8');

    }

    function getTheLoaiList()
    {
        // Lấy danh sách thể loại máy ảnh
        $query = "SELECT * FROM theloaimay";
        $result = mysqli_query($this->conn, $query);
        $theloais = $result->fetch_all(MYSQLI_ASSOC);
        return $theloais;
    }
    public function addCategory($theloais) {
        $stmt = $this->conn->prepare("INSERT INTO theloaimay (code, category_name, category_status) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $theloais['code'], $theloais['category_name'], $theloais['category_status']);
        $stmt->execute();
        $stmt->close();
    }
    public function deleteCategory($id) {
        $stmt = $this->conn->prepare("DELETE FROM theloaimay WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    public function editCategory1($id, $code, $category_name, $category_status) {
        $sql = "UPDATE theloaimay SET code='$code', category_name='$category_name', category_status='$category_status' WHERE id=$id";
        return $this->conn->query($sql);
    }
    public function getList($search_query = '') {
        if($search_query) {
            $stmt = $this->conn->prepare("SELECT * FROM theloaimay WHERE category_name LIKE ?");
            $search_query = "%$search_query%";
            $stmt->bind_param("s", $search_query);
        } else {
            $stmt = $this->conn->prepare("SELECT * FROM theloaimay");
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    public function getCamerasByCategory($categoryId)
    {
        $sql = "SELECT * FROM mayanh WHERE category_id = '$categoryId'";
        $result = mysqli_query($this->conn, $sql);
        $cameras = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $cameras[] = $row;
        }
        return $cameras;
    }
    public function getCameraById($id) {
        $sql = "SELECT * FROM theloaimay WHERE id=$id";
        $result = $this->conn->query($sql);
        return $result;
    }
    public function searchByPrice($price_min, $price_max) {
        $price_min = (float) $price_min;
        $price_max = (float) $price_max;
        $sql = "SELECT * FROM mayanh WHERE price >= $price_min AND price <= $price_max";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
}
 
    
    
