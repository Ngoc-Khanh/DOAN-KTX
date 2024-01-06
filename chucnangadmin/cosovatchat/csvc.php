<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="phong.css">
    <title>Cơ sở vật chất</title>
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
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
        }

        .btn-xoa {
            background-color: #ff6b6b;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
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
        $sql = "SELECT * FROM cosovatchat";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {?>
<!-- <html>
            <div>
                <form method="GET" action="timkiemphong.php" >
                    <input type="text" name="timkiemphong" placeholder="Tìm kiếm theo mã phòng hoặc mã khu" >
                    <button type="submit" >Tìm kiếm</button>
                </form>
            </div>
</html> -->

<table class="table table-hover text-center " style="font-size: 90%">
	<thead class="badge-info">
		<tr>
                <th>Mã CSVC</th>
                <th>Tên CSVC</th>
                <th colspan='2'>Thao tác</th>		
        </tr>
	</thead>
<?php
	// $MaKhu=$row['MaKhu'];
	$sql1="SELECT * FROM cosovatchat";
    // WHERE MaKhu='$MaKhu'";
	$rs1=mysqli_query($conn,$sql1);
	while ($row1=mysqli_fetch_array($rs1)) {
?>
	<tbody>
		<tr>
        <td><?php echo $row1['MaCSVC'] ?></td>
        <td><?php echo $row1['TenCSVC'] ?></td>
        <td><a href="index.php?action=suacsvc&MaCSVC=<?php echo $row1['MaCSVC']?>"><button class='btn-sua'>Sửa</button></a></td>
        <td><a onclick="confirmDelete('<?php echo $row1['MaCSVC'] ?>')"><button class='btn-xoa'>Xóa</button></a></td>
    </tr>
	</tbody>
    
<?php } ?>
</table>
<?php }else {
            echo "không có bản ghi";    
        }
    }
?>
<div>
    <a href="index.php?action=themcsvc"><button class="btn-them"><b>Thêm</b></button></a>
    <a href="index.php?action=xuatcsvc"><button class="btn-xuatexcel"><b>Xuất Excel</b></button></a>
</div>
<script>
        function confirmDelete(MaCSVC) {
            if (confirm("Bạn có chắc chắn muốn xóa phòng này không?")) {
                window.location.href = 'index.php?action=xoacsvc&MaCSVC=' + MaCSVC + '&confirm=yes';
                alert("Xóa thành công!");
            }
        }

</script>
</body>
</html>