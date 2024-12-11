<?php

class HomeController
{
    public $modelSanPham;
    public $modelDanhMuc;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelDanhMuc = new DanhMuc();
    }
    public function danhsachSanPham()
    {
        $listProduct = $this->modelSanPham->getallProduct();
        require_once 'views/listProduct.php';
        // var_dump($acc);die;
    }
    public function getAllSanPhamid1()
    {
        $listProductAoThun = $this->modelSanPham->getAllSanPham1(12);
        $listProductAoPoLo = $this->modelSanPham->getAllSanPham1(13);
        $listProductQuanJean = $this->modelSanPham->getAllSanPham1(14);
        $listProductAoSoMi = $this->modelSanPham->getAllSanPham1(15);
        $listProductAoKhoac = $this->modelSanPham->getAllSanPham1(16);
        // var_dump($listProductAoThun['ten_danh_muc']);die;
        $id = $listProductAoThun[0]['danh_muc_id'];
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc($id);
        // var_dump($id);die;
        if ($listProductAoThun) {
            require_once 'views/sanpham.php';
        } else {
            echo 'lỗi';
        }
    }
    public function listAoThun()
    {
        $listProductAoThun = $this->modelSanPham->getAllSanPham1(12);
        // var_dump($listProductAoThun['ten_danh_muc']);die;
        $id = $listProductAoThun[0]['danh_muc_id'];
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc($id);
        // var_dump($id);die;
        if ($listProductAoThun) {
            require_once 'views/sanpham/aoThun.php';
        } else {
            echo 'lỗi';
        }
    }
    public function listAoSoMi()
    {
        $listProductAoSoMi = $this->modelSanPham->getAllSanPham1(15);

        // var_dump($listProductAoThun['ten_danh_muc']);die;
        $id = $listProductAoSoMi[0]['danh_muc_id'];
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc($id);
        // var_dump($id);die;
        if ($listProductAoSoMi) {
            require_once 'views/sanpham/aoSoMi.php';
        } else {
            echo 'lỗi';
        }
    }
    public function listAoPolo()
    {
        $listProductAoPoLo = $this->modelSanPham->getAllSanPham1(13);
        // var_dump($listProductAoThun['ten_danh_muc']);die;
        $id = $listProductAoPoLo[0]['danh_muc_id'];
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc($id);
        // var_dump($id);die;
        if ($listProductAoPoLo) {
            require_once 'views/sanpham/aoPolo.php';
        } else {
            echo 'lỗi';
        }
    }
    public function listQuanJean()
    {
        $listProductQuanJean = $this->modelSanPham->getAllSanPham1(14);
        // var_dump($listProductAoThun['ten_danh_muc']);die;
        $id = $listProductQuanJean[0]['danh_muc_id'];
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc($id);
        // var_dump($id);die;
        if ($listProductQuanJean) {
            require_once 'views/sanpham/quanJean.php';
        } else {
            echo 'lỗi';
        }
    }
    public function listAoKhoac()
    {
        $listProductAoKhoac = $this->modelSanPham->getAllSanPham1(16);
        // var_dump($listProductAoThun['ten_danh_muc']);die;
        $id = $listProductAoKhoac[0]['danh_muc_id'];
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc($id);
        // var_dump($id);die;
        if ($listProductAoKhoac) {
            require_once 'views/sanpham/aoKhoac.php';
        } else {
            echo 'lỗi';
        }
    }

    public function detailsanpham()
    {
        // ob_start();

        $id = $_GET['id_san_pham'];
        // var_dump($id);
        $sanpham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listBinhLuan = $this->modelSanPham->getAllBinhLuan($id);
        // var_dump($listBinhLuan);die;
        // lấy ảnh cũ
        // var_dump($listAnhSanPham);
        // die;
        // var_dump($sanpham);
        if ($sanpham) {
            require_once './views/detailProduct.php';
        } else {
            header("location: " . BASE_URL . '?act=/');
            exit();
        }
    }
    public function login()
    {
        require_once './views/login.php';
        if (isset($_POST['login'])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            // var_dump($user);
            // die;
            $errors = [];
            if (empty($user && $pass)) {
                $errors['login'] = "Tài khoản hoặc mật khẩu không đúng";
            }
            // var_dump($acc['mat_khau']);die;
            if (empty($errors)) {
                $acc =  $this->modelSanPham->checkAcc($user, $pass);
                $validateAcc = false;
                foreach ($acc as $key => $row) {
                    if ($user == $row['email'] && $pass == $row['mat_khau']) {
                        $_SESSION['user'] = [
                            'id' => $row['id'],
                            'email' => $row['email'],
                            'chuc_vu_id' => $row['chuc_vu_id'],
                            'trang_thai' => $row['trang_thai']
                            // Bạn có thể lưu thêm thông tin khác nếu cần
                        ];
                        $validateAcc = true;
                        // var_dump($_SESSION);die;
                        if(isset($_SESSION['user']) && $_SESSION['user']['chuc_vu_id'] == 1){
                            header("location: " . BASE_URL_ADMIN );
                            exit();
                        }
                        else if(isset($_SESSION['user']) && $_SESSION['user']['chuc_vu_id'] == 2){
                            header("location: " . BASE_URL_ADMIN );
                            exit();
                        }
                        else if(isset($_SESSION['user']) && $_SESSION['user']['chuc_vu_id'] == 3) {
                            if($_SESSION['user']['trang_thai'] == 1){
                            header("location: " . BASE_URL . '?act=danhsachsanpham');
                            exit();
                            }else{
                                echo "<script> alert('Tài khoản đã bị khóa đăng nhập đến 21/12/2027') </script>";
                                header("Location: " . BASE_URL);
                                exit();
                            }
                        } else {
                            header("location: " . BASE_URL);
                            exit();
                        }
                    }
                }
            } else {
                $_SESSION['errors'] = $errors;
                header("location: " . BASE_URL);
                exit();
            }
        }
    }
    public function checkout()
    {
        ob_start();
        $id = $_GET['id_san_pham'];
        $listProduct = $this->modelSanPham->getDetailSanPham($id);
        // var_dump($listProduct);die;
        require_once 'views/checkout.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dwuc liệu
            $tai_khoan_id = $_POST['tai_khoan_id'] ?? '';
            $ten_nguoi_nhan = $_POST["ten_nguoi_nhan"] ?? '';
            $email_nguoi_nhan = $_POST["email_nguoi_nhan"] ?? '';
            $sdt_nguoi_nhan = $_POST["sdt_nguoi_nhan"] ?? '';
            $dia_chi_nguoi_nhan = $_POST["dia_chi_nguoi_nhan"] ?? '';
            $tong_tien = $_POST['tong_tien'];
            // var_dump($tong_tien);die;
            $ghi_chu = $_POST["ghi_chu"] ?? '';
            $phuong_thuc_thanh_toan = $_POST["phuong_thuc_thanh_toan"] ?? '';
            $trang_thai = 1;
            // var_dump($trang_thai);die;
            // var_dump($_POST);die;
            // var_dump("abc");die;
            $san_pham_id = $_GET['id_san_pham'];
            $so_luong = $_POST['so_luong'];
            $don_gia = $_POST['don_gia'];
            // var_dump($don_gia);die;
            // tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ten_nguoi_nhan)) {
                $errors['ten_nguoi_nhan'] = 'Họ tên không được để trống';
            }
            if (empty($email_nguoi_nhan)) {
                $errors['email_nguoi_nhan'] = 'Email không được để trống';
            }
            if (empty($sdt_nguoi_nhan)) {
                $errors['sdt_nguoi_nhan'] = 'Số điện thoại không được để trống';
            }
            if (empty($dia_chi_nguoi_nhan)) {
                $errors['dia_chi_nguoi_nhan'] = 'Địa chỉ không được để trống';
            }
            if (empty($phuong_thuc_thanh_toan)) {
                $errors['phuong_thuc_thanh_toan'] = 'Chọn phương thức thanh toán';
            }

            // $_SESSION['errors'] = $errors;
             // Nếu có lỗi, lưu thông báo lỗi vào session
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: " . BASE_URL . '?act=checkout&id_san_pham=' . $id);
                exit();
            }   
            if($don_hang_id = $this->modelSanPham->buy_product($tai_khoan_id, $ten_nguoi_nhan, $email_nguoi_nhan, $sdt_nguoi_nhan, $dia_chi_nguoi_nhan, $tong_tien, $ghi_chu, $phuong_thuc_thanh_toan, $trang_thai)){
                $this->modelSanPham->addDetailDonHang($don_hang_id['id'], $san_pham_id,$don_gia, $so_luong, $tong_tien);
                header('location: ' . BASE_URL . '?act=donHang&id_don_hang=' . $don_hang_id['id']);
                exit();
            }
            
            // var_dump($don_hang_id['id']);die;
            

            // nếu không có lỗi thì tiến hành thêm sản phẩm
            // if (empty($errors)) {
                // nếu không có lỗi thì tiến hành thêm sản phẩm

        }
    }

    public function donhang(){
        $don_hang_id = $_GET['id_don_hang'];
        // var_dump($don_hang_id);die;
        // lấy thoogn tin đơn hàng ở bảng đơn hàng
        // var_dump($don_hang_id);die;
        $donhang = $this->modelSanPham->getDetailDonHang($don_hang_id);
        // var_dump($donhang);die;
        // if(!$donhang){
        //     echo 'Không';
        //     die;
        // }else{
        //     echo 'Có';
        //     die;
        // }
        // lấy danh sách sản phẩm đã đặt của đơn hàng ở bẳng chi_tiet_dan_hangs
        $sanphamDonhang = $this->modelSanPham->getListSPDonHang($don_hang_id);
        // var_dump($sanphamDonhang);die;
        $listTrangThaiDonHang = $this->modelSanPham->getAllTrangThaiDonHang();
        require_once 'views/donhang.php';
    }

    
    


    function addBinhluan()
    {
        // var_dump('abc');die;
        // require_once 'views/detailProduct.php';

        if (isset($_POST['comment'])) {
            // var_dump("abc");;die;
            $san_pham_id = $_POST['san_pham_id'];
            $tai_khoan_id = $_POST['tai_khoan_id']; // Giả sử tai_khoan_id được lấy từ session sau khi đăng nhập
            $noi_dung = $_POST['mo_ta'];
            // var_dump($san_pham_id, $noi_dung, $tai_khoan_id);die;

            // Thêm bình luận
            if ($this->modelSanPham->insertBinhLuan($san_pham_id, $tai_khoan_id, $noi_dung)) {
                header('Location: ' . BASE_URL . '?act=detail_san_pham&id_san_pham=' . $san_pham_id);
                exit();
            } else {
                echo 'loi khong the them binh luan';
                header('Location: ' . BASE_URL . '?act=detail_san_pham&id_san_pham=' . $san_pham_id);
            }

            // Chuyển hướng lại trang sản phẩm



        }
    }
    public function searchSP(){
        if(isset($_POST['search'])){
            //var_dump('1234');die;
            $keysearch = $_POST['keysearch'];
            // var_dump($keysearch);die;
            $products = $this->modelSanPham->getAllSearch($keysearch);
            // var_dump($products);die;
        }
        require_once 'views/search.php';
    }

    public function logout(){
        ob_start();
        require_once './views/logout.php';
    }
}
