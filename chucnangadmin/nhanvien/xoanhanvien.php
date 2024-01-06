<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xoá nhân viên </title>
</head>
<body>
    <?php
    $conn= mysqli_connect("localhost","root","","kytucxa");
    if(!$conn){
        die("Ket noi that bai");
    } else {
        if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
            $sql= "DELETE FROM nhanvien WHERE MaNV = '".$_GET['MaNV']."'";
            $sql1= "DELETE FROM taikhoan WHERE MaNV = '".$_GET['MaNV']."'";
            $result= mysqli_query($conn,$sql);
            $result1= mysqli_query($conn,$sql1);
            if(!$result && !$result1){
                echo "Xóa thất bại";
            } else {
                echo "Xóa thành công";
            }
        }
    }
    header("location: index.php?action=nhanvien");
    ?>
</body>
</html>
