<!-- /*
* Bootstrap 5
* Template Name: Furni
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!doctype html>
<html lang="en">
<head>
<?php
	include_once('../components/assets.php');
	include_once('../components/header_user.php');
?>
		<title></title>
	</head>

	<body>
	<?php

// Lấy thông tin của blog từ URL (giả sử là truyền qua biến GET với tên là 'blog_id')
$blog_id = $_GET['blog_id']; // Bạn cần kiểm tra và xử lý dữ liệu đầu vào để tránh lỗ hổng bảo mật

$sql = "SELECT * FROM blog WHERE MaBlog = $blog_id";
$result = $conn->query($sql) or die("Can't get recordset");

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	?>
		<!-- Start Header/Navigation -->
		
		<!-- End Header/Navigation -->

		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
							<h1 class="section-title"><?php echo $row["Title"]; ?></h1>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="hero-img-wrap">
								<img src="../images/Blog/rau.png" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<!-- Start Blog Section -->
		
                <div class="why-choose-section">
                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col-lg-6">
                                <p><?php echo $row["NoiDung"]; ?></p>
                            </div>

                            <div class="col-lg-5">
                                <div class="img-wrap" style="padding-bottom: 20px;padding-top: 20px;">
                                    <img src="../images/Blog/<?php echo $row['AnhBlog']; ?>" alt="Image" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                echo "<p>Không tìm thấy blog.</p>";
            }
        ?>

		<!-- Start Footer Section -->
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
