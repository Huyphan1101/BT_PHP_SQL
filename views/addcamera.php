<?php
require_once '../models/config.php';
require_once '../models/CameraModel.php';

$model = new MayAnhModel();
$category_codes = $model->getCategoryCodes();

if (isset($_POST['submit'])) {
    // Lấy thông tin sản phẩm từ form
    $category_code = $_POST['category_code'];
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

    // Thực hiện thêm sản phẩm vào CSDL
    $model = new MayAnhModel();
    $result = $model->addProduct($category_code, $name, $spec, $price, $released_date, $image_url);

    if ($result !== null) {
        // Thêm sản phẩm thành công
        echo "<script>alert('Đã thêm thành công');</script>";
        header('Location: ../views/viewcamera.php');
    } else {
        // Lỗi: không tìm thấy danh mục
        echo "Category not found";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm máy ảnh</title>
    <link rel="stylesheet" type="text/css" href="../src/style2.css">
</head>
<body>
    <h1>THÊM MÁY ẢNH </h1>
    <div id="form-add">
    <form method="post" enctype="multipart/form-data">
        <label>Mã Máy:</label>
        <select name="category_code" required>
            <?php foreach ($category_codes as $code) { ?>
                <option value="<?php echo $code; ?>"><?php echo $code; ?></option>
            <?php } ?>
        </select><br><br>

        <label>Tên Máy:</label>
        <input type="text" name="name" required><br><br>

        <label>Thông Số:</label>
        <textarea name="spec" required></textarea><br><br>

        <label>Giá:</label>
        <input type="text" name="price" required><br><br>

        <label>Ngày Phát Hành:</label>
        <input type="date" name="released_date" required><br><br>

        <label>Ảnh:</label>
        <input type="file" name="image_url" required><br><br>

        <input 
        style=" background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;" 
        type="submit" 
        name="submit" 
        value="Thêm sản phẩm">
    </form>
    </div>
</body>
</html>
