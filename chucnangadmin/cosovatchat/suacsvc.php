<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa cơ sở vật chất</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 400px; /* Adjust the width as needed */
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 110%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        h2{
            text-align: center;
        }

        th, td {
            padding: 8px;
            text-align: left;
           
        }

        th {
            background-color: #333;
            color: #fff;
        }

        form {
            margin: 20px 20px;
            text-align: center;
        }

        select, input[type="text"] {
            padding: 10px;
            width: 80%; /* Make input fields full width */
        }

    button {
        background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 7px; /* Khoảng cách giữa hai nút */
          
    }

    button:hover {
        background-color: #1E6C41; /* Màu nền mới khi di chuột vào nút */
    }

    a {
        text-decoration: none;
        color: white;
    }
    </style>
<body>
<div class="container">
        <h2>Chỉnh sửa thông tin phòng</h2>
<?php
    $MaCSVC = $_GET['MaCSVC'];
    $TenCSVC = "";
  
    
    $conn = mysqli_connect("localhost", "root", "", "kytucxa");
    if (!$conn) {
        die("Kết nối thất bại");
    } else {
        $sql = "SELECT * FROM cosovatchat WHERE MaCSVC = '".$MaCSVC."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $MaCSVC = $row["MaCSVC"];
                $TenCSVC = $row["TenCSVC"];
              
            }
        } else {
            echo "Không có bản ghi";
        }
    }
    ?>

    <form method="POST">
        <div>
            <table>
                <tbody>
                
                    <tr>
                        <td>Mã CSVC</td>
                        <td>
                            <input type="text" id="txtMaCSVC" name="txtMaCSVC" value="<?php echo $MaCSVC; ?>"readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Tên CSVC</td>
                        <td>
                            <input type="text" id="txtTenCSVC" name="txtTenCSVC" value="<?php echo $TenCSVC; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button><a href="index.php?action=csvc"> Quay lại</a></button>
                            <button type="submit" id="btnLuu" name="btnLuu">Cập nhật</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['btnLuu'])) {
        $MaCSVC = $_POST['txtMaCSVC'];
        $TenCSVC = $_POST['txtTenCSVC'];
     

        $conn = mysqli_connect("localhost", "root", "", "kytucxa");
        if (!$conn) {
            die("Kết nối thất bại");
        }
        $sql= "UPDATE cosovatchat SET MaCSVC = '".$MaCSVC."', TenCSVC = '".$TenCSVC."' WHERE MaCSVC = '".$MaCSVC."'";
        
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Update error" . mysqli_error($conn);
        } else {
            echo "Update success !";
        }
    }
    //header("location: index.php?action=csvc");
    ?>
</div>
</body>
</html>