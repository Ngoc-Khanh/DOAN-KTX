<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $maHD = $_GET["MaHD"];

    $conn = mysqli_connect("localhost", "root", "", "kytucxa");

    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    // Cập nhật trạng thái của hóa đơn sang 'Đã Thu'
    $updateSql = "UPDATE hoadon SET TinhTrang = 'DaThu' WHERE MaHD = '$maHD'";
    if ($conn->query($updateSql) === TRUE) {
        ?>
        <script type="text/javascript">
        <?php 
        echo 'alert("Thu hóa đơn thành công!");';
        ?>
        </script>
    <?php
    } else {
        ?>
        <script type="text/javascript">
        <?php echo 'alert("Thu hóa đơn thất bại!");'; ?>
        </script>
        <?php
    }
    $conn->close();
}
?>
