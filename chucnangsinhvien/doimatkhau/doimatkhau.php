<?php
if (isset($_SESSION['sv'])) {
    $sv = $_SESSION['sv'];
$masv = $sv['MaSV'];
$sql = "SELECT * FROM sinhvien WHERE MaSV = '$masv'";
$rs = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($rs);
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Đổi mật khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
        }

        input[ type='password'] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[ type='submit'] {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[ type='submit']:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php
    $sql1 = "SELECT * FROM taikhoan WHERE TenDangNhap = '$masv'";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lấy dữ liệu từ biểu mẫu
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        // Kiểm tra mật khẩu hiện tại
        $currentPasswordFromDatabase = $row1['MatKhau'];

        if ($currentPassword != $currentPasswordFromDatabase) {
            ?>
                <script type='text/javascript'>
                    alert('Mật khẩu hiện tại không đúng!');
                </script>
                <?php
        } elseif ($newPassword != $confirmPassword) {
            ?>
                <script type='text/javascript'>
                    alert('Mật khẩu mới và xác nhận mật khẩu mới không khớp!');
                </script>
                <?php
        } else {
            // Cập nhật mật khẩu mới trong cơ sở dữ liệu ( thay thế 'your_username' bằng tên người dùng của bạn )
            $newPassword = mysqli_real_escape_string($conn, $newPassword);
            $sql = "UPDATE taikhoan SET MatKhau = '$newPassword' WHERE TenDangNhap = '$masv'";

            if ($conn->query($sql) == true) {
                ?>
                <script type='text/javascript'>
                    alert('Đổi Mật Khẩu Thành Công!');  
                </script>
                <?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                $date = getdate();
                $ngay = $date['year'] . '-' . $date['mon'] . '-' . ($date['mday']) . ' ' . $date['hours'] . ':' . $date['minutes'] . ':' . $date['seconds'];
                $ngayhientai = $date['year'] . '/' . $date['mon'] . '/' . ($date['mday']);
                $td = 'Thông Báo Đổi Mật Khẩu';
                $nd = 'Tài khoản của bạn đã được thay đổi mật khẩu thành công vào ' . $ngay . ', nếu không phải là bạn đổi hãy lập tức liên lạc với cán bộ ký túc xá, xin cảm ơn!';
                //$masv = 'SV1';
                
                $ngayTB = $ngayhientai;
                $sql2 = "INSERT INTO `thongbao`(`MaSV`, `TieuDe`, `NoiDung`) VALUES ('$masv', '$td', '$nd')";
                $rs2 = mysqli_query($conn, $sql2);
            }
        }
    }
    ?>
    <div class='container'>
        <h2>Đổi Mật Khẩu</h2>
        <form action='index.php?action=doimatkhau' method='post'>
            <label for='currentPassword'>Mật khẩu hiện tại:</label>
            <input type='password' name='currentPassword' required>

            <label for='newPassword'>Mật khẩu mới:</label>
            <input type='password' name='newPassword' required>

            <label for='confirmPassword'>Xác nhận mật khẩu mới:</label>
            <input type='password' name='confirmPassword' required>

            <input type='submit' value='Đổi Mật Khẩu'>
        </form>
    </div>
</body>

</html><?php } else
header("location: index.php?action=login");
?>
