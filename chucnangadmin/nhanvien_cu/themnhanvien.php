<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm nhân viên</title>
</head>
<body>
    <form method="post">
        <div>
            <table>
                <tbody>
                    <tr>
                        <td>MaNV</td>
                        <td>
                            <input type="text" name="txtMaNV">
                        </td>
                    </tr>
                    <tr>
                        <td>HoTen</td>
                        <td>
                            <input type="text" name="txtHoTen">
                        </td>
                    </tr>
                    <tr>
                        <td>NgaySinh</td>
                        <td>
                            <input type="date" name="txtNgaySinh">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>DiaChi</td>
                        <td>
                            <input type="text" name="txtDiaChi">
                        </td>
                    </tr>
                    <tr>
                        <td>SDT</td>
                        <td>
                            <input type="text" name="txtSDT">
                        </td>
                    </tr>
                    </tr>
                    <tr>
                        <td>TenDangNhap</td>
                        <td>
                            <input type="text" name="txtTenDangNhap">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="btnLuu">Lưu</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnLuu'])) {
        $conn = mysqli_connect("localhost", "root", "", "kytucxa");
        if (!$conn) {
            die("Kết nối thất bại");
            exit;
        }
        $MaNV = $_POST['txtMaNV'];
        $HoTen = $_POST['txtHoTen'];
        $NgaySinh = $_POST['txtNgaySinh'];
        $DiaChi = $_POST['txtDiaChi'];
        $SDT = $_POST['txtSDT'];
        $TenDangNhap = $_POST['txtTenDangNhap'];
        $TenLTK = $_POST['txtTenLTK'];

        $sql = "INSERT INTO nhanvien (MaNV, HoTen, NgaySinh, DiaChi, SDT, TenDangNhap) VALUES ('$MaNV', '$HoTen', '$NgaySinh', '$DiaChi', '$SDT', '$TenDangNhap')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Insert error";
        } else {
            echo "Insert success";
        }
    }
    ?>
    <a href="../admin/index.php"><button><b>Quay lại trang đầu</b></button></a>
</body>
</html>
