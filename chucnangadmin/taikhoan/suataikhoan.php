<?php
$conn = mysqli_connect("localhost", "root", "", "kytucxa");
if (!$conn) {
    die("Kết nối thất bại");
}

$TenDangNhap = $_GET['TenDangNhap'];

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnGhi'])) {
    // Lấy tên đăng nhập mới từ form
    $TenDangNhapMoi = $_POST['txtTenDangNhap'];

    // Truy vấn để kiểm tra tính duy nhất của tên đăng nhập (ngoại trừ tên đăng nhập đang sửa)
    $sqlCheckExist = "SELECT * FROM taikhoan WHERE TenDangNhap = '$TenDangNhapMoi'";
    $resultCheckExist = mysqli_query($conn, $sqlCheckExist);

    if (mysqli_num_rows($resultCheckExist) > 0) {
        echo "Lỗi: Tên đăng nhập đã tồn tại. Vui lòng chọn tên đăng nhập khác.";
    } else {
        // Tiếp tục cập nhật thông tin tài khoản
        $sqlUpdate = "UPDATE taikhoan SET TenDangNhap = '$TenDangNhapMoi', MatKhau = '" . $_POST['txtMatKhau'] . "', TenLTK = '" . $_POST['txtTenLTK'] . "' WHERE TenDangNhap = '" . $TenDangNhap . "'";
        $resultUpdate = mysqli_query($conn, $sqlUpdate);

        if ($resultUpdate) {
            echo "Sửa thông tin thành công";
        } else {
            echo "Lỗi SQL: " . mysqli_error($conn);
        }

        // Cập nhật lại biến $TenDangNhap sau khi cập nhật
        $TenDangNhap = $TenDangNhapMoi;
    }
}

$sql = "SELECT * FROM taikhoan WHERE TenDangNhap = '" . $TenDangNhap . "'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Không tìm thấy tài khoản có tên đăng nhập: " . $TenDangNhap;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa</title>
    <style>
    /* Căn giữa toàn bộ nội dung trên trang */
    body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    /* Tạo khung viền cho form sửa */
    table {
        border: 2px solid black;
        padding: 20px;
        border-radius: 10px;
    }

    /* Định dạng các trường nhập liệu */
    input {
        padding: 5px;
        font-size: 16px;
        border: none;
        outline: none;
        background: none;
        border-bottom: 2px solid black;
    }

    /* Định dạng nút ghi dữ liệu */
    button[type="submit"] {
        width: 150px;
        padding: 10px;
        border: none;
        outline: none;
        cursor: pointer;
        font-size: 18px;
        background: green;
        color: white;
        border-radius: 5px;
    }

    /* Định dạng nút quay lại trang chủ */
    button[type="button"] {
        width: 200px;
        padding: 10px;
        border: none;
        outline: none;
        cursor: pointer;
        font-size: 18px;
        background: blue;
        color: white;
        border-radius: 5px;
    }

    /* Định dạng các liên kết */
    a {
        text-decoration: none;
        color: black;
    }

    a:hover {
        color: green;
    }
</style>
</head>
<body>
    <form method="POST">
        <div>
            <table>
                <tbody>
                    <tr>
                        <td>Mã Khu</td>
                        <td>
                            <input type="text" name="txtTenDangNhap" value="<?php echo $row['TenDangNhap']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <td>Tên Khu</td>
                        <td>
                            <input type="text" name="txtMatKhau" value="<?php echo $row['MatKhau']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Giới tính</td>
                        <td>
                            <input type="radio" name="gender" value="male"> Nam
                            <input type="radio" name="gender" value="female"> Nữ

                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="submit" name="btnGhi">Lưu thay đổi</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
    <a href="../admin"><button>Quay lại trang chủ</button></a>
</body>
</html>
