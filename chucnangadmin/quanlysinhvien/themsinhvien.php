<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            align-items: center;
            height: 100vh;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
            

        h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .container {
        max-width: 35%;
        margin: 0 auto;
         }

        .add-student-form {
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        justify-content: center;
        width: 45%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-sua, .btn-xoa, .btn-them, .btn-quaylai {
            background-color: #FFA500;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .btn-xoa {
            background-color: #ff6b6b;
        }

        .btn-sua:hover, .btn-xoa:hover, .btn-them:hover, .btn-quaylai:hover {
            background-color: #FF8C00; /* Darker orange on hover */
        }

       

        input[type="text"], input[type="date"] {
            padding: 6px;
            width: 100%;
            font-size: 14px;
        }
        .btn{
            display: flex;
            justify-content: center;
            width: 100%;
        }

        button[type="submit"] {
            background-color: #FFA500;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
            margin: 0 10px;
        }

        button[type="submit"]:hover {
            background-color: #FF8C00; /* Darker orange on hover */
        }
        .btn-luu-quaylai {
            background-color: #FFA500;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
            margin: 0 10px;
    }

    .btn-luu-quaylai:hover {
        background-color: #FF8C00;
    }
    </style>



</head>
<body>
    <form method="post" class="add-student-form">
        <div>
            <h1> Thêm sinh viên </h1>
            <table>
                <tbody>
                    <tr>
                        <td>MaSV</td>
                        <td>
                            <input type="text" name="txtMaSV">
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
                        <td>GioiTinh</td>
                        <td>
                                <input type="radio" name="txtGioiTinh" value="nam" required >
                                <label for="nam">Nam</label><br>
                                <input type="radio" name="txtGioiTinh" value="nữ" required >
                                <label for="nu">Nữ</label><br>
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
                    <tr>
                        <td>Mail</td>
                        <td>
                            <input type="text" name="txtMail">
                        </td>
                    </tr>
                    <tr>
                        <td>MaPhong</td>
                        <td>
                            <input type="text" name="txtMaPhong">
                        </td>
                    </tr>
                    <tr>
                        <td>Tenkhu</td>
                        <td>
                            <input type="radio" name="txtTenKhu" value="khu A" required>
                            <label for="khuA">khu A</label><br>
                            <input type="radio" name="txtTenKhu" value="khu B" required>
                            <label for="khuB">khu B</label><br>
                            <input type="radio" name="txtTenKhu" value="khu C" required>
                            <label for="khuC">khu C</label><br>
                            <input type="radio" name="txtTenKhu" value="khu D" required>
                            <label for="khuD">khu D</label><br>
                        </td>
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
                    <tr class = "btn">
                        <td>
                            <button type="submit" name="btnLuu">Lưu</button>
                            <a href="index.php?action=sinhvien"><button class="btn-luu-quaylai"><b>Quay lại trang đầu</b></button></a>
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
        $MaSV = $_POST['txtMaSV'];
        $HoTen = $_POST['txtHoTen'];
        $NgaySinh = $_POST['txtNgaySinh'];
        $GioiTinh = $_POST['txtGioiTinh'];
        $DiaChi = $_POST['txtDiaChi'];
        $SDT = $_POST['txtSDT'];
        $Mail = $_POST['txtMail'];
        $MaPhong = $_POST['txtMaPhong'];
        $TenKhu = $_POST['txtTenKhu'];
        $TenDangNhap = $_POST['txtTenDangNhap'];

        $sql = "INSERT INTO sinhvien (MaSV, HoTen, NgaySinh, GioiTinh, DiaChi, SDT, Mail, MaPhong, TenKhu, TenDangNhap) VALUES ('$MaSV', '$HoTen', '$NgaySinh', '$GioiTinh', '$DiaChi', '$SDT', '$Mail', '$MaPhong', '$TenKhu', '$TenDangNhap')";
        $result = mysqli_query($conn, $sql);
        if ($result) { ?>
            <script>alert("Thêm thành công"); </script>
            <?php header("locaion: index.php?action=sinhvien");
        } else { ?>
            <script>alert("Thêm thất bại");</script> 
        <?php }
    }
    ?>
    
</body>
</html>
