<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký phòng ký túc xá</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

.container {
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 20px;
}

h1 {
    text-align: center;
    color: #333;
}

form {
    margin: 0 auto;
    max-width: 400px;
}

p {
    margin: 10px 0;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="radio"] {
    margin: 5px;
}

label {
    font-weight: bold;
}

input[type="submit"] {
    display: block;
    background-color: #007bff;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 5px;
    width: 100%;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}
</style>
</head>
<body>
    <h1>Đăng ký phòng ký túc xá</h1>
    <?php
    $conn = new mysqli("localhost", "root", "", "kytucxa");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    
    if (isset($_SESSION['sv'])) {
        $sv=$_SESSION['sv'];
    }
    
    $maSV = $sv['MaSV'];
    $query = "SELECT MaSV, HoTen, GioiTinh FROM sinhvien WHERE MaSV = '$maSV'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hoTen = $row['HoTen'];
        $gioiTinh = $row['GioiTinh'];
    }

// Xác định danh sách khu dựa vào giới tính
if ($gioiTinh == 'nam') {
    $danhSachKhu = array('A', 'B');
} elseif ($gioiTinh == 'nữ') {
    $danhSachKhu = array('C', 'D');
} else {
    $danhSachKhu = array(); // Giới tính không xác định, không hiển thị khu nào.
}

?>

<div class="container">

    <?php 
     // Lấy thông tin về số người trong phòng và giá phòng
     $sql = "SELECT MaKhu,MaPhong, SoNguoiToiDa, Gia FROM phong";
     $result = $conn->query($sql);
 
     if ($result->num_rows > 0) {
        echo "<form action='index.php?action=xulydangky' method='post'>";
            echo "<p>Mã sinh viên: <input type='text' name ='txtMaSV' value='$maSV'></p>";
            echo "<p>Họ và tên: <input type='text' name='txtHoTen' value='$hoTen' ></p>";
            echo "<p>Giới tính: <input type='text' name='txtGioiTinh' value='$gioiTinh' ></p>";
        echo "<p>Chọn số người trong 1 phòng:</p>";
        
        $roomChoices = array(); // Mảng để lưu các lựa chọn đã được hiển thị
        
        while ($row = $result->fetch_assoc()) {
            $maPhong = $row["MaPhong"];
            $soNguoiToiDa = $row["SoNguoiToiDa"];
            $gia = $row["Gia"];
            $choice = "$soNguoiToiDa người - Giá: $gia VND";
            
            // Nếu lựa chọn chưa được hiển thị, thêm vào form và danh sách
            if (!in_array($choice, $roomChoices)) {
                echo "<input type='radio' name='SoNguoi' value='$soNguoiToiDa'>$choice<br>";
                $roomChoices[] = $choice; // Thêm vào danh sách
            }
        }?>
          <label for="khu">Chọn Khu:</label>
        <?php foreach ($danhSachKhu as $khu) : ?>
            <input type="radio" name="khu" value="<?php echo $khu; ?>"> Khu <?php echo $khu; ?>
        <?php endforeach;

        echo "<p>*Lưu ý: Hệ thống sẽ tự động chọn phòng cho bạn theo yêu cầu trên. Hệ thống sẽ gửi thông báo sau!</p>";
        echo "<input type='submit' value='Đăng ký phòng'>";
        echo "</form>";
     }
        ?>
</div>
</body>
</html>

