<?php 
require_once '../controllers/LoginController.php';
$login = new UserController();
$login->login();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../src/style.css">
  <title>Đăng nhập</title>
</head>
<body>
  <div class="container">
    <h1>Đăng nhập</h1>
    <form method="post" action="?action=login">
      <label for="username">Tên đăng nhập:</label>
      <input type="text" id="username" name="username">

      <label for="password">Mật khẩu:</label>
      <input type="password" id="password" name="password">

      <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
      <?php endif; ?>

      <button type="submit">Đăng nhập</button>
    </form>
  </div>
</body>
</html>
