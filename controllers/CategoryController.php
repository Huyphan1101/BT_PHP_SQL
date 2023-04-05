<?php
require_once '../models/CategoryModel.php';
class TheLoaiController {
    private $theLoaiModel;

    public function __construct() {
        $theLoaiModel = new TheLoaiModel();
        $this->theLoaiModel = $theLoaiModel;
    }
    public function getList() {
        // Lấy danh sách thể loại từ model
        $list = $this->theLoaiModel->getTheLoaiList();
        return $list;
        // Hiển thị danh sách thể loại
        require_once '../views/admin.php';
    }
    public function viewAdd() {
        require_once '../views/add_category.php';
      }
      public function addCategory() {
          if (isset($_POST['submit-cat'])) {
            $theloais = array (
              'code' => $_POST['code'],
            'category_name' => $_POST['category_name'],
            'category_status' => $_POST['category_status']
            );
            try{
              $this->theLoaiModel->addCategory($theloais);
                header("Location: ../views/admin.php"); // Chuyển hướng về trang admin
                exit();
              } catch (\Exception $e)
              {
                echo  "Thêm thể loại máy ảnh không thành công.";
              }    
            }
          }
          public function huy()
        {
          if (isset($_POST['submit-huy'])) {
          header("Location: ../views/admin.php");
          }
        }
        public function logout()
        {
          if (isset($_POST['submit-logout'])) {
            session_unset();
            session_destroy();

          header("Location: ../views/login.php");
          }
        }
        
          public function deleteCategory() {
            if(isset($_POST['delete_category'])) {
                $id = $_POST['theloai_id'];
                try {
                    $this->theLoaiModel->deleteCategory($id);
                    header("Location: ../views/admin.php");
                    exit();
                } catch (\Exception $e) {
                    echo "Xóa sản phẩm không thành công.";
                }
            }
        }
      //   public function editCategory() {
      //     if(isset($_POST['edit_category'])) {
      //         $theloais = array (
      //             'id' => $_POST['theloai_id'],
      //             'code' => $_POST['code'],
      //             'category_name' => $_POST['category_name'],
      //             'category_status' => $_POST['category_status']
      //         );
      //         try {
      //             $this->theLoaiModel->editCategory1();
      //             header("Location: ../views/admin.php");
      //             exit();
      //         } catch (\Exception $e) {
      //             echo "Sửa loại máy ảnh không thành công.";
      //         }
      //     }
      // }
      public function searchCategory() {
        $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
       $this->theLoaiModel->getList($search_query);
        include '../views/admin.php';
    }
    
    public function showMachinesByCategory($code) {
   
  
      // Lấy danh sách máy theo thể loại máy
       return $this->theLoaiModel->getCamerasByCategory($code);

    }
  }
      

    