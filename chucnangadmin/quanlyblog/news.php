<!-- news.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Danh Sách Tin Tức</title>
    <style>
        .news-item {
            display: flex;
            align-items: flex-start; /* Căn chỉnh hình ảnh và tiêu đề lên trên */
            margin-bottom: 10px;
        }
        .news-image {
            max-width: 300px; /* Điều chỉnh kích thước hình ảnh */
            margin-right: 10px;
        }
        .news-content {
            flex-grow: 1; /* Để tiêu đề và ngày đăng tin mở rộng để lấp đầy không gian trống */
        }
    </style>
</head>
<body>
    <h1 style="text-align: center">Danh Sách Tin Tức</h1>
    <?php
    include_once('db_connection.php'); // Kết nối đến cơ sở dữ liệu

    $sql = "SELECT id, title, created_at, image_url FROM news ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li class='news-item'>";
            
            // Hiển thị hình ảnh nhỏ minh họa bên trái
            if (!empty($row["image_url"])) {
                echo "<img class='news-image' src='" . $row["image_url"] . "' alt='" . $row["title"] . "'>";
            }
            
            echo "<div class='news-content'>";
            
            // Hiển thị ngày đăng tin nhỏ phía trên tiêu đề
            echo "<div class='news-date'>" . date("d/m/Y", strtotime($row["created_at"])) . "</div>";

            echo "<a href='view_news.php?id=" . $row["id"] . "'>" . $row["title"] . "</a>";
            
            echo "</div>"; // Đóng news-content
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "Không có tin tức nào.";
    }

    $conn->close();
    ?>
</body>
</html>
