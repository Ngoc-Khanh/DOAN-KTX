<!DOCTYPE html>
<html>
<head>
    <title>Chi tiết đăng ký</title>
    <style>
        /* Định dạng trang web */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex; /* Sử dụng flexbox để xếp hai bảng cạnh nhau */
        }

        .card-title {
            text-align: center;
            font-size: 30px;
        }

        /* CSS cho bảng thông tin sinh viên */
        .student-table {
            flex: 1; /* Bảng sinh viên sẽ chiếm 50% chiều rộng */
            background-color: rgba(0, 128, 0, 0.1);
            border-radius: 0; /* Không bo góc */
            margin-right: 10px; /* Khoảng cách giữa hai bảng */
        }

        .student-table th, .student-table td {
            padding: 18px;
            text-align: center;
            background-color: rgba(0, 128, 0, 0.1);
        }

        .student-table th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        /* CSS cho bảng thông tin phòng */
        .room-table {
            flex: 1; /* Bảng phòng sẽ chiếm 50% chiều rộng */
            background-color: rgba(0, 128, 0, 0.1);
            border-radius: 0; /* Không bo góc */
            margin-left: 10px; /* Khoảng cách giữa hai bảng */
        }

        .room-table th, .room-table td {
            padding: 18px;
            text-align: center;
            background-color: rgba(0, 128, 0, 0.1);
        }

        .room-table th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php
// Kết nối đến cơ sở dữ liệu (thay đổi thông tin kết nối theo cơ sở dữ liệu của bạn)
$conn = mysqli_connect("localhost", "root", "", "kytucxa");

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Lấy mã sinh viên từ URL
$maSinhVien = isset($_GET['MaSV']) ? $_GET['MaSV'] : '';


// Truy vấn cơ sở dữ liệu để lấy thông tin sinh viên
$sqlSinhVien = "SELECT * FROM sinhvien WHERE MaSV = '$maSinhVien'";
$resultSinhVien = $conn->query($sqlSinhVien);

// Kiểm tra kết quả truy vấn
if ($resultSinhVien == false) {
    die("Lỗi truy vấn cơ sở dữ liệu: " . $conn->error);
}

$rowSinhVien = $resultSinhVien->fetch_assoc();

if (!$rowSinhVien) {
    echo "Không tìm thấy thông tin sinh viên.";
} else {
    echo "<h1 class='card-title'>Danh sách đăng ký trả phòng =>Chi tiết đăng ký</h1>";
    echo"<br>";
    echo "<div class='container'>";
    

    // Bảng thông tin sinh viên
    echo "<table class='student-table'>";
    echo "<tr><th colspan='2'>Thông tin sinh viên</th></tr>";
    echo "<tr><th>Mã sinh viên</th><td>" . $rowSinhVien['MaSV'] . "</td></tr>";
    echo "<tr><th>Tên sinh viên</th><td>" . $rowSinhVien['HoTen'] . "</td></tr>";
    echo "<tr><th>Ngày sinh</th><td>" . $rowSinhVien['NgaySinh'] . "</td></tr>";
    echo "<tr><th>Quê quán</th><td>" . $rowSinhVien['DiaChi'] . "</td></tr>";
    echo "<tr><th>Số điện thoại</th><td>" . $rowSinhVien['SDT'] . "</td></tr>";
    echo "<tr><th>Email</th><td>" . $rowSinhVien['Mail'] . "</td></tr>";
    echo "</table>";

    // Lấy thông tin đăng ký phòng dựa trên mã sinh viên
    $sqlPhong = "SELECT phong.MaPhong, phong.MaKhu, phong.Gia
                FROM phong
                INNER JOIN dangkyphong ON phong.MaPhong = dangkyphong.MaPhong
                WHERE dangkyphong.MaSV = '$maSinhVien'";
    $resultPhong = $conn->query($sqlPhong);

    // Kiểm tra kết quả truy vấn
    if ($resultPhong == false) {
        die("Lỗi truy vấn cơ sở dữ liệu: " . $conn->error);
    }

    $rowPhong = $resultPhong->fetch_assoc();

    if (!$rowPhong) {
        echo "Không tìm thấy thông tin phòng.";
    } else {
        // Bảng thông tin phòng
        echo "<table class='room-table'>";
        echo "<tr><th colspan='2'>Thông tin phòng</th></tr>";
        echo "<tr><th>Mã phòng</th><td>" . $rowPhong['MaPhong'] . "</td></tr>";
        echo "<tr><th>Mã khu</th><td>" . $rowPhong['MaKhu'] . "</td></tr>";
        echo "<tr><th>Giá</th><td>" . $rowPhong['Gia'] . "</td></tr>";
        echo "</table>";
    }

    echo "</div>"; // Đóng container
}
?>
</body>
</html>
