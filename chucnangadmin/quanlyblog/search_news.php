<?php
if (isset($_GET['search'])) {
    $search = $_GET['search'];

    $conn = mysqli_connect("localhost", "root", "", "kytucxa");
    if (!$conn) {
        die("Kết nối thất bại");
    }

    $sql = "SELECT * FROM news WHERE title LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<p>Kết quả tìm kiếm cho: " . $search . "</p>";
        echo "<table>";
        echo "<thead>";
        echo "<tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Ngày đăng</th>
                </tr>
            </thead>
            <tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            $ID = $row['id'];
            echo "<tr>";
            echo "<td>" . $ID . "</td>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["created_at"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "Không có kết quả tìm kiếm cho: " . $search;
    }

    mysqli_close($conn);
}
?>
