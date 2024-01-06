<?php
if (isset($_GET['MaHD'])) {
    $maHD = $_GET['MaHD'];

    // Kết nối đến cơ sở dữ liệu
    $conn = mysqli_connect("localhost", "root", "", "kytucxa");

    if (!$conn) {
        die("Kết nối không thành công: " . mysqli_connect_error());
    }

    // Truy vấn SQL để xóa hóa đơn dựa trên MaHD
    $deleteSql = "DELETE FROM hoadon WHERE MaHD = $maHD";

    if (mysqli_query($conn, $deleteSql)) {
        echo "Hóa đơn đã được xóa thành công.";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Không có thông tin MaHD để xóa.";
}
header("location: danhsachdangky.php");

?>
