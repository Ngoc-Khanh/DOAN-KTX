<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm tài khoản</title>
    <style>
    /* Căn giữa toàn bộ nội dung trên trang */
    body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    /* Tạo khung viền cho form thêm tài khoản */
    table {
        border: 2px solid black;
        padding: 20px;
        border-radius: 10px;
    }

    /* Định dạng các trường nhập liệu */
    input {
        width: 200px;
        padding: 5px;
        font-size: 16px;
        border: none;
        outline: none;
        background: none;
        border-bottom: 2px solid black;
    }

    /* Định dạng nút lưu */
    button[type="submit"] {
        width: 100px;
        padding: 10px;
        border: none;
        outline: none;
        cursor: pointer;
        font-size: 18px;
        background: green;
        color: white;
        border-radius: 5px;
    }

    /* Định dạng nút quay lại trang đầu */
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
                        <td>TenDangNhap</td>
                        <td>
                            <input type="text" name="txtTenDangNhap">
                        </td>
                    </tr>
                    <tr>
                        <td>MatKhau</td>
                        <td>
                            <input type="password" name="txtMatKhau">
                        </td>
                    </tr>
                    <tr>
                        <td>TenLTK</td>
                        <td>
                            <input type="text" name="txtTenLTK">
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
        }
        $TenDangNhap = $_POST['txtTenDangNhap'];
        $MatKhau = $_POST['txtMatKhau'];
        $TenLTK = $_POST['txtTenLTK'];

        $sql = "INSERT INTO taikhoan (TenDangNhap, MatKhau, TenLTK) VALUES ( '$TenDangNhap','$MatKhau', '$TenLTK')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Insert error";
        } else {
            echo "Insert success";
        }
    }
    ?>
    <a href="index.php?action=taikhoan"><button><b>Quay lại trang đầu</b></button></a>
</body>
</html>
