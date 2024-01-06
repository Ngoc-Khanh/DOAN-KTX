<?php
$conn = mysqli_connect("localhost", "root", "", "kytucxa");

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

if (isset($_SESSION['nv'])) {
    $nv=$_SESSION['nv'];
}

$madk = $_GET['madk'];
$manv = $nv['MaNV'];
$manv = $_GET['MaNV']; // sao mã nhân viên dùng của sv :v
$sql = "UPDATE dangkyphong SET MaNV = '$manv', TinhTrang='đã duyệt' WHERE MaDK = '$madk'";
$rs = mysqli_query($conn, $sql);

if ($rs) {
    $query = "SELECT MaPhong FROM dangkyphong WHERE MaDK = '$madk'";
    $result = mysqli_query($conn, $query);
    
    if ($result && $row = mysqli_fetch_assoc($result)) {
		$sql9 = "UPDATE phong SET SoNguoiHienTai = SoNguoiHienTai + 1 WHERE MaPhong = '" . $row['MaPhong'] . "'";
		$query9=mysqli_query($conn, $sql9);
        $maPhong = $row['MaPhong'];
        
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = getdate();
        $ngay = $date['year']."-".$date['mon']."-".($date['mday']+3)." ".$date['hours'].":".$date['minutes'].":".$date['seconds'];
        $td = "Thông Báo Đăng Ký Phòng Ký Túc Xá";
        $nd = "Bạn đã đăng ký phòng thành công ! Phòng: $maPhong. Vui lòng lên ký túc xá để thanh toán tiền phòng và nhận phòng trước $ngay. Nếu không lên nhận phòng hệ thống sẽ hủy phòng của bạn và thêm bạn vào danh sách Xấu. Xin Cảm ơn !!!";

        $masv = $_GET['MaSV'];
        $ngayTB = date('Y/m/d'); // Lấy ngày/tháng/năm hiện tại

        $sql2 = "INSERT INTO `thongbao`(`MaSV`, `TieuDe`, `NoiDung`) VALUES ('$masv', '$td', '$nd')";
        $rs2 = mysqli_query($conn, $sql2);

        echo '<script type="text/javascript">';
        echo 'alert("Thành công!");';
        echo '</script>';
        header("location: index.php?action=danhsachdaduyetqldkp");
    }
}
?>
