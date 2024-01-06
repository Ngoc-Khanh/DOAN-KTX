<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khu</title>
</head>
<body>
    <form method="post">
        <div>
            <table>
                <tbody>
                    <tr>
                        <td>Mã Khu</td>
                        <td>
                            <input type="text" name="txtMaKhu">
                        </td>
                    </tr>
                    <tr>
                        <td>Tên Khu</td>
                        <td>
                            <input type="text" name="txtTenKhu">
                        </td>
                    </tr>
                    <tr>
                        <td>GioiTinh</td>
                        <td>
                            <input type="radio" id="nam" name="txtGioiTinh" value="Nam" required>
                            <label for="nam">Nam</label><br>
                            <input type="radio" id="nu" name="txtGioiTinh" value="Nữ" required>
                            <label for="nu">Nữ</label><br>
                        </td>
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
        $MaKhu = $_POST['txtMaKhu'];
        $TenKhu = $_POST['txtTenKhu'];
        $GioiTinh = $_POST['txtGioiTinh'];

        $sql = "INSERT INTO khu (MaKhu, TenKhu, GioiTinh) VALUES ('$MaKhu', '$TenKhu', '$GioiTinh')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Insert error";
        } else {
            echo "Insert success";
        }
    }
    ?>
    <a href="khu.php"><button><b>Quay lại</b></button></a>
</body>
</html>
