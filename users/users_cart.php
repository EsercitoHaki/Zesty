<!doctype html>
<html lang="en">

<head>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<?php

	include_once('../components/assets.php');
	include_once('../components/connection.php');
	include_once('../components/header_user.php');
	$sql = "SELECT
		giohang.MaGioHang,
		thanhvien.MaThanhVien,
		sanpham.Anh,
		sanpham.TenSanPham,
		sanpham.Gia,
		giohang.SoLuong,
		(giohang.SoLuong * sanpham.Gia) AS Tong
		FROM
		giohang
		JOIN
		thanhvien ON giohang.MaThanhVien = thanhvien.MaThanhVien
		JOIN
		sanpham ON giohang.MaSanPham = sanpham.MaSanPham;";

	$result = $conn->query($sql) or die("Can't get recordset");

	if (isset($_POST['action'])) {
		switch ($_POST['action']) {
			case "add":
				if (isset($_POST["SoLuong"]) && isset($_GET["MaMonAn"])) {
					$MaMonAn = $_GET["MaMonAn"];
					$SoLuong = $_POST["SoLuong"];

					// Fetch the item details from the database
					$sql = "SELECT * FROM MonAn WHERE MaMonAn = ?";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param("i", $MaMonAn);
					$stmt->execute();
					$result = $stmt->get_result();
					$item = $result->fetch_assoc();

					if ($item) {
						// Add the item to the cart
						$_SESSION["cart"][$MaMonAn] = array(
							'SoLuong' => $SoLuong,
							'Gia' => $item['Gia']  // Add this line
						);
					}

					$stmt->close();
				}
				break;
			case "update":
				if (isset($_POST['new_quantity']) && isset($_POST['MaGioHang'])) {
					$new_quantity = $_POST['new_quantity'];
					$MaGioHang = $_POST['MaGioHang'];

					// Prepare an update statement
					$sql = "UPDATE giohang SET SoLuong = ? WHERE MaGioHang = ?";

					// Initialize a statement
					$stmt = $conn->prepare($sql);

					// Bind the new quantity and the item ID to the statement
					$stmt->bind_param("ii", $new_quantity, $MaGioHang);

					// Execute the statement
					$stmt->execute();

					// Close the statement
					$stmt->close();
					$_SESSION['cart'][$MaGioHang]['SoLuong'] = $new_quantity;
					header("Location: users_cart.php");
					exit;
				}
				break;
			case "delete":
				if (isset($_POST['MaGioHang'])) {
					$MaGioHang = $_POST['MaGioHang'];

					$sql = "DELETE FROM donhang WHERE MaGioHang = ?";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param("i", $MaGioHang);
					$stmt->execute();
					$stmt->close();

					// Then, delete the row in the giohang table
					$sql = "DELETE FROM giohang WHERE MaGioHang = ?";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param("i", $MaGioHang);
					$stmt->execute();
					$stmt->close();
					header("Location: users_cart.php");
					exit;
				}
				break;
		}
	}
	?>

	<title>Cart</title>
</head>

<body>
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>Cart</h1>
					</div>
				</div>
				<div class="col-lg-7">

				</div>
			</div>
		</div>
	</div>

	<form class="col-md-12" action="users_cart.php?action=submit" method="post">

		<div class="untree_co-section before-footer-section">
			<div class="container">
				<div class="row mb-5">

					<div class="site-blocks-table">
						<table class="table">
							<thead>
								<tr>
									<th class="product-thumbnail">Ảnh</th>
									<th class="product-name">Sản Phẩm</th>
									<th class="product-price">Giá</th>
									<th class="product-quantity">Số Lượng</th>
									<th class="product-remove">Xóa</th>
								</tr>
							</thead>
							<tbody>

								<?php
								$cartTotal = 0;

								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {
										$itemTotal = $row["SoLuong"] * $row["Gia"];
										$cartTotal += $itemTotal;
								?>
										<tr>
											<td class="product-thumbnail">
												<img src="../images/Product/<?php echo $row["Anh"] ?>" alt="Image" class="img-fluid">
											</td>
											<td class="product-name">
												<h2 class="h5 text-black"><?php echo $row["TenSanPham"] ?></h2>
											</td>
											<td><?php echo number_format($row["Gia"]) ?> VNĐ</td>

											<td>
												<div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 100px;">
													<form method="post" action="users_cart.php">
														<input type="hidden" name="action" value="update">
														<input type="hidden" name="MaGioHang" value="<?php echo $row["MaGioHang"] ?>">
														<center>
															<input name="new_quantity" type="text" class="form-control text-center quantity-amount" value="<?php echo $row["SoLuong"] ?>" style="margin-left: 80px;">
														</center>
													</form>
												</div>
											</td>

											<form method="post" action="users_cart.php">
												<input type="hidden" name="action" value="delete">
												<input type="hidden" name="MaGioHang" value="<?php echo $row["MaGioHang"] ?>">
												<td>
													<button type="submit" class="btn btn-black btn-sm">X</button>
												</td>
											</form>
										</tr>
								<?php
									}
								} else {
									echo "<tr><td colspan=5>Chưa có gì trong giỏ cả</td></tr>";
								}
								?>
							</tbody>
						</table>
					</div>

				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="row mb-5">
							<div class="col-md-6 mb-3 mb-md-0">
								<button name="update_click" class="btn btn-black btn-sm btn-block">Cập nhật giỏ</button>
							</div>
							<div class="col-md-6">
								<a href="users_shop.php" class="btn btn-outline-black btn-sm btn-block">
									Tiếp tục lướt</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label class="text-black h4" for="coupon">Coupon</label>
								<p>Nhập coupon code nếu bạn có.</p>
							</div>
							<div class="col-md-8 mb-3 mb-md-0">
								<input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
							</div>
							<div class="col-md-4">
								<button class="btn btn-black">Nhập</button>
							</div>
						</div>
					</div>
					<div class="col-md-6 pl-5">
						<div class="row justify-content-end">
							<div class="col-md-7">
								<div class="row">
									<div class="col-md-12 text-right border-bottom mb-5">
										<?php
										echo "<div class='text-right border-bottom mb-5'>";
										echo "<h3 class='text-black h4 text-uppercase'>Tổng</h3>";
										echo "</div>";

										echo "<div class='row mb-5'>";
										echo "<div class='col-md-6'>";
										echo "<span class='text-black'>Tổng</span>";
										echo "</div>";
										echo "<div class='col-md-6 text-right'>";
										echo "<strong class='text-black'>" . number_format($cartTotal) . " VNĐ</strong>";
										echo "</div>";
										echo "</div>";
										?> </div>
								</div>
								<?php
								if (empty($_SESSION["cart"])) {
								?>
									<div class="alert alert-warning" role="alert">
										Bạn phải thêm món vào giỏ đã!
									</div>
								<?php
								} else {
								?>
									<div class="col-md-12">
										<a href="users_checkout.php" class="btn btn-black btn-lg py-3 btn-block">
											Xác nhận thông tin
										</a>
									</div>
								<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>

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

					<ul class="list-unstyled custom-social">
						<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
						<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
						<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
						<li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
					</ul>
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