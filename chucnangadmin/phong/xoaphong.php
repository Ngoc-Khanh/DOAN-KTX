<!DOCTYPE html>
<html lang="en">
<head>
    <title>Xoá phòng</title>
</head>
<body>
<?php
    $conn = mysqli_connect("localhost", "root", "","kytucxa");
    if(!$conn){
        die("Ket noi that bai");
    }
    else{
        if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        $sql = "DELETE FROM phong WHERE MaPhong='".$_GET['MaPhong']."'";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            echo "Delete error" .mysqli_error($conn);
        }else{
            echo "Delete success";
        }
    }
}
    header("location: index.php?action=quanlyphong");
    ?>
    </body>
</html>