<?php
// Kết nối vào cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "kytucxa");

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];

    // Xử lý tải lên hình ảnh
    $image = $_FILES["image"];
    $imageName = $image["name"];
    $imageTmpName = $image["tmp_name"];
    $imageError = $image["error"];
    $imageType = $image["type"];

    // Kiểm tra xem người dùng đã chọn hình ảnh chưa
    if ($imageError === 0) {
        // Tạo đường dẫn cho hình ảnh trong thư mục lưu trữ (ví dụ: uploads/)
        $imagePath = "uploads/" . $imageName;

        // Di chuyển tệp tin hình ảnh từ thư mục tạm sang thư mục lưu trữ
        move_uploaded_file($imageTmpName, $imagePath);
        $imagePath = "../../chucnangadmin/quanlyblog/uploads/" . $imageName;
        // Thêm tin tức vào cơ sở dữ liệu với đường dẫn hình ảnh
        $sql = "INSERT INTO news (title, content, image_url) VALUES ('$title', '$content', '$imagePath')";
        if ($conn->query($sql) === TRUE) {
            header("Location: admin.php"); // Chuyển hướng về trang quản trị
            exit();
        } else {
            echo "Lỗi: " . $conn->error;
        }
    } else {
        echo "Có lỗi xảy ra khi tải lên hình ảnh.";
    }
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
?>
