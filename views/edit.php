<?php
require_once '../models/config.php';
require_once '../controllers/CategoryController.php';
require_once '../models/CategoryModel.php';


    // Tạo một đối tượng CategoryController để lấy thông tin thể loại từ CSDL
    $categoryController = new TheLoaiController();
    $category = new TheLoaiModel();
   
if (isset($_POST['submit_edit'])) {
    $id = $_POST['id'];
    $code = $_POST['code'];
    $category_name = $_POST['category_name'];
    $category_status = $_POST['category_status'];

    // Kiểm tra thông tin sản phẩm đã được nhập đầy đủ hay chưa
    if (empty($code) || empty($category_name) || empty($category_status)) {
        echo "Vui lòng nhập đầy đủ thông tin sản phẩm";
        exit;
    }

    // Tạo đối tượng ProductModel để thao tác với CSDL
    $productModel = new TheLoaiModel();

    // Cập nhật thông tin sản phẩm trong CSDL
     $productModel->editCategory1($id, $code, $category_name, $category_status);

     header('Location: ../views/admin.php');
     exit;
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Lấy thông tin máy ảnh cần sửa từ CSDL
    $theloais = $category->getCameraById($id);
    
    // Hiển thị form sửa máy ảnh
    if ($theloais) {
        $row = $theloais->fetch_assoc();
    ?>               
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../src/style2.css">
</head>
<body>
    <div id="form-add">
        <form method="post" action="edit.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="code">Mã:</label>
            <input type="text" id="code" name="code" value="<?php echo $row['code']; ?>">
            <br>
            <label for="category_name">Tên:</label>
            <input type="text" id="category_name" name="category_name" value="<?php echo $row['category_name']; ?>">
            <br>
            <label for="category_status">Trạng thái:</label>
            <select name="category_status" id="category_status" required>
                <option value="hoạt động" <?php if($row['category_status'] == 'hoạt động') echo 'selected'; ?>>Hoạt động</option>
                <option value="không hoạt động" <?php if($row['category_status'] == 'không hoạt động') echo 'selected'; ?>>Không hoạt động</option>
            </select>
            <br>
            <button type="submit" name="submit_edit">Sửa thông tin</button>
        </form>
        <form method="post" action="?action=huy">
            <button style="background-color: red ;" type="submit" name="submit-huy">Hủy</button>
        </form>
    </div>
</body>
</html>
<?php
} else {
    echo "Không tìm thấy sản phẩm cần sửa";
}
}