<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="phong.css">
    <title>Quản lý phòng</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            padding: 0;
        }
        
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 36px;
            font-weight: bold;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-sua {
            background-color: #FFC30F;
            color: black;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            align-items: center;
            display: inline-flex;
        }

        .btn-xoa {
            background-color: #ff6b6b;
            color: black;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            align-items: center;
            display: inline-flex;
        }

        .btn-sua:hover, .btn-xoa:hover {
            opacity: 0.8;
        }

        .btn-them {
            background-color: #096BFF;
            color: #fff;
            border: none;
            padding: 12px 33px; 
            margin: 20px 0; 
            cursor: pointer;
            display: inline-block; 
            
        }

        .btn-xuatexcel {
            background-color: #1E6C41;
            color: #fff;
            border: none;
            padding: 12px 24px;
            margin: 20px 10px 20px 0; 
            cursor: pointer;
            display: inline-block; 
        }

        .btn-them:hover, .btn-xuatexcel:hover {
            opacity: 0.8;
        }

        form {
            margin: 20px 0;
            text-align: center;
        }

        input[type="text"] {
            padding: 10px;
            width: 60%;
        }

        button[type="submit"] {
            background-color: #ccc5c5;
            color: #333;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
</style>
<body>
<?php
    $conn = mysqli_connect("localhost", "root", "", "kytucxa");
    if(!$conn) {
        die("Ket noi that bai");
    } else {
        $sql="SELECT  ID, MaPhong, cosovatchat.MaCSVC, cosovatchat.TenCSVC, SoLuong, GhiChu FROM csvc_phong INNER JOIN cosovatchat ON csvc_phong.MaCSVC=cosovatchat.MaCSVC ORDER BY MaPhong ";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {?>
<html>
            <div>
                <form method="GET" action="index.php?action=timkiemcsvc_phong" >
                    <input type="text" name="timkiemcsvc_phong" placeholder="Tìm kiếm theo mã phòng hoặc tên cơ sở vật chất" >
                    <button type="submit" >Tìm kiếm</button>
                </form>
            </div>
</html>

<table class="table table-hover text-center " style="font-size: 90%">
	<thead class="badge-info">
		<tr>   
                <th>ID</th>
                <th>Mã Phòng</th>
                <th>Mã CSVC</th>
                <th>Tên CSVC</th>
                <th>Số Lượng</th>
                <th>Ghi Chú</th>
                <th colspan='2'>Thao tác</th>		
        </tr>
	</thead>
<?php
	// $MaKhu=$row['MaKhu'];
	$sql1="SELECT  ID,MaPhong, cosovatchat.MaCSVC, cosovatchat.TenCSVC, SoLuong, GhiChu FROM csvc_phong INNER JOIN cosovatchat ON csvc_phong.MaCSVC=cosovatchat.MaCSVC ORDER BY MaPhong";
    // WHERE MaKhu='$MaKhu'";
	$rs1=mysqli_query($conn,$sql1);
	while ($row1=mysqli_fetch_array($rs1)) {
?>
	<tbody>
		<tr>
        <td><?php echo $row1['ID'] ?></td>
        <td><?php echo $row1['MaPhong'] ?></td>
        <td><?php echo $row1['MaCSVC'] ?></td>
        <td><?php echo $row1['TenCSVC'] ?></td>
		<td><?php echo $row1['SoLuong'] ?></td>	
        <td><?php echo $row1['GhiChu'] ?></td>	
        <td><a href="index.php?action=suacsvcphong&ID=<?php echo $row1['ID']?>"><button class='btn-sua'><img src='edit.png'><b>Sửa</b></button></a></td>
        <td><a onclick="confirmDelete('<?php echo $row1['ID'] ?>')"><button class='btn-xoa'><img src='delete.png'><b>Xóa</b></button></a></td>

    </tr>
	</tbody>
    
<?php } ?>
</table>
<?php }else {
            echo "không có bản ghi";    
        }
    }
    // Đếm số dòng
$rowCount = mysqli_num_rows($result);

// In ra số dòng
echo "<br>";
echo "Tổng số dòng trong danh sách là: " .$rowCount;
?>
<div>
    <a href="index.php?action=themcsvc_phong"><button class="btn-them"><b>Thêm</b></button></a>
    <a href="index.php?action=xuatcsvc_phong"><button class="btn-xuatexcel"><b>Xuất Excel</b></button></a>
</div>
<script>
        function confirmDelete(ID) {
            if (confirm("Bạn có chắc chắn muốn xóa CSVC của phòng này không?")) {
                window.location.href = 'index.php?action=xoacsvc_phong&ID=' + ID +'&confirm=yes';
                alert("Xóa thành công!");
            }
            
        }
        header("Location: index.php?action=csvc_phong");
</script>
</body>
</html>