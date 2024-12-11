<?php 
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';

// Require toàn bộ file Models
require_once './models/danhmucmodels.php';
require_once './models/sanpham.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/' => (new HomeController())->login(),
    'logout' => (new HomeController())->logout(),
    'danhsachsanpham' => (new HomeController())->danhsachSanPham(), // trường hợp đặc biệt
    'sanpham' => (new HomeController())->getAllSanPhamid1(), // trường hợp đặc biệt
    'detail_san_pham' => (new HomeController())->detailsanpham(),
    'checkout' => (new HomeController())->checkout(),
    'donHang' => (new HomeController())->donhang(),

    // Bình luận
    'them_binh_luan' => (new HomeController())->addBinhLuan(),

    // sản phẩm
    'aoThun' => (new HomeController())->listAoThun(),
    'aoSoMi' => (new HomeController())->listAoSoMi(),
    'quanJean' => (new HomeController())->listQuanJean(),
    'aoPolo' => (new HomeController())->listAoPolo(),
    'aoKhoac' => (new HomeController())->listAoKhoac(),
    'search' => (new HomeController())->searchSP(),

};