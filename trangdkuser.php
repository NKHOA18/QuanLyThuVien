<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
function goimail($email, $name, $noidung) {

    require "PHPMailer-master/src/PHPMailer.php";  //nhúng thư viện vào để dùng, sửa lại đường dẫn cho đúng nếu bạn lưu vào chỗ khác
    require "PHPMailer-master/src/SMTP.php"; //nhúng thư viện vào để dùng
    require 'PHPMailer-master/src/Exception.php'; //nhúng thư viện vào để dùng
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);  //true: enables exceptions
    try {

        $mail->SMTPDebug = 0;  // 0,1,2: chế độ debug. khi mọi cấu hình đều tớt thì chỉnh lại 0 nhé
        $mail->isSMTP();
        $mail->CharSet = "utf-8";
        $mail->Host = 'smtp.gmail.com';  //SMTP servers
        $mail->SMTPAuth = true; // Enable authentication
        $nguoigui = 'bqttmt@gmail.com';
        $matkhau = 'uvokcwqyhglulhkd';
        $tennguoigui = "web quản lí thư viện có người đăng kí";
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

if (isset($_POST["email"])) {
    $email = $_POST["email"];
    $hoten = $_POST["hoten"];
    $gioitinh = $_POST['gioitinh'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];
    $conn = mysqli_connect('localhost', 'root', '', 'quanlythuvien');
    $sql = "SELECT  * FROM `nguoidung` WHERE `email`='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "Đăng kí thông tin không thành công, gmail đã được sử dụng. Mời nhập lại";
    } else {
        goimail("tien2002tmt@gmail.com", 'quản lí thư viện', " họ tên :" . $hoten . " <br> giới tính  :" . $gioitinh . " <br> SDT :" . $sdt . " <br> email :" . $email . " <br> địa chỉ :" . $diachi);
        echo 'Đã đăng kí thông tin thành công. Chờ phản hồi từ gmail';

    }
}
}
?>