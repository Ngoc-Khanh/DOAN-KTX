<?php
if (isset($_SESSION['sv'])) {
    $sv=$_SESSION['sv'];
    $masv = $sv['MaSV'];
    $sql = "SELECT * FROM sinhvien WHERE MaSV = '$masv'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    $sql2 = "select * from thongbao where MaSV='$masv' order by NgayTB DESC , MaTB DESC";
    $rs2 = mysqli_query($conn, $sql2);
?>

<style>
  /* Internal CSS Styles */
  .container {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    padding: 20px;
  }

  h5 {
    color: #333;
  }

  label {
    font-weight: bold;
  }

  input {
    width: 50%;
    padding: 5px;
    /* margin: 5px 0; */
  }

  hr {
    border: 1px solid #ddd;
  }

  .notification {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    padding: 10px;
    /* margin: 10px 0; */
  }

  h6 {
    font-style: italic;
    color: #888;
  }
</style>

<div class="container">
  <div>
    <div>
      <div>
        <h5>Thông Báo của bạn</h5>
        <hr>

        <div>
          <div>
            <div>
              <label for="masv">Mã sinh viên</label>
              <input type="text" id="masv" value="<?php echo $row['MaSV'] ?>" disabled>
            </div>
            <div>
              <label for="hoten">Họ và tên</label>
              <input type="text" id="hoten" value="<?php echo $row['HoTen'] ?>" disabled>
            </div>
          </div>
          <hr>
        </div>

        <?php while ($row2 = mysqli_fetch_array($rs2)) { ?>
          <div class="notification">
            <div>
              <label><?php echo $row2['TieuDe']; ?></label>
              <br>
              <label><?php echo $row2['NoiDung']; ?></label>
            </div>
            <div>
              <h6><?php echo 'Ngày gửi : ' . $row2['NgayTB']; ?></h6>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<?php } else
header("location: index.php?action=login");
?>