<?php
$conn = mysqli_connect("localhost", "root", "", "kytucxa");

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

if (isset($_SESSION['sv'])) {
    $sv = $_SESSION['sv'];


    $maSV = $sv['MaSV'];

    $query = "SELECT d.MaSV, s.HoTen, d.MaPhong
          FROM dangkyphong AS d
          JOIN sinhvien AS s ON d.MaSV = s.MaSV
          WHERE d.MaSV = '$maSV'";
    $result = mysqli_query($conn, $query);

    $query1 = "SELECT HoTen, MaPhong FROM sinhvien WHERE MaSV = '$maSV'";
    $result1 = mysqli_query($conn, $query1);
    
    $maPhong = "Không có";
    if (mysqli_num_rows($result1) > 0) {
        $row1 = mysqli_fetch_array($result1);
        $hoTen = $row1['HoTen'];
        if(isset($row1['MaPhong'])) {
        $maPhong = $row1['MaPhong'];
        }
    }

    if (isset($_POST['traPhong'])) {
        $queryKiemTraCoPhong = "SELECT MaPhong FROM sinhvien WHERE MaSV = '$maSV'";
        $resultKiemTraCoPhong = mysqli_query($conn, $queryKiemTraCoPhong);
        $rowKiemTraCoPhong = mysqli_fetch_array($resultKiemTraCoPhong);
        if ($rowKiemTraCoPhong == NULL) { ?>
            <script type="text/javascript">
                alert("Bạn đang không có phòng, vui lòng đăng ký phòng!");
            </script>
        <?php } else {
            // Lấy thông tin phòng đang ở của sinh viên
            $queryPhongDangO = "SELECT MaPhong FROM dangkyphong WHERE MaSV = '$maSV'";
            $resultPhongDangO = mysqli_query($conn, $queryPhongDangO);

            if (mysqli_num_rows($resultPhongDangO) > 0) {
                $rowPhongDangO = mysqli_fetch_assoc($resultPhongDangO);
                $maPhongDangO = $rowPhongDangO['MaPhong'];

                // Cập nhật thông tin phòng và ngày trả phòng
                $updateQuery = "UPDATE dangkyphong SET  TinhTrang = 'chờ duyệt trả' WHERE MaSV = '$maSV'";

                if (mysqli_query($conn, $updateQuery)) {
                    //header('location: index.php');
                    // Đăng ký thành công, chuyển hướng và hiển thị thông báo
                    echo '<script>alert("Bạn đã đăng ký trả phòng thành công. Hãy chờ ban quản lý ktx duyệt yêu cầu của bạn.");</script>';
                    $sql1 = "UPDATE dangkyphong SET NgayTraPhong = CURDATE()";
                    $query1 = mysqli_query($conn, $sql1);

                } else {
                    echo "Lỗi khi cập nhật thông tin trả phòng: " . mysqli_error($conn);
                }
            } else { ?>
                <script type="text/javascript">
                    alert("Sinh viên không có phòng để trả, vui lòng đăng ký phòng!");
                </script>
            <?php
            }

        }
    }
} else {
    header('location: index.php?action=login');
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

        .tra-phong-form {
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
            transition: background-color 0.3s;
            /* Thêm hiệu ứng màu nền thay đổi trong 0.3 giây */
        }

        input[type="submit"]:hover {
            background-color: #87CEEB;
            /* Màu nền với độ trong suốt (opacity) thấp hơn khi hover */
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
    </style>
</head>

<body>
    <div class="container">
        <h1> SINH VIÊN ĐĂNG KÝ TRẢ PHÒNG</h1>

        <?php if (isset($maSV)): ?>
            <div class="user-info">
                <table>
                    <tr>
                        <th>Mã Sinh Viên</th>
                        <th>Họ Tên</th>
                        <th>Phòng Đang Ở</th>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $maSV; ?>
                        </td>
                        <td>
                            <?php echo $hoTen; ?>
                        </td>
                        <td>
                            <?php echo $maPhong; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <label> <span style="color: red;font-size: 25px;">*</span>Lưu ý: Bạn sẽ không được nhận lại tiền dư khi
                trả phòng trước thời hạn. Nhân viên ký túc xá sẽ kiểm tra lại tài sản trước khi cho bạn trả
                phòng. Hệ thống sẽ gửi thông báo sau !</label>
        <?php else: ?>
            <p>Không tìm thấy thông tin sinh viên hoặc phòng.</p>
        <?php endif; ?>

        <div class="tra-phong-form">
            <form action="index.php?action=traphong" method="post">
                <br>
                <input type="submit" name="traPhong" value="Đăng Ký Trả Phòng">
            </form>
        </div>
    </div>
</body>

</html>