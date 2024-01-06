<?php
session_start(); // Bắt đầu hoặc tiếp tục phiên làm việc

$conn = mysqli_connect("localhost", "root", "", "kytucxa");

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

if (isset($_SESSION['sv'])) {
    $sv = $_SESSION['sv'];
    $maSV = $sv['MaSV'];

    // Cập nhật ngày đăng ký với thời gian hiện tại
    $ngayDangKy = date('Y-m-d H:i:s');  // Định dạng ngày giờ YYYY-MM-DD HH:MM:SS

    if (isset($_POST['dangKy'])) {
        $maKhu = $_POST['khu'];
        $lyDo = $_POST['lyDo'];

        // Truy vấn dữ liệu phòng phù hợp
        $queryRoom = "SELECT MaPhong, SoNguoiHienTai, SoNguoiToiDa
                      FROM phong
                      WHERE MaKhu = '$maKhu' AND SoNguoiHienTai < SoNguoiToiDa
                      ORDER BY RAND()
                      LIMIT 1";

        $resultRoom = mysqli_query($conn, $queryRoom);

        if (mysqli_num_rows($resultRoom) > 0) {
            $rowRoom = mysqli_fetch_assoc($resultRoom);
            $maPhong = $rowRoom['MaPhong'];

            // Lấy thông tin phòng đang ở của sinh viên
            $queryPhongDangO = "SELECT MaPhong FROM dangkyphong WHERE MaSV = '$maSV'";
            $resultPhongDangO = mysqli_query($conn, $queryPhongDangO);

            if (mysqli_num_rows($resultPhongDangO) > 0) {
                $rowPhongDangO = mysqli_fetch_assoc($resultPhongDangO);
                $maPhongDangO = $rowPhongDangO['MaPhong'];

                // Thêm yêu cầu chuyển phòng vào cơ sở dữ liệu
                $insertQuery = "INSERT INTO chuyenphong (MaSV, MaPhong, MaPhongChuyen, LyDo, TinhTrang, NgayDangKy)
                                VALUES ('$maSV', '$maPhongDangO', '$maPhong', '$lyDo', 'Chờ Duyệt', '$ngayDangKy')";

                if (mysqli_query($conn, $insertQuery)) {
                    // Đăng ký thành công, chuyển hướng và hiển thị thông báo
                    echo "<script>alert('Đăng ký thành công');</script>";
                    header("Location: index.php?action=chuyenphong?success=1");
                    exit();
                } else {
                    echo "Lỗi khi đăng ký chuyển phòng: " . mysqli_error($conn);
                }
            } else {
                echo "Không có phòng phù hợp để chuyển đến.";
            }
        }
    }
}
?>
