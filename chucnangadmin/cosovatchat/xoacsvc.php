<!DOCTYPE html>
<html lang="en">
<head>
    <title>Xoá cơ sở vật chất</title>
</head>
<body>
<?php
    $conn = mysqli_connect("localhost", "root", "","kytucxa");
    if(!$conn){
        die("Ket noi that bai");
    }
    else{
        if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        $sql = "DELETE FROM cosovatchat WHERE MaCSVC='".$_GET['MaCSVC']."'";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            echo "Delete error" .mysqli_error($conn);
        }else{
            echo "Delete success";
        }
    }
}
    header("location: index.php?action=csvc");
    ?>
    </body>
</html>