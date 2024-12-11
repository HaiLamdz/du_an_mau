
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php require_once 'layout/header.php' ?><br>
    <div class="row col-2"  style="float: right;"><a onclick="return confirm('Bạn muốn rời trang đặt mua sản phẩm chứ??')" href="<?= BASE_URL . '?act=danhsachsanpham' ?>"><button class="btn btn-secondary">Home</button></a></div>
    <div>
        <div class="container mt-4">
            <h3>Thông tin thanh toán</h3>
            <div class="row col-12 col-sm-12">
                <div class="col-6 col-sm-6">
                    <form method="POST" enctype="multipart/form-data">
                        <?php
                        // Lấy thông báo lỗi từ session
                        $errors = $_SESSION['errors'] ?? [];
                        // Xóa thông báo lỗi trong session sau khi hiển thị
                        unset($_SESSION['errors']);
                        ?>
                        <input type="hidden" name="tai_khoan_id" value="<?= $_SESSION['user']['id'] ?>">
                        <div class="form-group">
                            <label for="name">Họ và tên:</label>
                            <input type="text" class="form-control" name="ten_nguoi_nhan">
                            <?php if (isset($errors['ten_nguoi_nhan'])) { ?>
                                <p class="text-danger"><?= $errors['ten_nguoi_nhan']  ?></p>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email_nguoi_nhan">
                            <?php if (isset($errors['email_nguoi_nhan'])) { ?>
                                <p class="text-danger"><?= $errors['email_nguoi_nhan']  ?></p>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại:</label>
                            <input type="text" class="form-control" name="sdt_nguoi_nhan">
                            <?php if (isset($errors['sdt_nguoi_nhan'])) { ?>
                                <p class="text-danger"><?= $errors['sdt_nguoi_nhan']  ?></p>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ:</label>
                            <input type="text" class="form-control" name="dia_chi_nguoi_nhan">
                            <?php if (isset($errors['dia_chi_nguoi_nhan'])) { ?>
                                <p class="text-danger"><?= $errors['dia_chi_nguoi_nhan']  ?></p>
                            <?php } ?>
                        </div><div class="form-group">
                            <label>Số Lượng</label>
                            <input type="number" name="so_luong" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Ghi chú</label>
                            <textarea class="form-control" name="ghi_chu" id="" placeholder="Ghi chú"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="ship">Tiền Vận Chuyển:</label>
                            <input type="text" class="form-control" name="ship" value="30,000vnđ" disabled>
                            <input type="hidden" name="don_gia" value="<?= $listProduct['gia_khuyen_mai'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="tong_tien">Thành Tiền:</label>
                            <input type="hidden" name="tong_tien" value="<?= $listProduct['gia_khuyen_mai'] + 30000 ?>">
                            <input type="text" class="form-control"  value="<?= number_format($listProduct['gia_khuyen_mai'] + 30000)  ?>đ" disabled >
                        </div>
                        <div class="form-group">
                            <label for="payment">Phương thức thanh toán:</label>
                            <select class="form-control" name="phuong_thuc_thanh_toan">
                                <option selected disabled>Xin mời chọn phương thức thanh toán</option>
                                <option value="1">Thanh toán khi nhận hàng (COD)</option>
                                <option value="2">VNPay</option>
                                <option value="3">Thẻ tín dụng</option>

                            </select>
                        </div>
                        <?php if (isset($errors['phuong_thuc_thanh_toan'])) { ?>
                            <p class="text-danger"><?= $errors['phuong_thuc_thanh_toan']  ?></p>
                        <?php } ?>
                        <input type="hidden" name="trang_thai">
                        <a href="<?= BASE_URL . '?act=donHang&id_don_hang=' . $listProduct['id']?>"><button type="submit" name="xacnhan" class="btn btn-primary">Xác nhận đơn hàng</button></a>
                    </form>
                </div>
                <div class="col-6 col-sm-6" align="center">
                    <h4 class="my-3"><?= $listProduct['ten_san_pham'] ?></h4>
                    <hr>
                    <img src="<?= $listProduct['hinh_anh'] ?>" style="width: 250px;" alt="">
                    <h4 class="mt-3"><small><del><?= number_format($listProduct['gia_san_pham']) ?>vnđ</del></small></h4>
                    <h4 class="mt-3"><small><?= number_format($listProduct['gia_khuyen_mai']) ?></small>vnđ</h4>
                    <h4 class="mt-3"><small><?= $listProduct['mo_ta'] ?></small></h4>
                    <input type="text" class=" col-12 col-sm-6" id="address" placeholder="Mã giảm giá">
                    <button class="col-sm-3 btn-secondary">Áp Dụng</button>
                </div>


            </div>
        </div>
        <?php require_once 'layout/footer.php' ?>
</body>

</html>