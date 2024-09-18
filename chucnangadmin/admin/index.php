<?php 	  
  	ob_start();
  	session_start(); 
	if(!isset($_SESSION['nv'])) {
		header('location:dangnhap.php');
	}
	else {
		include_once('../config/database.php'); ?>
    <meta charset="utf-8">
    <script src="../template/vendor/jquery/jquery.min.js"></script>
    <script src="../template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../template/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../template/js/sb-admin-2.min.js"></script>
    <script src="../template/vendor/chart.js/Chart.min.js"></script>
    <script src="../template/js/demo/chart-area-demo.js"></script>
    <script src="../template/js/demo/chart-pie-demo.js"></script>
    <script src="../shoponi/jquery/jquery.js"></script>
    <script src="../shoponi/view/bootstrap4/js/bootstrap.js"> </script>
    <script src="../jquery/jquery.js"></script>
    <link href="../chucnangadmin/font/Font Awesome/css/all.min.css" rel="stylesheet" type="text/css"> 
    <link href="../template/cssfont.css" rel="stylesheet">
    <link href="../template/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../shoponi/view/bootstrap4/css/bootstrap.css">
   
    <title>Admin Page</title>
    <div class="main-body" style="width: 100%">
    <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>  
              </button>
               <h3 > ADMIN - PAGE</h3>
               <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span style="font-size: 15px;color: #333" class="mr-2 d-none d-lg-inline text-gray-600 small"><?php if(isset($_SESSION['nv'])){ $nv=$_SESSION['nv'];
                         echo $nv['HoTen'];} ?>
                        </span>
                        <i class="fas fa-users-cog font" style="font-size: 25px;color: #333"></i>
                   </a>
                  <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="dangxuat.php" >
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

          </ul>
      </nav>
    </div>
  </div>
  
  <div class="col-2" style="margin-left: -25px; margin-top: -20px;margin-right: 10px;">
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
              <div class="sidebar-brand-icon rotate-n-15">
                  <i class="fas fa-laugh-wink"></i>
              </div>
              <div class="sidebar-brand-text mx-3">Admin Page</div>
            </a>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
              <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
              Quản Lý
            </div>
             <!-- Nav Item - Pages Collapse Menu -->
           <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sanpham" aria-expanded="true" aria-controls="sanpham">
                <i class="fas fa-fw fa-cog"></i>
                <span>Quản Lý Đăng Ký Phòng</span> 
              </a>
              <div id="sanpham" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                 <!-- <h6 class="collapse-header">Quản Lý Sản Phẩm</h6>-->
                  <a class="collapse-item" href="index.php?action=quanlydangkyphong&view=quanlydangkyphong">Xử Lý Đăng Ký<br></a>
                  <a class="collapse-item" href="index.php?action=danhsachdaduyetqldkp">Danh sách đã xử  lý</a>
                  
                </div>

              </div>
           </li>

           <!-- <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sanpham" aria-expanded="true" aria-controls="sanpham">
                <i class="fas fa-fw fa-cog"></i>
                <span>Quản Lý Gửi Xe</span> 
              </a>
              <div id="sanpham" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded"> -->
                 <!-- <h6 class="collapse-header">Quản Lý Sản Phẩm</h6>-->
                  <!-- <a class="collapse-item" href="index.php?action=quanlyguixe&view=quanlyguixe">Xe Gửi</a>                  
                </div>
              </div>
           </li> -->

              <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#danhmuc" aria-expanded="true" aria-controls="danhmuc">
                  <i class="fas fa-poll-h"></i>
                  <span>Quản Lý Trả Phòng</span>  
              </a>
              <div id="danhmuc" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                 
                  <!-- <a class="collapse-item" href="index.php?action=quanlychuyenphong&view=quanlychuyenphong">Xử Lý Đ/K Chuyển Phòng</a> -->
                  
                  <a class="collapse-item" href="index.php?action=quanlytraphong&view=quanlytraphong">Xử Lý Đ/K Trả Phòng</a>
                </div>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#hoadon" aria-expanded="true" aria-controls="hoadon">
                  <i class="fas fa-yen-sign"></i>
                  <span>Quản Lý Hóa Đơn</span>
              </a>
              <div id="hoadon" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">          
                  <a class="collapse-item" href="index.php?action=hoadon&view=quanlyhoadon">Hóa đơn</a>
                </div>
              </div>
            </li>

            <!-- <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#blog" aria-expanded="true" aria-controls="blog">
                  <i class="fas fa-yen-sign"></i>
                  <span>Quản Lý Blog</span>
              </a>
              <div id="blog" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">          
                  <a class="collapse-item" href="index.php?action=quanlyblog&view=quanlyblog">Blog</a>
                </div>
              </div>
            </li> -->

            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#phong" aria-expanded="true" aria-controls="phong">
                  <i class="fas fa-poll-h"></i>
                  <span>Quản Lý Phòng</span>
              </a>
              <div id="phong" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                 
                  <a class="collapse-item" href="index.php?action=quanlyphong&view=quanlyphong">Phòng</a>
                  <!-- <a class="collapse-item" href="index.php?action=csvc&view=csvc">Các cơ sở vật chất</a>
                  <a class="collapse-item" href="index.php?action=csvcphong&view=csvcphong">Cơ sở vật chất của phòng</a> -->
                </div>
              </div>
            </li>

             <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#taikhoan" aria-expanded="true" aria-controls="taikhoan">
                  <i class="fas fa-poll-h"></i>
                  <span>Quản Lý Tài Khoản</span>
              </a>
              <div id="taikhoan" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                 
                  <a class="collapse-item" href="index.php?action=taikhoan&view=taikhoan">Tất cả tài khoản</a>
                
                </div>
              </div>
            </li>
            </li>
             <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#nv" aria-expanded="true" aria-controls="nv">
                  <i class="fas fa-poll-h"></i>
                  <span>Quản Lý Khu</span>
              </a>
              <div id="nv" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item" href="index.php?action=khu&view=all">Danh sách khu</a>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sv" aria-expanded="true" aria-controls="sv">
                  <i class="fas fa-poll-h"></i>
                  <span>Quản Lý Sinh Viên</span>
              </a>
              <div id="sv" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item" href="index.php?action=sinhvien&view=all">Tất cả sinh viên</a>          
                </div>
              </div>
            </li>
            </div>

            
<div class="col-10" style="margin-left: 15rem; margin-top: -45rem; margin-right: 10px;">
<?php
      if(isset($_GET['action'])){
          $action=$_GET['action'];
          switch ($action) {
                    case 'logout':  
                        header('location:dangxuat.php');
                    case 'xuatcsvc':
                        include('../cosovatchat/xuatcsvc.php');
                        break;
                    case 'xoacsvc':
                        include('../cosovatchat/xoacsvc.php');
                        break;
                    case 'themcsvc':
                        include('../cosovatchat/themcsvc.php');
                        break;
                    case 'suacsvc':
                        include('../cosovatchat/suacsvc.php');
                        break;
                    case 'csvc':
                        include('../cosovatchat/csvc.php');
                        break;
                    case 'csvcphong':
                        include('../CSVC_PHONG/csvc_phong.php');
                        break;
                    case 'suacsvcphong':
                        include('../CSVC_PHONG/suacsvc_phong.php');
                        break;
                    case 'themcsvc_phong':
                        include('../CSVC_PHONG/themcsvc_phong.php');
                        break;
                    case 'timkiemcsvc_phong':
                        include('../CSVC_PHONG/timkiemcsvc_phong.php');
                        break;
                    case 'xoacsvcphong':
                        include('../CSVC_PHONG/xoacsvc_phong.php');
                        break;
                    case 'xuatcsvc_phong':
                        include('../CSVC_PHONG/xuatcsvc_phong.php');
                        break;
                    case 'quanlydangkyphong':
                        include('../quanlydangkyphong/danhsachdangky.php');
                        break;
                    case 'duyetdangkyqldkp':
                        include('../quanlydangkyphong/duyetdangky.php');
                        break;
                    case 'danhsachdaduyetqldkp':
                        include('../quanlydangkyphong/danhsachdaduyet.php');
                        break;  
                    case 'chitietdangkyqldkp':
                        include('../quanlydangkyphong/chitietdangky.php');
                        break;  
                    case 'quanlychuyenphong':
                        include('../quanlychuyenphong/admin.php');
                        break;  
                    case 'xulyduyetqlcp':
                        include('../quanlychuyenphong/xulyduyet.php');
                        break;  
                    case 'quanlyguixe':
                        include('../quanlyguixe/quanlyguixe.php');
                        break;
                    case 'themquanlyguixe':
                        include('../quanlyguixe/insert.php');
                        break;  
                    case 'suaquanlyguixe':
                        include('../quanlyguixe/edit.php');
                        break;  
                    case 'xoaquanlyguixe':
                        include('../quanlyguixe/delete.php');
                        break;
                    case 'xuatexcelquanlyguixe':
                        include('../quanlyguixe/exportexcel.php');
                        break;  
                    case 'hoadon':
                        include('../quanlyhoadon/danhsachdangky.php');
                        break;
                    case 'themhoadon':
                        include('../quanlyhoadon/themhoadon.php');
                        break;
                    case 'thuhoadon':
                        include('../quanlyhoadon/thu_hoa_don.php');
                        break;
                    case 'xemhoadon':
                        include('../quanlyhoadon/xemhoadon.php');
                        break;
                    case 'xoahoadon':
                        include('../quanlyhoadon/xoa_hoa_don.php');
                        break;
                    case 'xuathoadon':
                        include('../quanlyhoadon/xuathoadon.php');
                        break;
                    case 'quanlyblog':
                        include('../quanlyblog/admin.php');
                        break;    
                    case 'xoablog':
                        include('../quanlyblog/delete_news.php');
                        break;    
                    case 'suablog':
                        include('../quanlyblog/edit_news.php');
                        break;    
                    case 'pcsuablog':
                        include('../quanlyblog/process_edit_news.php');
                        break;    
                    case 'suaquanlyphong':
                        include('../phong/suaphong.php');
                        break; 
                    case 'themquanlyphong':
                        include('../phong/themphong.php');
                        break; 
                    case 'timkiemquanlyphong':
                        include('../phong/timkiemphong.php');
                        break; 
                    case 'xoaquanlyphong':
                        include('../phong/xoaphong.php');
                        break; 
                    case 'xuatquanlyphong':
                        include('../phong/xuatphong.php');
                        break; 
                    case 'quanlyphong':
                        include('../phong/phong.php');
                        break; 
                    case 'quanlytraphong':
                        include('../quanlytraphong/danhsachdangky.php');
                        break;  
                    case 'xulyduyetquanlytraphong':
                        include('../quanlytraphong/xulyduyet.php');
                        break;  
                    case 'chitietdangkyquanlytraphong':
                        include('../quanlytraphong/chitietdangky.php');
                        break;  
                    case 'cancel':
                        include('../quanlytraphong/danhsachdangky.php');
                        break;  
                    case 'taikhoan':
                        include('../taikhoan/danhsachtaikhoan.php');
                        break;
                    case 'themtaikhoan':
                        include('../taikhoan/themtaikhoan.php');
                        break;
                    case 'suataikhoan':
                        include('../taikhoan/suataikhoan.php');
                        break;
                    case 'xoataikhoan':
                        include('../taikhoan/xoataikhoan.php');
                        break;
                    case 'xuattaikhoan':
                        include('../taikhoan/xuattaikhoan.php');
                        break;
                    case 'nhanvien':
                        include('../nhanvien/danhsachnhanvien.php');
                        break;
                    case 'themnhanvien':
                        include('../nhanvien/themnhanvien.php');
                        break;
                    case 'suanhanvien':
                        include('../nhanvien/suanhanvien.php');
                        break;
                    case 'xoanhanvien':
                        include('../nhanvien/xoanhanvien.php');
                        break;
                    case 'timnhanvien':
                          include('../nhanvien/timkiemnhanvien.php');
                          break;
                    case 'xuatnhanvien':
                        include('../nhanvien/xuatnhanvien.php');
                        break;
                    case 'sinhvien':
                        include('../quanlysinhvien/danhsachsinhvien.php');
                        break; 
                    case 'themsinhvien':
                        include('../quanlysinhvien/themsinhvien.php');
                        break;
                    case 'suasinhvien':
                        include('../quanlysinhvien/suasinhvien.php');
                        break;
                    case 'timsinhvien':
                        include('../quanlysinhvien/timkiemsinhvien.php');
                        break;
                    case 'xoasinhvien':
                        include('../quanlysinhvien/xoasinhvien.php');
                        break;  
                    case 'xuatsinhvien':
                        include('../quanlysinhvien/xuatsinhvien.php');
                        break;                     
                    case 'khu':
                        include('../khu/khu.php');
                        break;                     
                    case 'suakhu':
                        include('../khu/suakhu.php');
                        break;                     
                    case 'themkhu':
                        include('../khu/themkhu.php');
                        break;                     
                    case 'xoakhu':
                        include('../khu/xoakhu.php');
                        break;                     
                    case 'xuatkhu':
                        include('../khu/xuatkhu.php');
                        break;                     
                  
                    default:
                         
                        break;
                }
      }
      else {
        echo '<div class="m-auto">
          Đây là trang ADMIN Ký Túc Xá - UTT !!!
        </div>';
      }

    ?>
    <script type="text/javascript">
        function homePage() {
                window.location.href = 'http://localhost/ktxxxxxx/chucnangadmin/admin/index.php';
            }
    </script>
    
  </div>

<?php }?>