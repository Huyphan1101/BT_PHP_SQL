<?php
// Kết nối CSDL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ql_mayanh";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
if(isset($_POST['id'])) {
    $id = $_POST['id'];

    // Thực hiện truy vấn xóa máy ảnh từ CSDL
    $sql = "DELETE FROM mayanh WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Máy ảnh đã được xóa thành công";
    } else {
        echo "Lỗi khi xóa máy ảnh: " . $conn->error;
    }

    // Đóng kết nối đến CSDL
    $conn->close();

    // Điều hướng trở lại trang danh sách máy ảnh sau khi xóa hoàn tất
    header('Location: ../views/viewcamera.php');
    exit;
}
// Truy vấn tất cả các máy ảnh từ bảng mayanh
$sql = "SELECT * FROM mayanh";
$result = $conn->query($sql);

// Hiển thị kết quả
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<h1> DANH SÁCH MÁY ẢNH</h1>";
    echo "<form method='post' action='addcamera.php'><button type='submit' name='add_camera'>Thêm máy ảnh</button></form>";
    echo "<tr><th>Mã máy ảnh</th><th>Tên máy ảnh</th><th>Thông số kỹ thuật</th><th>Giá</th><th>Ngày phát hành</th><th>Ảnh</th><th>Tác vụ</th></tr>";
    while($row = $result->fetch_assoc()) {
        
        echo "<tr>";
        echo "<td>" . $row["category_id"] . "</td>";   
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["spec"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . $row["released_date"] . "</td>";
        echo "<td><img src='" . $row["image_url"] . "'></td>";
        echo "<td>";
        echo "<form method='post'><input type='hidden' name='id' value='" . $row["id"] . "'><button type='submit'>Xóa</button></form>";
        echo "<form method='post' action='editcamera.php?id=" . $row["id"] . "'><button type='submit'>Sửa</button></form>";

        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";

} else {
    echo "Không tìm thấy máy ảnh nào.";
}


$conn->close();


?>

