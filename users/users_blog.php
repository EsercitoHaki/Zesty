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

		<!-- Start Header/Navigation -->
		
		<!-- End Header/Navigation -->

		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Blog</h1>
								<p class="mb-4">Khám phá thế giới ẩm thực qua những bí quyết nấu ăn độc đáo và những công thức ngon tuyệt. Hãy cùng nhau khám phá hương vị mới và tạo ra những bữa ăn tuyệt vời từ những chiếc nồi và chảo của bạn!</p>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="hero-img-wrap">
							<img src="../images/Blog/hero.png" class="img-fluid" style="max-width: 70%; margin-left: 100px;">							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<!-- Start Blog Section -->
		<div class="blog-section">
			<div class="container">
				
				<div class="row">
							<?php
								$sql = "SELECT blog.*, thanhvien.MaThanhVien, thanhvien.HoTen AS TenThanhVien, admin.TenDangNhap FROM blog LEFT JOIN thanhvien ON blog.MaThanhVien = thanhvien.MaThanhVien LEFT JOIN admin ON blog.MaAdmin = admin.MaAdmin";
								$result = $conn->query($sql) or die("Can't get recordset");
								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {
										?>
										<div class="col-12 col-sm-6 col-md-4 mb-5">
										<div class="post-entry">
											<a href="users_blog_detail.php?blog_id=<?=$row["MaBlog"]?>" class="post-thumbnail"><img src="../images/Blog/<?=$row['AnhBlog']?>" alt="Image" class="img-fluid"></a>
											<div class="post-content-entry">
												<h3><a href="users_blog_detail.php?blog_id=<?=$row["MaBlog"]?>"><?=$row["Title"]?></a></h3>
												<div class="meta">
													<span>bởi <a href="users_blog_detail.php?blog_id=<?=$row["MaBlog"]?>"><?php
													 	if(!empty($row["TenThanhVien"])){
															echo $row["TenThanhVien"];
														} elseif (!empty($row["TenDangNhap"])) {
															echo $row["TenDangNhap"];
														} else {
															echo "Ẩn danh";
														}
													?></a></span> <span>vào <a href="users_blog_detail.php?blog_id=<?=$row["MaBlog"]?>"><?=$row["NgayDang"]?></a></span>
												</div>
											</div>
										</div>
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
			
		</div>
		<!-- End Blog Section -->	


		<div class="container">
			<a href="users_add_blog.php?id=<?=$_SESSION["MaThanhVien"]?>" class="btn btn-secondary me-2">Viết Blog</a>
		</div>

		<?php include_once("../components/tail_user.php") ?>
	</body>

</html>
