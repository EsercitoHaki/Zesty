<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once('../components/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['product_id'])) {
    // Kiểm tra xem phiên làm việc đã được khởi tạo chưa
    if (!isset($_SESSION['MaThanhVien'])) {
        // Nếu chưa, bạn có thể chuyển hướng người dùng đến trang đăng nhập hoặc thực hiện xử lý khác
        die("Phiên làm việc không hợp lệ, vui lòng đăng nhập.");
    }

    $productID = $_GET['product_id'];
    $userID = $_SESSION['MaThanhVien'];

    // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của người dùng hay chưa
    $checkCartQuery = "SELECT * FROM giohang WHERE MaThanhVien = $userID AND MaSanPham = $productID";
    $checkCartResult = $conn->query($checkCartQuery);

    if ($checkCartResult === false) {
        die("Lỗi truy vấn: " . $conn->error);
    }

    if ($checkCartResult->num_rows > 0) {
        // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng lên 1
        $updateQuantityQuery = "UPDATE giohang SET SoLuong = SoLuong + 1 WHERE MaThanhVien = $userID AND MaSanPham = $productID";

        if ($conn->query($updateQuantityQuery) === false) {
            die("Lỗi truy vấn cập nhật: " . $conn->error);
        }
    } else {
        // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm mới vào giỏ hàng
        $insertCartQuery = "INSERT INTO giohang (MaThanhVien, MaSanPham, SoLuong) VALUES ($userID, $productID, 1)";

        if ($conn->query($insertCartQuery) === false) {
            die("Lỗi truy vấn thêm mới: " . $conn->error);
        }
    }

    // Chuyển hướng trực tiếp đến trang giỏ hàng
    header("Location: ../users/users_cart.php");
    exit();
} else {
    // Xử lý lỗi nếu có
    echo "Yêu cầu không hợp lệ!";
}
?>
