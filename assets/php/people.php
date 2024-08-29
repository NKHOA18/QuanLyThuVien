<?php

session_start();

// Kết nối cơ sở dữ liệu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    $conn = mysqli_connect('localhost', 'root', '', 'sqlquanlythuvien');
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    switch ($action) {
        case 'get':

//             $my_var = $_SESSION['my_var'];

            $sql = "SELECT * FROM `nguoidung` WHERE 1";
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
        case 'getemail':
            $sql = "SELECT `Email` FROM `users` WHERE 1";
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
            $sex = $_POST["sex"];
            $phone = $_POST["phone"];
            $email = $_POST["email"];
            $address = $_POST["address"];

            $sql = "INSERT INTO `nguoidung`(`MaND`, `HoTen`, `GioiTinh`, `SDT`, `Email`, `DiaChi`) 
SELECT '$id', '$name', '$sex', '$phone', '$email', '$address' 
FROM dual WHERE NOT EXISTS (SELECT `Email` FROM `nguoidung` WHERE `Email` = '$email')";

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
            $sex = $_POST["sex"];
            $phone = $_POST["phone"];
            $email = $_POST["email"];
            $address = $_POST["address"];

            $sql = "UPDATE `nguoidung` SET `HoTen`='$name',`GioiTinh`='$sex',`SDT`='$phone',`DiaChi`='$address' WHERE `MaND`='$id'";
            $result = $conn->query($sql);

            if (!$result) {
                echo "Sửa dữ liệu thất bại.";
            } else {
                echo "Sửa dữ liệu thành công.";
            }

            break;
        case 'delete':

            $id = $_POST["id"];
            $sql = "DELETE FROM `nguoidung` WHERE `MaND`=$id";

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

//        unset($_SESSION['email']);
?>