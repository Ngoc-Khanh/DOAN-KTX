<div class="box">
        <span class="borderline">
            <form method="POST" action="dangnhap.php" class="form-box">
                <h2>Đăng nhập tài khoản sinh viên</h2>
                <div class="inputBox">
                    <input type="text" id="inputEmail" name="masv" required autofocus>
                    <span>Mã sinh viên</span>
                    <i></i>
                </div>

                <div class="inputBox">
                    <input type="password" id="inputPassword" name="pass" required>
                    <span>Mật khẩu</span>
                    <i></i>
                </div>
                <div class="links">
                    <a href="../sinhvien/dangky.php">Chưa có tài khoản</a>
                    <a href="../sinhvien/quenmatkhau.php">Quên mật khẩu</a>
                </div>
                <input type="submit" name="login" value="Đăng nhập">
            </form>
        </span>
    </div>
<?php
    include_once('../../chucnangadmin/config/database.php');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['sv'])) {
        header('Location:index.php');
    }

    if (isset($_POST['login'])) {
        $ma = $_POST['masv'];
        $mk = $_POST['pass'];
        $sql = "SELECT * FROM taikhoan WHERE TenDangNhap = '".$ma."' && MatKhau = '".$mk."'";
        $rs=mysqli_query($conn,$sql);
        $dem=mysqli_num_rows($rs);

        if ($dem == 0) {
            echo '<script>alert("Sai tài khoản hoặc mật khẩu!")</script>';
        } else {
            $sql1 = "SELECT * FROM sinhvien WHERE MaSV = '".$ma."'";
            $rs1=mysqli_query($conn,$sql1);
            $row=mysqli_fetch_array($rs1);
            $_SESSION['sv'] = $row;
            header('location:index.php');
        }
    }
    
?>