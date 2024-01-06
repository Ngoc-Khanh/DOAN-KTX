<!DOCTYPE html>
<html>
<head>
    <title>Danh Sách Tin Tức</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .page-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .news-list {
            list-style: none;
            padding: 0;
        }
        .news-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #fff;
        }
        .news-image {
            max-width: 200px;
            margin-right: 20px;
        }
        .news-content {
            flex-grow: 1;
        }
        .news-title {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }
        .news-date {
            font-size: 14px;
            color: #888;
        }
        .news-link {
            text-decoration: none;
            color: #0077b6;
        }
        .no-news {
            text-align: center;
            font-weight: bold;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            color: #0077b6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="page-title">Danh Sách Tin Tức</h1>
        <ul class="news-list">
            <?php
            include_once('../../chucnangadmin/config/database.php'); // Kết nối đến cơ sở dữ liệu

            $sql = "SELECT id, title, created_at, image_url FROM news ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li class='news-item'>";
                    
                    // Hiển thị hình ảnh nhỏ minh họa bên trái
                    if (!empty($row["image_url"])) {
                        echo "<img class='news-image' src='" . $row["image_url"] . "' alt='" . $row["title"] . "'>";
                    }
                    
                    echo "<div class='news-content'>";
                    
                    // Hiển thị ngày đăng tin phía trên tiêu đề
                    echo "<div class='news-date'>" . date("d/m/Y", strtotime($row["created_at"])) . "</div>";

                    echo "<h2 class='news-title'><a class='news-link' href='index.php?action=view_news&id=" . $row["id"] . "'>" . $row["title"] . "</a></h2>";
                    
                    echo "</div>"; // Đóng news-content
                    echo "</li>";
                }
            } else {
                echo "<p class='no-news'>Không có tin tức nào.</p>";
            }

            $conn->close();
            ?>
        </ul>
        <a class="back-link" href="news.php">Quay lại danh sách tin tức</a>
    </div>
</body>
</html>
