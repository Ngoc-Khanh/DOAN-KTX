<?php
$conn = mysqli_connect("localhost", "root", "", "kytucxa");
if (!$conn) {
    die("Kết nối thất bại");
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnGhi'])) {
    $sql1 = "UPDATE nhanvien SET HoTen = '" . $_POST['txtHoTen'] . "', NgaySinh = '" . $_POST['txtNgaySinh'] . "', DiaChi = '" . $_POST['txtDiaChi'] . "', SDT = '" . $_POST['txtSDT'] . "', TenDangNhap = '" . $_POST['txtTenDangNhap'] . "' WHERE MaNV = '" . $_POST['txtMaNV'] . "'";
    $result1 = mysqli_query($conn, $sql1);
    if ($result1) {
        echo "Sửa thông tin thành công";
    } else {
        echo "Lỗi SQL: " . mysqli_error($conn);
    }
}

$MaNV = $_GET['MaNV'];
$sql = "SELECT * FROM nhanvien WHERE MaNV = '" . $MaNV . "'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Không tìm thấy nhân viên có mã: " . $MaNV;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa</title>
</head>
<body>
    <form method="POST">
        <div>
            <table>
                <tbody>
                    <tr>
                        <td>MaNV</td>
                        <td>
                            <input type="text" name="txtMaNV" value="<?php echo $row['MaNV']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>HoTen</td>
                        <td>
                            <input type="text" name="txtHoTen" value="<?php echo $row['HoTen']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>NgaySinh</td>
                        <td>
                            <input type="date" name="txtNgaySinh" placeholder="dd-mm-yyyy" value="<?php echo $row['NgaySinh']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>DiaChi</td>
                        <td>
                            <input type="text" name="txtDiaChi" value="<?php echo $row['DiaChi']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>SDT</td>
                        <td>
                            <input type="text" name="txtSDT" value="<?php echo $row['SDT']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>TenDangNhap</td>
                        <td>
                            <input type="text" name="txtTenDangNhap" value="<?php echo $row['TenDangNhap']; ?>"readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <td>
                                <button type="submit" name="btnGhi">Ghi Dữ Liệu</button>
                            </td>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
    <a href="../admin/index.php"><button>Quay lại trang chủ</button></a>
</body>
</html>
