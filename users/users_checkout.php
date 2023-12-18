<?php
include_once('../components/assets.php');
include_once('../components/connection.php');
include_once('../components/header_user.php');

$sqlUser = "SELECT * FROM thanhvien WHERE MaThanhVien = $MaThanhVien";
$resultUser = $conn->query($sqlUser) or die("Can't get recordset");


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
	<title> </title>
</head>

<body>
	<!-- Start Hero Section -->
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>Checkout</h1>
					</div>
				</div>
				<div class="col-lg-7">

				</div>
			</div>
		</div>
	</div>
	<!-- End Hero Section -->

	<div class="untree_co-section">
		<div class="container">
			<div class="row mb-5">
				<div class="col-md-12">

				</div>
			</div>
			<form method="post" action="users_process_checkout.php">
			<?php
    // Create the SQL query
    $query = "SELECT MaGioHang FROM giohang WHERE MaThanhVien = $MaThanhVien";

    // Execute the query
    $resultU = $conn->query($query);

    // Check if the query returned a result
    if ($resultU->num_rows > 0) {
        // Create an array to store MaGioHang values
        $maGioHangArray = array();

        // Fetch all rows from the result
        while ($row = $resultU->fetch_assoc()) {
            // Get MaGioHang from the row
            $maGioHang = $row['MaGioHang'];

            // Store MaGioHang in the array
            $maGioHangArray[] = $maGioHang;

            // Display MaGioHang (optional)
            echo '<input type="text" name="MaGioHang[]" value="' . $maGioHang . '"><br>';
        }

        // Store the array in a hidden input field
        echo '<input type="hidden" name="MaGioHangArray[]" value="' . implode(",", $maGioHangArray) . '">';
    } else {
        echo "No results found";
    }
    ?>
				<input type="hidden" name="MaThanhVien" value="<?php echo $MaThanhVien; ?>">
				
				<input type="hidden" name="ThoiGianDatHang" value="<?php echo date('Y-m-d H:i:s', strtotime('+6 hours')); ?>">
				<div class="row">
					<div class="col-md-6 mb-5 mb-md-0">
						<h2 class="h3 mb-3 text-black">Thông tin</h2>
						<div class="p-3 p-lg-5 border bg-white">
							<?php
							$row = $resultUser->fetch_assoc();
							?>
							<div class="form-group">
								<div class="col-md-12">
									<label for="c_fname" class="text-black">Tên người nhận <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="c_fname" name="TenNguoiNhan" value="<?php echo $row["HoTen"] ?>" required>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-5">
									<label for="c_fname" class="text-black">Số điện thoại <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="c_fname" name="SDT" value="<?php echo $row["SDT"] ?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<label for="c_address" class="text-black">Địa chỉ nhận hàng <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="c_address" name="DiaChiNhanHang" placeholder="Street address" value="<?php echo $row["DiaChi"] ?>">
								</div>
							</div>

							<div class="form-group row mb-5">
								<div class="col-md-12">
									<label for="c_email_address" class="text-black">Email <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="c_email_address" name="Email" value="<?php echo $row["Email"] ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="c_order_notes" class="text-black">Ghi chú</label>
								<textarea name="GhiChu" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Bạn cần gì cứ viết..."></textarea>
							</div>

						</div>
					</div>
					<div class="col-md-6">
						<div class="row mb-5">
							<div class="col-md-12">
								<h2 class="h3 mb-3 text-black">Đơn hàng</h2>
								<div class="p-3 p-lg-5 border bg-white">
									<table class="table site-block-order-table mb-5">
										<thead>
											<th>Tên sản phẩm</th>
											<th>Số lượng</th>
											<th>Định lượng</th>
											<th>Giá</th>
										</thead>
										<tbody>
											<?php
											$totalQuantity = 0;
											$totalPrice = 0;
											$result = $conn->query(
												"   SELECT *
											FROM giohang g 
											JOIN sanpham s ON g.MaSanPham = s.MaSanPham 
											WHERE g.MaThanhVien = " . $_SESSION["MaThanhVien"]
											);
											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													$totalQuantity += $row['SoLuong'];
													$totalPrice += $row['Gia'] * $row['SoLuong'];
											?>
													<tr>
														<td><?php echo $row['TenSanPham']; ?></td>
														<td><?php echo $row['SoLuong']; ?></td>
														<td><?php echo $row['DinhLuong']; ?></td>
														<td><?php echo number_format($row['Gia']); ?>đ</td>
													</tr>
											<?php
												}
											}
											?>
											<tr>
												<td colspan="1">Tổng:</td>
												<td><?php echo $totalQuantity; ?></td>
												<td></td>
												<td><?php echo number_format($totalPrice, 0); ?>đ</td>
											</tr>
										</tbody>
									</table>

									<div class="form-group">
										<label for="c_diff_country" class="text-black">Phương thức thanh toán <span class="text-danger">*</span></label>
										<select id="c_diff_country" name="MaPhuongThuc" class="form-control" style="margin-top: 10px; margin-bottom: 10px;">
											<?php
											$result = $conn->query("SELECT * FROM phuongthucthanhtoan WHERE TrangThai = 1");
											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													echo '<option value="' . $row['MaPhuongThuc'] . '">' . $row['TenPhuongThuc'] . '</option>';
												}
											}
											?>
										</select>
									</div>




									<div class="form-group">
										<input type="submit" value="Đặt đơn luôn" class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='users_process_checkout.php'">
									</div>

								</div>
							</div>
						</div>

					</div>
				</div>
				<!-- </form> -->
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