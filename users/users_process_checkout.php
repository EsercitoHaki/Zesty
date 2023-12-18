<?php
$MaThanhVien = $_POST['MaThanhVien'];
$TrangThai = 0;
$ThoiGianDatHang = date("Y-m-d H:i:s");
$MaPhuongThuc = $_POST['MaPhuongThuc'];
$MaGioHangArray = $_POST['MaGioHang']; // Retrieve the array from the hidden input
$TenNguoiNhan = $_POST['TenNguoiNhan'];
$DiaChiNhanHang = $_POST['DiaChiNhanHang'];
$SDT = $_POST['SDT'];
$GhiChu = $_POST['GhiChu'];

include_once('../components/connection.php');
if (isset($_POST['MaGioHang'], $_POST['SoLuong'], $_POST['Gia']) && is_array($_POST['MaGioHang']) && is_array($_POST['SoLuong']) && is_array($_POST['Gia'])) {
    foreach ($_POST['MaGioHang'] as $key => $maGioHang) {
        // Insert into donhang table
        $query = "INSERT INTO donhang (MaThanhVien, MaGioHang, TrangThai, ThoiGianDatHang, TenNguoiNhan, DiaChiNhanHang, SDT, GhiChu, MaPhuongThuc) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iisssssss", $MaThanhVien, $maGioHang, $TrangThai, $ThoiGianDatHang, $TenNguoiNhan, $DiaChiNhanHang, $SDT, $GhiChu, $MaPhuongThuc);
        $stmt->execute();

        // Get the ID of the last inserted row
        $MaDonHang = $conn->insert_id;

        // Insert into ctdonhang table
        $query = "INSERT INTO ctdonhang (MaDonHang, MaSanPham, MaGioHang, SoLuong, GiaMoiSP) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $MaSanPham = $_POST['MaSanPham'][$key];
        $SoLuong = $_POST['SoLuong'][$key];
        $GiaMoiSP = $SoLuong * $_POST['Gia'][$key];
        $stmt->bind_param("iiidi", $MaDonHang, $MaSanPham, $maGioHang, $SoLuong, $GiaMoiSP);
        $stmt->execute();
    }
}
?>

<?php
include_once('../components/header_user.php');
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Untree.co">
	<link rel="shortcut icon" href="favicon.png">

	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap4" />

	<!-- Bootstrap CSS -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="../assets/css/tiny-slider.css" rel="stylesheet">
	<link href="../assets/css/style.css" rel="stylesheet">
	<title>Cảm ơn </title>
</head>

<body>


	<!-- Start Hero Section -->

	<!-- End Hero Section -->



	<div class="untree_co-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center pt-5">
					<span class="display-3 thankyou-icon text-primary">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-check mb-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M11.354 5.646a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708 0z" />
							<path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
						</svg>
					</span>
					<h2 class="display-3 text-black">Cảm ơn ạ!</h2>
					<p class="lead mb-5">Đơn của bạn đặt xong rồi đó.</p>
					<p><a href="users_shop.php" class="btn btn-sm btn-outline-black">Quay về đặt tiếp luôn</a></p>
				</div>
			</div>
		</div>
	</div>
	<footer class="footer-section">
		<div class="container relative">

			<div class="sofa-img">
				<img src="../images/Product/cuoitrang.png" alt="Image" class="img-fluid">
			</div>

			<div class="row">
				<div class="col-lg-8">
					<div class="subscription-form">
						<h3 class="d-flex align-items-center"><span class="me-1"><img src="../assets/images/envelope-outline.svg" alt="Image" class="img-fluid"></span><span>Đăng ký thôi bạn ơi</span></h3>

						<form action="#" class="row g-3">
							<div class="col-auto">
								<input type="text" class="form-control" placeholder="Điền tên của bạn">
							</div>
							<div class="col-auto">
								<input type="email" class="form-control" placeholder="Email nữa">
							</div>
							<div class="col-auto">
								<button class="btn btn-primary">
									<span class="fa fa-paper-plane"></span>
								</button>
							</div>
						</form>

					</div>
				</div>
			</div>

			<div class="row g-5 mb-5">
				<div class="col-lg-4">
					<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Zesty<span>.</span></a></div>
					<p class="mb-4">Zesty - Người bạn đồng hành tuyệt vời nhất của bạn trong hành trình ngon miệng.</p>

				</div>

				<div class="col-lg-8">
					<div class="row links-wrap">
						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#">Nguyên liệu</a></li>
								<li><a href="#">Combo</a></li>
							</ul>
						</div>

						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#">Blog</a></li>
								<li><a href="#">Liên hệ</a></li>
							</ul>
						</div>

						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#">Hỗ trợ</a></li>
								<li><a href="#">Kho thông tin</a></li>
							</ul>
						</div>

						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#">Live chat</a></li>
								<li><a href="#">Thông tin</a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>
	</footer>
	<!-- End Footer Section -->


	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/tiny-slider.js"></script>
	<script src="js/custom.js"></script>
</body>

</html>