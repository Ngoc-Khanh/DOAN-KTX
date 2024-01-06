<?php
    session_start(); 
  	ob_start();
    include_once('../../chucnangadmin/config/database.php');
    include_once('../banutlienhe/1.php');
    ?>
    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" href="css.css">
    <script src="../jquery/jquery.js"></script>
    <script src="../bootstrap4/js/bootstrap.js"> </script>
    <title>Users Pages</title>
<div>
      <div class="container-fluid">
        <div class="row nenxanh">
                <div class="col-md-4">
                    <img class="logo" src="images/logo.jpg" alt="">
                </div>
                <div class="col-md-5     cantop"><center>
                        <h5> KÝ TÚC XÁ - Đại Học Công Nghệ Giao Thông Vận Tải</h5>
                        <h7> 54 Triều Khúc - Hà Nội</h7></center>
                </div>
                <div class="col-md-3 cantop"><center>
                        <img class="logofb" src="images/logofb.png">
                </div>
        </div>
        <div class="row">
            <div class="col-12">
                <nav class="menu">
                    <ul>
                        <li><a  href="#">TRANG CHỦ</a></li>
                        <li><a  href="#">Webiste Trường</a></li>
                        <li><a  href="#">Trang sinh viên Trường</a></li>
                        <li><a href="#">Liên hệ</a></li>
                        <li><a class="ad" href="index.php?action=login">Đăng nhập</a></li>
                    </ul>
                </nav>
            </div>          
        </div>
    </div> 
</div>

<div class="container-fluid">
        <dir class="row">
            <div class="col-2 nenbac" style="margin-left: -20px">
                    <nav id="menu">      
                        <ul>
                            <h3> Sinh Viên </h3> 
                                    <li><a href="index.php?action=login">Đăng nhập</a></li>
                                    <li><a href="index.php?action=capnhatthongtin">Cập Nhật Thông Tin</a></li>
                                    <li><a href="index.php?action=doimatkhau">Đổi Mật Khẩu</a></li>
                                    <li><a href="index.php?action=dkphong">Đăng Ký Phòng</a></li>
                                    <li><a href="index.php?action=chuyenphong">ĐK Chuyển Phòng</a></li>
                                    <li><a href="index.php?action=traphong">Trả Phòng</a></li>
                                    <li><a href="index.php?action=xemthongbao">Xem Thông Báo</a></li>
                                    <li><a href="index.php?action=blog">Blog</a></li>
                                    <li><a href="index.php?action=logout">Đăng Xuất</a></li>
                        </ul>        
                      </nav>
            </div>
            <div class="col-8 ">
                
            <?php 
	if(isset($_GET['tb'])){
			$tb = $_GET['tb'];
			switch ($tb) {
				case 'ok':
				     echo '<script>alert("success!!!")</script>';
					break;
				case 'loi':
				     echo '<script>alert("Lỗi!!!")</script>';
					break;	
				case 'ok1':
				     echo '<script>alert("Đăng ký thành công. Nhân viên sẽ thông báo sau!!!")</script>';
					break;
				case 'ok2':
				     echo '<script>alert("Đăng ký trả phòng thành công. Nhân viên sẽ kiểm tra và thông báo sau!!!")</script>';
					break;	
				case 'loi1':
				     echo '<script>alert("Vui lòng trả phòng đang ở trước khi đăng ký... Nếu bạn đã đăng ký trước đó vui lòng đợi, nhân viên sẽ thông báo sau !!!")</script>';
					break;
					
				case 'loi2':
				     echo '<script>alert("Lỗi!!!")</script>';
					break;
				case 'loi3':
						$sn=$_GET['sn'];
				     echo '<script>alert("Phòng ('.$sn.' người) đã hết. Vui lòng chọn phòng khác !!!")</script>';
					break;									
				default:
				 
				break;
		}
	}
	if(isset($_GET['action'])){
		$action = $_GET['action'];
		switch ($action) {
			case 'login':
			    include_once('../user/dangnhap.php');
				break;
			case 'capnhatthongtin':
			    include_once('../thongtinsinhvien/thongtinsinhvien1.php');
				break;
			case 'xulydangkydkcp':
			    include_once('../dangkychuyenphong/xulydangky.php');
				break;
            case 'xemthongbao':
                include_once('../thongbao/thongbao.php');
                break;
			case 'doimatkhau':
			    include_once('../doimatkhau/doimatkhau.php');
				break;
			case 'dkphong':
			    include_once('../dangkyphong/dangkyphong.php');
				break;
			case 'xulydangky':
			    include_once('../dangkyphong/xulydangky.php');
				break;
			case 'chuyenphong':
			    include_once('../dangkychuyenphong/dangkychuyenphong.php');
				break;
			case 'traphong':
			    include_once('../dangkytraphong/dangkytraphong.php');
				break;
			case 'tracucphong':
			    include_once('../phong/phong.php');
				break;
			case 'blog':
			    include_once('../blog/news.php');
				break;
			case 'view_news':
			    include_once('../blog/view_news.php');
				break;
			case 'logout':
			    include_once('dangxuat.php');
				break;
			default:
                if (isset($_SESSION['sv'])) {
                    $vs=$_SESSION['sv'];
                    echo "<h6>Xin chào sinh viên : ".$vs['HoTen']."</h6>";
                }
				break;
		}
	}
	else
	{
		if (isset($_SESSION['sv'])) {
            $vs=$_SESSION['sv'];
            echo "<h6>Xin chào sinh viên : ".$vs['HoTen']."</h6>";
        }
	}
	
?>
            <!-- </div>
            <div class="col-2 nenbac">
               <div >   
                    <img src="images/logo.jpg" width="200" 
                         alt="Activities Board">
                    <center><h2><a href="#" class="no_underline">
                        Tin tức UTT</center>
                    </a></h2>
                    <p class="news_item">Ký Túc Xá sẽ mở cửa phục vụ sinh viên ....</p>
                </div>

            </div>
        </dir>        
    </div> -->


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin Page</title>
</head>
<body>
    <div class="container">
        <div class="content">
            <h3>Hi, <span>Admin</span></h3>
            <h1>welcome Admin</h1>
            <p>This is admin page</p>
            <a href="dangnhap.php" class="btn">Login</a>
            <a href="dangki.php" class="btn">Register</a>
            <a href="dangxuat.php" class="btn">Logout</a>
        </div>
    </div>
</body>
</html> -->