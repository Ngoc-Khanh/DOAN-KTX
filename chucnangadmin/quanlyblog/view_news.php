<!-- view_news.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Chi Tiết Tin Tức</title>
</head>
<body>
<?php
// Kết nối vào cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "kytucxa");

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Kiểm tra xem có tham số ID trong URL không
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Truy vấn tin tức với ID tương ứng
    $sql = "SELECT * FROM news WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    // Kiểm tra xem tin tức có tồn tại không
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $title = $row["title"];
        $content = $row["content"];
        $imagePath = $row["image_url"]; // Đường dẫn đến hình ảnh

        // Hiển thị tiêu đề và nội dung tin tức
        echo "<h2>$title</h2>";
        echo "<p>$content</p>";

        // Hiển thị hình ảnh
        echo "<img src='$imagePath' alt='$title'>";
    } else {
        echo "Không tìm thấy tin tức.";
    }
} else {
    echo "ID tin tức không hợp lệ.";
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
?>
    <a href="news.php">Xem Tin Tức</a>
</body>
</html>
