<nav style="position: fixed; width: 100%; z-index:1000; min-height: 70px;" class="navbar navbar-expand-sm bg-dark navbar-dark ">
    <ul style="margin-left: 200px;" class="navbar-nav col-8">
        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL . '?act=danhsachsanpham' ?>"><i class="nav-icon fa-solid fa-house-chimney"></i>Trang chủ</a></li>
        <li class="nav-item">
            <a class="nav-link" href=""><i class="fas fa-vest"></i>Sản phẩm</a>
            <ul class="submenu">
                <li><a href="<?= BASE_URL . '?act=aoThun' ?>">Áo Thun</a></li>
                <li><a href="<?= BASE_URL . '?act=aoSoMi' ?>">T-Shift</a></li>
                <li><a href="<?= BASE_URL . '?act=quanJean' ?>">Quần Jeans</a></li>
                <li><a href="<?= BASE_URL . '?act=aoPolo' ?>">Áo Polo</a></li>
                <li><a href="<?= BASE_URL . '?act=aoKhoac' ?>">Áo Khoác Gió</a></li>
            </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="contact.html"><i class="fa-solid fa-square-phone-flip"></i>Liên hệ</a></li>
        <li class="nav-item"><a class="nav-link" href="cart.html"><i class="fa-solid fa-cart-arrow-down"></i>Giỏ hàng</a></li>
    </ul>
    <ul class="navbar-nav col-3">
        <li style="margin-top: 8px;" class="nav-item">
            <form action="<?= BASE_URL . '?act=search' ?>" method="POST" enctype="multipart/form-data">
                <input name="keysearch" style="width: 200px; border-radius: 7px; box-shadow: 0px;" type="text" placeholder="Nhập sản phẩm tìm kiếm..." require>
                <button name="search" style="border: 0px; border-radius: 3px;"><i class="nav-icon fa-solid fa-magnifying-glass"></i></button>
            </form>
        </li>
        <li class="nav-item"><a onclick="return confirm('Bạn có muốn đăng xuất hay không??')" class="nav-link" href="<?= BASE_URL . '?act=logout' ?>"><button>Đăng Xuất</button></a></li>
    </ul>
</nav>
<div style="height: 90px;"></div>

