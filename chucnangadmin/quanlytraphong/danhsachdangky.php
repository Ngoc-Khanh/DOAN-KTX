<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #333;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        .action-buttons {
    display: flex;
    justify-content: center;
}

.approve-button,
.cancel-button,
.detail-button {
    background-color: #4CAF50; /* Màu xanh */
    color: white;
    border: none;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 2px;
    cursor: pointer;
    opacity: 0.7; /* Điều này làm cho nút trở nên trong suốt */
}

.approve-button:hover{
    background-color: #45a049; /* Màu xanh khi hover */
    opacity: 1; /* Trở lại không trong suốt khi hover */
}

.detail-button:hover {
    background-color: #87CEEB; /* Màu xanh dương khi hover */
    opacity: 1; /* Trở lại không trong suốt khi hover */
}

.cancel-button:hover {
    background-color: #ff0000; /* Màu đỏ khi hover */
    opacity: 1; /* Trở lại không trong suốt khi hover */
}

    </style>
</head>
<body>
    <h1> Danh sách trả phòng <trang admin></h1>
    <table>
        <tr>
            <th>Mã Đăng Ký</th>
            <th>Mã Sinh Viên</th>
            <th>Phòng Đang Ở</th>
            <th>Ngày Trả Phòng</th>
            <th>Tình Trạng</th>
            <th></th>
        </tr>
        <?php
       $conn = mysqli_connect("localhost", "root", "", "kytucxa");

       if ($conn->connect_error) {
           die("Kết nối không thành công: " . $conn->connect_error);
       }

        if (isset($_GET['requestId'])) {
            $requestId = $_GET['requestId'];
            if (isset($_GET['action']) && $_GET['action'] == 'cancel') {
                // Xóa dòng dữ liệu nếu ấn nút huỷ
                $deleteQuery = "DELETE FROM dangkyphong WHERE MaDK = '$requestId'";
                if(mysqli_query($conn, $deleteQuery)){
                    ?>
            <script type="text/javascript">
                alert("Xóa thành công!");
            </script>

            <?php
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = getdate();
            $ngay = $date['year'] . '-' . $date['mon'] . '-' . ($date['mday']) . ' ' . $date['hours'] . ':' . $date['minutes'] . ':' . $date['seconds'];
            $ngayhientai = $date['year'] . '/' . $date['mon'] . '/' . ($date['mday']);
            $td = 'Thông Báo Trả Phòng';
            $nd = 'Yêu cầu trả phòng của bạn không được phê duyệt. Mọi thắc mắc vui lòng lên gặp Nhân viên Ký túc xá để biết thêm chi tiết. Xin cảm ơn !';
            $masv = $_GET['MaSV'];
            
            $ngayTB = $ngayhientai;
            $sql2 = "INSERT INTO `thongbao`(`MaSV`, `TieuDe`, `NoiDung`) VALUES ('$masv', '$td', '$nd')";
            $rs2 = mysqli_query($conn, $sql2);
                }else{
                    ?>
            <script type="text/javascript">
                alert("Xóa không thành công!");
            </script>
            <?php
                }
            }
        }

        $query = "SELECT MaDK, MaSV, MaPhong, NgayTraPhong, TinhTrang FROM dangkyphong";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['MaDK'] . "</td>";
                echo "<td>" . $row['MaSV'] . "</td>";
                echo "<td>" . $row['MaPhong'] . "</td>";
                echo "<td>" . $row['NgayTraPhong'] . "</td>";
                echo "<td>" . $row['TinhTrang'] . "</td>";
                echo "<td class='action-buttons'>
                        <a class='detail-button' href='index.php?action=chitietdangkyquanlytraphong&requestId=" . $row['MaDK'] . "&MaSV=".$row['MaSV']."'>Chi tiết</a>
                        <a class='approve-button' href='index.php?action=xulyduyetquanlytraphong&requestId=" . $row['MaDK'] . "&MaSV=".$row['MaSV']."'>Duyệt</a>
                        <a class='cancel-button' href='index.php?requestId=" . $row['MaDK'] . "&action=cancel&MaSV=" . $row['MaSV'] . "'>Xóa</a>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Không có đăng ký nào.</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>
</body>
</html>
