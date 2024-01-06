<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm nhân viên</title>
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
    <form method="post">
        <div>            
            <h1> Thêm nhân viên </h1>

            <table>
                <tbody>
                    <tr>
                        <td>MaNV</td>
                        <td>
                            <input type="text" name="txtMaNV">
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
                            <a href="index.php?action=nhanvien"><button class="btn-luu-quaylai"><b>Quay lại trang đầu</b></button></a>
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
        $MaNV = $_POST['txtMaNV'];
        $HoTen = $_POST['txtHoTen'];
        $NgaySinh = $_POST['txtNgaySinh'];
        $DiaChi = $_POST['txtDiaChi'];
        $SDT = $_POST['txtSDT'];
        $TenDangNhap = $_POST['txtTenDangNhap'];

        $sql = "INSERT INTO nhanvien (MaNV, HoTen, NgaySinh, DiaChi, SDT, TenDangNhap) VALUES ('$MaNV', '$HoTen', '$NgaySinh', '$DiaChi', '$SDT', '$TenDangNhap')";
        $result = mysqli_query($conn, $sql);
        if (!$result) { ?>
            <script>alert("Thêm thất bại"); </script>
            <?php header("locaion: index.php?action=nhanvien");
        } else { ?>
            <script>alert("Thêm thành công");</script> 
        <?php }
    }
    ?>
</body>
</html>
