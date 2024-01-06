<?php
$conn = mysqli_connect("localhost", "root", "", "kytucxa");

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

if (isset($_GET['requestId'])) {
    $requestId = $_GET['requestId'];

    // Lấy ngày giờ hiện tại
    $ngayChuyen = date('Y-m-d H:i:s');  // Định dạng ngày giờ YYYY-MM-DD HH:MM:SS

    // Thực hiện cập nhật trạng thái, ngày chuyển và tăng cột LanChuyen trong cơ sở dữ liệu
    $updateQuery = "UPDATE chuyenphong SET TinhTrang = 'Đã Duyệt', NgayChuyen = '$ngayChuyen', LanChuyen = LanChuyen + 1 WHERE MaDK = '$requestId'";

    if (mysqli_query($conn, $updateQuery)) {
        // Lấy MaPhongChuyen từ chuyenphong
        $selectMaPhongChuyenQuery = "SELECT MaPhongChuyen FROM chuyenphong WHERE MaDK = '$requestId'";
        $resultMaPhongChuyen = mysqli_query($conn, $selectMaPhongChuyenQuery);

        if (mysqli_num_rows($resultMaPhongChuyen) > 0) {
            $rowMaPhongChuyen = mysqli_fetch_assoc($resultMaPhongChuyen);
            $maPhongChuyen = $rowMaPhongChuyen['MaPhongChuyen'];

            // Cập nhật MaPhong trong dangkyphong
            $updateMaPhongQuery = "UPDATE dangkyphong SET MaPhong = '$maPhongChuyen' WHERE MaSV IN (SELECT MaSV FROM chuyenphong WHERE MaDK = '$requestId')";

            if (mysqli_query($conn, $updateMaPhongQuery)) {
                date_default_timezone_set('Asia/Ho_Chi_Minh');
        				$date=getdate();
                        $ngayhientai=$date['mday'] . '/' . $date['mon'] . '/' . $date['year'];
        				$ngay=$date['year']."-".$date['mon']."-".($date['mday']+3)." ".$date['hours'].":".$date['minutes'].":".$date['seconds'];
        				$td = "Thông Báo Chuyển Phòng Ký Túc Xá";
                        $nd = "Bạn đã chuyển phòng thành công ! Phòng: " . $maPhongChuyen . ". Vui lòng lên ký túc xá để thanh toán tiền phòng và nhận phòng trước ngày " . $ngay. ". Nếu không lên nhận phòng hệ thống sẽ hủy phòng của bạn và thêm bạn vào danh sách Xấu. Xin Cảm ơn !!!";
                        $masv = $_GET['MaSV'];

                        $sql2 = "INSERT INTO `thongbao`(`MaSV`, `TieuDe`, `NoiDung`) VALUES ('$masv', '$td', '$nd')";

                        $rs2 = mysqli_query($conn, $sql2);
                        echo $masv.$manv.$selectMaPhongChuyenQuery.$ngay;
        				if($rs2){
        					echo "Thành công";

        				}		
                header("Location: index.php?action=quanlychuyenphong");
            } else {
                echo "Lỗi khi cập nhật MaPhong: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Lỗi khi cập nhật trạng thái, ngày chuyển và LanChuyen: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>
