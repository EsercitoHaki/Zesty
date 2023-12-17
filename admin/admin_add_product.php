<!DOCTYPE html>
<html lang="en">
<head>
    <title>
    Admin Zesty
  </title>
  <?php
    include_once('../components/assets_admin.php');
    include_once('../components/connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $TenSanPham = $_POST['tensanpham'];
        $Gia = $_POST['gia'];
        $DinhLuong = $_POST['dinhluong'];
        $ThongTin = $_POST['thongtin'];
        $MaDanhMuc = $_POST['madanhmuc'];


        $file = $_FILES['filename'];
            $size_allow = 10; //Cho phép 10MB

            //Đổi tên trước khi upload 
            $filename = $file['name'];
            $filename = explode('.', $filename);
            $ext = end($filename);
            $new_file = $_POST['tieude'].'.'.$ext;
            

            $allow_ext = ['png', 'jpg', 'jpeg', 'gif', 'ppt'];
            if(in_array($ext, $allow_ext)){
                //Thoả mãn điều kiện định dạng
                $size = $file['size']/1024/1024; //Đổi từ byte sang MB

                if($size<=$size_allow){
                    //Thoả mãn điều kiện size

                    $upload = move_uploaded_file($file['tmp_name'], '../images/Product/'.$new_file);
                    if(!$upload){
                        $errors = 'upload_err';
                    }
                }else{
                    $errors = 'size_err';
                }
            }else{
                $errors[] = 'ext_err';
            }

        // Thực hiện truy vấn để thêm mới thành viên
        $query = "INSERT INTO thanhvien (TenDangNhap, MatKhau, HoTen, Email, SDT, DiaChiNhanHang) VALUES ('$tendangnhap', '$matkhau', '$hoten', '$email', '$sdt', '$diachi')";
        $result = mysqli_query($conn, $query);

        // Kiểm tra và hiển thị thông báo tương ứng
        if ($result) {
            $message = "Tạo người dùng thành công!";
        } else {
            $message = "Lỗi! Không thể tạo người dùng.";
        }
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
        </div>
    </aside>
        <main class="main-content border-radius-lg ">
            <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">

            </div>
            </nav>

        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <h3>Tạo sản phẩm</h3>
            <?php if (isset($message)) : ?>
                <div class="alert alert-<?php echo ($result) ? 'success' : 'danger'; ?> mt-3">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <div>
                <button type="button" class="btn btn-outline-primary" onclick="location.href='admin_product.php';">Trở về</button>
            </div>
            <form action="" method="post">
                <div class="input-group input-group-static mb-4">
                    <label>Tên sản phẩm</label>
                    <input type="text" name="tensanpham" class="form-control">
                </div>
                <div class="input-group input-group-static mb-4">
                    <label>Giá</label>
                    <input type="text" name="gia" class="form-control">
                </div>
                <div class="input-group input-group-static mb-4">
                    <label>Định lượng</label>
                    <input type="text" name="dinhluong" class="form-control">
                </div>
                <div class="input-group input-group-static mb-4">
                    <label>Thông tin</label>
                    <input type="text" name="thongtin" class="form-control">
                </div>
                <div class="input-group input-group-static mb-4">
                    <label>Ảnh</label>
                    <input type="file" name="filename" class="form-control">
                </div>
                <div class="input-group input-group-static mb-4">
                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Danh mục</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <?php
                                $sqlDM = "SELECT * FROM danhmuc";
                                $resultDanhMuc = $conn->query($sqlDM) or die("Can't get categories");
                                while($rowDanhMuc = $resultDanhMuc->fetch_assoc()){
                                    ?>
                                        <option><?=$rowDanhMuc["MaDanhMuc"]?> - <?=$rowDanhMuc["TenDanhMuc"]?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="input-group input-group-static mb-4">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="hoatdong" id="customRadio1">
                        <label class="custom-control-label" for="customRadio1">Hoạt động</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="ngunghoatdong" id="customRadio2">
                        <label class="custom-control-label" for="customRadio2">Không hoạt động</label>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-outline-primary" onclick="location.href='admin_add_users.php';">Tạo mới</button>
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
    </body>
</html>
