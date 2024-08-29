<?php

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

if (isset($_POST['Email'])) {
    $email = $_POST['Email'];
    $pass = $_POST['MatKhau'];
    $conn = mysqli_connect('localhost', 'root', '', 'sqlquanlythuvien');

    $sql = "SELECT * FROM `users` WHERE `Email`='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo '<script>alert("Email đã được sử dụng ");</script>';
    } else {
        $sql = "INSERT INTO `users`(`Email`, `MatKhau`, `MaQuyen`) VALUES ('$email','$pass','1')";
        $result = mysqli_query($conn, $sql);
        $sql = "INSERT INTO `nguoidung`(`Email`) VALUES ('$email')";
        $result = mysqli_query($conn, $sql);
        goimail($email, $name, "chúc mừng bạn đã đăng ký thành công chính thức được làm quản lí thư viện");
        header("location: login-form.php"); // gắn link trang chủ
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Đăng ký</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <style>

        /* Thêm kiểu cho thẻ body */
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            background: url('assets/img/backgound/hinh1.jpg');
        }


        .center{
            display: flex;
            justify-content: center;
        }
        h2{
            text-align: center;
                text-transform: uppercase;
        }
        .form-login {
            margin: 0 auto;
            margin-top: 100px;
            width: 400px;
            border: 1px solid #ccc;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .form-login input[type="email"],
        .form-login input[type="password"]{
            margin-top: 8px;
            margin-bottom: 20px;
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-login input[type="submit"] {

            display: inline-block;
            align-items: center ;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 12px 20px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 3px;
            font-size: 16px;
                text-transform: uppercase;
        }

        .form-login input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        .center a {
            text-decoration: none;
            color:#333;
            opacity:0.8;
        }
        .center a:hover
        {
            text-decoration: none;
            color:#333;
            opacity:1;
        }

    </style>
    <body >

        <div class="form-login">
            <h2>Đăng ký tài khoản</h2>
            <form id="registration-form" method="POST">
                <label for="Email">Email:</label>
                <input type="email" id="Email"  name="Email" required>

                <label for="MatKhau">Mật khẩu:</label>
                <input type="password" id="MatKhau"  name="MatKhau"required>

                <label for="confirm-password">Xác nhận mật khẩu:</label>
                <input type="password" id="confirm-password" required>

                <div class="center"><input type="submit" value="Đăng Ký" id="button"> </div>
                <div class="center">
                    <p class="text-ac">Bạn đã có tài khoản </p>
                </div>
                <div class="center">
                    <a href="login-form.php" class="link-ac js-form-sign"> ĐĂNG NHẬP  </a>
                </div>
            </form>

        </div>


        <script>
            const form = document.getElementById('registration-form');
            const password = document.getElementById('MatKhau');
            const confirmPassword = document.getElementById('confirm-password');

            form.addEventListener('submit', function (event) {
                if (password.value !== confirmPassword.value) {
                    alert('Mật khẩu xác nhận không trùng khớp ! . vui lòng nhập lại   !');
                    event.preventDefault();
                }
            });
        </script>
    </body>
</html>

