<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin phòng</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 400px; /* Adjust the width as needed */
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 110%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        h2{
            text-align: center;
        }

        th, td {
            padding: 8px;
            text-align: left;
           
        }

        th {
            background-color: #333;
            color: #fff;
        }

        form {
            margin: 20px 20px;
            text-align: center;
        }

        select, input[type="text"] {
            padding: 10px;
            width: 80%; /* Make input fields full width */
        }

    button {
        background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 7px; /* Khoảng cách giữa hai nút */
          
    }

    button:hover {
        background-color: #1E6C41; /* Màu nền mới khi di chuột vào nút */
    }

    a {
        text-decoration: none;
        color: white;
    }
    </style>
<body>
<div class="container">
        <h2>Chỉnh sửa thông tin phòng</h2>
<?php
    $MaPhong = $_GET['MaPhong'];
    $MaKhu = "";
    $SoNguoiToiDa = "";
    $SoNguoiHienTai = "";
    $Gia = "";
    
    $conn = mysqli_connect("localhost", "root", "", "kytucxa");
    if (!$conn) {
        die("Kết nối thất bại");
    } else {
        $sql = "SELECT * FROM phong WHERE MaPhong = '".$MaPhong."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $MaKhu = $row["MaKhu"];
                $SoNguoiToiDa = $row["SoNguoiToiDa"];
                $SoNguoiHienTai = $row["SoNguoiHienTai"];
                $Gia = $row["Gia"];
            }
        } else {
            echo "Không có bản ghi";
        }
    }
    ?>

    <form method="POST">
        <div>
            <table>
                <tbody>
                <tr>
                        <td>Mã Khu</td>
                        <td>
                        <select name="txtMaKhu">
                            <?php
                            $sql1 = "SELECT * FROM khu";
                            $result1 = mysqli_query($conn, $sql1);
                            while ($kq = mysqli_fetch_array($result1)) {
                                $selected = ($kq['MaKhu'] == $MaKhu) ? 'selected' : '';
                                echo "<option value='{$kq['MaKhu']}' $selected>{$kq['MaKhu']} ({$kq['GioiTinh']})</option>";
                            }
                            ?>
                        </select>
                    </td>
                    </tr>
                    <tr>
                        <td>Mã Phòng</td>
                        <td>
                            <input type="text" id="txtMaPhong" name="txtMaPhong" value="<?php echo $MaPhong; ?>"readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Số người tối đa</td>
                        <td>
                            <input type="text" id="txtSoNguoiToiDa" name="txtSoNguoiToiDa" value="<?php echo $SoNguoiToiDa; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Số người hiện tại</td>
                        <td>
                            <input type="text" id="txtSoNguoiHienTai" name="txtSoNguoiHienTai" value="<?php echo $SoNguoiHienTai; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Giá phòng</td>
                        <td>
                            <input type="text" id="txtGia" name="txtGia" value="<?php echo $Gia; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button><a href="index.php?action=quanlyphong"> Quay lại</a></button>
                            <button type="submit" id="btnLuu" name="btnLuu">Cập nhật</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['btnLuu'])) {
        $MaKhu = $_POST['txtMaKhu'];
        $MaPhong = $_POST['txtMaPhong'];
        $SoNguoiToiDa = $_POST['txtSoNguoiToiDa'];
        $SoNguoiHienTai = $_POST['txtSoNguoiHienTai'];
        $Gia = $_POST['txtGia'];

        $conn = mysqli_connect("localhost", "root", "", "kytucxa");
        if (!$conn) {
            die("Kết nối thất bại");
        }
        $sql= "UPDATE phong SET MaKhu = '".$MaKhu."', SoNguoiToiDa = '".$SoNguoiToiDa."',SoNguoiHienTai = '$SoNguoiHienTai', Gia = '".$Gia."'WHERE MaPhong = '".$MaPhong."'";
        
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Update error" . mysqli_error($conn);
        } else {
            echo "Update success !";
        }
    }
    ?>

    <a href="index.php?action=quanlyphong">Quay lại</a>
</div>
</body>
</html>