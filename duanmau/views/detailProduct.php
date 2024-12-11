<?php 
    // Giả sử bạn đã xác thực người dùng thành công và có $user chứa thông tin người dùng từ cơ sở dữ liệu

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php require_once 'layout/header.php' ?>
    <?php require_once 'layout/nav.php' ?>
    <div class="container">
        <section class="content">

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="col-12">
                                <img src="<?= BASE_URL . $sanpham['hinh_anh'] ?>" class="product-image" style="max-width: 400px; height: auto;" alt="Product Image">
                            </div>
                            <div class="col-12 product-image-thumbs">
                                <?php foreach ($listAnhSanPham as $key => $anh_SP) {
                                ?>
                                    <div class="product-image-thumb <?= $anh_SP[$key] == 0 ? 'active' : '' ?> "><img src="<?= BASE_URL . $anh_SP['link_hinh_anh'] ?>" alt="Product Image"></div>
                                <?php
                                } ?>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6">
                            <h4 class="my-3">Tên Sản Phẩm: <?= $sanpham['ten_san_pham'] ?></h4>

                            <hr>
                            <h4 class="mt-3">Giá Tiền: <small><?= number_format($sanpham['gia_san_pham']) ?></small></h4>
                            <h4 class="mt-3">Giá khuyến mãi: <small><?= number_format($sanpham['gia_khuyen_mai']) ?></small></h4>
                            <h4 class="mt-3">Số lượng: <small><?= $sanpham['so_luong'] ?></small></h4>
                            <h4 class="mt-3">Lượt xem: <small><?= $sanpham['luot_xem'] ?></small></h4>
                            <h4 class="mt-3">Danh mục: <small><?= $sanpham['ten_danh_muc'] ?></small></h4>
                            <h4 class="mt-3">Trang thái: <small><?= $sanpham['trang_thai'] == 1 ? 'Còn bán' : 'Dừng bán' ?></small></h4>
                            <h4 class="mt-3">Mô tả: <small><?= $sanpham['mo_ta'] ?></small></h4>
                            <div class="col-6 col-sm-12">
                                <a href="<?= BASE_URL . '?act=checkout&id_san_pham=' . $sanpham['id'] ?>"> <button type="submit" class="btn btn-primary col-6 col-sm-12">Mua Ngay</button></a>
                            </div>
                        </div>

                    </div>
                    <div class="container">
                        <nav class="w-100">
                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#comment" role="tab" aria-controls="product-desc" aria-selected="true">Bình luận sản phẩm</a>
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="comment" role="tabpanel" aria-labelledby="product-desc-tab">
                                <div class="container">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tên Người bình luận</th>
                                                <th>Nội dung</th>
                                                <th>Ngày đăng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($listBinhLuan as $key => $row) { ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= $row['ho_ten'] ?></td>
                                                <td><?= $row['noi_dung'] ?></td>
                                                <td><?= $row['ngay_dang'] ?></td>
                                                
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <form action="<?= BASE_URL . '?act=them_binh_luan' ?>" method="POST" enctype="multipart/form-data">
                                <div class="col-12">
                                    <label>Nội dung bình luận</label>
                                    <div>
                                        <textarea name="mo_ta" class="form-control" id="" placeholder="Nhập mô tả"></textarea>
                                        <!-- <input class="form-control" name="mo_ta" id=""> -->
                                    </div>
                                </div>
                                <div style="margin-top: 20px; float: right; ">
                                <input type="hidden" name="san_pham_id" value="<?= $sanpham['id'] ?>">
                                <input type="hidden" name="tai_khoan_id" value="<?= $_SESSION['user']['id'] ?>">
                                <button type="submit" name="comment" class="btn btn-primary">Submit</button>
                                </div>

                        </form>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <?php require_once 'layout/footer.php' ?>
</body>
<script>
    $(document).ready(function() {
        $('.product-image-thumb').on('click', function() {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
    })
</script>

</html>