<!DOCTYPE html>
<html>
<head>
    <title>Danh sách hóa đơn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 36px;
            font-weight: bold;
        }

        .container {
            max-width: 1000px;
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

        .btn-them {
            background-color: #096BFF;
            color: #fff;
            border: none;
            padding: 5px 22px;
            margin: 20px 0;
            cursor: pointer;
            display: inline-block;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-xuatexcel {
            background-color: #1E6C41;
            color: #fff;
            border: none;
            padding: 12px 24px;
            margin: 20px 10px 20px 0; 
            cursor: pointer;
            display: inline-block; 
        }

        .btn-them:hover {
            background-color: #0753CD;
        }

        form {
            text-align: center;
        }

        input[type="text"] {
            padding: 10px;
            width: 60%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #096BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #0753CD;
        }
    </style>
</head>
<body>
    <header>
        <h1>Danh sách hóa đơn</h1>
    </header>

    <!-- Tạo biểu mẫu tìm kiếm -->
    <form method="POST">
        <div style="text-align: center; margin: 10px 0;">
            <input type="text" name="search" placeholder="Tìm kiếm theo mã phòng...">
            <input type="submit" value="Tìm kiếm">
        </div>
    </form>

    <?php
    $conn = mysqli_connect("localhost", "root", "", "kytucxa");

    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    if (isset($_POST['search'])) {
        $search = $_POST['search'];
        $sql = "SELECT MaPhong, MaKhu, SoNguoiToiDa, SoNguoiHienTai, Gia FROM phong WHERE MaPhong LIKE '%$search%'";
    } else {
        $sql = "SELECT MaPhong, MaKhu, SoNguoiToiDa, SoNguoiHienTai, Gia FROM phong";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Phòng</th><th>Khu</th><th>Số người tối đa</th><th>Số người hiện tại</th><th>Giá</th><th></th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['MaPhong'] . "</td>";
            echo "<td>" . $row['MaKhu'] . "</td>";
            echo "<td>" . $row['SoNguoiToiDa'] . "</td>";
            echo "<td>" . $row['SoNguoiHienTai'] . "</td>";
            echo "<td>" . $row['Gia'] . "</td>";
            echo "<td><a class='btn-them' href='index.php?action=themhoadon&MaPhong=" . $row['MaPhong'] . "'>Thao Tác</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Không có dữ liệu phòng.";
    }
    if (isset($_POST['search'])) { ?>
        <a href="index.php?action=hoadon"><button class="btn-xuatexcel"><b>Quay Lại</b></button></a>
    <?php }
    $conn->close();
    ?>
</body>
</html>
