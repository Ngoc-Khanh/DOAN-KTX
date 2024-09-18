<?php

$conn = mysqli_connect("localhost", "root", "", "kytucxa");

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

if (isset($_SESSION['sv'])) {
    $sv = $_SESSION['sv'];
} else {
    header('location: index.php?action=login');
}

$maSV = $sv['MaSV'];

$query = "SELECT d.MaSV, s.HoTen, d.MaPhong, s.GioiTinh 
          FROM dangkyphong AS d
          JOIN sinhvien AS s ON d.MaSV = s.MaSV
          WHERE d.MaSV = '$maSV'";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $maSV = $row['MaSV'];
    $hoTen = $row['HoTen'];
    $maPhong = $row['MaPhong'];
    $gioiTinh = $row['GioiTinh'];
}

// Xác định danh sách khu dựa vào giới tính
if (isset($gioiTinh)) {
    if ($gioiTinh == 'nam') {
        $danhSachKhu = array('A', 'B');
    } elseif ($gioiTinh == 'nữ') {
        $danhSachKhu = array('C', 'D');
    } else {
        $danhSachKhu = array(); // Giới tính không xác định, không hiển thị khu nào.
    }
} else {
    // Xử lý trường hợp nếu biến $gioiTinh không được đặt giá trị.
    $danhSachKhu = array();
}

?>


<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .user-info {
            margin-top: 20px;
        }

        .user-info p {
            margin: 10px 0;
        }

        .chuyen-phong-form {
            margin-top: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin: 10px 0;
            font-weight: bold;
        }

        input[type="radio"] {
            margin: 5px;
        }

        textarea {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: block;
            width: 100%;
            margin-top: 10px;
            cursor: pointer;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #333;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        .note {
            background-color: #f2f2f2;
            text-align: center;
            padding: 10px;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Đăng Ký Chuyển Phòng</h1>

        <?php if (isset($hoTen) && isset($maPhong)) : ?>
            <div class="user-info">
                <p><strong>Mã Sinh Viên:</strong> <?php echo $maSV; ?></p>
                <p><strong>Họ Tên:</strong> <?php echo $hoTen; ?></p>
                <p><strong>Phòng Đang Ở:</strong> <?php echo $maPhong; ?></p>
            </div>
        <?php else : ?>
            <p>Không tìm thấy thông tin sinh viên hoặc phòng.</p>
        <?php endif; ?>

        <div class="chuyen-phong-form">
            <form action="index.php?action=xulydangkydkcp" method="post">
                <label for="khu">Chọn Khu:</label>
                    <input type="radio" name="khu" value="<?php echo $danhSachKhu[0]; ?>" >Khu <?php echo $danhSachKhu[0]; ?>
                    <input type="radio" name="khu" value="<?php echo $danhSachKhu[1]; ?>" >Khu <?php echo $danhSachKhu[1]; ?>
                    <br>
                    <label for="lyDo">Lý Do Chuyển:</label>
                    <textarea name="lyDo" rows="4" cols="50"></textarea>
                    <br>
                    <input type="submit" name="dangKy" value="Đăng Ký Chuyển Phòng">
            </form>
        </div>

        <h2>Danh Sách Phòng</h2>
        <table>
            <tr>
                <th>Mã Khu</th>
                <th>Phòng</th>
                <th>Số Người Tối Đa</th>
                <th>Giá</th>
            </tr>
            <?php
            $queryPhong = "SELECT MaKhu, MaPhong, SoNguoiToiDa, Gia FROM phong WHERE MaKhu IN ('" . implode("', '", $danhSachKhu) . "')";
            $resultPhong = mysqli_query($conn, $queryPhong);

            if (mysqli_num_rows($resultPhong) > 0) {
                while ($rowPhong = mysqli_fetch_assoc($resultPhong)) {
                    echo "<tr>";
                    echo "<td>" . $rowPhong['MaKhu'] . "</td>";
                    echo "<td>" . $rowPhong['MaPhong'] . "</td>";
                    echo "<td>" . $rowPhong['SoNguoiToiDa'] . "</td>";
                    echo "<td>" . $rowPhong['Gia'] . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
        <div class="note">
            *Lưu ý: Hệ thống sẽ tự động chọn phòng cho bạn theo yêu cầu trên. Hệ thống sẽ gửi thông báo sau!
        </div>
    </div>
</body>

</html>