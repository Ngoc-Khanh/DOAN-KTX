<?php
    header("Content-type: text/html; charset=utf-8");
    $tenmaychu = 'localhost';
    $tentaikhoan = 'root';
    $matkhau = '';
    $csdl = 'kytucxa';
    $conn = mysqli_connect($tenmaychu, $tentaikhoan, $matkhau, $csdl);
    mysqli_select_db($conn, $csdl);
    mysqli_query($conn, "SET NAMES 'UTF8'");
?>