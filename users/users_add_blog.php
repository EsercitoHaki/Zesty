<!doctype html>
<html lang="en">
<head>
	<?php
		include_once('../components/assets.php');
		include_once('../components/header_user.php');

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $MaThanhVienBlog = $_GET['id'];
            $TenTieuDe = $_POST['tieude'];
            $NoiDung = $_POST['noidung'];
            $currentDate = date('Y-m-d H:i:s');
            //Mảng lỗi

            $errors = [];

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

                    $upload = move_uploaded_file($file['tmp_name'], '../images/Blog/'.$new_file);
                    if(!$upload){
                        $errors = 'upload_err';
                    }
                }else{
                    $errors = 'size_err';
                }
            }else{
                $errors[] = 'ext_err';
            }

            if(!empty($errors)){
                $mess = '';
                if(in_array('ext_err', $errors)){
                    $mess = 'Định dạng file không hợp lệ';
                }elseif (in_array('size_err', $errors)){
                    $mess = 'Dung lượng không được vượt quá'.$size_allow.'MB';
                }else{
                    $mess = 'Bạn không thể upload file vào thời điểm này. Vui lòng thử lại sau';
                }
            }else{
                $query = "INSERT INTO blog (MaThanhVien, Title, NoiDung, NgayDang, AnhBlog) VALUES ('$MaThanhVienBlog', '$TenTieuDe', '$NoiDung', '$currentDate', '$new_file')";
                $result = mysqli_query($conn, $query);
            }
        }
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
								<h1>Viết Blog</h1>
								
							</div>
						</div>
						<div class="col-lg-7">
							<div class="hero-img-wrap">
								<img src="images/couch.png" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<!-- Start Blog Section -->
		<div class="blog-section">
			<div class="container">
				<form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tiêu đề blog</label>
                        <input name="tieude" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nhập tên tiêu đề">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Mô tả</label>
                        <textarea name="noidung" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Tải tệp lên</label>
                        <input class="form-control" type="file" name="filename" id="formFile">
                    </div>
                    <div class="mb-3">
                    <button type="submit" class="btn btn-outline-success">Tạo</button>
                    </div>
                </form>
			</div>
			
		</div>
		<!-- End Blog Section -->	

		<?php include_once("../components/tail_user.php") ?>
	</body>

</html>