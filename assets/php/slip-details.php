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

            $sql = "SELECT n.`MaPM`,l.MaS,l.MaND,l.NgayMuon,n.`SoLuong`, n.`DiaChiMuon`, n.`TrangThai`  FROM `chitietmuon` n, phieumuon l WHERE n.MaPM=l.MaPM";
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
        case 'getmaphieumuon':
            $sql = "SELECT `MaPM` FROM `phieumuon` WHERE 1";
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

            $idPM = $_POST["idPM"];
            $sl = $_POST["sl"];
            $address = $_POST["address"];
            $status = $_POST["status"];

            $sql = "INSERT INTO `chitietmuon`(`MaPM`, `SoLuong`, `DiaChiMuon`, `TrangThai`) VALUES ('$idPM','$sl','$address','$status')";

            $result = $conn->query($sql);
            if (!$result) {
                echo "Thêm thất bại .";
            } else {
                echo "Thêm thành công ";
            }
            break;
        case 'update':
            $idPM = $_POST["idPM"];
            $sl = $_POST["sl"];
            $address = $_POST["address"];
            $status = $_POST["status"];

            $sql = "UPDATE `chitietmuon` SET `SoLuong`='$sl',`DiaChiMuon`='$address',`TrangThai`='$status' WHERE `MaPM`='$idPM'";
            $result = $conn->query($sql);

            if (!$result) {
                echo "Sửa dữ liệu thất bại.";
            } else {
                echo "Sửa dữ liệu thành công.";
            }

            break;
        case 'delete':

            $idPM = $_POST["idPM"];
            $sql = "DELETE FROM `chitietmuon` WHERE `MaPM`=$idPM";

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