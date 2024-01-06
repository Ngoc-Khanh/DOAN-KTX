<?php
$conn = mysqli_connect("localhost", "root", "", "kytucxa");
if (!$conn) {
	die("Ket noi that bai");
}
// $sql = "select * from dangkyphong where TinhTrang='chưa duyệt' and NgayDangKy is not null and NgayTraPhong is null Order  by NgayDangKy DESC ";
$sql = "select * from dangkyphong";
$rs = mysqli_query($conn, $sql);

?>
<style>
	body {

		font-family: Arial, sans-serif;
		margin: 0;
		padding: 0;
	}

	h1 {
		text-align: center;
		color: #00796b;
		/* Màu xanh nhạt cho tiêu đề */
	}

	table {
		width: 100%;
		border-collapse: collapse;
		font-size: 13px;
	}

	th,
	td {
		border: 1px solid #00796b;
		/* Màu xanh nhạt cho viền của bảng */
		padding: 8px;
	}

	th {
		background-color: #00acc1;
		/* Màu xanh nhạt cho dòng tiêu đề của bảng */
		color: #fff;
		font-weight: bold;
	}

	tr:nth-child(even) {
		background-color: #b2dfdb;
		/* Màu xanh nhạt cho các hàng chẵn của bảng */
	}


	a:hover {
		text-decoration: underline;
	}

	.badge-danger {
		background-color: #ff6f61;
		/* Màu đỏ nhạt cho nút Thao Tác */
		color: #fff;
		text-align: center;
	}

	.badge-danger a {
		color: #fff;
	}
</style>
<h1> Danh sách sinh viên đăng ký phòng </h1>
<table class="table table-hover m-auto text-center" style="font-size: 13px;">
	<thead class="badge-info">
		<tr>
			<th>Mã Đăng Ký</th>
			<th>Mã Sinh Viên</th>
			<th>Mã Nhân Viên</th>
			<th>Mã Phòng</th>
			<th>Ngày Đăng Ký</th>
			<th>Tình trạng</th>
			<th>Chi Tiết</th>
			<th colspan="1" class="badge-danger">Thao Tác</th>
		</tr>
	</thead>
	<tbody>
		<?php $so = 0;
		while ($row = mysqli_fetch_array($rs)) {
			$masv = $row['MaSV'];
			$maphong = $row['MaPhong'];
			$sql2 = "select * from sinhvien where MaSV='$masv'";
			$rs2 = mysqli_query($conn, $sql2);
			$row2 = mysqli_fetch_array($rs2);
			$sql12 = "select * from phong where MaPhong='$maphong'";
			$rs12 = mysqli_query($conn, $sql12);
			$row12 = mysqli_fetch_array($rs12); ?>
			<tr>
				<td><?php echo $row['MaDK']; ?></td>
				<td><?php echo $row['MaSV']; ?></td>
				<td><?php echo $row['MaNV']; ?></td>
				<td><?php echo $row['MaPhong']; ?></td>
				<td><?php echo $row['NgayDangKy']; ?></td>
				<td><?php echo $row['TinhTrang']; ?></td>
				<td><a href="index.php?action=chitietdangkyqldkp&madk=<?php echo $row['MaDK']; ?>">Chi tiết</a></td>
				<td><a href="index.php?action=duyetdangkyqldkp&madk=<?php echo  $row['MaDK'] ?>&MaSV=<?php echo $masv; ?>">Duyệt <i class="fas fa-check"></i> </a></td>
				<!--<td><a href="danhmuc/main.php?view=ctdh&mahd=<?php echo $row['MaDK']; ?>" ><i class="fas fa-backspace"></i></a></td> -->
			</tr>
		<?php	} ?>
	</tbody>

	<?php

	?>