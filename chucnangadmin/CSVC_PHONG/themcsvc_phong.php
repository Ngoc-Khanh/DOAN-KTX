<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm cơ sở vật chất</title>
</head>
<body>
<?php
    $MaPhong = "";
    
    $conn = mysqli_connect("localhost", "root", "", "kytucxa");
    if (!$conn) {
        die("Kết nối thất bại");
    } else {
        $sql = "SELECT * FROM phong";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                
                $MaPhong = $row["MaPhong"];
             
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
                        <td>
                            <input type="hidden" name="txtID">
                        </td>
                    </tr>
                    <tr>
                        <td>Mã Phòng</td>
                        <td>
                            <select name="txtMaPhong" ><?php $MaPhong=$row['MaPhong']; $sql="select * from phong";$result=mysqli_query($conn,$sql);
                    		while ($kq=mysqli_fetch_array($result)) { ?>
                    			<option <?php  if($kq['MaPhong']==$MaPhong){ echo 'selected="selected"' ;} ?> value="<?php  echo $kq['MaPhong']; ?>"> <?php echo $kq['MaPhong']; ?></option>
                    <?php } ?>  	
                    </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Mã CSVC</td>
                        <td>
                            <select name="txtMaCSVC">
                                <?php
                                $sql1 = "SELECT * FROM cosovatchat";
                                $result1 = mysqli_query($conn, $sql1);
                                while ($kq = mysqli_fetch_array($result1)) {
                                    $selected = ($kq['MaCSVC'] == $MaCSVC) ? 'selected' : '';
                                    echo "<option value='{$kq['MaCSVC']}' $selected>{$kq['MaCSVC']} ({$kq['TenCSVC']})</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Số Lượng</td>
                        <td>
                            <input type="text" name="txtSoLuong">
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>Tình Trạng</td>
                        <td>
                            <input type="text" name="txtTinhTrang">
                        </td>
                    </tr>
                    <tr> -->
                        <td>Ghi Chú</td>
                        <td>
                            <input type="text" name="txtGhiChu">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="btnLuu">Lưu</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnLuu'])) {
        $conn = mysqli_connect("localhost", "root", "", "kytucxa");
        if (!$conn) {
            die("Kết nối thất bại");
        }
        $ID=$_POST['txtID'];
        $MaCSVC = $_POST['txtMaCSVC'];
        $MaPhong = $_POST['txtMaPhong'];
        // $TenCSVC = $_POST['txtTenCSVC'];
        $SoLuong = $_POST['txtSoLuong'];
        // $TinhTrang = $_POST['txtTinhTrang'];
        $GhiChu = $_POST['txtGhiChu'];

        $sql = "INSERT INTO csvc_phong (ID,MaPhong, MaCSVC, SoLuong, GhiChu) VALUES ( '$ID','$MaPhong','$MaCSVC', '$SoLuong', '$GhiChu')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Insert error";
        } else {
            echo "Insert success";
        }
        header("Location: index.php?action=csvc_phong");
    }
    ?>
    
</body>
</html>
