<?php
include("db_connection.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Thực hiện truy vấn để xóa tin tức khỏi cơ sở dữ liệu
    $sql = "DELETE FROM news WHERE id = $id";

    if ($conn->query($sql) == TRUE) {
        header("Location: index.php?action=quanlyblog"); // Chuyển hướng về trang quản trị
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

$conn->close();
?>
