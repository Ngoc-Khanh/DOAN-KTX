<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>
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

        form {
            margin: 20px 0;
            text-align: center;
        }

        input[type="text"] {
            padding: 10px;
            width: 100%; /* Make input fields full width */
        }

        .button-container {
        text-align: center;
        margin-top: 20px;
    }

    .quaylai, button[type="submit"] {
        background-color: #096BFF; /* Màu nền của nút */
        color: #fff; /* Màu chữ trên nút */
        border: none;
        padding: 12px 33px;
        cursor: pointer;
        margin: 0 10px; /* Khoảng cách giữa hai nút */
        transition: background-color 0.3s, color 0.3s; /* Hiệu ứng màu khi di chuột vào nút */
    }

    .quaylai:hover, button[type="submit"]:hover {
        background-color: #1E6C41; /* Màu nền mới khi di chuột vào nút */
    }

    a {
        text-decoration: none;
        color: white;
    }
    </style>
</head>
<body>
    <form method = "post">
        <div>
            <table>
                <tbody>
                    <tr>
                        <td>Mã Sinh Viên</td>
                        <td>
                            <input type="text" name="txtMaSV">
                        </td>
                    </tr>
                    <tr>
                        <td>Họ Tên</td>
                        <td>
                            <input type="text" name="txtHoTen">
                        </td>
                    </tr>
                    <tr>
                        <td>Loại Xe</td>
                        <td>
                            <input type="text" name="txtLoaiXe">
                        </td>
                    </tr>
                    <tr>
                        <td>Màu Xe</td>
                        <td>
                            <input type="text" name="txtMauXe">
                        </td>
                    </tr>
                    <tr>
                        <td>Biển Số</td>
                        <td>
                            <input type="text" name="txtBienSo">
                        </td>
                    </tr>
                    <tr>
                        <td>Tình Trạng</td>
                        <td>
                            <input type="text" name="txtTinhTrang">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class="quaylai"><a href="index.php?action=quanlyguixe"> Quay lại</a></button>
                            <button type="submit" name ="btnGhi"><B>Ghi Dữ Liệu</B></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['btnGhi']) ){
            $conn = mysqli_connect("localhost","root","","kytucxa");
            if(!$conn){
                die ("Ket noi that bai");
            }   
            $sql="INSERT INTO guixe (MaSV, HoTen, LoaiXe, MauXe, BienSo, TinhTrang) VALUES ('".$_POST['txtMaSV']."','".$_POST['txtHoTen']."','".$_POST['txtLoaiXe']."','".$_POST['txtMauXe']."','".$_POST['txtBienSo']."', '".$_POST['txtTinhTrang']."')";
            $result = mysqli_query($conn,$sql);
            if ($result) { ?>
                <script>alert("Thêm thành công"); </script>
                <?php header("locaion: index.php?action=quanlyguixe");
            } else { ?>
                <script>alert("Thêm thất bại");</script> 
            <?php }

        }
    ?>
</body>
</html>