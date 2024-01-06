<!DOCTYPE html>
<html lang="en">
<head>
    <title>Xoá Khu</title>
</head>
<body>
<?php
    $conn = mysqli_connect("localhost", "root", "","kytucxa");
    if(!$conn){
        die("Ket noi that bai");
    }
    else{
        if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        $sql = "DELETE FROM khu WHERE MaKhu='".$_GET['MaKhu']."'";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            echo "Delete error" .mysqli_error($conn);
        }else{
            echo "Delete success";
        }
    }
}
    header("location: khu.php");
    ?>
    </body>
</html>