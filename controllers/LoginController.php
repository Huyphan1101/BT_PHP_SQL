<?php
require_once '../models/LoginModel.php';
require_once '../models/User.php';
class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = $this->userModel->checkUser($username, $password);
            if ($user) {
                
                $_SESSION['user'] = $user;
                if ($user->getRole() == 'admin') {
                    header('Location: ../views/admin.php');
                } else {
                    header('Location: ../views/home.php');
                }
                exit();
            } else {
                $error = 'Tên đăng nhập hoặc mật khẩu không đúng';
            }
        }
        require_once '../views/login.php';
    }
}
