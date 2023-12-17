
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="assets/favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="assets/css/tiny-slider.css" rel="stylesheet">
		<link href="assets/css/style.css" rel="stylesheet">
		<title>Zesty</title>
		<?php
			include_once("components/connection.php");
			include_once("components/header.php");
		?>
	</head>

	<body>

		<!-- Start Header/Navigation -->
		
		<!-- End Header/Navigation -->

		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Của hàng bán <span clsas="d-block">nguyên liệu nấu ăn</span></h1>
								<p class="mb-4">Zesty là nền tảng đa dạng cho mọi thứ liên quan tới ẩm thực. Từ việc tìm nguyên liệu chất lượng đỉnh cao đến việc khám phá công thức nấu ăn mới và kết nối với cộng đồng yêu thích ẩm thực, Zesty sẽ là người bạn đồng hành đắc lực của bạn.</p>
								<p><a href="" class="btn btn-secondary me-2">Đặt ngay</a><a href="#" class="btn btn-white-outline">Tìm hiểu thêm</a></p>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="hero-img-wrap">
								<img src="images/Product/imagehome.png" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>

		<!-- Sản phẩm nổi bật -->
		<div class="untree_co-section product-section before-footer-section">
			<div class="container">
				<div class="row">

					<div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
						<h2 class="mb-4 section-title">Sản phảm nổi bật.</h2>
						<p class="mb-4">Nguyên liệu nấu ăn nổi bật của chúng tôi: chất lượng tốt, đa dạng, giúp tạo ra món ăn ngon, làm phong phú và thú vị bữa ăn hàng ngày của bạn. </p>
						<p><a href="assets/shop.html" class="btn">Khám phá</a></p>
					</div> 

					<?php
						$sql = "SELECT * FROM sanpham";
						$result = $conn->query($sql) or die("Can't get recordset");
						if($result->num_rows > 0){
							while($row = $result->fetch_assoc()){
								?>
									<div class="col-12 col-md-4 col-lg-3 mb-5">
											<a class="product-item" href="#">
												<img src="images/Product/<?php echo $row["Anh"]?>" class="img-fluid product-thumbnail">
												<h3 class="product-title"><?php echo $row["TenSanPham"] ?></h3>
												<strong class="product-price"><?php echo $row["Gia"]?></strong>

												<span class="icon-cross">
													<img src="assets/images/cross.svg" class="img-fluid">
												</span>
											</a>
									</div>
								<?php
							}
						} else {
                            echo "<tr><td colspan=7>Tap ket qua rong</td></tr>";
                        }
					?>

				</div>
			</div>
		</div>
		<div class="blog-section">
			<div class="container">
				<div class="row mb-5">
					<div class="col-md-6">
						<h2 class="section-title">Nguyên liệu</h2>
					</div>
					<div class="col-md-6 text-md-end">
						<a href="#">Tất cả</a>
						<a href="#">Nguyên liệu</a>
						<a href="#">Hoa quả và rau củ</a>
						<a href="#">Đồ từ sữa</a>
						<a href="#">Gia vị</a>
					</div>
				</div>
				<div class="untree_co-section product-section before-footer-section">
					<div class="row">
						<?php
								$sql1 = "SELECT * FROM sanpham";
								$result1 = $conn->query($sql1) or die("Can't get recordset");
								if($result1->num_rows > 0){
									while($row = $result1->fetch_assoc()){
										?>
											<div class="col-12 col-md-4 col-lg-3 mb-5">
													<a class="product-item" href="#">
														<img src="images/Product/<?php echo $row["Anh"]?>" class="img-fluid product-thumbnail">
														<h3 class="product-title"><?php echo $row["TenSanPham"] ?></h3>
														<strong class="product-price"><?php echo $row["Gia"]?></strong>

														<span class="icon-cross">
															<img src="assets/images/cross.svg" class="img-fluid">
														</span>
													</a>
											</div>
										<?php
									}
								} else {
									echo "<tr><td colspan=7>Tap ket qua rong</td></tr>";
								}
							?>
					</div>
				</div>
			</div>
		</div>
		<!-- End Product Section -->

		<!-- Start Why Choose Us Section -->
		<div class="why-choose-section">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-6">
						<h2 class="section-title">Tại sao lại chọn chúng tôi</h2>
						<p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>

						<div class="row my-5">
							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="assets/images/truck.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Nhanh &amp; Free Shipping</h3>
									<p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="assets/images/bag.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Dễ dàng mua sắm</h3>
									<p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="assets/images/support.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Hỗ trợ 24/7</h3>
									<p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="assets/images/return.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Hoàn trả miễn phí khi sai sót</h3>
									<p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
								</div>
							</div>

						</div>
						<p><a herf="#" class="btn">Mua ngay</a></p>
					</div>

					<div class="col-lg-5">
						<div class="img-wrap">
							<img src="images/BackEnd/nguoigiao.jpg" alt="Image" class="img-fluid">
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- End Why Choose Us Section -->
		<div>
			<div class="container">
				<div class="">

				</div>
				<div>

				</div>
			</div>
		</div>
		
		<!-- Start We Help Section -->
		<div class="we-help-section">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-7 mb-5 mb-lg-0">
						<div class="imgs-grid">
							<div class="grid grid-1"><img src="images/BackEnd/img_grid1.jpg" alt="Untree.co"></div>
							<div class="grid grid-2"><img src="images/BackEnd/img_grid2.jpg" alt="Untree.co"></div>
							<div class="grid grid-3"><img src="images/BackEnd/img_grid3.jpg" alt="Untree.co"></div>
						</div>
					</div>
					<div class="col-lg-5 ps-lg-5">
						<h2 class="section-title mb-4">Đắm chìm vào thế giới hương vị mới với Zesty</h2>
						<p>Với Zesty, khám phá các công thức và mẹo nấu ăn được tuyển chọn để mở ra vô số khả năng trong gian bếp của bạn.</p>

						<ul class="list-unstyled custom-list my-4">
							<li>Hãy làm thoả mãn khẩu vị của bạn</li>
							<li>Không bao giờ thiếu ý tưởng cho bữa ăn nữa</li>
							<li>Khám phá những hương vị mới</li>
							<li>Thuận tiện cho việc tìm nguyên liệu</li>
						</ul>
						<p><a herf="#" class="btn">Đi thôi</a></p>
					</div>
				</div>
			</div>
		</div>

		<!-- Start Blog Section -->
		<div class="blog-section">
			<div class="container">
				<div class="row mb-5">
					<div class="col-md-6">
						<h2 class="section-title">Blog gần đây</h2>
					</div>
					<div class="col-md-6 text-start text-md-end">
						<a href="#" class="more">Xem tất cả</a>
					</div>
				</div>

				<div class="row">

					<div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
						<div class="post-entry">
							<a href="#" class="post-thumbnail"><img src="assets/images/post-1.jpg" alt="Image" class="img-fluid"></a>
							<div class="post-content-entry">
								<h3><a href="#">First Time Home Owner Ideas</a></h3>
								<div class="meta">
									<span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 19, 2021</a></span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
						<div class="post-entry">
							<a href="#" class="post-thumbnail"><img src="assets/images/post-2.jpg" alt="Image" class="img-fluid"></a>
							<div class="post-content-entry">
								<h3><a href="#">How To Keep Your Furniture Clean</a></h3>
								<div class="meta">
									<span>by <a href="#">Robert Fox</a></span> <span>on <a href="#">Dec 15, 2021</a></span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
						<div class="post-entry">
							<a href="#" class="post-thumbnail"><img src="assets/images/post-3.jpg" alt="Image" class="img-fluid"></a>
							<div class="post-content-entry">
								<h3><a href="#">Small Space Furniture Apartment Ideas</a></h3>
								<div class="meta">
									<span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 12, 2021</a></span>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- End Blog Section -->	

		<!-- Start Footer Section -->
		<footer class="footer-section">
			<div class="container relative">

				<div class="sofa-img">
					<img src="images/Product/cuoitrang.png" alt="Image" class="img-fluid">
				</div>

				<div class="row">
					<div class="col-lg-8">
						<div class="subscription-form">
							<h3 class="d-flex align-items-center"><span class="me-1"><img src="assets/images/envelope-outline.svg" alt="Image" class="img-fluid"></span><span>Đăng ký thôi bạn ơi</span></h3>

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


		<script src="assets/js/bootstrap.bundle.min.js"></script>
		<script src="assets/js/tiny-slider.js"></script>
		<script src="assets/js/custom.js"></script>
	</body>

</html>
