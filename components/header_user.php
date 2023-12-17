<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <?php
        session_start();
        include_once("../components/connection.php");
        $MaThanhVien = $_SESSION['MaThanhVien'];
        if (!isset($_SESSION['MaThanhVien'])) {
            // Nếu phiên làm việc không tồn tại hoặc không có giá trị, chuyển hướng đến trang đăng nhập
            header("Location: login.php");
            exit();
        }
    ?>
</head>
<body>
    <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

    <div class="container">
        <a class="navbar-brand" href="#">Zesty<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item active">
                    <a class="nav-link" href="users_home.php">Trang chủ</a>
                </li>
                <li><a class="nav-link" href="users_shop.php">Nguyên liệu</a></li>
                <li><a class="nav-link" href="users_about_us.php">Khám phá</a></li>
                <li><a class="nav-link" href="users_blog.php">Blog</a></li>
                <li><a class="nav-link" href="users_comment.php">Đánh giá</a></li>
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li><a class="nav-link" href="users_profile.php?id=<?=$_SESSION['MaThanhVien']?>"><img src="../assets/images/user.svg"></a></li>
                <li><a class="nav-link" href="users_cart.php"><img src="../assets/images/cart.svg"></a></li>
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li><a class="nav-link">Welcome, <?php echo $_SESSION['TenDangNhap'] ?></a></li>
            </ul>
        </div>
    </div>
        
    </nav>
</body>
</html>