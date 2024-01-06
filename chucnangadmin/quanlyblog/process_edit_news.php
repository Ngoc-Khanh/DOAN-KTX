<?php
include("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
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
        // Thực hiện truy vấn để cập nhật tin tức trong cơ sở dữ liệu, bao gồm cả đường dẫn hình ảnh mới
        $sql = "UPDATE news SET title='$title', content='$content', image_url='$imagePath' WHERE id=$id";

        if ($conn->query($sql) == TRUE) {
            header("Location: index.php?action=quanlyblog"); // Chuyển hướng về trang quản trị
        } else {
            echo "Lỗi: " . $conn->error;
        }
    } else {
        echo "Có lỗi xảy ra khi tải lên hình ảnh.";
    }
}

$conn->close();
?>
