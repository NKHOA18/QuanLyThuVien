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

            $sql = "SELECT * FROM `phieumuon` WHERE 1";
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
        case 'getmanguoidung':
            $sql = "SELECT `MaND` FROM `nguoidung` WHERE 1";
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
            case 'getmasach':
                $sql = "SELECT `MaS` FROM `sach` WHERE 1";
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
            $idS = $_POST["idS"];
            $idND = $_POST["idND"];
            $borrowdate = $_POST["borrowdate"];
            $returndate = $_POST["returndate"];
            

            $sql = "INSERT INTO `phieumuon`(`MaPM`, `MaND`, `MaS`, `NgayMuon`, `NgayTra`) VALUES ('$idPM','$idND','$idS','$borrowdate','$returndate')";

            $result = $conn->query($sql);
            if (!$result) {
                echo "Thêm thất bại .";
            } else {
                echo "Thêm thành công ";
            }
            break;
        case 'update':
            $idPM = $_POST["idPM"];
            $idS = $_POST["idS"];
            $idND = $_POST["idND"];
            $borrowdate = $_POST["borrowdate"];
            $returndate = $_POST["returndate"];

            
            $sql = "UPDATE `phieumuon` SET `MaS`='$idS',`MaND`='$idND',`NgayMuon`='$borrowdate',`NgayTra`='$returndate' WHERE `MaPM`='$idPM'";
            $result = $conn->query($sql);

            if (!$result) {
                echo "Sửa dữ liệu thất bại.";
            } else {
                echo "Sửa dữ liệu thành công.";
            }

            break;
        case 'delete':

            $idPM = $_POST["idPM"];
            $sql = "DELETE FROM `phieumuon` WHERE `MaPM`='$idPM'";

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