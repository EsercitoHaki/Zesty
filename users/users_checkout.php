<?php
session_start();
require_once("../components/connection.php");
$result = $conn->query("SELECT * FROM thanhvien WHERE tendangnhap = '" . $_SESSION['tendangnhap'] . "'");

$sql1 = "SELECT * FROM donhang";
$result1 = $conn->query($sql1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thông tin đặt hàng</title>
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../assets/css/main.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #22092C;
      margin: 0;
      color: #ffffff;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .order-form {
      background-color: #872341;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 500px;
      text-align: left;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #FBA1B7;
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #BE3144;
    }
  </style>
</head>

<body>
  <form action="users_process_checkout.php" method="post">
    <div class="order-form">
      <h2>Thông tin đặt hàng</h2>

      <input type="hidden" id="NgayDatHang" name="NgayDatHang" value="<?php echo date('Y-d-m'); ?>">
      <?php
      while ($row = $result->fetch_assoc()) {
      ?>
        <input type="hidden" id="MaThanhVien" name="MaThanhVien" required value="<?php echo $row["MaThanhVien"]; ?>">
        <div class="form-group">
          <label for="HoTen">Tên khách hàng:</label>
          <input type="text" id="HoTen" name="HoTen" required value="<?php echo $row["HoTen"]; ?>">
        </div>
        <div class="form-group">
          <label for="tel">SDT:</label>
          <input type="text" id="SDT" name="SDT" required value="<?php echo $row["SDT"]; ?>">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required value="<?php echo $row["Email"]; ?>">
        </div>
        <div class="form-group">
          <label for="address">Địa chỉ:</label>
          <input type="text" id="DiaChi" name="DiaChi" required value="<?php echo $row["DiaChi"]; ?>">
        </div>
        <div>
          <div class="form-group">
            <label for="payment">Phương thức thanh toán:</label>
            <select id="phuongthucthanhtoan" name="phuongthucthanhtoan" class="form-select" required>
              <?php
              $stmt = $conn->prepare("SELECT * FROM phuongthucthanhtoan WHERE TrangThai = 1");
              $stmt->execute();
              $payments = $stmt->get_result();
              while ($payment = $payments->fetch_assoc()) {
                echo '<option value="' . $payment['MaPhuongThuc'] . '">' . $payment['TenPhuongThuc'] . '</option>';
              }
              ?>
            </select>
          </div>


          <tbody>
            <th>
              <h4>Thông tin sản phẩm</h4>
            </th>
            <?php
            if (isset($_SESSION['cart_item'])) {
              $totalQuantity = 0;
              $totalPrice = 0;
            ?>
              <table border="1">
                <tr>
                  <th>Tên Món Ăn</th>
                  <th>Mã Món Ăn</th>
                  <th>Số Lượng</th>
                  <th>Giá</th>
                </tr>
                <?php
                foreach ($_SESSION['cart_item'] as $item) {
                  $product = $conn->query("SELECT * FROM MonAn WHERE MaMonAn = " . $item['MaMonAn'])->fetch_assoc();
                  $totalQuantity += $item['SoLuong'];
                  $totalPrice += $product['Gia'] * $item['SoLuong'];
                ?>
                  <tr>
                    <td><?php echo $product['TenMonAn']; ?></td>
                    <td><?php echo $product['MaMonAn']; ?></td>
                    <td><?php echo $item['SoLuong']; ?></td>
                    <td><?php echo number_format($product['Gia']); ?>đ</td>
                  </tr>
                <?php
                }
                ?>
                <tr>
                  <td colspan="2">Tổng:</td>
                  <td><?php echo $totalQuantity; ?></td>
                  <td><?php echo number_format($totalPrice, 0); ?>đ</td>
                </tr>
              </table>
            <?php
            }
            ?>
          </tbody>
          <button type="submit" name="hoadon_confirm">Xác nhận</button>
        </div>
        <input type="hidden" name="tongdonhang" value="<?= $totalPrice ?>"></input>
  </form>
</body>

</html>
<?php

      }
?>