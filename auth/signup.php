<?php
    session_start();
    require_once('../components/connection.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Tendangnhap = $_POST['tendangnhap'];
        $Matkhau = $_POST['matkhau'];
    
        // Check if all fields are filled
        if (empty($Tendangnhap) || empty($Matkhau)) {
            $_SESSION['message'] = '<div class="alert alert-danger" role="alert">Vui lòng nhập đủ thông tin</div>';
            header("Location: signup.php");
            exit();
        } else {
            // Check if username already exists
            $query = "SELECT * FROM thanhvien WHERE TenDangNhap = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $Tendangnhap);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                // Username already exists
                $_SESSION['message'] = '<div class="alert alert-danger" role="alert" style="color:white;">Tên đăng nhập đã tồn tại</div>';
                header("Location: signup.php");
                exit();
            } else {
                // Insert new user into thanhvien table
                $query = "INSERT INTO thanhvien (TenDangNhap, MatKhau) VALUES (?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ss", $Tendangnhap, $Matkhau);
                $stmt->execute();
    
                if ($stmt->affected_rows == 1) {
                    // User successfully registered
                    $_SESSION['TenDangNhap'] = $Tendangnhap;
                    $_SESSION['user_type'] = 'thanhvien';
                    $_SESSION['message'] = '<div class="alert alert-success" role="alert" style="color:white;">Đăng ký thành công</div>';
                    header("Location: login.php");
                    exit();
                } else {
                    // Registration failed
                    $_SESSION['message'] = '<div class="alert alert-danger" role="alert">Đăng ký thất bại</div>';
                    header("Location: signup.php");
                    exit();
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets_admin/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets_admin/img/favicon.png">
    <title>Signup Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="../assets_admin/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets_admin/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link id="pagestyle" href="../assets_admin/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

    <style>
        body {
            background-color: #fff;
            color: black;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            overflow: hidden; /* Ngăn chặn cuộn xuống */
        }

        .container {
            width: 100%;
            display: flex;
        }

        .image-container {
            width: 100%;
            height: 100vh;
            overflow: hidden; 
            position: relative;
            margin-left: -320px; 
            
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: left; 
        }

        .login-container {
            width: 100%;
            padding: 20px;
            margin-bottom: 400px;
            padding-left: 200px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .card-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .card-header h3 {
            color: black; 
        }

        .card-body {
            text-align: left;
            color: black;
        }

        .form-label {
            margin-bottom: 8px;
            display: block;
            font-weight: bold;
            color: #000;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            color: #163020;
            
        }

        .btn-login {
            width: 100%;
            padding: 10px;
            background-color: #FFC933;
            color: #131413;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }
        .text-right {
            text-align: right;
            margin-top: 10px; /* Khoảng cách từ nội dung trên xuống */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="image-container">
            <img src="../assets/images/4901804.jpg" alt="Background Image">
        </div>
        <div class="login-container">
        <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']); 
    }
    ?>
            <div class="card-header">
                <h3>Dấu Ấn Nấu Ăn - Nguyên Liệu Cho Hương Vị Tuyệt Vời</h3>
            </div>
            <form method="post">
                <!-- Các trường đăng nhập -->
                <div class="card-body">
                    <div class="input-group input-group-dynamic mb-4">
                        <label class="form-label">Tên đăng nhập</label>
                        <input type="text" name="tendangnhap" class="form-control" style="color: #163020;">
                    </div>
                    <div class="input-group input-group-dynamic mb-4" >
                        <label class="form-label">Mật Khẩu</label>
                        <input type="password" name="matkhau" class="form-control">
                    </div>
                    <div class="form-check mb-3">
                    <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="user_type" id="customRadio2" value="thanhvien">
                        <label class="form-check-label" style="margin-left: 10px;" for="customRadio2">Thành viên</label>
                    </div>
                    <div class="text-right">
                        <h4></h4>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg bg btn-login">Đăng ký</button>
                    </div>
                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                        <p class="mb-2 text-sm mx-auto">
                        Bạn có tài khoản rồi à? Thế thì
                        <a href="../auth/login.php" class="text text font-weight-bold" style="color:#163020 ;">Đăng nhập</a> thôii
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="../assets_admin/js/core/popper.min.js"></script>
    <script src="../assets_admin/js/core/bootstrap.min.js"></script>
    <script src="../assassets_adminets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets_admin/js/plugins/smooth-scrollbar.min.js"></script>
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
