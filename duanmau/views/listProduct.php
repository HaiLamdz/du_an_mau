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
    

    <div class="col-12">
        <img style="width: 100%; object-fit: cover; " src="./assets/img/banner2.jpg" alt="lỗi anbhe">
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div style="background-color: grey;" class="jumbotron text-center">
                    <h2>Chào mừng đến với HaiLam Store!</h2>
                    <p>Khám phá bộ sưu tập thời trang mới nhất của chúng tôi.</p>
                </div>

            </div>
        </div>
        <div class="row">
            <?php foreach ($listProduct as $key => $row) { ?>
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top product-img" src="<?= $row['hinh_anh'] ?>" alt="Product 1">
                        <div class="card-body">
                            <h3 class="card-title"><?= $row['ten_san_pham'] ?></h3>
                            <h4 class="card-text grey"><del><?= number_format($row['gia_san_pham']) ?>đ</del></h4>
                            <h2 class="card-text red"><?= number_format($row['gia_khuyen_mai']) ?>đ</h2>
                            <a href="<?= BASE_URL  . '?act=detail_san_pham&id_san_pham=' . $row['id'] ?>" class="detail">Chi Tiết</a>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
        <?php require_once 'layout/footer.php' ?>
</body>

</html>