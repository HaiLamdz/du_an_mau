<?php
    class DanhMuc{
        public $conn;

        public function __construct()
        {
            $this->conn = connectDB();
        }
        public function getAllDanhMuc(){
            try {
                $sql = 'select * from danh_mucs';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                return $stmt->fetch();
            } catch (Exception $e) {
                echo "lỗi" . $e->getMessage();
            }
        }
    }

?>