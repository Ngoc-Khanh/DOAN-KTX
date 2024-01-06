<?php

// Tạo kết nối
$conn = mysqli_connect("localhost", "root", "", "kytucxa");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}
?>
