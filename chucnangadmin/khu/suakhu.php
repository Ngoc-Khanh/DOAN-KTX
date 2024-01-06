<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin khu</title>
</head>
<body>
<?php
    $MaKhu = $_GET['MaKhu'];
    $TenKhu = "";
    $GioiTinh="";
    
    $conn = mysqli_connect("localhost", "root", "", "kytucxa");
    if (!$conn) {
        die("Kết nối thất bại");
    } else {
        $sql = "SELECT * FROM khu WHERE MaKhu = '".$MaKhu."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $TenKhu = $row["TenKhu"];
                $MaKhu = $row["MaKhu"];
                $GioiTinh = $row["GioiTinh"];
            }
        } else {
            echo "Không có bản ghi";
        }
    }
    ?>

    <form method="POST">
        <div>
            <table>
                <tbody>
                    <tr>
                        <td>Mã Khu</td>
                        <td>
                            <input type="text" id="txtMaKhu" name="txtMaKhu" value="<?php echo $MaKhu; ?>"readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Tên Khu</td>
                        <td>
                            <input type="text" id="txtTenKhu" name="txtTenKhu" value="<?php echo $TenKhu; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Giới Tính</td>
                        <td>
                            <input type="radio" id="nam" name="txtGioiTinh" value="Nam" <?php if ($GioiTinh == "nam") echo "checked"; ?> required>
                            <label for="nam">Nam</label>
                            <input type="radio" id="nu" name="txtGioiTinh" value="Nữ" <?php if ($GioiTinh == "nữ") echo "checked"; ?> required>
                            <label for="nu">Nữ</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" id="btnLuu" name="btnLuu">Lưu dữ liệu</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['btnLuu'])) {
        $TenKhu = $_POST['txtTenKhu'];
        $MaKhu = $_POST['txtMaKhu'];
        $GioiTinh = $_POST['txtGioiTinh'];

        $conn = mysqli_connect("localhost", "root", "", "kytucxa");
        if (!$conn) {
            die("Kết nối thất bại");
            exit;
        }
        $sql= "UPDATE khu SET TenKhu = '".$TenKhu."', GioiTinh='".$GioiTinh."' WHERE MaKhu = '".$MaKhu."'";
        
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Update error" . mysqli_error($conn);
        } else {
            echo "<script> type ='text/javascript'> alert('Cập nhật thành công');</script>";
            header('Location: khu.php');
        }
    }
    ?>

    <a href="khu.php">Home</a>
</body>
</html>