<?php
require_once 'config.php';
require_once 'User.php';
class MayAnhModel
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
        $query = "SELECT * FROM mayanh";
        $result = mysqli_query($this->conn, $query);
        $mays = $result->fetch_all(MYSQLI_ASSOC);
        return $mays;
    }
    public function getCategoryCodes() {
        $sql = "SELECT code FROM theloaimay";
        $result = $this->conn->query($sql);
        $category_codes = array();
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $category_codes[] = $row["code"];
            }
        }
        return $category_codes;
    }
    
    
    public function addProduct($category_code, $name, $spec, $price, $released_date, $image_url) {
        $name = $this->conn->real_escape_string($name);
        $spec = $this->conn->real_escape_string($spec);
        $price = (float) $price;
        $released_date = $this->conn->real_escape_string($released_date);
        $image_url = $this->conn->real_escape_string($image_url);
    
        // Lấy category_id từ bảng theloaimay dựa trên code
        $sql_category = "SELECT id FROM theloaimay WHERE code = '$category_code'";
        $result_category = $this->conn->query($sql_category);
        if ($result_category->num_rows > 0) {
            $row_category = $result_category->fetch_assoc();
            $category_id = $row_category["id"];
    
            // Thêm sản phẩm vào bảng mayanh
            $sql_product = "INSERT INTO mayanh (category_id, name, spec, price, released_date, image_url) 
                            VALUES ('$category_id', '$name', '$spec', '$price', '$released_date', '$image_url')";
            return $this->conn->query($sql_product);
        } else {
            return null;
        }
    }
    
    public function updateCamera($id,$category_id, $name, $spec, $price, $released_date, $image_url) {
        $sql = "UPDATE mayanh SET category_id='$category_id', name='$name', spec='$spec', price='$price', released_date='$released_date', image_url='$image_url' WHERE id=$id";
        return $this->conn->query($sql);
    }
    
    public function getCameraById($id) {
        $sql = "SELECT * FROM mayanh WHERE id=$id";
        $result = $this->conn->query($sql);
        return $result;
    }
    public function searchByName($name) {
        $name = $this->conn->real_escape_string($name);
        $sql = "SELECT * FROM mayanh WHERE name LIKE '%$name%'";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function searchByCategoriId($category_id) {
        $category_id = $this->conn->real_escape_string($category_id);
        $sql = "SELECT * FROM mayanh WHERE category_id LIKE '%$category_id%'";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function searchByPrice($price_min, $price_max) {
        $price_min = (float) $price_min;
        $price_max = (float) $price_max;
        $sql = "SELECT * FROM mayanh WHERE price >= $price_min AND price <= $price_max";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function searchByReleasedDateRange($start_date, $end_date) {
        $start_date = $this->conn->real_escape_string($start_date);
        $end_date = $this->conn->real_escape_string($end_date);
        $sql = "SELECT * FROM mayanh WHERE released_date >= '$start_date' AND released_date <= '$end_date'";
        $result = $this->conn->query($sql);
        $mays = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $mays[] = $row;
            }
        }
        return $mays;
    }
}    
