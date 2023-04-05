
<?php 
require_once '../controllers/CategoryController.php';
$a = new TheLoaiController();

  if(isset($_GET['code'])){
    $code = $_GET['code'];
$tl = $a->showMachinesByCategory($code);
  }

?> 



<!DOCTYPE html>
<html>
<head>
	<title>Danh sách máy ảnh</title>
   <Link rel="stylesheet" type="text/css" href="../src/style4.css">
</head>
<body>
	<h1 style="text-align: center;">Danh sách máy ảnh thuộc thể loại máy : <?php echo $code; ?></h1>
	<table>
		<tr>
			<th>Mã thể loại</th>
			<th>Tên máy ảnh</th>
			<th>Thông số kỹ thuật</th>
			<th>Giá</th>
			<th>Ngày phát hành</th>
			<th>Ảnh</th>
		</tr>
		<?php foreach ($tl as $mayanh) : ?>
			<tr>
				<td><?php echo $mayanh['category_id']; ?></td>
				<td><?php echo $mayanh['name']; ?></td>
				<td><?php echo $mayanh['spec']; ?></td>
				<td><?php echo $mayanh['price']; ?></td>
				<td><?php echo $mayanh['released_date']; ?></td>
				<td><img src="<?php echo $mayanh['image_url']; ?>"></td>
			</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>
