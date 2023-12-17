<!DOCTYPE html>
<html lang="en">
<head>
    <title>
    Admin Zesty
  </title>
  <?php
    include_once('../components/assets_admin.php');
    include_once('../components/connection.php');
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        $result = isset($_GET['result']) ? $_GET['result'] : 'danger';
    }
  ?>
</head>

<body class="g-sidenav-show  bg-gray-100">

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
            <a class="nav-link text-white " href="admin_users_list.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1">Quản lý người dùng</span>
            </a>
            </li>
        
            <li class="nav-item">
            <a class="nav-link text-white active bg-gradient-primary" href="admin_product.php">
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

        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <h3>Danh sách sản phẩm</h3>
            <div>
                <button type="button" class="btn btn-outline-primary" onclick="location.href='admin_add_product.php';">Tạo mới</button>
            </div>
            <?php if (isset($message)) : ?>
                <div class="alert alert-<?php echo ($result) ? 'success' : 'danger'; ?> mt-3">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">#</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên sản phẩm</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Giá</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Định lượng</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Thông Tin</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ảnh</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Trạng thái</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mã danh mục</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT SanPham.MaSanPham, SanPham.TenSanPham, SanPham.Gia, SanPham.DinhLuong, SanPham.ThongTin, SanPham.Anh, SanPham.TrangThai, SanPham.MaDanhMuc, DanhMuc.TenDanhMuc
                                        FROM SanPham
                                        JOIN DanhMuc ON SanPham.MaDanhMuc = DanhMuc.MaDanhMuc";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['MaSanPham'] . "</td>";
                                    echo "<td>" . $row['TenSanPham'] . "</td>";
                                    echo "<td>" . $row['Gia'] . "</td>";
                                    echo "<td>" . $row['DinhLuong'] . "</td>";
                                    echo "<td>" . $row['ThongTin'] . "</td>";
                                    echo "<td><img src='../images/product/" . $row['Anh'] . "' alt='Product Image'></td>";

                                    // Hiển thị trạng thái
                                    echo "<td>" . ($row['TrangThai'] == 1 ? 'Đang hoạt động' : 'Không hoạt động') . "</td>";

                                    echo "<td>" . $row['MaDanhMuc'] . "-" . $row['TenDanhMuc'] . "</td>";
                                    echo "<td><a href='admin_edit_product.php?id=" . $row['MaSanPham'] . "'>Sửa</a> | <a href='admin_delete_product.php?id=" . $row['MaSanPham'] . "'>Xóa</a></td>";
                                    echo "</tr>";
                                }

                                mysqli_free_result($result);
                            } else {
                                echo "Error: " . mysqli_error($conn);
                            }

                            // Close the connection
                            mysqli_close($conn);
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
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
    </body>
</html>
