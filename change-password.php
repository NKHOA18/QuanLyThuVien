<!DOCTYPE html>
<html>
    <head>
        <title>Change Password</title>
        <link rel="stylesheet" href="style.css">
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
    <body>
        <div class="form-login">
            <h2>THAY ĐỔI MẬT KHẨU </h2>
            <form id="registration-form" method="POST">
                <label for="Email">Email:</label>
                <input type="email" id="Email"  name="Email" required>
                <label for="MatKhau">Mật khẩu cũ:</label>
                <input type="password" id="MatKhau"  name="MatKhau"required>

                <label for="MatKhau">Mật khẩu mới:</label>
                <input type="password" id="MatKhau1"  name="MatKhau1"required>

                <label for="confirm-password">Xác nhận mật khẩu:</label>
                <input type="password" id="confirm-password" required>

                <div class="center"><input type="submit" value="Đổi mật khẩu " id="button"> </div>

            </form>

        </div>


        <script>
            const form = document.getElementById('registration-form');
            const password = document.getElementById('MatKhau1');
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
<?php
if (isset($_POST['Email'])) {
    $email = $_POST['Email'];
    $pass = $_POST['MatKhau'];
    $passnew = $_POST['MatKhau1'];
    $conn = mysqli_connect('localhost', 'root', '', 'sqlquanlythuvien');

    $sql = "SELECT * FROM `users` WHERE `Email`='$email' AND  `MatKhau`='$pass'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $sql = "UPDATE `users` SET `MatKhau`='$passnew' WHERE `Email`='$email'";
        $result = mysqli_query($conn, $sql);

        header("location: login-form.php"); // gắn link trang chủ
    } else {
        echo '<script>alert("Mật khẩu không chính xác");</script>';
    }
}
?>