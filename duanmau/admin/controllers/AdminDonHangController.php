
<?php
// require_once '../models/AdminDonHang.php';  
class AdminDonHangController
{

    public $modelDonHang;
    public $modelSanPham;
    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();
        $this->modelSanPham = new AdminSanPham();
    }
    public function danhsachdonhang()
    {
        $listDonHang = $this->modelDonHang->getAllDonHang();
        // var_dump($listDonHang);die;
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/donhang/listdonhang.php';
    }
    public function detaildonhang()
    {
        $don_hang_id = $_GET['id_don_hang'];
        // var_dump($don_hang_id);die;
        // lấy thoogn tin đơn hàng ở bảng đơn hàng
        // var_dump($don_hang_id);die;
        $donhang = $this->modelDonHang->getDetailDonHang($don_hang_id);
        // var_dump($donhang);die;
        // if(!$donhang){
        //     echo 'Không';
        //     die;
        // }else{
        //     echo 'Có';
        //     die;
        // }
        // lấy danh sách sản phẩm đã đặt của đơn hàng ở bẳng chi_tiet_dan_hangs
        $sanphamDonhang = $this->modelDonHang->getListSPDonHang($don_hang_id);
        // var_dump($sanphamDonhang);die;
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        // var_dump($listTrangThaiDonHang);die;
        require_once './views/donhang/detailDonHang.php';
    }
    public function suadonhang()
    {
        $don_hang_id = $_GET['id_don_hang'];
        // var_dump($don_hang_id);die;
        // lấy thoogn tin đơn hàng ở bảng đơn hàng
        // var_dump($don_hang_id);die;
        $donhang = $this->modelDonHang->getDetailDonHang($don_hang_id);
        // var_dump($donhang);die;
        // lấy danh sách sản phẩm đã đặt của đơn hàng ở bẳng chi_tiet_dan_hangs
        $sanphamDonhang = $this->modelDonHang->getListSPDonHang($don_hang_id);
        // var_dump($sanphamDonhang);die;
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // var_dump('abc');die;
            // Lấy dữ liệu từ POST
            // lấy dữ liệu cũ của sản phẩm
            $don_hang_id = $_GET['id_don_hang'] ?? '';
            $trang_thai_id = $_POST['trang_thai_id'] ?? '';
            // var_dump($don_hang_id);die;
            // Kiểm tra và lưu lỗi vào session
            // Nếu không có lỗi, tiến hành thêm sản phẩm vào CSDL
             if($this->modelDonHang->updateDonHang($don_hang_id,$trang_thai_id )){;
                // Chuyển hướng sau khi thêm sản phẩm thành công
                header("location: " . BASE_URL_ADMIN . '?act=donhang');
                exit();
            } else {
                // Nếu có lỗi, lưu lỗi vào session và chuyển hướng về form thêm sản phẩm
                
                header("location: " . BASE_URL_ADMIN . '?act=sua_don_hang&id_don_hang=' . $don_hang_id);
                exit();
            }
        }
        require_once './views/donhang/editdonhang.php';
    }
    //     // Kiểm tra xem phương thức yêu cầu có phải là POST không
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // Lấy dữ liệu từ POST
    //         // lấy dữ liệu cũ của sản phẩm
    //         $don_hang_id = $_POST['don_hang_id'] ?? '';





    //         $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? '';
    //         $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? '';
    //         $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? '';
    //         $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? '';
    //         $ghi_chu = $_POST['ghi_chu'] ?? '';
    //         $trang_thai_id = $_POST['trang_thai_id'] ?? '';








    //         // Kiểm tra và lưu lỗi vào session
    //         $errors = [];
    //         if (empty($ten_nguoi_nhan)) {
    //             $errors['ten_nguoi_nhan'] = 'Tên người nhận không được để trống';
    //         }
    //         if (empty($sdt_nguoi_nhan)) {
    //             $errors['sdt_nguoi_nhan'] = 'SĐT không được để trống';
    //         }
    //         if (empty($email_nguoi_nhan)) {
    //             $errors['email_nguoi_nhan'] = 'Email không được để trống';
    //         }
    //         if (empty($dia_chi_nguoi_nhan)) {
    //             $errors['dia_chi_nguoi_nhan'] = 'địa chỉ người nhận không được để trống';
    //         }

    //         if (empty($trang_thai_id)) {
    //             $errors['trang_thai_id'] = 'Trạng thái đơn hàng';
    //         }


    //         $_SESSION['error'] = $errors;

    //         var_dump($errors);
    //         die;


    //         // Nếu không có lỗi, tiến hành thêm sản phẩm vào CSDL
    //         if (empty($errors)) {
    //             $this->modelDonHang->updateDonHang(
    //                 $don_hang_id,
    //                 $ten_nguoi_nhan,
    //                 $sdt_nguoi_nhan,
    //                 $email_nguoi_nhan,
    //                 $dia_chi_nguoi_nhan,
    //                 $ghi_chu,
    //                 $trang_thai_id

    //             );

    //             // Chuyển hướng sau khi thêm sản phẩm thành công
    //             header("location: " . BASE_URL_ADMIN . '?act=don-hang');
    //             exit();
    //         } else {
    //             // Nếu có lỗi, lưu lỗi vào session và chuyển hướng về form thêm sản phẩm

    //             header("location: " . BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $don_hang_id);
    //             exit();
    //         }
    //     }
    // }


    // public function addSanPham(){
    //     // deleteSession_errors();
    //     // dùng để hiển thị form nhập
    //     // kiểm tra xem dữ liệu có phải đc summit lên không
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // lấy ra dwuc liệu
    //         $ten_san_pham = $_POST["ten_san_pham"] ?? '' ?? '';
    //         $gia_san_pham = $_POST["gia_san_pham"] ?? '';
    //         $gia_khuyen_mai = $_POST["gia_khuyen_mai"] ?? '';
    //         $so_luong = $_POST["so_luong"] ?? '';
    //         $ngay_nhap = $_POST["ngay_nhap"] ?? '';
    //         $danh_muc_id = $_POST["danh_muc_id"] ?? '';
    //         $trang_thai = $_POST["trang_thai"] ?? '';
    //         $mo_ta = $_POST["mo_ta"] ?? '';

    //         $hinh_anh = $_FILES['hinh_anh'] ?? null ;
    //         //lưu hình ảnh vào 
    //         $file_thumb = uploadFile($hinh_anh, './uploads/');
    //         // $file_thumb = uploadFile($hinh_anh, './uploads/');
    //         $img_array = $_FILES['img_array'];
    //         // var_dump($hinh_anh);
    //         // exit();
    //         // var_dump($trang_thai);
    //         // exit();
    //         //validate
    //         // tạo 1 mảng trống để chứa dữ liệu
    //         $errors = [];
    //         if (empty($ten_san_pham)) {
    //             $errors['ten_san_pham'] = 'Tên sản phẩm ko được để trống';
    //         }
    //         if (empty($gia_san_pham)) {
    //             $errors['gia_san_pham'] = 'giá sản phẩm ko được để trống';
    //         }
    //         if (empty($gia_khuyen_mai)) {
    //             $errors['gia_khuyen_mai'] = 'Giá khuyễn mãi ko được để trống';
    //         }
    //         if (empty($so_luong)) {
    //             $errors['so_luong'] = 'Số lượng ko được để trống';
    //         }
    //         if (empty($ngay_nhap)) {
    //             $errors['ngay_nhap'] = 'Ngày nhập ko được để trống';
    //         }
    //         if (empty($danh_muc_id)) {
    //             $errors['danh_muc_id'] = 'danh mục  ko được để trống';
    //         }
    //         if (empty($trang_thai)) {
    //             $errors['trang_thai'] = 'trạng thái ko được để trống';
    //         }
    //         if (empty($hinh_anh['name'])) {
    //             $errors['hinh_anh'] = 'hinhf anhr sp ko được để trống';
    //         }

    //         // $_SESSION['errors'] = $errors;
    //          // Nếu có lỗi, lưu thông báo lỗi vào session
    //         if (!empty($errors)) {
    //             $_SESSION['errors'] = $errors;
    //             header("Location: " . BASE_URL_ADMIN . '?act=them_san_pham');
    //             exit();
    //         }

    //         // nếu không có lỗi thì tiến hành thêm sản phẩm
    //         // if (empty($errors)) {
    //             // nếu không có lỗi thì tiến hành thêm sản phẩm
    //             $san_pham_id = $this->modelSanPham->insertSanPham($ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $file_thumb);
    //             // var_dump($san_pham_id);
    //             // die;
    //             // xử lý thêm albumm ảnh sp img_array
    //             if (!empty($img_array['name'])) {
    //                 foreach($img_array['name'] as $key=>$value){
    //                     $file = [
    //                         'name' => $img_array['name'][$key],
    //                         'type' => $img_array['type'][$key],
    //                         'tmp_name' => $img_array['tmp_name'][$key],
    //                         'error' => $img_array['error'][$key],
    //                         'size' => $img_array['size'][$key],
    //                     ];
    //                     $link_hinh_anh = uploadFile($file, './uploads/');
    //                     $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh);
    //                 }

    //             }
    //             header("location: " . BASE_URL_ADMIN . '?act=sanpham');
    //             exit();
    //         }else{
    //     //         // trả về form
    //     //         // đặt chỉ thị xóa session sau khi hiển thị form
    //     //         $_SESSION['flash'] = true;
    //     //         header("location: " .  BASE_URL_ADMIN . '?act=them_san_pham');
    //     //         exit();
    //     //         // require_once './views/sanpham/addSanPham.php';
    //     //     }
    //     }
    //     $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
    //     require_once './views/sanpham/addSanPham.php';

    // }

    // public function suaSanPham(){
    //     ob_start();
    //     // dlấy ra thông tin danh mục cần sửa
    //     $id = $_GET['id_san_pham'];
    //     // var_dump($id);
    //     $sanpham = $this->modelSanPham->getDetailSanPham($id);
    //     $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
    //     $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
    //     // lấy ảnh cũ
    //     // var_dump($listAnhSanPham);
    //     // die;
    //     $Old_file = $sanpham['hinh_anh'];
    //     // var_dump($id);
    //     // var_dump($sanpham);
    //     if($sanpham){
    //         require_once './views/sanpham/editSanPham.php';    
    //     }else{
    //         header("location: " . BASE_URL_ADMIN . '?act=sanpham');
    //         exit();
    //     }
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //         // lấy ra dwuc liệu
    //         $id = $_POST["id"];
    //         $ten_san_pham = $_POST["ten_san_pham"];
    //         $gia_san_pham = $_POST["gia_san_pham"];
    //         $gia_khuyen_mai = $_POST["gia_khuyen_mai"];
    //         $so_luong = $_POST["so_luong"];
    //         $ngay_nhap = $_POST["ngay_nhap"];
    //         $danh_muc_id = $_POST["danh_muc_id"];
    //         $trang_thai = $_POST["trang_thai"];
    //         $mo_ta = $_POST["mo_ta"];
    //         if(empty($_FILES['hinh_anh']['name'])){
    //             $hinh_anh = "";
    //         }else{
    //             $hinh_anh = $_FILES['hinh_anh'];
    //             //lưu hình ảnh vào 
    //             $file_thumb = uploadFile($hinh_anh, './uploads/');
    //             $img_array = $_FILES['img_array'];
    //             // nếu có ảnh mới thì xóa ảnh cũ
    //             if(!empty($Old_file)){
    //                 deleteFile($Old_file);
    //             }
    //         }

    //         // var_dump($_POST);
    //         // exit();
    //         // var_dump($ten_danh_muc);
    //         // var_dump($mo_ta);
    //         //validate
    //         // tạo 1 mảng trống để chứa dữ liệu
    //         $errors = [];
    //         if (empty($ten_san_pham)) {
    //             $errors['ten_san_pham'] = 'Tên sản phẩm ko dcd để trống';
    //         }
    //         if (empty($gia_san_pham)) {
    //             $errors['gia_san_pham'] = 'giá sản phẩmko dcd để trống';
    //         }
    //         if (empty($gia_khuyen_mai)) {
    //             $errors['gia_khuyen_mai'] = 'Giá khuyễn mãi ko dcd để trống';
    //         }
    //         if (empty($so_luong)) {
    //             $errors['so_luong'] = 'Số lượng ko dcd để trống';
    //         }
    //         if (empty($ngay_nhap)) {
    //             $errors['ngay_nhap'] = 'Ngày nhập ko dcd để trống';
    //         }
    //         if (empty($danh_muc_id)) {
    //             $errors['danh_muc_id'] = 'danh mục  ko dcd để trống';
    //         }
    //         if (empty($trang_thai)) {
    //             $errors['trang_thai'] = 'trạng thái ko dcd để trống';
    //         }
    //         if (!empty($errors)) {
    //             $_SESSION['errors'] = $errors;
    //             header("Location: " . BASE_URL_ADMIN . '?act=sua_san_pham&id_san_pham=' . $id);
    //             exit();
    //         }

    //         // var_dump($errors);
    //         // nếu không có lỗi thì tiến hành sửa danh mục
    //         if (empty($errors)) {
    //             // var_dump('abc');
    //             // die;
    //             // nếu không có lỗi thì tiến hành sửa danh mục
    //             $this->modelSanPham->updateSanPham($id, $ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $file_thumb);
    //             header("location: " . BASE_URL_ADMIN . '?act=sanpham');
    //             exit();
    //         }else{
    //             // trả về form
    //             $sanpham = [
    //                 ':id' => $id,
    //                 ':ten_san_pham' => $ten_san_pham,
    //                 ':gia_san_pham' => $gia_san_pham,
    //                 ':gia_khuyen_mai' => $gia_khuyen_mai,
    //                 ':so_luong' => $so_luong,
    //                 ':ngay_nhap' => $ngay_nhap,
    //                 ':danh_muc_id' => $danh_muc_id,
    //                 ':trang_thai' => $trang_thai,
    //                 ':mo_ta' => $mo_ta,
    //                 ':hinh_anh' => $hinh_anh,
    //             ];
    //             header("Location: " . BASE_URL_ADMIN . '?act=sua_san_pham&id_san_pham=' . $id);
    //         }

    //     }


    // }

    // // sửa album ảnh 
    // // sửa ảnh cũ
    // // + thêm ảnh mới
    // // + ko thêm ảnh mới
    // // ko sửa ảnh cũ
    // // + thêm ảnh mới
    // // + ko thêm ảnh mới
    // // xóa sửa ảnh cũ
    // // + thêm ảnh mới
    // // + ko thêm ảnh mới
    // public function editablumanhsanpham(){
    //     // var_dump($_SERVER['REQUEST_METHOD']);
    //     // die;
    //     // var_dump('123');
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // var_dump($_FILES);
    //         // die;
    //         $id = $_POST['id'] ?? '';
    //         // lấy danh sách ảnh hiện tại của sản phẩm
    //         $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($id);

    //         // xử lý các ảnh đc gửi về form 
    //         $img_array = $_FILES['img_array']; 
    //         $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
    //         $current_img_ids = $_POST['current_img_ids'] ?? [];

    //         // khai báo mảng để lưu ảnh thêm mới hoặc thây thế
    //         $upload_file = [];

    //         // upload ảnh mới hoặc thây thế ảnh mới 
    //         foreach($img_array['name'] as $key=>$values){
    //             if ($img_array['errors'][$key] == UPLOAD_ERR_OK) {
    //                 $new_file = uploadFileAlbum($img_array, './uploads/', $key);
    //                 if ($new_file) {
    //                     $upload_file[] = [
    //                         'id' => $current_img_ids[$key] ?? null,
    //                         'file' => $new_file
    //                     ];
    //                 }
    //             }
    //         }
    //         //lưu ảnh mới vào database 
    //         foreach($upload_file as $file_info){
    //             if ($file_info['id']) {
    //                 $old_file = $this->modelSanPham->getDetailAnhSanPham($file_info['id'])['link_hinh_anh'];

    //                 // cập nhập ảnh cũ
    //                 $this->modelSanPham->updateAlbumAnhSanPham($file_info['id'], $file_info['file']);

    //                 // xóa ảnh cũ
    //                 deleteFile($old_file);
    //             }else{
    //                 // thêm ảnh mới
    //                 $this->modelSanPham->insertAlbumAnhSanPham($id, $file_info['file']);
    //             }
    //         }

    //         // xử lý xóa ảnh
    //         foreach($listAnhSanPhamCurrent as $anhSP){
    //             $id_anh = $anhSP['id'];
    //             if(in_array($id_anh, $img_delete)){
    //                 // xóa ảnh trogn db
    //                 $this->modelSanPham->destroyAnhSanPham($id_anh);

    //                 // xóa file
    //                 deleteFile($anhSP['link_hinh_anh']);
    //             }
    //         }
    //         header("Location: " . BASE_URL_ADMIN . '?act=sua_san_pham&id_san_pham=' . $id);
    //         exit();
    //     }
    // }

    // public function deleteSanPham(){
    //     ob_start();
    //     $id = $_GET['id_san_pham'];
    //     $sanpham = $this->modelSanPham->getDetailSanPham($id);
    //     $listAnhSanPham= $this->modelSanPham->getListAnhSanPham($id);
    //     if($sanpham){

    //         deleteFile($sanpham['hinh_anh']);

    //         $this->modelSanPham->xoaSanPham($id);
    //         header("location: " . BASE_URL_ADMIN . '?act=sanpham');
    //         exit();
    //     }
    //     if($sanpham){
    //         foreach($listAnhSanPham as $key=>$anh_san_pham){
    //             // var_dump($anh_san_pham['link_hinh_anh']);
    //             deleteFile($anh_san_pham['link_hinh_anh']);
    //             $this->modelSanPham->destroyAnhSanPham($anh_san_pham['id']);
    //         }
    //     }
    //     else{
    //        echo '<script> alert("không xóa đc sản phẩm") ;</script>';
    //        header("location: " . BASE_URL_ADMIN . '?act=sanpham');
    //         exit();
    //     }
    // }
    // public function detailsanpham(){
    //     // ob_start();

    //     $id = $_GET['id_san_pham'];
    //     // var_dump($id);
    //     $sanpham = $this->modelSanPham->getDetailSanPham($id);
    //     $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
    //     // lấy ảnh cũ
    //     // var_dump($listAnhSanPham);
    //     // die;
    //     // var_dump($sanpham);
    //     if($sanpham){
    //         require_once './views/sanpham/detailSanPham.php';    
    //     }else{
    //         header("location: " . BASE_URL_ADMIN . '?act=sanpham');
    //         exit();
    //     }
    // }


}

?>