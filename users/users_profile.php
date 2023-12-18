<!doctype html>
<html lang="en">

<head>
	<?php
	include_once('../components/connection.php');
	include_once('../components/assets.php');
	include_once('../components/header_user.php');
	$sql = "SELECT * FROM thanhvien WHERE MaThanhVien = $MaThanhVien";
	$result = $conn->query($sql) or die("Can't get recordset");
	$row = $result->fetch_assoc();
	if (!isset($_SESSION["error_message"])) {
		$_SESSION["error_message"] = "";
	}
	?>
	<title>Nguyên liệu</title>
</head>

<body>

	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>Hồ sơ</h1>
					</div>
				</div>
				<div class="col-lg-7">
				</div>
			</div>
		</div>
	</div>

	<div class="why-choose-section">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-6">
					<h2 class="section-title">Thông tin</h2>
					<h4 class="section-title"><?php echo $_SESSION["error_message"]; ?></h4>
					<form action="" method="post">
						<div class="row">
							<div class="col">
								<label for="">Họ tên</label>
								<input type="text" class="form-control" value="<?= $row['HoTen'] ?>" aria-label="First name" disabled>
							</div>
							<div class="col">
								<label for="">SĐT</label>
								<input type="text" class="form-control" value="<?= $row['SDT'] ?>" aria-label="Last name" disabled>
							</div>
						</div>
						<div class="mb-3">
							<label for="formGroupExampleInput" class="form-label">Email</label>
							<input type="text" class="form-control" id="formGroupExampleInput" value="<?= $row['Email'] ?>" disabled>
						</div>
						<div class="mb-3">
							<label for="formGroupExampleInput" class="form-label">Địa chỉ</label>
							<input type="text" class="form-control" id="formGroupExampleInput" value="<?= $row['DiaChi'] ?>" disabled>
						</div>
						<div class="mb-3">
							<label for="formGroupExampleInput" class="form-label">Ngày sinh</label>
							<input type="date" class="form-control" id="formGroupExampleInput" value="<?= $row['NgaySinh'] ?>" disabled>
						</div>
						<div class="mb-3">
							<span><a href="users_profile_edit.php?id=<?php echo $_SESSION["MaThanhVien"] ?>" class="btn">Thay đổi</a></span>
							<span><a href="users_edit_password.php?id=<?php echo $_SESSION["MaThanhVien"] ?>" class="btn">Đổi mật khẩu</a></span>
						</div>
					</form>
				</div>

				<div class="col-lg-5">
					<form action="" method="post">
						<h2 class="section-title">Lịch sử mua hàng</h2>
						<table class="table">
							<thead>
								<tr>
									<th scope="col">Đơn hàng</th>
									<th scope="col">Ngày đặt</th>
									<th scope="col">Trạng thái</th>
									<th scope="col">Tổng</th>
									<th scope="col">Đánh giá</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sqlDH = "SELECT * FROM donhang WHERE MaThanhVien = $MaThanhVien";
								$resultDH = $conn->query($sqlDH) or die("Can't get recordset");
								if ($resultDH->num_rows > 0) {
									while ($row = $resultDH->fetch_assoc()) {
								?>
										<tr>
											<th><?= $row["MaDonHang"] ?></th>
											<th><?= $row["ThoiGianDatHang"] ?></th>
											<th>
												<?php
												switch ($row["TrangThai"]) {
													case 0:
														echo 'Đơn hàng mới tạo';
														break;
													case 1:
														echo 'Đang xử lý';
														break;
													case 2:
														echo 'Đang giao hàng';
														break;
													case 3:
														echo 'Đã giao hàng';
														break;
													case 4:
														echo 'Đơn hàng đã hủy';
														break;
													default:
														echo $row["TrangThai"];
														break;
												}
												?>
											</th>
											<th></th>
											<th><a href="">Đánh giá</a></th>
										</tr>
								<?php
									}
								}
								?>
							</tbody>
						</table>
					</form>
				</div>

			</div>
		</div>
	</div>


	</div>


	<?php
	include_once("../components/tail_user.php");
	unset($_SESSION["error_message"]);
	?>
</body>

</html>