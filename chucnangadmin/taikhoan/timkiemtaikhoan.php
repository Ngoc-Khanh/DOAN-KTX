<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TÌM KIẾM NHÂN VIÊN</title>
</head>
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

        .btn-sua {
            background-color: #FFC30F;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
        }

        .btn-xoa {
            background-color: #ff6b6b;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
        }

        .btn-sua:hover, .btn-xoa:hover {
            opacity: 0.8;
        }

        .btn-them {
            background-color: #096BFF;
            color: #fff;
            border: none;
            padding: 12px 33px; 
            margin: 20px 0; 
            cursor: pointer;
            display: inline-block; 
        }

        .btn-quaylai {
            background-color: #dea2f2;
            color: #fff;
            border: none;
            padding: 12px 33px; 
            margin: 20px 0; 
            cursor: pointer;
            display: inline-block;
        }

        .btn-them:hover, .btn-xuatexcel:hover .btn-quaylai:hover {
            opacity: 0.8;
        }

        form {
            margin: 20px 0;
            text-align: center;
        }

        input[type="text"] {
            padding: 10px;
            width: 60%;
        }

        button[type="submit"] {
            background-color: #ccc5c5;
            color: #333;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
</style>


<body>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "kytucxa");
    if(!$conn) {
        die("Ket noi that bai");
    } 
    if (isset($_GET['timkiemtaikhoan'])) {
        $search = $_GET['timkiemtaikhoan'];
        $sql = "SELECT * FROM taikhoan WHERE TenDangNhap LIKE '%$search%' ";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {?>
            <html>
            <div>
                <form method="GET" action="timkiemtaikhoan.php">
                    <input type="text" name="timkiemtaikhoan" placeholder="Tìm kiếm theo tên đăng nhập">
                    <button type="submit">Tìm kiếm</button>
                </form>
            </div>
            </html>
            <?php echo "<table>";
                echo "<thead>";
                    echo "<tr>
                        <th>TenDangNhap</th>
                        <th>MatKhau</th>
                        <th>TenLTK</th>
                        <th colspan='2'>Thao tác</th>
                    </tr>
                </thead>
                <tbody>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                    echo"<td>" .$row["TenDangNhap"] ."</td>";
                    echo"<td>" .$row["MatKhau"] ."</td>";
                    echo"<td>" .$row["TenLTK"] ."</td>";
                    echo "<td><a href='suataikhoan.php?TenDangNhap=".$row["TenDangNhap"]."' target='_blank'><button class='btn-sua'>Sửa</button></a></td>";
                    echo "<td><a onclick='confirmDelete(\"" . $row["TenDangNhap"] . "\")'><button class='btn-xoa'>Xóa</button></a></td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "không có bản ghi";    
        }
    }
?>
<div>
    <a href="../taikhoan/themtaikhoan.php"><button class="btn-them"><b>Thêm</b></button></a>
    <a href="../taikhoan/danhsachtaikhoan.php"><button class="btn-quaylai"><b>Quay lại trang chủ</b></button></a>
</div>
<script>
        function confirmDelete(TenDangNhap) {
            if (confirm("Bạn có chắc chắn muốn xóa tài khoản  này không?")) {
                window.location.href = 'xoataikhoan.php?TenDangNhap=' + TenDangNhap + '&confirm=yes';
                alert("Xóa thành công!");
            }
        }
    </script>
</body>
</html>
</html>
