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
            justify-content: right;
        }

        .approve-button,
        .cancel-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px;
            cursor: pointer;
        }

        .approve-button:hover {
            background-color: #45a049;
        }

        .cancel-button:hover {
            background-color: #ff0000;
        }
    </style>
</head>

<body>
    <h1>Quản Lý Chuyển Phòng</h1>
    <table>
        <tr>
            <th>Mã Đăng Ký</th>
            <th>Mã Sinh Viên</th>
            <th>Phòng Đang Ở</th>
            <th>Phòng Chuyển Tới</th>
            <th>Lý Do</th>
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
            if (isset($_GET['actionn']) && $_GET['actionn'] == 'cancel') {
                // Xóa dòng dữ liệu nếu actionn là 'cancel'
                $deleteQuery = "DELETE FROM chuyenphong WHERE MaDK = '$requestId'";
                if (mysqli_query($conn, $deleteQuery)) {
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $date = getdate();
                    $ngay = $date['year'] . '-' . $date['mon'] . '-' . ($date['mday']) . ' ' . $date['hours'] . ':' . $date['minutes'] . ':' . $date['seconds'];
                    $ngayhientai = $date['year'] . '/' . $date['mon'] . '/' . ($date['mday']);
                    $td = 'Thông Báo Chuyển Phòng';
                    $nd = 'Yêu cầu chuyển phòng của bạn không được phê duyệt. Mọi thắc mắc vui lòng lên gặp Nhân viên Ký túc xá để biết thêm chi tiết. Xin cảm ơn !';
                    $masv = $_GET['MaSV'];

                    $ngayTB = $ngayhientai;
                    $sql2 = "INSERT INTO `thongbao`(`MaSV`, `TieuDe`, `NoiDung`) VALUES ('$masv', '$td', '$nd')";
                    $rs2 = mysqli_query($conn, $sql2);
                }


            }
        }

        $query = "SELECT MaDK, MaSV, MaPhong, MaPhongChuyen, LyDo, TinhTrang FROM chuyenphong";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['MaDK'] . "</td>";
                echo "<td>" . $row['MaSV'] . "</td>";
                echo "<td>" . $row['MaPhong'] . "</td>";
                echo "<td>" . $row['MaPhongChuyen'] . "</td>";
                echo "<td>" . $row['LyDo'] . "</td>";
                echo "<td>" . $row['TinhTrang'] . "</td>";
                echo "<td class='action-buttons'>
                        <a class='approve-button' href='index.php?action=xulyduyetqlcp&requestId=" . $row['MaDK'] . "&MaSV=" . $row['MaSV'] . "'>Duyệt</a>
                        <a class='cancel-button' href='index.php?action=quanlychuyenphong&requestId=" . $row['MaDK'] . "&actionn=cancel&MaSV=" . $row['MaSV'] . "'>Hủy</a>
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