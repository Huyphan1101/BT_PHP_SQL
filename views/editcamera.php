<?php
require_once '../models/config.php';
require_once '../models/CameraModel.php';

// Khởi tạo đối tượng model
$model = new MayAnhModel();

// Kiểm tra nếu form đã được submit
if (isset($_POST['submit'])) {
    // Lấy thông tin cần thiết từ form
    $id = $_POST['id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $spec = $_POST['spec'];
    $price = $_POST['price'];
    $released_date = $_POST['released_date'];

    // Xử lý lưu ảnh
    $image_url = "";
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == UPLOAD_ERR_OK) {
        $image_tmp_name = $_FILES['image_url']['tmp_name'];
        $image_name = basename($_FILES['image_url']['name']);
        $image_path = "../src/image/" . $image_name;
        move_uploaded_file($image_tmp_name, $image_path);
        $image_url = $image_path;
    }

    // Gọi phương thức updateCamera() từ đối tượng model để cập nhật thông tin máy ảnh
    $model->updateCamera($id,$category_id, $name, $spec, $price, $released_date, $image_url);

    // Điều hướng trở lại trang danh sách máy ảnh sau khi cập nhật hoàn tất
    header('Location: ../views/viewcamera.php');
    exit;
}
if (isset($_GET['id'])) {
$id = $_GET['id'];

// Lấy thông tin máy ảnh cần sửa từ CSDL
$camera = $model->getCameraById($id);

// Hiển thị form sửa máy ảnh
if ($camera) {
    $row = $camera->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sửa máy ảnh</title>
    <link rel="stylesheet" type="text/css" href="../src/style2.css">
</head>
<body>
    <h1>Sửa thông tin máy ảnh</h1>
    <div id="form-add">
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="code">Mã máy ảnh :</label>
        <input type="text" id="category_id" name="category_id" value="<?php echo $row['category_id']; ?>"><br>
        <label for="name">Tên máy ảnh:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>"><br>
        <label for="spec">Thông số kỹ thuật:</label>
        <textarea id="spec" name="spec"><?php echo $row['spec']; ?></textarea><br>
        <label for="price">Giá:</label>
        <input type="text" id="price" name="price" value="<?php echo $row['price']; ?>"><br>
        <label for="released_date">Ngày phát hành:</label>
        <input type="date" id="released_date" name="released_date" value="<?php echo $row['released_date']; ?>"><br>
        <label for="image_url">Ảnh:</label>
        <input type="file" id="image_url" name="image_url"><br>
        <img src="<?php echo $row['image_url']; ?>"><br>
        <input style=" background-color: aqua;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;"  type="submit" name="submit" value="Lưu">
    </form>
    </div>
<?php
} else {
    echo "Không tìm thấy sản phẩm cần sửa";
}
}
