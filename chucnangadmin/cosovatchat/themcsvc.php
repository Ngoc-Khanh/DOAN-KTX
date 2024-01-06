<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm cơ sở vật chất</title>
</head>
<body>
<?php
    $MaCSVC = "";
    $TenCSVC = "";
   
    $conn = mysqli_connect("localhost", "root", "", "kytucxa");
    if (!$conn) {
        die("Kết nối thất bại");
    } else {
        $sql = "SELECT * FROM cosovatchat";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                
                $MaCSVC = $row["MaCSVC"];
                $TenCSVC = $row["TenCSVC"];
               
            }
        } else {
            echo "Không có bản ghi";
        }
    }
    ?>
    <form method="post">
        <div>
            <table>
                <tbody>
                    <tr>
                        <td>Mã CSVC</td>
                        <td>
                           <input type="text" name="txtMaCSVC">
                        </td>
                    </tr>
                    <tr>
                        <td>Mã Phòng</td>
                        <td>
                            <input type="text" name="txtTenCSVC">
                        </td>
                    </tr>
              
                    <tr>
                        <td>
                            <button type="submit" name="btnLuu">Thêm</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['btnLuu']) ){
            $conn = mysqli_connect("localhost","root","","kytucxa");
            if(!$conn){
                die ("Kết nối thất bại");
            }
            $sql="INSERT INTO cosovatchat (MaCSVC, TenCSVC) VALUES ('".$_POST['txtMaCSVC']."','".$_POST['txtTenCSVC']."')";
            $result = mysqli_query($conn,$sql);
            if(!$result){
                echo "Insert error";
            }else{
                echo "Insert success";
            }

        }
    ?>
     <a href="index.php?action=csvc"> Quay lại</a>
</body>
</html>