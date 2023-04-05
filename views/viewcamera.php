<!DOCTYPE html>
<html>
<head>
	<title>Quản lý máy ảnh</title>
	<style type="text/css">
		table {
			border-collapse: collapse;
			width: 100%;
			max-width: 800px;
			margin: 0 auto;
			font-size: 14px;
			line-height: 1.5;
			color: #333;
			background-color: #fff;
			border: 1px solid #ddd;
		}
        h1 {
            text-align: center;
        }
		th, td {
			padding: 10px;
			text-align: left;
			vertical-align: top;
			border: 1px solid #ddd;
		}
		th {
			font-weight: bold;
			background-color: #f5f5f5;
		}
		tr:hover {
			background-color: #f5f5f5;
		}
		button[name="add_camera"] {
			margin: 20px auto;
			padding: 10px 20px;
			font-size: 14px;
			font-weight: bold;
			color: #fff;
			background-color: #428bca;
			border: none;
			border-radius: 3px;
			cursor: pointer;
			transition: background-color 0.3s;
		}
		button[name="add_camera"]:hover {
			background-color: #3071a9;
		}
        /* Đặt kích thước cố định cho hình ảnh */
img {
    max-width: 200px;
    max-height: 200px;
    width: auto;
    height: auto;
}

/* Căn giữa hình ảnh */
td img {
    display: block;
    margin: 0 auto;
}

	</style>
</head>
<body>
	<?php include '../controllers/camera.php'; ?>
</body>
</html>
