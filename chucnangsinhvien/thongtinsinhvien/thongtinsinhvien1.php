<?php
    if (isset($_SESSION['sv'])) {
        $sv=$_SESSION['sv'];
        $masv = $sv['MaSV'];
        $sql = "SELECT * FROM sinhvien WHERE MaSV = '$masv'";
        $rs = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($rs);
        $gioiTinh = $row['GioiTinh'];
?>

<head>
    <style>
        /* Phần tựa đề */
        h5 {
            text-align: center;
            font-size: large;
        }

        /* Form */
        form {
            width: 300px;
            margin: 0 auto;
        }

        /* Các div chứa thông tin */
        div {
            margin-bottom: 10px;
        }

        /* Chỉnh cách hiển thị các input */
        input[type="text"],
        input[type="date"],
        input[type="password"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 3px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Button */
        button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Chỉnh màu nền khi hover */
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<div>
    <div>
        <div>
            <h5>Cập nhật thông tin cá nhân</h5>
            <form method="POST">
                <div>
                    <span>Mã sinh viên </span>
                    <input type="text" id="inputText" name="masv" value="<?php echo $row['MaSV'] ?>" disabled>
                    <input type="hidden" name="masv" value="<?php echo $row['MaSV'] ?>">
                </div>
                <hr>
                <span>Họ và tên </span>
                <div>
                    <input type="text" id="inputText" name="hoten" placeholder="Họ và Tên" value="<?php echo $row['HoTen'] ?>" required>
                </div>  
                <hr>
                <span>Giới Tính </span>
                    <div>
                        <select name="gioiTinh" required>
                            <option value="nam" <?php if($gioiTinh== 'nam') echo 'selected' ?>>Nam</option>
                            <option value="nữ" <?php if($gioiTinh== 'nữ') echo 'selected' ?>>Nữ</option>
                        </select>
                    </div>
                <hr>
                <span>Ngày sinh </span>
                <div>
                    <input type="date" name="ns" max="3000-12-31" min="1000-01-01" value="<?php echo $row['NgaySinh'] ?>">
                </div>
                <hr>
                <span>Quê quán </span>
                <div>
                    <input type="text" id="inputText" name="dc" value="<?php echo $row['DiaChi'] ?>" required>
                </div>
                <hr>
                <span>Phòng đang ở</span>
                <div>
                    <input type="text" id="inputText" name="phong" value="<?php echo $row['MaPhong'] ?>" disabled  >
                </div>
                <hr>
                <span>Số điện thoại </span>
                <div>
                    <input type="text" id="inputText" name="sdt" value="<?php echo $row['SDT'] ?>" required>
                </div>
                <button name="sv_capnhaptt" type="submit" style="margin-left:80px;">Cập Nhật</button>
                <hr>
            </form>
        </div>
    </div>
</div>

<?php 
if(isset($_POST['sv_capnhaptt'])){
    $masv = $_POST['masv'];
    $ns = $_POST['ns'];
    $hoten = $_POST['hoten'];
    $dc = $_POST['dc'];
    $sdt = $_POST['sdt'];
    $gioitinh = $_POST['gioiTinh'];
    
    $sql = "UPDATE sinhvien SET HoTen = '$hoten', GioiTinh = '$gioitinh', NgaySinh = '$ns', DiaChi = '$dc', SDT = '$sdt' WHERE MaSV = '$masv'";
    
    $rs = mysqli_query($conn, $sql);
    
    if($rs){?>
        <script type="text/javascript">alert("Cập nhật thành công!")</script>
        <?php
    }else{
        ?>
        <script type="text/javascript">alert("Lỗi!")</script>
        <?php
    }
}}else{
    header("location: index.php?action=login");
}
?>
