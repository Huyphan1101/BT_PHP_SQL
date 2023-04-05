<?php 
session_start();
require_once '../controllers/CategoryController.php';
require_once '../controllers/index1.php';
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
  <form method="post" action="?action=add_category">
    <label for="code">Mã máy ảnh:</label>
    <input type="text" id="code" name="code">
    <br>
    <label for="name">Tên:</label>
    <input type="text" id="name" name="category_name">
    <br>
    <label for="status">Trạng thái:</label>
    <select name="category_status" id="status" required>
			<option value="hoạt động">Hoạt động</option>
			<option value="không hoạt động">Không hoạt động</option>
		</select>
    <br>
    <button type="submit" name="submit-cat">Thêm thể loại</button> 
  </form>
  <form method="post" action="?action=huy">
    <button style="background-color: red ;" type="submit" name="submit-huy">Hủy</button>
    </form>
</div>
</body>
</html>