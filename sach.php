<?php

// Kết nối cơ sở dữ liệu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    $conn = mysqli_connect('localhost', 'root', '', 'sqlquanlythuvien');
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    switch ($action) {
        case 'add':

            $mas = $_POST['mas'];
            $mals = $_POST['mals'];
            $tens = $_POST['tens'];
            $matg = $_POST['matg'];
            $soluong = $_POST['soluong'];
            $hinhs = $_POST['hinhs'];
            $manxb = $_POST['manxb'];
            $namxb = $_POST['namxb'];
            $trangthai = $_POST['trangthai'];

            $sql = "INSERT INTO `sach`(`MaS`, `MaLS`, `TenS`, `MaTG`, `SoLuong`,`HinhAnh`, `MaNXB`, `NamXB`, `TrangThai`) VALUES ('$mas','$mals','$tens','$matg','$soluong','$hinhs','$manxb','$namxb','$trangthai')";

            $result = $conn->query($sql);
            if (!$result) {
                echo "Thêm thất bại .";
            } else {
                echo "Thêm thành công ";
            }
            break;
        case 'update':
            $mas = $_POST['mas'];
            $mals = $_POST['mals'];
            $tens = $_POST['tens'];
            $matg = $_POST['matg'];
            $soluong = $_POST['soluong'];
            $hinhs = $_POST['hinhs'];
            $manxb = $_POST['manxb'];
            $namxb = $_POST['namxb'];
            $trangthai = $_POST['trangthai'];
            $sql = "UPDATE `sach` SET `MaLS`='$mals',`TenS`='$tens',`MaTG`='$matg',`SoLuong`='$soluong',`HinhAnh`='$hinhs',`MaNXB`='$manxb',`NamXB`='$namxb',`TrangThai`='$trangthai' WHERE `MaS`='$mas'";
            $result = $conn->query($sql);
            if (!$result) {
                echo "Sửa dữ liệu thất bại.";
            } else {
                echo "sửa dữ liệu thành công";
            }

            break;
        case 'delete':
            $mas= $_POST['mas'];
            $sql = "DELETE FROM `sach` WHERE `MaS`=$mas";
            $result = $conn->query($sql);
            if (!$result) {
                echo "xóa thất bại .";
            } else {
               // echo "xóa thành công ";
            }

            break;
        case 'getmals':
            $tam="";
            $sql = "SELECT `MaLS` FROM `theloai` WHERE 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $tam=$tam."<option value=".$row['MaLS'].">".$row['MaLS']."</option>";
                }
                echo ($tam);
            } else {
                echo "khong co du lieu .";
            }
            break;
        case 'getmatg':
            $tam="";
            $sql = "SELECT `MaTG` FROM `tacgia` WHERE 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $tam=$tam."<option value=".$row['MaTG'].">".$row['MaTG']."</option>";
                }
                echo ($tam);
            } else {
                echo "khong co du lieu .";
            }
            break;
        case 'getmanxb':
            $tam="";
            $sql = "SELECT `MaNXB` FROM `nhaxuatban` WHERE 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $tam=$tam."<option value=".$row['MaNXB'].">".$row['MaNXB']."</option>";
                }
                echo ($tam);
            } else {
                echo "khong co du lieu .";
            }
            break;
    }
    mysqli_close($conn);
}
?>