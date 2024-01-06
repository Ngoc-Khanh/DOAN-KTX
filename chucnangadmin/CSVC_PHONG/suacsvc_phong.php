<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa cơ sở vật chất</title>
</head>
<body>
<?php
$conn = mysqli_connect("localhost", "root", "", "kytucxa");
if (!$conn) {
    die("Kết nối thất bại");
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnGhi'])) {
    $ID = $_POST['txtID'];
    $maPhong = $_POST['txtMaPhong'];
    $maCSVC = $_POST['txtMaCSVC'];
    // $tenCSVC = $_POST['txtTenCSVC'];
    $soLuong = $_POST['txtSoLuong'];
    $ghiChu = $_POST['txtGhiChu'];

    // Sửa lỗi trong câu truy vấn UPDATE
    $sql1 = "UPDATE csvc_phong SET MaPhong = '$maPhong', SoLuong = '$soLuong', MaCSVC = '$maCSVC', GhiChu = '$ghiChu' WHERE ID = '$ID'";
    $result1 = mysqli_query($conn, $sql1);

    if ($result1) {
        echo "Sửa thông tin thành công";
    } else {
        echo "Sửa thông tin thất bại";
    }
    header("Location: index.php?action=csvc_phong");
}

$ID = $_GET['ID'];
$sql = "SELECT * FROM csvc_phong WHERE ID = '$ID'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $MaCSVC = $row['MaCSVC']; // Lấy mã CSVC từ dữ liệu cơ sở vật chất
} else {
    echo "Không tìm thấy cơ sở vật chất có mã $MaCSVC";
}

// Lấy thông tin tên CSVC từ cơ sở vật chất
$sqlTenCSVC = "SELECT TenCSVC FROM cosovatchat WHERE MaCSVC = '$MaCSVC'";
$resultTenCSVC = mysqli_query($conn, $sqlTenCSVC);
if (mysqli_num_rows($resultTenCSVC) > 0) {
    $rowTenCSVC = mysqli_fetch_assoc($resultTenCSVC);
    $tenCSVC = $rowTenCSVC['TenCSVC'];
} else {
    $tenCSVC = "";
}
?>
    <form method="POST">
        <div>
            <table>
                <tbody>
                <tr>
                        <td>ID</td>
                        <td>
                            <input type="text" name="txtID" value="<?php echo $row['ID']; ?>"readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Mã Phòng</td>
                        <td>
                            <select name="txtMaPhong">
                                <?php
                                $sql1 = "SELECT * FROM phong";
                                $result1 = mysqli_query($conn, $sql1);
                                while ($kq = mysqli_fetch_array($result1)) {
                                    $selected = ($kq['MaPhong'] == $MaPhong) ? 'selected' : '';
                                    echo "<option value='{$kq['MaPhong']}' $selected>{$kq['MaPhong']} ({$kq['MaKhu']})</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Mã CSVC</td>
                        <td>
                            <select name="txtMaCSVC">
                                <?php
                                $sql1 = "SELECT * FROM cosovatchat";
                                $result1 = mysqli_query($conn, $sql1);
                                while ($kq = mysqli_fetch_array($result1)) {
                                    $selected = ($kq['MaCSVC'] == $MaCSVC) ? 'selected' : '';
                                    echo "<option value='{$kq['MaCSVC']}' $selected>{$kq['MaCSVC']} ({$kq['TenCSVC']})</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>Tên CSVC</td>
                        <td>
                            <input type="text" name="txtTenCSVC" value="<?php echo $tenCSVC; ?>">
                        </td>
                    </tr> -->
                    <tr>
                        <td>Số Lượng</td>
                        <td>
                            <input type="text" name="txtSoLuong" value="<?php echo $row['SoLuong']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Ghi Chú</td>
                        <td>
                            <input type="text" name="txtGhiChu" value="<?php echo $row['GhiChu']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                                <button type="submit" name="btnGhi">Ghi Dữ Liệu</button>
                               
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>

</body>
</html>
