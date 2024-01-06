<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Tin Tức - Danh sách Tin Tức</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 8px 0;
        }

        h1 {
            text-align: center;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: right;
            border: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .action-button {
            background-color: #096BFF;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin: 10px 5px;
        }

        .action-button:hover {
            background-color: #0753CD;
        }

        .add-button {
            background-color: #1E6C41;
        }

        .add-button:hover {
            background-color: #0E472C;
        }

        .delete-button {
            background-color: #FF6B6B;
        }

        .delete-button:hover {
            background-color: #D84C4C;
        }

        .edit-button {
            background-color: #FFC30F;
        }

        .edit-button:hover {
            background-color: #D1A109;
        }

        .back-button {
            background-color: #333;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            text-align: center;
            display: block;
            margin: 0 auto;
            margin-top: 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>Quản lý Tin Tức - Danh sách Tin Tức</h1>
    </header>
    <div class="container">
        <?php
            $conn = mysqli_connect("localhost", "root", "", "kytucxa");
            if (!$conn) {
                die("Kết nối thất bại");
            } else {
                $sql = "SELECT * FROM news";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "<p>Danh sách Tin Tức</p>";
                    echo "<table>";
                    echo "<thead>";
                    echo "<tr>
                                <th>ID</th>
                                <th>Tiêu đề</th>
                                <th>Ngày đăng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $ID = $row['id'];
                        echo "<tr>";
                        echo "<td>" . $ID . "</td>";
                        echo "<td>" . $row["title"] . "</td>";
                        echo "<td>" . $row["created_at"] . "</td>";
                        echo "<td>
                                  <a href='index.php?action=suablog&id=" . $ID . "' class='action-button edit-button'>Sửa</a>
                                  <a href='index.php?action=xoablog&id=" . $ID . "' class='action-button delete-button'>Xóa</a>
                              </td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "Không có Tin Tức nào";
                }
            }
        ?>

        <a href="../quanlyblog/add_news.php" class="action-button add-button">Thêm Tin Tức</a>
        <a href='../admin/index.php?action=quanlyblog' class='back-button'>Quay lại</a>
    </div>
</body>
</html>
