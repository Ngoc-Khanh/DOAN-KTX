<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Thêm Tin Tức</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
            margin: 0;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #096BFF;
            color: white;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #0753CD;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Thêm Tin Tức</h1>
    <form method="post" action="process_add_news.php" enctype="multipart/form-data">
        <label for="title">Tiêu đề:</label>
        <input type="text" name="title" id="title" required>
        <br><br>
        <label for="content">Nội dung:</label>
        <textarea name="content" id="content" rows="4" required></textarea>
        <br><br>
        <label for="image">Hình ảnh:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
        <br><br>
        <input type="submit" value="Thêm Tin Tức">
    </form>
    <a href="../admin/index.php?action=quanlyblog">Quay lại trang quản trị</a>
</body>
</html>
