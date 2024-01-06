<?php
    include_once('../config/database.php');

    if (isset($_POST['register'])) {
        $ma = mysqli_real_escape_string($conn, $_POST['ma']);
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];
        $HoTen = mysqli_real_escape_string($conn, $_POST['HoTen']);
        $NgaySinh = $_POST['NgaySinh'];
        $DiaChi = $_POST['DiaChi'];
        $SDT = $_POST['SDT'];
        $tenltk = $_POST['tenltk'];

        $select = "SELECT * FROM taikhoan WHERE TenDangNhap = '$ma' && MatKhau = '$pass'";
    
        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) > 0) {
            $error[] = 'Tài khoản đã tồn tại!';
        } else {
            if  ($pass != $cpass) {
                $error[] = 'Mật khẩu không trùng khớp!';
            } else {
                if ($tenltk == 'nv') {
                    $insert = "INSERT INTO taikhoan(TenDangNhap, MatKhau, TenLTK) VALUES('$ma', '$pass', '$tenltk')";
                    $insert2 = "INSERT INTO nhanvien(MaNV, HoTen, NgaySinh, DiaChi, SDT, TenDangNhap) VALUES('$ma', '$HoTen', '$NgaySinh', '$DiaChi', '$SDT', '$ma')";
                    mysqli_query($conn, $insert);
                    mysqli_query($conn, $insert2);
                    echo '<script>alert("Đăng kí tài khoản thành công!")</script>';
                    header('Location:../admin/dangnhap.php');
                    exit;
                } else {
                    echo '<script>alert("Sai tài khoản hoặc mật khẩu!")</script>';
                }

                if ($tenltk == 'sv') {
                    $insert = "INSERT INTO taikhoan(TenDangNhap, MatKhau, TenLTK) VALUES('$ma', '$pass', '$tenltk')";
                    $insert2 = "INSERT INTO sinhvien(MaSV, HoTen, NgaySinh, DiaChi, SDT, TenDangNhap) VALUES('$ma', '$HoTen', '$NgaySinh', '$DiaChi', '$SDT', '$ma')";
                    mysqli_query($conn, $insert);
                    mysqli_query($conn, $insert2);
                    echo '<script>alert("Đăng kí tài khoản thành công!")</script>';
                    header('Location:../admin/dangnhap.php');
                    exit;
                } else {
                    echo '<script>alert("Sai tài khoản hoặc mật khẩu!")</script>';
                }
            } 
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
</head>
<body>
    <div class="box">
        <span class="borderline">
            <form method="POST" action="dangky.php" class="form-box">
                <h2>Đăng ký tài khoản</h2>
                <?php
                    if (isset($error)) {
                        foreach($error as $error) {
                            echo '<span class "error-msg">'. $error .'</span>';
                        }
                    }
                ?>
                <div class="inputBox">
                    <input type="text" id="inputEmail" name="ma" required autofocus>
                    <span>Mã nhân viên</span>
                    <i></i>
                </div>

                <div class="inputBox">
                    <input type="password" id="inputPassword" name="pass" required>
                    <span>Mật khẩu</span>
                    <i></i>
                </div>

                <div class="inputBox">
                    <input type="password" id="inputCPassword" name="cpass" required>
                    <span>Nhập lại mật khẩu</span>
                    <i></i>
                </div>

                <div class="inputBox">
                    <input type="text" id="inputHoTen" name="HoTen" required autofocus>
                    <span>Họ và tên</span>
                    <i></i>
                </div>

                <div class="inputBox">
                    <input type="date" id="inputNgaySinh" name="NgaySinh" required>
                    <span>Ngày sinh</span>
                    <i></i>
                </div>

				<div class="inputBox">
                    <input type="text" id="inputDiaChi" name="DiaChi" required>
                    <span>Địa chỉ</span>
                    <i></i>
                </div>

				<div class="inputBox">
                    <input type="text" id="inputSDT" name="SDT" required>
                    <span>SĐT</span>
                    <i></i>
                </div>

                <div class="inputBox">
                    <select name="tenltk" id="inputTenLTK">
                        <option value="sv">Sinh viên</option>
                        <option value="nv">Nhân viên</option>
                    </select>
                </div>
                
                <div class="links">
                    <a href="../admin/dangnhap.php">Đã có tài khoản</a>
                </div>
                <input type="submit" name="register" value="Đăng ký">
            </form>
        </span>
    </div>
</body>
</html>