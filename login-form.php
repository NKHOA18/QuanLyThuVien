
<!DOCTYPE html>
<html>
    <head>
        <title>Đăng nhập</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #fff;
                background: url('assets/img/backgound/hinh1.jpg');
            }


            .center{
                display: flex;
                justify-content: center;
                margin: 10px 0;
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
                margin-bottom: 20px;
                margin-top: 8px;
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 3px;
                box-sizing: border-box;
                font-size: 16px;
            }
            form{
                display:inline-block;
            }

            .form-login button[type="submit"] {
                background-color: #4CAF50;
                color: #fff;
                border: none;
                padding: 12px 20px;
                margin-top: 10px;
                cursor: pointer;
                border-radius: 3px;
                font-size: 16px;
                align-items: center;

            }

            .form-login button[type="submit"]:hover {
                background-color: #3e8e41;
            }
            form{
                /* display:inline-block; */
            }
            .error-message {
                color: red;
                margin-top: 10px;
            }
            .check{
                display: flex;
                justify-content: space-between;
                font-size: 13px;
            }
            .center a ,.check a{
                text-decoration: none;
                color:#333;
                opacity:0.8;
            }
            .center a:hover ,
            .check a:hover{
                text-decoration: none;
                color:#333;
                opacity:1;
            }
        </style>
        <script>

            function lose(name) {

                document.getElementById('username').value = name;
                document.getElementById('notification').style.display = 'block';
                document.getElementById('username').focus();
            }
        </script>
   

    </head>
    <body>
        <div class="form-login">
            <h2>Đăng nhập</h2>
            <form action="assets/php/login.php" method="post">
                <div class="body-login ">     
                    <label for="Email">Tài khoản:</label>
                    <input type="text" id="Email" name="Email" required>
                    <label for="MatKhau">Mật khẩu:</label>
                    <input type="password" id="MatKhau" name="MatKhau" required>
                    <div class="check">
                        <label for="" class="remember-login"><input type="checkbox" > Remember login</label>
                        <a href="fogot-password.php" class="link-ac">Forgot password ?</a>
                    </div>
                    <div class="center">
                        <button class="ac-btn" type="submit" value="Đăng nhập" id="button">ĐĂNG NHẬP</button>
                    </div>
                    <div class="center">
                        <p class="text-ac">Bạn chưa có tài khoản ?</p>
                    </div>
                    <div class="center">
                        <a href="dangky.php" class="link-ac js-form-sign"> ĐĂNG KÝ</a>
                    </div>
                </div>
                <div class="error-message">
                </div>
            </form>
        </div>
    </body>
</html>

