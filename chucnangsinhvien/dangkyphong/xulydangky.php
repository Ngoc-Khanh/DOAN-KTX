<?php

    $conn = new mysqli("localhost", "root", "", "kytucxa");

    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }

    // Lấy thông tin số người mà người dùng đã chọn
    if (isset($_POST['SoNguoi'])) {
        $soNguoiChon = $_POST['SoNguoi'];
    }

    // Lấy thông tin mã khu dựa trên giới tính của người dùng
    $maKhu = $_POST['khu']; // Điền mã khu ứng với giới tính của người dùng

    // Tìm phòng phù hợp với số người tối đa và mã khu
    $sql = "SELECT MaPhong FROM phong WHERE SoNguoiToiDa = $soNguoiChon AND MaKhu = '$maKhu' AND SoNguoiHienTai < SoNguoiToiDa";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Lấy phòng phù hợp đầu tiên từ kết quả truy vấn
        $row = $result->fetch_assoc();
        $maPhong = $row['MaPhong'];

        // Lấy thông tin Mã SV và Họ tên của sinh viên đã đăng nhập
        // $maSV = $_SESSION['MaSV'];
        // $hoTen = $_SESSION['HoTen'];
        if (isset($_SESSION['sv'])) {
            $sv=$_SESSION['sv'];
            $maSV = $sv['MaSV'];}
        // Thêm thông tin đăng ký phòng vào bảng dangkyphong
        $ngayDangKy = date("Y-m-d"); // Lấy ngày hiện tại
        $tinhTrang = "chưa duyệt"; // Tùy theo quy trình của bạn

        $sql = "INSERT INTO dangkyphong (MaPhong, MaSV, NgayDangKy, TinhTrang) VALUES ('$maPhong', '$maSV', '$ngayDangKy', '$tinhTrang')";
        // if ($conn->query($sql) === TRUE) {
        //     // Cập nhật số người hiện tại trong bảng phong
        //     $sql = "UPDATE phong SET SoNguoiHienTai = SoNguoiHienTai + 1 WHERE MaPhong = '$maPhong'";
            if ($conn->query($sql) == TRUE) {
                // Gửi thông báo cho người dùng và điều hướng về trang chính
                echo "<script type='text/javascript'>alert('Đăng ký phòng thành công!')</script>";
            // } else {
            //     echo "Lỗi cập nhật số người hiện tại: " . $conn->error;
            // }
        } else {
            echo "<script type='text/javascript'>alert('Đăng ký phòng không thành công!')</script>";
        }
    } else {
        echo "Không có phòng phù hợp.";
    }
    header('location: index.php?action=dangkyphong');
    $conn->close();
?>
