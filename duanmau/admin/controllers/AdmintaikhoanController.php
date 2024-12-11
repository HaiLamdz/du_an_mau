<?php
    class AdmintaikhoanController
    {

        public $modelTaiKhoan;
        public $modelDonHang;
        public $modelSanPham;
        public function __construct()
        {
            $this->modelTaiKhoan = new AdminTaiKhoan();
            $this->modelDonHang = new AdminDonHang();
            $this->modelSanPham = new AdminSanPham();
        }
        public function taikhoankhachhang()
        {
            $listAccount = $this->modelTaiKhoan->getAllTaiKhoan(3);
            // var_dump($listAccount);
            // die;
            require_once './views/taikhoan/khachhang/taikhoankhachhang.php';
        }
        public function taikhoannhanvien()
        {
            $listAccountQuanTri = $this->modelTaiKhoan->getAllTaiKhoan(1);
            // var_dump($listAccountQuanTri);
            // die;
            require_once './views/taikhoan/quantri/taikhoanquantri.php';
        }
        public function addQuanTri(){
            ob_start();
             // kiểm tra xem dữ liệu có phải đc summit lên không
             require_once './views/taikhoan/quantri//addquantri.php';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // lấy ra dwuc liệu
                $ho_ten = $_POST["ho_ten"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                //validate
                // tạo 1 mảng trống để chứa dữ liệu
                $errors = [];
                if (empty($ho_ten)) {
                    $errors['ho_ten'] = 'Tên  không được để trống';
                }
                if (empty($email)) {
                    $errors['email'] = 'Email không được để trống';
                }
                if (empty($password)) {
                    $errors['password'] = 'Mật khẩu không được để trống';
                }
                if (!empty($errors)) {
                    $_SESSION['errors'] = $errors;
                    header("Location: " . BASE_URL_ADMIN . '?act=them_quan_tri');
                    exit();
                }

                // Khai báo chức vụ
                $chuc_vu_id = 1;

                 // nếu không có lỗi thì tiến hành thêm danh mục
                // if (empty($errors)) {
                     // nếu không có lỗi thì tiến hành thêm danh mục
                    $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $password, $chuc_vu_id);
                    header("location: " . BASE_URL_ADMIN . '?act=taikhoannhanvien');
                    exit();
            //     } else {
            //          // trả về form
            //         require_once './views/danhmuc/addDanhMuc.php';
            //     }
            // } else {
            //      // trả về form
                
            }
        }

        public function suaQuanTri(){
            ob_start();
            // dlấy ra thông tin danh mục cần sửa
            $id_quan_tri = $_GET['id_quan_tri'];
            $quanTri = $this->modelTaiKhoan->getDetailTaiKhoan($id_quan_tri);
            // var_dump($danhmuc);
            if($quanTri){
                require_once './views/taikhoan/quantri/editquantri.php';    
            }else{
                header("location: " . BASE_URL_ADMIN . '?act=danhmuc');
                exit();
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // lấy ra dwuc liệu
                $id = $_POST["quan_tri_id" ];
                $ho_ten = $_POST["ho_ten"];
                $email = $_POST["email"];
                $so_dien_thoai = $_POST["so_dien_thoai"];
                $trang_thai = $_POST["trang_thai"];
                // var_dump($ho_ten);
                // var_dump($email);
                //validate
                // tạo 1 mảng trống để chứa dữ liệu
                $errors = [];
                if (empty($ho_ten)) {
                    $errors['ho_ten'] = 'Tên danh mục ko dcd để trống';
                }
                if (empty($email)) {
                    $errors['email'] = 'Tên danh mục ko dcd để trống';
                } 
                if (!empty($errors)) {
                    $_SESSION['errors'] = $errors;
                    header("Location: " . BASE_URL_ADMIN . '?act=sua_quan_tri&id_quan_tri=' . $id);
                    exit();
                }
                // var_dump($errors);
                // nếu không có lỗi thì tiến hành sửa danh mục
                if (empty($errors)) {
                    // nếu không có lỗi thì tiến hành sửa danh mục
                    $this->modelTaiKhoan->updateTaiKhoan($id, $ho_ten, $email, $so_dien_thoai, $trang_thai);
                    header("location: " . BASE_URL_ADMIN . '?act=taikhoannhanvien');
                    exit();
                }else{
                    // trả về form
                    $quanTri = ['id' => $id, 'ho_ten' => $ho_ten, 'email'=>$email, 'so_dien_thoai' => $so_dien_thoai, 'trang_thai' => $trang_thai];
                    require_once './views/taikhoan/quantri/editquantri.php';
                }
            }
        }
        public function detailkhachhang(){
            $id_khach_hang = $_GET['id_khach_hang'];
            $khachhang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
            $listDonHang = $this->modelDonHang->getDonHangOfKhachHang($id_khach_hang);
            $listBinhLuan = $this->modelSanPham->getBinhLuanOfKhachHang($id_khach_hang);

            require_once './views/taikhoan/khachhang/detailkhachhang.php';
            
        }
    }
?>