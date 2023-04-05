<?php
require_once "../models/CameraModel.php";
require_once '../views/home.php';
class MayAnhController {
    private $mayanh;

    public function __construct() {
        $mayanh = new MayAnhModel();
        $this->mayanh = $mayanh;
    }
    public function getListCamera() {
        // Lấy danh sách thể loại từ model
        $list = $this->mayanh->getTheLoaiList();
        return $list;
        // Hiển thị danh sách thể loại
        require_once '../views/home.php';
    }
    public function logout()
    {
      if (isset($_POST['submit-logout'])) {
      header("Location: ../views/login.php");
      }
    }
    
}