<?php 
require_once '../models/CameraModel.php';
require_once '../controllers/CameraController.php';
require_once '../controllers/index1.php';
require_once '../models/CameraModel.php';
$tl = new MayAnhController();
$mayanhModel = new MayAnhModel();

$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
$price_min = isset($_GET['price_min']) ? $_GET['price_min'] : 0;
$price_max = isset($_GET['price_max']) ? $_GET['price_max'] : PHP_INT_MAX;
$category_id = isset($_GET['search_code']) ? $_GET['search_query'] : '';

if (isset($_GET['search'])) {
    $mays = $mayanhModel->searchByName($search_query);
} elseif (isset($_GET['search_price'])) {
    $mays = $mayanhModel->searchByPrice($price_min, $price_max);
} elseif (isset($_GET['search_code'])) {
    $mays = $mayanhModel->searchByCategoriId($category_id);
} else {
    $mays = $tl->getListCamera();
}
if (isset($_GET['search_by_date'])) {
  $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
  $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
  if ($start_date && $end_date) {
      $mays = $mayanhModel->searchByReleasedDateRange($start_date, $end_date);
  }
}

// Nếu không có tìm kiếm theo ngày, thực hiện hiển thị tất cả sản phẩm
if (!isset($mays)) {
  $mays = $tl->getListCamera();
}



?>
<?php
// require_once '../controllers/LoginController.php';
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

  <h2 style="text-align: center;">THẾ GIỚI MÁY ẢNH</h2>
  <form action="home.php" method="get">
        <input type="text" name="search_query" placeholder="Tìm kiếm sản phẩm theo tên">
        <button type="submit" name="search">Tìm kiếm</button>
  </form>
  <br>
  <form action="home.php" method="get">
    <input type="text" name="price_min" placeholder="Giá thấp nhất">
    <button type="submit" name="search_price">Tìm kiếm</button>
    <br>
    <input type="text" name="price_max" placeholder="Giá cao nhất">
    
  </form>
  <form action="home.php" method="get">
        <input type="text" name="search_query" placeholder="Tìm kiếm sản phẩm theo mã">
        <button type="submit" name="search_code">Tìm kiếm</button>
  </form>
  <form action="home.php" method="get">
    <label for="start_date">Ngày bắt đầu:</label>
    <input type="date" id="start_date" name="start_date" required>

    <label for="end_date">Ngày kết thúc:</label>
    <input type="date" id="end_date" name="end_date" required>
    <button type="submit" name="search_by_date">Tìm kiếm</button>
</form>





    <form method="post" action="?action=logout">
    <button id="bt3" type="submit" name="submit-logout">Đăng xuất</button>
    </form>
    <br>
  <table>
		
                
  <!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Danh sách sản phẩm</title>
  <link rel="stylesheet" href="../src//style3.css">
</head>
<body>
  <div class="product-list">
    <?php
    if ($mays)
     foreach ($mays as $sanpham): ?>
      <form method="post" action="...">
        <div class="product-item">
          <img src="<?php echo $sanpham['image_url']; ?>" alt="<?php echo $sanpham['name']; ?>">
          <h2><?php echo $sanpham['name']; ?></h2>
          <p class="product-info">
            Mã loại sản phẩm: <?php echo $sanpham['category_id']; ?> |
            Thông số: <?php echo $sanpham['spec']; ?> |
            Giá: <?php echo $sanpham['price']; ?> |
            Ngày phát hành: <?php echo $sanpham['released_date']; ?>
          </p>
          <input type="hidden" name="id" value="<?php echo $sanpham['id']; ?>">
          <button type="submit" name="them_vao_giohang">Thêm vào giỏ hàng</button>
        </div>
      </form>
    <?php endforeach; ?>
  </div>
</body>
</html>

