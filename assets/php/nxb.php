<?php

// Kết nối cơ sở dữ liệu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    $conn = mysqli_connect('localhost', 'root', '', 'sqlquanlythuvien');
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    switch ($action) {
          case 'get':
            $sql = "SELECT `MaNXB`, `TenNXB`, `SDT`,`Email`, `DiaChi` FROM `nhaxuatban` WHERE 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                    
                }
                echo json_encode($data);
            } else {
                echo "khong co du lieu .";
            }
            break;
        case 'add':

            $id = $_POST["id"];
            $name = $_POST["name"];
            $phone = $_POST["phone"];
            $email= $_POST["email"];
            $address = $_POST["address"];

            $sql = "INSERT INTO `nhaxuatban`(`MaNXB`, `TenNXB`, `SDT`,`Email`, `DiaChi`) VALUES ('$id','$name','$phone','$email','$address')";

            $result = $conn->query($sql);
            if (!$result) {
                echo "Thêm thất bại .";
            } else {
                echo "Thêm thành công ";
            }
            break;
            case 'update':
                $id = $_POST["id"];
                $name = $_POST["name"];
                $phone = $_POST["phone"];
                $email= $_POST["email"];
                $address = $_POST["address"];
   
               $sql = "UPDATE `nguoidung` SET `TenNXB`='$name',`SDT`='$phone',`Email`='$email',`DiaChi`='$address' WHERE `MaNXB`='$id'";
               $result = $conn->query($sql);
   
               if (!$result) {
                   echo "Sửa dữ liệu thất bại.";
               } else {
                   echo "Sửa dữ liệu thành công.";
               }
   
               break;
        case 'delete':

            $id = $_POST["id"];
            $sql = "DELETE FROM `nhaxuatban` WHERE `MaNXB`=$id";

            $result = $conn->query($sql);
            if (!$result) {
                echo "xóa thất bại .";
            } else {
                echo "xóa thành công ";
            }

            break;
      
    }
    mysqli_close($conn);
}
?>