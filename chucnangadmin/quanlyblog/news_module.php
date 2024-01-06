<?php
// Kết nối đến cơ sở dữ liệu
include("db_connection.php"); // Thay thế bằng tệp kết nối cơ sở dữ liệu của bạn

// Truy vấn dữ liệu tin tức từ cơ sở dữ liệu
$sql = "SELECT id, title, created_at FROM news ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>";
        echo "<a href='edit_news.php?id=" . $row["id"] . "'>" . $row["title"] . "</a> ";
        echo "<a href='delete_news.php?id=" . $row["id"] . "'>Xóa</a>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "Không có tin tức nào.";
}
?>
