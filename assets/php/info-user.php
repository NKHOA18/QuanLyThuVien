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

            $my_var = $_SESSION['my_var'];

            $sql = "SELECT * FROM `nguoidung` WHERE `Email`='$my_var'";
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

        case 'update':
            $name = $_POST["name"];
            $phone = $_POST["phone"];
            $address = $_POST["address"];
            $my_var = $_SESSION['my_var'];
            $img =$_POST["img"];
            $sql = "UPDATE `nguoidung` SET `HoTen`='$name',`SDT`='$phone',`DiaChi`='$address',`image`='$img' WHERE `Email`='$my_var'";
            $result = $conn->query($sql);

            if (!$result) {
                echo "Sửa dữ liệu thất bại.";
            } else {
                echo "Sửa dữ liệu thành công.";
            }

            break;
    }
    mysqli_close($conn);
}

//        unset($_SESSION['email']);
?>