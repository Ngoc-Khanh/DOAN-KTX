<!DOCTYPE html>
<html>
<head>
    <title>Chỉnh sửa Tin tức</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin: 20px auto;
        }

        label, input, textarea {
            display: block;
            margin: 10px 0;
        }

        img {
            max-width: 100%;
            display: block;
            margin: 10px auto;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="file"] {
            width: 100%;
            padding: 10px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <h1>Chỉnh sửa Tin tức</h1>
    <div class="container">
        <?php
        include("../config/database.php");

        if (isset($_GET["id"])) {
            $id = $_GET["id"];

            // Truy vấn tin tức cần chỉnh sửa
            $sql = "SELECT * FROM news WHERE id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $title = $row["title"];
                $content = $row["content"];
                $imagePath = $row["image_url"];
            } else {
                echo "Không tìm thấy tin tức.";
            }
        } else {
            echo "ID tin tức không hợp lệ.";
        }
        ?>

        <form method="post" action="index.php?action=pcsuablog" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="title">Tiêu đề:</label>
            <input type="text" name="title" id="title" value="<?php echo $title; ?>" required>

            <label for="content">Nội dung:</label>
            <textarea name="content" id="content" rows="4" required><?php echo $content; ?></textarea>

            <label for="image">Hình ảnh:</label>
            <input type="file" name="image" id="image">

            <img src="<?php echo $imagePath; ?>" alt="Hình ảnh hiện tại" width="300">
            
            <input type="submit" value="Lưu Tin tức">
        </form>
    </div>
</body>
</html>
