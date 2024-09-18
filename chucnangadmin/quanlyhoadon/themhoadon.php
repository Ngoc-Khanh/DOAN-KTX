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
        .back-button {
            background-color: #333;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            text-align: center;
            display: block;
            margin: 0 auto;
            margin-top: 20px; /* Điều chỉnh giá trị này để đặt khoảng cách mong muốn */
            text-decoration: none; /* Remove underline from the link */
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .update-form {
            text-align: center;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .update-form input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .update-form input[type="submit"] {
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }
        .update-form input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>Danh sách hóa đơn cho phòng <?php echo $_GET['MaPhong']; ?></h1>
    </header>

    <?php
$conn = mysqli_connect("localhost", "root", "", "kytucxa");

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

if (isset($_GET['MaPhong'])) {
    $maPhong = $_GET['MaPhong'];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        var_dump($_POST);
        if (!empty($_POST['tienDien']) && !empty($_POST['tienNuoc']) && !empty($_POST['tienMang']) && !empty($_POST['thang'])) {
            $tienDien = $_POST['tienDien'];
            $tienNuoc = $_POST['tienNuoc'];
            $tienMang = $_POST['tienMang'];
            $thang = $_POST['thang'];

            // Use prepared statement to avoid SQL injection
            $insertSql = $conn->prepare("INSERT INTO hoadon (MaPhong, TienDien, TienNuoc, TienMang, Thang, TinhTrang) VALUES (?, ?, ?, ?, ?, 'ChuaThu')");
            $insertSql->bind_param("sssss", $maPhong, $tienDien, $tienNuoc, $tienMang, $thang);

            if ($insertSql->execute()) {
                echo "Dữ liệu mới đã được thêm thành công.";
                // Redirect to the same page to prevent form resubmission
                header("Location: {$_SERVER['REQUEST_URI']}");
            } else {
                echo "Lỗi: " . $conn->error;
            }
        } else {
            echo "Vui lòng nhập đầy đủ thông tin tiền điện, tiền nước, tiền mạng và tháng.";
        }
    }

    // Display update form
    echo "<div class='update-form'>";
    echo "<form method='POST'>";
    echo "<input type='number' name='tienDien' placeholder='Tiền điện'>";
    echo "<input type='number' name='tienNuoc' placeholder='Tiền nước'>";
    echo "<input type='number' name='tienMang' placeholder='Tiền mạng'>";
    echo "<input type='text' name='thang' placeholder='Tháng'>";
    echo "<input type='submit' name='submit' value='Thêm'>";
    echo "</form>";
    echo "</div>";

    // Display list of invoices
    $sql = "SELECT MaHD, MaPhong, Thang, TienDien, TienNuoc, TienMang, TinhTrang, (TienDien + TienNuoc + TienMang) AS TongTien FROM hoadon WHERE MaPhong = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $maPhong);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Mã hóa đơn</th><th>Mã phòng</th><th>Tháng</th><th>Tiền điện</th><th>Tiền nước</th><th>Tiền mạng</th><th>Tổng tiền</th><th>Tình trạng</th><th></th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['MaHD'] . "</td>";
            echo "<td>" . $row['MaPhong'] . "</td>";
            echo "<td>" . $row['Thang'] . "</td>";
            echo "<td>" . $row['TienDien'] . "</td>";
            echo "<td>" . $row['TienNuoc'] . "</td>";
            echo "<td>" . $row['TienMang'] . "</td>";
            echo "<td>" . $row['TongTien'] . "</td>";
            if ($row['TinhTrang'] == 'ChuaThu') {
                echo "<td><button onclick='thuHoaDon(" . $row['MaHD'] . ")'>Chưa Thu</button></td>";
            } else {
                echo "<td>Đã Thu</td>";
            }
            echo "<td><a href='index.php?action=xoahoadon&MaPhong=" . $maPhong . "&MaHD=" . $row['MaHD'] . "'>Xóa</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Không có dữ liệu hóa đơn cho phòng này.";
    }

    // Back button and export to Excel button
    echo "<a href='index.php?action=hoadon' class='back-button'>Quay lại</a>";
    echo "<a href='index.php?action=xuathoadon&MaPhong=" . $maPhong . "' class='back-button' style='background-color: #1E6C41'>xuất excel</a>";
} else {
    echo "Không có thông tin MaPhong.";
}

$conn->close();
?>
<script>
    var updatedHDs = {}; // Để theo dõi các hóa đơn đã được cập nhật

    function thuHoaDon(maHD) {
        updatedHDs[maHD] = true; // Đánh dấu hóa đơn này là đã được cập nhật

        // Gửi yêu cầu cập nhật trạng thái hóa đơn sang 'Đã Thu'
        fetch('index.php?action=thuhoadon&MaHD=' + maHD, { method: 'POST' })
            .then(function(response) {
                if (response.status === 200) {
                    alert('Hóa đơn đã được thu.');
                } else {
                    alert('Có lỗi xảy ra khi thu hóa đơn.');
                }
            });
    }
</script>
</body>
</html>