<?php 
require_once '../models/CategoryModel.php';
require_once '../controllers/CategoryController.php';
require_once '../controllers/index1.php';
$tl = new TheLoaiController();
$theloais = $tl->getList();


// require_once "../controllers/LoginController.php";
//       $user = $_SESSION['user'];
//       echo 'Xin chào: ' . $user->getUsername() . '';
      
// ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../src/style1.css">
  <title>Trang chủ</title>
</head>
<body>
<header class="site-header">
  <nav class="site-navigation">
    <ul>
      <li><a href="../views/admin.php">QL Thể Loại</a></li>
      <li><a href="../views/viewcamera.php">QL Sản phẩm</a></li>
      <li><a href="../views/home.php">Trang Chủ</a></li>
    </ul>
  </nav>
</header>

  <h2 style="text-align: center;">Danh sách thể loại</h2>
  <form method="get" action="?action=search_category">
        <input type="text" name="search_query" placeholder="Tìm kiếm theo tên...">
        <button type="submit" name="search">Tìm kiếm</button>
    </form>
    <form method="post" action="?action=logout">
    <button id="bt3" type="submit" name="submit-logout">Đăng xuất</button>
    </form>
    <br>
  <table>
			<thead>
				<tr>
					<th>STT</th>        
					<th>Mã Máy Ảnh</th>
					<th>Tên Hãng</th>
					<th>Trạng Thái</th>
                    <th>Tác Vụ</th>
                    <th>Chi Tiết</th>
				</tr>
			</thead>
			<tbody>
                
				<?php
                if($theloais)
                foreach ($theloais as $theloai): ?>
					<tr>
						<td><?php echo $theloai['id']; ?></td>
						<td><?php echo $theloai['code']; ?></td>    
						<td><?php echo $theloai['category_name']; ?></td>
						<td><?php echo $theloai['category_status']; ?></td>
						<td>
                 <form method="post" action="?action=delete_category">
                 <input type="hidden" name="theloai_id" value="<?php echo $theloai['id']; ?>">
                 <button id="bt1" type="submit" name="delete_category">Xóa</button>
                 </form>
                 <button id="bt" onclick="editCategory(<?php echo $theloai['id']; ?>)">Sửa</button>

						</td>
            <td>
            <a href="detail.php?code=<?php echo $theloai['code'];?>">Xem chi tiết</a>
            </td>
					</tr>
                    <?php endforeach; ?>

			</tbody>
            
		</table>
        <br>
        <button id="bt2" onclick="window.location.href = 'add.php';">Thêm thể loại</button>
      <br>

    
    <?php
if(isset($_GET['search'])) {
    $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
    $theloais = $tl->getList($search_query);
    if ($theloais && count($theloais) > 0) {
        $found = false;
        foreach ($theloais as $theloai) {
            if ($theloai['category_name'] == $search_query) {
                $found = true;
                ?>
                <link rel="stylesheet" type="text/css" href="../src/style2.css">
                <div class="theloai" id="form-add">
                    <h2>Kết quả tìm kiếm cho <?php echo $search_query; ?></h2>
                    <p><strong>Mã Máy Ảnh:</strong> <?php echo $theloai['code']; ?></p>
                    <p><strong>Trạng Thái:</strong> <?php echo $theloai['category_status']; ?></p>
                </div>
                <?php
                break;
            }
        }
        if (!$found) {
            echo "<p>Không tìm thấy thể loại phù hợp.</p>";
        }
    } else {
        echo "<p>Không tìm thấy thể loại phù hợp.</p>";
    }
}
?>

<script>
function editCategory(categoryId) {
    window.location.href = 'edit.php?id=' + categoryId;
}
</script>