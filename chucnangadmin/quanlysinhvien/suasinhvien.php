<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sinh viên</title>
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

        .form-sua {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            justify-content: center;
            width: 35%; /* Set the width to 35% */
            margin: 0 auto; /* Center the form horizontally */
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

        .quaylai {
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
        .quaylai {
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
        

    .quaylai:hover {
        background-color: #FF8C00;
    }
    </style>
</head>

<body>
<?php
    $conn = mysqli_connect("localhost", "root", "", "kytucxa");
    if (!$conn) {
        die("Kết nối thất bại");
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnGhi'])) {
        $sql1 = "UPDATE sinhvien SET HoTen = '" . $_POST['txtHoTen'] . "', NgaySinh = '" . $_POST['txtNgaySinh'] . "', GioiTinh = '" . $_POST['txtGioiTinh'] . "', DiaChi = '" . $_POST['txtDiaChi'] . "', SDT = '" . $_POST['txtSDT'] . "', Mail = '" . $_POST['txtMail'] . "', TenDangNhap = '" . $_POST['txtTenDangNhap'] . "' WHERE MaSV = '" . $_POST['txtMaSV'] . "'";
        $result1 = mysqli_query($conn, $sql1);
        if ($result1) {
            echo "Sửa thông tin thành công";
        } else {
            echo "Lỗi SQL: " . mysqli_error($conn);
        }
    }
    
    $MaSV = $_GET['MaSV'];
    $sql = "SELECT * FROM sinhvien WHERE MaSV = '" . $MaSV . "'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Không tìm thấy sinh viên có MãSV: " . $MaSV;
    }
?>
    <form method="POST" name="form-sua">
        <div>
        <h1> Sửa sinh viên </h1>
            <table>
                <tbody>
                    <tr>
                        <td>MaSV</td>
                        <td>
                            <input type="text" name="txtMaSV" value="<?php echo $row['MaSV']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>HoTen</td>
                        <td>
                            <input type="text" name="txtHoTen" value="<?php echo $row['HoTen']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>NgaySinh</td>
                        <td>
                            <input type="date" name="txtNgaySinh" placeholder="dd-mm-yyyy" value="<?php echo $row['NgaySinh']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>GioiTinh</td>
                        <td>
                            <input type="radio" name="txtGioiTinh" value="nam" <?php if ($row['GioiTinh'] == "nam") echo "checked"; ?>>
                            <label for="nam">Nam</label><br>
                            <input type="radio" name="txtGioiTinh" value="nữ" <?php if ($row['GioiTinh'] == "nữ") echo "checked"; ?>>
                            <label for="nu">Nữ</label><br>
                        </td>
                    </tr>
                    <tr>
                        <td>DiaChi</td>
                        <td>
                            <input type="text" name="txtDiaChi" value="<?php echo $row['DiaChi']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>SDT</td>
                        <td>
                            <input type="text" name="txtSDT" value="<?php echo $row['SDT']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Mail</td>
                        <td>
                            <input type="text" name="txtMail" value="<?php echo $row['Mail']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>TenDangNhap</td>
                        <td>
                            <input type="text" name="txtTenDangNhap" value="<?php echo $row['TenDangNhap']; ?>"readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <td>
                            <button type="submit" name="btnGhi" onclick="alert()">Ghi Dữ Liệu</button>
                            <button class="quaylai"><a href="index.php?action=sinhvien">Quay lại</a></button>
                            </td>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>

</body>
</html>
