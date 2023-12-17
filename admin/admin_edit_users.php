<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Zesty</title>
    <?php
        include_once('../components/assets_admin.php');
        include_once('../components/connection.php');
        

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Xử lý khi form được submit
            $id = $_GET['id'];
            $tendangnhap = $_POST['tendangnhap'];
            $matkhau = $_POST['matkhau'];
            $hoten = $_POST['hoten'];
            $email = $_POST['email'];
            $sdt = $_POST['sdt'];
            $diachi = $_POST['diachi'];

            // Thực hiện truy vấn để cập nhật thông tin thành viên
            $query = "UPDATE thanhvien SET TenDangNhap = '$tendangnhap', MatKhau = '$matkhau', HoTen = '$hoten', Email = '$email', SDT = '$sdt', DiaChiNhanHang = '$diachi' WHERE MaThanhVien = '$id'";
            $result = mysqli_query($conn, $query);

            // Kiểm tra và hiển thị thông báo tương ứng
            if ($result) {
                $message = "Cập nhật thông tin người dùng thành công!";
            } else {
                $message = "Lỗi! Không thể cập nhật thông tin người dùng.";
            }
        } else {
            // Nếu không phải là form submit, truy xuất thông tin cũ từ cơ sở dữ liệu
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $query = "SELECT * FROM thanhvien WHERE MaThanhVien = '$id'";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $tendangnhap = $row['TenDangNhap'];
                    $matkhau = $row['MatKhau'];
                    $hoten = $row['HoTen'];
                    $email = $row['Email'];
                    $sdt = $row['SDT'];
                    $diachi = $row['DiaChiNhanHang'];
                }
            }
        }
    ?>
</head>

<body class="g-sidenav-show bg-gray-100">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
            <img src="../assets_admin/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">Zesty</span>
            </a>
        </div>
        
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link text-white active bg-gradient-primary" href="admin_users_list.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1">Quản lý người dùng</span>
            </a>
            </li>
        
            <li class="nav-item">
            <a class="nav-link text-white " href="admin_product.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1">Quản lý sản phẩm</span>
            </a>
            </li>

            <li class="nav-item">
            <a class="nav-link text-white " href="admin_category.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1">Quản lý danh mục</span>
            </a>
            </li>

            <li class="nav-item">
            <a class="nav-link text-white " href="admin_cart.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1">Quản lý đơn hàng</span>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white " href="admin_blog.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1">Quản lý blog</span>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white " href="admin_comment.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1">Quản lý đánh giá</span>
            </a>
            </li>
        </div>
        </aside>
        <main class="main-content border-radius-lg ">
            <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">

            </div>
            </nav>
        <div class="container-fluid py-4">
            <h3>Cập nhật người dùng</h3>
            <?php if (isset($message)) : ?>
                <div class="alert alert-<?php echo ($result) ? 'success' : 'danger'; ?> mt-3">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <div>
                <button type="button" class="btn btn-outline-primary" onclick="location.href='admin_users_list.php';">Trở về</button>
            </div>
            <form action="" method="post">
                <!-- Các trường input với giá trị mặc định là thông tin cũ -->
                <div class="input-group input-group-static mb-4">
                    <label>Tên đăng nhập</label>
                    <input type="text" name="tendangnhap" class="form-control" value="<?php echo $tendangnhap; ?>">
                </div>
                <div class="input-group input-group-static mb-4">
                    <label>Mật khẩu</label>
                    <input type="text" name="matkhau" class="form-control" value="<?php echo $matkhau; ?>">
                </div>
                <div class="input-group input-group-static mb-4">
                    <label>Họ tên</label>
                    <input type="text" name="hoten" class="form-control" value="<?php echo $hoten; ?>">
                </div>
                <div class="input-group input-group-static mb-4">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                </div>
                <div class="input-group input-group-static mb-4">
                    <label>Số điện thoại</label>
                    <input type="text" name="sdt" class="form-control" value="<?php echo $sdt; ?>">
                </div>
                <div class="input-group input-group-static mb-4">
                    <label>Địa chỉ</label>
                    <input type="text" name="diachi" class="form-control" value="<?php echo $diachi; ?>">
                </div>
                <div>
                    <button type="submit" class="btn btn-outline-primary">Cập nhật</button>
                </div>
            </form>
        </div>
          <!--   Core JS Files   -->
        <script src="../assets_admin/js/core/popper.min.js" ></script>
        <script src="../assets_admin/js/core/bootstrap.min.js" ></script>
        <script src="../assets_admin/js/plugins/perfect-scrollbar.min.js" ></script>
        <script src="../assets_admin/js/plugins/smooth-scrollbar.min.js" ></script>

        <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
            damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
        </script>
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script src="../assets_admin/js/material-dashboard.min.js?v=3.1.0"></script>
        </main>
    </body>
</html>
