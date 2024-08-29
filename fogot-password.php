<!DOCTYPE html>
<html>
    <head>
        <title>Quên mật khẩu</title>
        <style>
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

            .form-login input[type="text"], .form-login input[type="password"] {

                margin-bottom: 15px;
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
            }

            .form-login input[type="submit"]:hover {
                background-color: #3e8e41;
            }

            .error-message {
                color: red;
                margin-top: 10px;
            }
            .loading {
                align-items: right;
                border: 8px solid #f3f3f3;
                border-radius: 50%;
                width: 35px;
                height: 35px;
                animation: spin 2s linear infinite;
            }
            .hinh{
                
                display: flex;
                align-items: center;
            }
            #hide{
                display: none;
            }
        </style>
    </head>
    <body>

        <div class="form-login ">
            <form action="#" method="post" >
                <h2>Quên mật khẩu</h2>
                <label for="Email">Email:</label>
                <input type="email" id="email" name="Email" required >
                <input type="submit" value="Lấy lại mật khẩu" >
                <div id="error" class="error-message"></div>                              
            </form>
        </div>
        <script>
            function lose(name) {
                document.getElementById('email').value = name;
                error.innerHTML = "Email không hợp lệ.";
                document.getElementById('email').focus();
            }

            function load() {
                // Set the number of seconds to countdown
                document.getElementById('hide').style.display = 'block';  
            }

        </script>   
    </body>
</html>
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
if (isset($_POST["Email"])) {
    $email = $_POST["Email"];
    $conn = mysqli_connect('localhost', 'root', '', 'sqlquanlythuvien');
    $sql = "SELECT  `MatKhau` FROM `users` WHERE `Email`='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>load()</script>"; 
        $row = mysqli_fetch_assoc($result)['MatKhau'];
        goimail($email, 'quản lí thư viện', "Không được tiết lộ mật khẩu cho người khác ! <br>mật khẩu của bạn là: " . $row);
        echo '<script> 
        if (confirm("Đã gửi thông tin qua gmail thành công. Bạn có muốn chuyển qua đăng nhập ?")) {
              window.location.href = "login-form.php";
              };</script>';
    } else {
        echo "<script>lose('$email')</script>";
    }
}
?>