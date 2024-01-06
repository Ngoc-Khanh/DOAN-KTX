<!DOCTYPE html>
<html>
<head>
    <title>Chi Tiết Tin Tức</title>
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
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .news-content {
            padding: 20px;
        }
        h2 {
            font-size: 24px;
            margin: 0;
        }
        p {
            font-size: 16px;
            margin-top: 10px;
        }
        img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
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
        <div class="header">
            <h1>Chi Tiết Tin Tức</h1>
        </div>
        <div class="news-content">
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
                    $imagePath = $row["image_url"];

                    // Hiển thị tiêu đề và nội dung tin tức
                    echo "<h2>$title</h2>";
                    echo "<p>$content</p>";

                    // Hiển thị hình ảnh (nếu có)
                    if (!empty($imagePath)) {
                        echo "<img src='$imagePath' alt='$title'>";
                    }

                    // Liên kết quay lại trang danh sách tin tức
                    echo "<a class='back-link' href='index.php?action=blog'>Quay lại danh sách tin tức</a>";
                } else {
                    echo "Không tìm thấy tin tức.";
                }
            } else {
                echo "ID tin tức không hợp lệ.";
            }

            // Đóng kết nối cơ sở dữ liệu
            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</html>
