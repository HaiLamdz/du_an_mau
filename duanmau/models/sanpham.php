<?php
class SanPham
{
    public $conn; // Khai báo phương thức 

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // viết hàm lấy toàn bộ danh sách snar phẩm
    public function getallProduct()
    {
        try {
            $sql = 'SELECT * FROM san_phams';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "loi" . $e->getMessage();
        }
    }
    public function getDetailSanPham($id)
    {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc 
                        FROM san_phams
                        INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                        WHERE san_phams.id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
    public function getListAnhSanPham($id)
    {
        try {
            $sql = 'SELECT * FROM hinh_anh_san_phams WHERE san_pham_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
    public function getAllSanPham1($id)
    {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc 
                        FROM san_phams
                        INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                        WHERE san_phams.danh_muc_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
    public function checkAcc($user, $pass)
    {
        try {
            $sql = "SELECT * FROM tai_khoans WHERE email = :email AND mat_khau = :mat_khau";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'email' => $user,
                'mat_khau' => $pass
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function ThanhToan($id)
    {
        try {
            $sql = 'SELECT * FROM san_phams WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'id' => $id,
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "loi" . $e->getMessage();
        }
    }

    public function getAllBinhLuan($id)
    {
        try {
            $sql = 'SELECT binh_luans.*, tai_khoans.ho_ten
                        FROM binh_luans
                        INNER JOIN tai_khoans ON binh_luans.tai_khoan_id= tai_khoans.id
                        INNER JOIN san_phams ON binh_luans.san_pham_id= san_phams.id
                        WHERE binh_luans.san_pham_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
    public function insertBinhLuan($san_pham_id, $tai_khoan_id, $noi_dung)
    {
        try {
            $sql = 'INSERT INTO binh_luans (san_pham_id, tai_khoan_id, noi_dung, ngay_dang)
                VALUES (:san_pham_id, :tai_khoan_id, :noi_dung, :ngay_dang)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':tai_khoan_id' => $tai_khoan_id,
                ':noi_dung' => $noi_dung,
                ':ngay_dang' => date('Y-m-d H:i:s')
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

        public function buy_product($tai_khoan_id, $ten_nguoi_nhan, $email_nguoi_nhan, $sdt_nguoi_nhan, $dia_chi_nguoi_nhan, $tong_tien, $ghi_chu, $phuong_thuc_thanh_toan_id){
            try {
                $trang_thai_id = 1;
                $sql = 'INSERT INTO don_hangs (tai_khoan_id, ten_nguoi_nhan, email_nguoi_nhan, sdt_nguoi_nhan, dia_chi_nguoi_nhan, ngay_dat, tong_tien, ghi_chu, phuong_thuc_thanh_toan_id, trang_thai_id)
                        VALUES (:tai_khoan_id, :ten_nguoi_nhan, :email_nguoi_nhan, :sdt_nguoi_nhan, :dia_chi_nguoi_nhan, :ngay_dat, :tong_tien, :ghi_chu, :phuong_thuc_thanh_toan_id, :trang_thai_id)';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    ':trang_thai_id' => $trang_thai_id,
                    ':tai_khoan_id' => $tai_khoan_id,
                    ':ten_nguoi_nhan' => $ten_nguoi_nhan,
                    ':email_nguoi_nhan' => $email_nguoi_nhan,
                    ':sdt_nguoi_nhan' => $sdt_nguoi_nhan,
                    ':dia_chi_nguoi_nhan' => $dia_chi_nguoi_nhan,
                    ':ngay_dat' => date('Y-m-d H:i:s'),
                    ':tong_tien' => $tong_tien,
                    ':ghi_chu' => $ghi_chu,
                    ':phuong_thuc_thanh_toan_id' => $phuong_thuc_thanh_toan_id,
                ]);
                // lấy id sản phẩm vừa thêmm
                $lastInsertId =  $this->conn->lastInsertId();
                // var_dump($lastInsertId);die;
                // return $lastInsertId;
                // viết câu truy vấn đơn hàng
                $sql = 'SELECT * FROM don_hangs WHERE id = :id';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    ':id' => $lastInsertId,
                ]);
                $detailDon = $stmt->fetch();    
                return [
                    'id' => $lastInsertId,
                    'detailDon' => $detailDon
                ];
                // return $stmt->fetchAll();
            } catch (Exception $e) {
                echo "lỗi" . $e->getMessage();
            }
        }
    public function addDetailDonHang($don_hang_id, $san_pham_id, $don_gia, $so_luong, $tong_tien) {
        try {
            $sql = 'INSERT INTO chi_tiet_don_hangs (don_hang_id, san_pham_id,don_gia, so_luong,  thanh_tien) 
                           VALUES (:don_hang_id, :san_pham_id, :don_gia, :so_luong,  :thanh_tien)';
    
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    ':don_hang_id' => $don_hang_id,
                    ':san_pham_id' =>$san_pham_id,
                    ':don_gia' => $don_gia,
                    ':so_luong' => $so_luong,
                    ':thanh_tien' => $tong_tien,
                ]);
                return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }


    public function getDetailDonHang($id) {
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
    

    public function getListSPDonHang($id){
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
    
    public function getAllTrangThaiDonHang(){
        try {
            $sql = 'SELECT * FROM trang_thai_don_hangs';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    } 
    
    public function getAllSearch($keySearch) {
        try {
            $sql = "SELECT * FROM san_phams WHERE ten_san_pham LIKE :keySearch OR mo_ta LIKE :keySearch";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':keySearch' => '%' . $keySearch . '%',
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'lỗi' . $e;
        }
    }
    
    
}
