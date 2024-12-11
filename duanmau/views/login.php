<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/login.css">
</head>

<body>
    <?php
    $errors = $_SESSION['errors'] ?? [];
    unset($_SESSION['errors']);
    ?>
    <div style="width: 500px; " class="login">
        <form action="" method="POST" enctype="multipart/form-data">
            <h2>Hello!!</h2>
            <span style="font-size: 20px;">Chào Mừng Bạn Đến Với HaiLam Store</span>
            <br>
            <br>
            <div class="inputBox">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="user" placeholder="Email">
            </div>
            <div class="inputBox">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="pass" placeholder="Passwork">
            </div>
            <label for="">
                <input type="checkbox">Ghi Nhớ Mật Khẩu
            </label>
            <div class="inputBox">
                <input type="submit" name="login" value="Log In">
            </div>
            <?php if (isset($errors['login'])) {
            ?>
                <p style="color: red; font-weight: 500; margin-top: 30px;" align="center" class="text-danger"><?= $errors['login']  ?></p>
            <?php
            } ?>
        </form>
        <br>
        <h4 align="center">Hoặc</h4>

        <br>
        <div class="fingerprint">
            <i class="fa-brands fa-google"></i>
            <p>Login With google</p>
        </div>
    </div>
</body>

</html>