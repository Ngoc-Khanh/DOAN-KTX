<!DOCTYPE html>
<html>
<head>
    <title>Danh sách hóa đơn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #333;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <header>
        <h1>Danh sách hóa đơn của bạn</h1>
    </header>
    <table>
        <tr>
            <th>Tháng</th>
            <th>Tiền điện</th>
            <th>Tiền nước</th>
            <th>Tiền mạng</th>
            <th>Tổng tiền</th>
            <th>Tình trạng</th>
        </tr>
        <?php
        // Đoạn mã PHP để lấy và hiển thị thông tin hóa đơn
        // Thay đổi dòng dưới đây để lấy thông tin của người dùng cụ thể
        $maPhong = 'A101';

        // Kết nối đến cơ sở dữ liệu
        $conn = mysqli_connect("localhost", "root", "", "kytucxa");

        if (!$conn) {
            die("Kết nối không thành công: " . mysqli_connect_error());
        }

        // Thực hiện truy vấn SQL để lấy thông tin hóa đơn cho phòng của người dùng
        $query = "SELECT Thang, TienDien, TienNuoc, TienMang, (TienDien + TienNuoc + TienMang) AS TongTien, TinhTrang FROM hoadon WHERE MaPhong = '$maPhong'";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['Thang'] . "</td>";
            echo "<td>" . $row['TienDien'] . "</td>";
            echo "<td>" . $row['TienNuoc'] . "</td>";
            echo "<td>" . $row['TienMang'] . "</td>";
            echo "<td>" . $row['TongTien'] . "</td>";
            echo "<td>" . $row['TinhTrang'] . "</td>";
            echo "</tr>";
        }

        // Đóng kết nối đến cơ sở dữ liệu
        mysqli_close($conn);
        ?>
    </table>
</body>
</html>
