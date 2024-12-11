<?php

class AdminDonHang
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllDonHang()
    {
        try {
            $sql = 'SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai
                        FROM don_hangs
                        INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
            return null; // Hoặc xử lý ngoại lệ ở đây, ví dụ: throw $e;
        }
    }

    public function getAllTrangThaiDonHang()
    {
        try {
            $sql = 'SELECT * FROM trang_thai_don_hangs';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function updateDonHang($id, $trang_thai_id)
    {
        try {
            $sql = 'UPDATE don_hangs SET trang_thai_id = :trang_thai_id WHERE id = :id ';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':trang_thai_id' => $trang_thai_id,
                ':id' => $id
            ]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function getDetailDonHang($id)
    {
        try {
            // $sql = 'SELECT * FROM don_hangs WHERE id = :id';
            // Truy vấn SQL để lấy chi tiết đơn hàng
            $sql = 'SELECT don_hangs.*, 
                               trang_thai_don_hangs.ten_trang_thai, 
                               tai_khoans.ho_ten, 
                               tai_khoans.email, 
                               tai_khoans.so_dien_thoai, 
                               phuong_thuc_thanh_toans.ten_phuong_thuc
                        FROM don_hangs
                        INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
                        INNER JOIN tai_khoans ON don_hangs.tai_khoan_id = tai_khoans.id
                        INNER JOIN phuong_thuc_thanh_toans ON don_hangs.phuong_thuc_thanh_toan_id = phuong_thuc_thanh_toans.id
                        WHERE don_hangs.id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            // if(($stmt->fetch()) === false ){
            //     var_dump($stmt->errorInfo()); 
            //     die;
            // }else{
            //     echo 'okokok';
            // }
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }


    public function getListSPDonHang($id)
    {
        try {
            $sql = 'SELECT chi_tiet_don_hangs.*, san_phams.ten_san_pham 
                FROM chi_tiet_don_hangs
                INNER JOIN san_phams ON chi_tiet_don_hangs.san_pham_id = san_phams.id
                WHERE chi_tiet_don_hangs.don_hang_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function getDonHangOfKhachHang($id)
    {
        try {
            $sql = 'SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai 
                        FROM don_hangs
                        INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
                        WHERE don_hangs.tai_khoan_id = :id ';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return $stmt;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
            return null; // Hoặc xử lý ngoại lệ ở đây, ví dụ: throw $e;
        }
    }


    // public function insertSanPham($ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh){
    //     try {
    //         $sql = 'INSERT INTO san_phams (ten_san_pham, gia_san_pham, gia_khuyen_mai, so_luong, ngay_nhap, danh_muc_id, trang_thai, mo_ta, hinh_anh)
    //                    VALUE (:ten_san_pham, :gia_san_pham, :gia_khuyen_mai, :so_luong, :ngay_nhap, :danh_muc_id, :trang_thai, :mo_ta, :hinh_anh)';
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute([
    //             ':ten_san_pham' => $ten_san_pham,
    //             ':gia_san_pham' => $gia_san_pham,
    //             ':gia_khuyen_mai' => $gia_khuyen_mai,
    //             ':so_luong' => $so_luong,
    //             ':ngay_nhap' => $ngay_nhap,
    //             ':danh_muc_id' => $danh_muc_id,
    //             ':trang_thai' => $trang_thai,
    //             ':mo_ta' => $mo_ta,
    //             ':hinh_anh' => $hinh_anh,
    //         ]);
    //         // lấy id sản phẩm vừa thêmm
    //         return $this->conn->lastInsertId();
    //     } catch (Exception $e) {
    //         echo "lỗi" . $e->getMessage();
    //     }
    // }
    // public function insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh){
    //     try {
    //         $sql = 'INSERT INTO hinh_anh_san_phams (san_pham_id, link_hinh_anh)
    //                    VALUE (:san_pham_id, :link_hinh_anh)';
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute([
    //             ':san_pham_id' => $san_pham_id,
    //             ':link_hinh_anh' => $link_hinh_anh,
    //         ]);
    //         // lấy id sản phẩm vừa thêmm
    //         return true;
    //     } catch (Exception $e) {
    //         echo "lỗi" . $e->getMessage();
    //     }
    // }


    // public function getListAnhSanPham($id){
    //     try {
    //         $sql = 'SELECT * FROM hinh_anh_san_phams WHERE san_pham_id = :id';
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute([
    //             ':id' => $id,
    //         ]);
    //         return $stmt->fetchAll();
    //     } catch (Exception $e) {
    //         echo "lỗi" . $e->getMessage();
    //     }
    // }

    // public function getDetailAnhSanPham($id){
    //     try {
    //         $sql = 'SELECT * FROM hinh_anh_san_phams WHERE id = :id';
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute([
    //             ':id' => $id,
    //         ]);
    //         return $stmt->fetch();
    //     } catch (Exception $e) {
    //         echo "lỗi" . $e->getMessage();
    //     }
    // }
    // public function updateAlbumAnhSanPham($id, $new_file){
    //     try {
    //         $sql = 'UPDATE hinh_anh_san_phams SET link_hinh_anh = :new_file WHERE id = :id';
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute([
    //             ':id' => $id,
    //             ':link_hinh_anh' => $new_file
    //         ]);
    //         return true;
    //     } catch (Exception $e) {
    //         echo "lỗi" . $e->getMessage();
    //     }
    // }

    // public function destroyAnhSanPham($id){
    //     try {
    //         $sql = 'DELETE FROM  hinh_anh_san_phams WHERE id = :id';
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute([
    //             ':id' => $id
    //         ]);
    //         return true;
    //     } catch (Exception $e) {
    //         echo "lỗi" . $e->getMessage();
    //         return false;
    //     }
    // }

    // public function updateSanPham($id, $ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh){
    //     try {
    //         if (empty($hinh_anh)) {
    //             $sql = 'UPDATE san_phams SET ten_san_pham = :ten_san_pham, gia_san_pham = :gia_san_pham, gia_khuyen_mai = :gia_khuyen_mai, so_luong = :so_luong, ngay_nhap = :ngay_nhap, danh_muc_id = :danh_muc_id, trang_thai = :trang_thai, mo_ta = :mo_ta WHERE id = :id';
    //             $params = [
    //                 ':id' => $id,
    //                 ':ten_san_pham' => $ten_san_pham,
    //                 ':gia_san_pham' => $gia_san_pham,
    //                 ':gia_khuyen_mai' => $gia_khuyen_mai,
    //                 ':so_luong' => $so_luong,
    //                 ':ngay_nhap' => $ngay_nhap,
    //                 ':danh_muc_id' => $danh_muc_id,
    //                 ':trang_thai' => $trang_thai,
    //                 ':mo_ta' => $mo_ta
    //             ];
    //         } else {
    //             $sql = 'UPDATE san_phams SET ten_san_pham = :ten_san_pham, gia_san_pham = :gia_san_pham, gia_khuyen_mai = :gia_khuyen_mai, so_luong = :so_luong, ngay_nhap = :ngay_nhap, danh_muc_id = :danh_muc_id, trang_thai = :trang_thai, mo_ta = :mo_ta, hinh_anh = :hinh_anh WHERE id = :id';
    //             $params = [
    //                 ':id' => $id,
    //                 ':ten_san_pham' => $ten_san_pham,
    //                 ':gia_san_pham' => $gia_san_pham,
    //                 ':gia_khuyen_mai' => $gia_khuyen_mai,
    //                 ':so_luong' => $so_luong,
    //                 ':ngay_nhap' => $ngay_nhap,
    //                 ':danh_muc_id' => $danh_muc_id,
    //                 ':trang_thai' => $trang_thai,
    //                 ':mo_ta' => $mo_ta,
    //                 ':hinh_anh' => $hinh_anh
    //             ];
    //         }
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute($params);
    //         return true;
    //     } catch (Exception $e) {
    //         echo "lỗi" . $e->getMessage();
    //     }
    // }

    // public function xoaSanPham($id){
    //     try {
    //         $sql = 'DELETE FROM  san_phams WHERE id = :id';
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute([
    //             ':id' => $id
    //         ]);
    //         return true;
    //     } catch (Exception $e) {
    //         echo "lỗi" . $e->getMessage();
    //         return false;
    //     }
    // }

}
