<?php
    $conn = mysqli_connect("localhost", "root", "", "kytucxa");
	$sql="select * from dangkyphong where TinhTrang='đã duyệt' Order by NgayDangKy DESC ";
	$rs=mysqli_query($conn,$sql);
	
?>
<style>
	body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    color: #333; /* Màu đen cho tiêu đề */
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

th, td {
    border: 1px solid #ccc; /* Màu xám nhạt cho viền của bảng */
    padding: 8px;
}

th {
    background-color: #007bff; /* Màu xanh nhạt cho dòng tiêu đề của bảng */
    color: #fff;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f2f2f2; /* Màu xám nhạt cho các hàng chẵn của bảng */
}


a:hover {
    text-decoration: underline;
}
</style>
		<h1> Danh sách sinh viên đã được duyệt đăng ký phòng </h1>
<table class="table table-hover m-auto text-center" style="font-size: 13px;">
	<thead class="badge-info">
		<tr>
			<th>Mã Đăng Ký</th> <th>Mã Sinh Viên</th><th>Mã Nhân Viên</th><th>Mã Phòng</th><th>Ngày Đăng Ký</th><th>Tình trạng</th><th>Chi Tiết</th>
		</tr>
	</thead>
	<tbody>
 <?php $so=0;
	 while ($row=mysqli_fetch_array($rs)) {
	 	$masv=$row['MaSV'];
        // $masv="SV4";
        $map=$row['MaPhong'];
	 	$sql2="select * from sinhvien where MaSV='$masv'"; $rs2=mysqli_query($conn,$sql2);$row2=mysqli_fetch_array($rs2);
	 	$sql12="select * from phong where MaPhong='$map'"; $rs12=mysqli_query($conn,$sql12);$row12=mysqli_fetch_array($rs12);?>
		<tr>
			<td><?php echo $row['MaDK']; ?></td>
			<td title="<?php echo $row2['HoTen'];?>"><?php echo $row['MaSV']; ?></td>
			<td><?php echo $row['MaNV']; ?></td>
			<td title="<?php echo 'Phòng '.$row12['SoNguoiToiDa'].' Người';?>"><?php echo $row['MaPhong']; ?></td>
			<td><?php echo $row['NgayDangKy']; ?></td>
			<td><?php echo $row['TinhTrang']; ?></td>
			<td><a href="index.php?action=chitietdangkyqldkp&madk=<?php echo $row['MaDK']; ?>" >Detail </a></td>
		
		</tr>
 <?php	} ?>
		
	</tbody>



<?php 


?>