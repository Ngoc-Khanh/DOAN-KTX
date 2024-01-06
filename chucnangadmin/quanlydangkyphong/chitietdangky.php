<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chi tiết đăng ký</title>
</head>
<style>
        /* Định dạng trang web */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
            background-color: blanchedalmond;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex; /* Sử dụng flexbox để xếp hai bảng cạnh nhau */
        }

        .card-title {
            text-align: center;
            font-size: 30px;
        }

        /* CSS cho bảng thông tin sinh viên */
        .student-table {
            flex: 1; /* Bảng sinh viên sẽ chiếm 50% chiều rộng */
            background-color: rgba(0, 128, 0, 0.1);
            border-radius: 0; /* Không bo góc */
            margin-right: 10px; /* Khoảng cách giữa hai bảng */
        }

        .student-table th, .student-table td {
            padding: 18px;
            text-align: center;
            background-color: rgba(0, 128, 0, 0.1);
        }

        .student-table th {
            background-color: #f0f0f0;
            color: black;
            font-weight: bold;
        }

        /* CSS cho bảng thông tin phòng */
        .room-table {
            flex: 1; /* Bảng phòng sẽ chiếm 50% chiều rộng */
            background-color: rgba(0, 128, 0, 0.1);
            border-radius: 0; /* Không bo góc */
            margin-left: 10px; /* Khoảng cách giữa hai bảng */
        }

        .room-table th, .room-table td {
            padding: 18px;
            text-align: center;
            background-color: rgba(0, 128, 0, 0.1);
        }

        .room-table th {
            background-color: #f0f0f0;
            color: black;
            font-weight: bold;
        }
    </style>
<body>

<?php
$conn = mysqli_connect("localhost", "root", "", "kytucxa");

	$madk=$_GET['madk'];
	$sql="SELECT * FROM `sinhvien` WHERE MaSV =(SELECT MaSV from dangkyphong WHERE MaDK=$madk)";
	$rs=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($rs);
	$sql1="SELECT * FROM `phong` WHERE MaPhong =(SELECT MaPhong from dangkyphong WHERE MaDK=$madk)";
	$rs1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_array($rs1); 
    $makhu=$row1['MaKhu'];
	$sql2="SELECT * FROM `Khu` WHERE MaKhu ='$makhu'";
	$rs2=mysqli_query($conn,$sql2);
	$row2=mysqli_fetch_array($rs2);
?>
	<h1> Danh sách sinh viên đăng ký phòng => Chi tiết sinh viên </h1>
	<div class='container'>
			<table class="student-table">
				<thead>
					<tr class="badge-info text-center"><td colspan="2"><h3>Thông tin sinh viên đăng ký</h3> </td></tr>
					<tr>
						<th>Mã sinh viên</th><th> <?php echo $row['MaSV'] ?></th>
					</tr>
					<tr>
						<th>Họ và Tên </th><th> <?php echo $row['HoTen'] ?></th>
					</tr>
					<tr>
						<th>Giới Tính </th><th> <?php if($row['GioiTinh']=='nữ'){echo 'Nữ';}else{echo 'Nam';} ?></th>
					</tr>
					<tr>
						<th>Ngày sinh</th><th> <?php echo $row['NgaySinh'] ?></th>
					</tr>
					<tr>
						<th>Địa Chỉ </th><th> <?php echo $row['DiaChi'] ?></th>
					</tr>
					<tr>
						<th>SĐT</th><th> <?php echo $row['SDT'] ?></th>
					</tr>
				</thead>
			</table>
			
			<table class="room-table">
				<thead>
					<tr class="badge-info text-center"><td colspan="2"><h3>Thông tin Phòng</h3> </td></tr>
					<tr>
						<th>Mã Phòng</th><th> <?php echo $row1['MaPhong'] ?></th>
					</tr>
					<tr>
						<th>Mã Khu</th><th> <?php echo $row1['MaKhu'].' (Khu '.$row2['GioiTinh'].')'; ?></th>
					</tr>
					<tr>
						<th>Số Người Tối Đa</th><th> <?php echo $row1['SoNguoiToiDa'] ?></th>
					</tr>
					<tr>
						<th>Số Người Hiện Tại</th><th> <?php echo $row1['SoNguoiHienTai']; ?></th>
					</tr>
					<tr>
						<th>Giá</th><th> <?php echo number_format($row1['Gia']).' đ' ?></th>
					</tr>
					<tr>
						<th> &emsp;</th><th> &emsp;</th>
					</tr>
				</thead>
			</table>
			
		</div>
	</div><hr class="badge-danger"><br>
	
	</body>
</html>