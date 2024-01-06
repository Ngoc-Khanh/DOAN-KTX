<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Phòng</title>
</head>
<body>
<?php
    $MaPhong = "";
    $MaKhu = "";
    $SoNguoiToiDa = "";
    $SoNguoiHienTai = "";
    $Gia = "";
    
    $conn = mysqli_connect("localhost", "root", "", "kytucxa");
    if (!$conn) {
        die("Kết nối thất bại");
    } else {
        $sql = "SELECT * FROM phong";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                
                $MaKhu = $row["MaKhu"];
                $SoNguoiToiDa = $row["SoNguoiToiDa"];
                $SoNguoiHienTai = $row["SoNguoiHienTai"];
                $Gia = $row["Gia"];
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
                        <td>Mã Khu</td>
                        <td>
                            <select class="form-control" name="txtMaKhu" ><?php $MaKhu=$row['MaKhu']; $sql="select * from khu";$result=mysqli_query($conn,$sql);
                    		while ($kq=mysqli_fetch_array($result)) { ?>
                    			<option <?php  if($kq['MaKhu']===$MaKhu){ echo 'selected="selected"' ;} ?> value="<?php  echo $kq['MaKhu']; ?>"> <?php echo $kq['MaKhu'].' ('.$kq['GioiTinh'].')'; ?></option>
                    <?php } ?>  	
                    </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Mã Phòng</td>
                        <td>
                            <input type="text" name="txtMaPhong">
                        </td>
                    </tr>
                    <tr>
                        <td>Số người tối đa</td>
                        <td>
                            <input type="text" name="txtSoNguoiToiDa">
                        </td>
                    </tr>
                    <tr>
                        <td>Số người hiện tại</td>
                        <td>
                            <input type="text" name="txtSoNguoiHienTai">
                        </td>
                    </tr>
                    <tr>
                        <td>Giá</td>
                        <td>
                            <input type="text" name="txtGia">
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
            $sql="INSERT INTO phong (MaKhu, MaPhong, SoNguoiToiDa, SoNguoiHienTai, Gia) VALUES ('".$_POST['txtMaKhu']."','".$_POST['txtMaPhong']."','".$_POST['txtSoNguoiToiDa']."','".$_POST['txtSoNguoiHienTai']."','".$_POST['txtGia']."')";
            $result = mysqli_query($conn,$sql);
            if(!$result){
                echo "Insert error";
            }else{
                echo "Insert success";
            }

        }
    ?>
     <a href="index.php?action=quanlyphong"> Quay lại</a>
</body>
</html>