<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Xoá Cơ Sở Vật Chất Của Phòng</title>
</head>
<body>
<?php
    $conn = mysqli_connect("localhost", "root", "", "kytucxa");
    if (!$conn) {
        die("Kết nối thất bại");
    } else {
        if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
            // Lưu ý rằng bạn đã sử dụng $_GET['MaPhong'] hai lần trong câu truy vấn.
            // Bạn cần thay đổi một trong chúng để tránh lỗi.
            $ID = $_GET['ID'];
            $sql = "DELETE FROM csvc_phong WHERE ID='$ID'";
            // $maCSVC = $_GET['MaCSVC'];
            // $sql = "DELETE FROM csvc_phong WHERE MaPhong='$maPhong' AND MaCSVC='$maCSVC'";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                echo "Lỗi khi xóa: " . mysqli_error($conn);
            } else {
                echo "Xóa thành công";
            }
        }
    }
    // Sau khi xóa hoặc nếu không xóa, hãy chuyển hướng trang.
    header("Location: index.php?action=csvc_phong");
    ?>
</body>
</html>
