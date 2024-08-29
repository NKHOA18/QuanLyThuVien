<?php

function goimail($email, $name, $noidung) {

    require "../../PHPMailer-master/src/PHPMailer.php";  //nhúng thư viện vào để dùng, sửa lại đường dẫn cho đúng nếu bạn lưu vào chỗ khác
    require "../../PHPMailer-master/src/SMTP.php"; //nhúng thư viện vào để dùng
    require '../../PHPMailer-master/src/Exception.php'; //nhúng thư viện vào để dùng
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);  //true: enables exceptions
    try {
        $mail->SMTPDebug = 0;  // 0,1,2: chế độ debug. khi mọi cấu hình đều tớt thì chỉnh lại 0 nhé
        $mail->isSMTP();
        $mail->CharSet = "utf-8";
        $mail->Host = 'smtp.gmail.com';  //SMTP servers
        $mail->SMTPAuth = true; // Enable authentication
        $nguoigui = 'bqttmt@gmail.com';
        $matkhau = 'uvokcwqyhglulhkd';
        $tennguoigui = "web quản lí thư viện";
        $mail->Username = $nguoigui; // SMTP username
        $mail->Password = $matkhau;   // SMTP password
        $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
        $mail->Port = 465;  // port to connect to                
        $mail->setFrom($nguoigui, $tennguoigui);
        $to = $email;
        $to_name = "Tên người nhận";

        $mail->addAddress($to, $to_name); //mail và tên người nhận  
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Xin chào ' . $name;
        $noidungthu = $noidung;
        $mail->Body = $noidungthu;
        $mail->smtpConnect(array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));
        if ($mail->send()) {
            //  echo "Email hợp lệ vào gmail để đăng nhập";
        } else {
            // echo "Email không hợp lệ vui lòng đăng nhập lại";
        }
    } catch (Exception $e) {
        echo "Email is not valid. Error message: {$mail->ErrorInfo}";
    }
}

// Kết nối cơ sở dữ liệu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    $conn = mysqli_connect('localhost', 'root', '', 'sqlquanlythuvien');
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    switch ($action) {

        case 'login':
            $email = $_POST["email"];
            $password = $_POST["password"];

            $sql = "SELECT * FROM `users` WHERE `Email`='$email' AND `MatKhau`='$password' ";

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Có dòng tương ứng với câu truy vấn được tìm thấy, đăng nhập thành công
                $response = array('success' => true, 'message' => 'Đăng nhập thành công.','type'=>'success' ,'title'=>'Thành công.');
            } else {
                // Không có dòng tương ứng với câu truy vấn, đăng nhập thất bại
                $response = array('success' => false, 'message' => 'Đăng nhập thất bại.','type'=>'warning','title'=>'Thất bại.');
            }

            header('Content-type: application/json');
            echo json_encode($response);

            break;
        case 'signup':
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passconfirm = $_POST["passconfirm"];
            $sql = "SELECT * FROM `users` WHERE `Email`='$email'";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                $response = array('success' => false, 'message' => 'Đăng ký thất bại. Email đã được sử dụng ','type'=>'warning','title'=>'Thất bại.');
            } else {

                if ($password == $passconfirm) {
                    $sql = "INSERT INTO `users`(`Email`, `MatKhau`, `MaQuyen`) VALUES ('$email','$password','2')";
                    $result = mysqli_query($conn, $sql);
                    $sql = "INSERT INTO `nguoidung`( `Email`) VALUES ('$email')";
                    $result = mysqli_query($conn, $sql);
                    // Có dòng tương ứng với câu truy vấn được tìm thấy, đăng nhập thành công
                $response = array('success' => true, 'message' => 'Đăng ký thành công.','type'=>'success' ,'title'=>'Thành công.');
                } else {
                    // Không có dòng tương ứng với câu truy vấn, đăng nhập thất bại
                $response = array('success' => false, 'message' => ' Mật khẩu xác nhận không trùng khớp . .Vui lòng nhập lại','type'=>'warning','title'=>'Thất bại.');
                }
            }
            header('Content-type: application/json');
            echo json_encode($response);

            break;
        case 'info':
            $email = $_POST["email"];
            $sql = "SELECT * FROM `nguoidung`  WHERE `Email`='$email'";

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
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $name = $_POST["name"];
            $img = $_POST["img"];
            $address = $_POST["address"];
            $sql = "UPDATE `nguoidung` SET`HoTen`='$name',`SDT`='$phone',`DiaChi`='$address',`image`='$img' WHERE `Email`='$email'";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                $response = array('success' => false, 'message' => 'Cập nhật thất bại.','type'=>'warning','title'=>'Thất bại.');
            } else {
                $response = array('success' => true, 'message' => 'Cập nhật thành công.','type'=>'success' ,'title'=>'Thành công.');
            }
            header('Content-type: application/json');
            echo json_encode($response);

            break;
        case 'forgot':
            $email = $_POST["email"];

            $sql = "SELECT  `MatKhau` FROM `users` WHERE `Email`='$email'";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result)['MatKhau'];
                goimail($email, 'quản lí thư viện', "Không được tiết lộ mật khẩu cho người khác ! <br>mật khẩu của bạn là: " . $row);
                $response = array('success' => true, 'message' => 'Mật khẩu đã dược gửi tới Email của bạn . Vui lòng kiểm tra .','type'=>'success' ,'title'=>'Thành công.');
            } else {
                $response = array('success' => false, 'message' => 'Email không chính xác . Vui lòng nhập lại.','type'=>'warning','title'=>'Thất bại.');
            }


            header('Content-type: application/json');
            echo json_encode($response);

            break;
        case 'change':
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordnew = $_POST["passwordnew"];
            $passwordcofirn = $_POST["passwordcofirn"];

            $sql = "SELECT  `MatKhau` FROM `users` WHERE `Email`='$email' AND `MatKhau`='$password' ";

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Có dòng tương ứng với câu truy vấn được tìm thấy, đăng nhập thành công
                if ($passwordnew == $passwordcofirn) {
                    $sql = "UPDATE `users` SET `MatKhau`='$passwordnew' WHERE `Email`='$email'";
                    $result = $conn->query($sql);
                $response = array('success' => true, 'message' => 'Đổi mật khẩu thành công.','type'=>'success' ,'title'=>'Thành công.');
                } else {
                $response = array('success' => false, 'message' => 'Mật khẩu xác nhận không trùng khớp . Vui lòng nhập lại . ','type'=>'warning','title'=>'Thất bại.');
                }
            } else {
                // Không có dòng tương ứng với câu truy vấn, đăng nhập thất bại
                $response = array('success' => false, 'message' => 'Mật khẩu chưa chính xác . Vui lòng đăng nhập lại .','type'=>'warning','title'=>'Thất bại.');
            }

            header('Content-type: application/json');
            echo json_encode($response);

            break;
        case 'book':
            $search = $_POST["search"];
            $email = $_POST["email"];
            $sql = "SELECT s.MaS, s.TenS, pm.MaPM, pm.NgayMuon,tl.TenLS,s.TrangThai,tg.TenTG,s.HinhAnh
FROM sach s
JOIN phieumuon pm ON s.MaS = pm.MaS
JOIN theloai tl ON  s.MaLS = tl.MaLS
JOIN nguoidung nd ON  pm.MaND= nd.MaND
JOIN tacgia tg ON  s.MaTG = tg.MaTG
WHERE nd.Email = '$email'  AND (tl.TenLS LIKE '%$search%' OR s.TenS LIKE '%$search%' OR tg.TenTG LIKE '%$search%' )";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                echo json_encode($data);
            } else {
                echo "Không có dữ liệu.";
            }
            break;
    }
    mysqli_close($conn);
}
?>