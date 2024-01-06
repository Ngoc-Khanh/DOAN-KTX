<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 36px;
            font-weight: bold;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
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

        form {
            margin: 20px 0;
            text-align: center;
        }

        input[type="text"], .select {
            padding: 10px;
            width: 60%;
        }

        button[type="submit"], .quaylai {
            background-color: #096BFF;
            color: #fff;
            border: none;
            padding: 12px 33px;
            cursor: pointer;
        }

        .quaylai {
            margin-right: 50px;
        }
        .quaylai a {
            text-decoration: none;
            color: white;
            padding: 10px;
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
        $MaSV = $_POST['txtMaSV'];
        $HoTen = $_POST['txtHoTen'];
        $LoaiXe = $_POST['txtLoaiXe'];
        $MauXe = $_POST['txtMauXe'];
        $BienSo = $_POST['txtBienSo'];
        $TinhTrang = $_POST['txtTinhTrang'];

        $sql1 = "UPDATE guixe SET HoTen = '$HoTen', LoaiXe = '$LoaiXe', MauXe = '$MauXe', TinhTrang = '$TinhTrang' WHERE BienSo = '$BienSo'";
        $result1 = mysqli_query($conn, $sql1);

        if ($result1) { ?>
            <script>alert("Sửa thông tin thành công"); </script>
        <?php } else { ?>
            <script>alert("Sửa thông tin thất bại");</script> 
        <?php }
    }

    $sql = "SELECT * FROM guixe WHERE BienSo = '".$_GET['BienSo']."'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
?>
    <form method="POST">
        <div class="container">
            <table>
                <tbody>
                    <tr>
                        <td>Mã Sinh Viên</td>
                        <td>
                            <input type="text" name="txtMaSV" value="<?php echo $row['MaSV']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Họ Tên</td>
                        <td>
                            <input type="text" name="txtHoTen" value="<?php echo $row['HoTen']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Loại Xe</td>
                        <td>
                            <input type="text" name="txtLoaiXe" value="<?php echo $row['LoaiXe']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Màu Xe</td>
                        <td>
                            <input type="text" name="txtMauXe" value="<?php echo $row['MauXe']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Biển Số</td>
                        <td>
                            <input type="text" name="txtBienSo" value="<?php echo $row['BienSo']; ?>" readonly>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Tình Trạng
                        </td>
                        <td>
                            <select class="select" name="txtTinhTrang" required>
                                <option value="Đã thanh toán" <?php if($row['TinhTrang'] == 'Đã thanh toán') echo 'selected' ?>>Đã thanh toán</option>
                                <option value="Chưa thanh toán" <?php if($row['TinhTrang'] == 'Chưa thanh toán') echo 'selected' ?>>Chưa thanh toán</option>
                            </select>
                        </td>
                    </tr>
    
                    <!--<tr>
                        <td>Tình Trạng</td>
                        <td>
                            <input type="text" name="txtTinhTrang" value="<?php //echo $row['TinhTrang']; ?>">
                        </td>
                    </tr>-->

                    <tr>
                        <td>
                            <button class="quaylai"><a href="index.php?action=quanlyguixe">Quay lại</a></button>
                            <button type="submit" name="btnGhi" onclick="alert()">Ghi Dữ Liệu</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
</body>
</html>
