<?php

session_start();
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'sqlquanlythuvien');
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
// Lấy thông tin đăng nhập từ form
if (isset($_POST['Email'])) {
    // Lấy thông tin đăng nhập từ form

    $user = $_POST['Email'];
    $pass = $_POST['MatKhau'];

    // Kiểm tra đăng nhập
    $sql = "SELECT `Email`, `MatKhau`, `MaQuyen` FROM `users` WHERE `Email`='$user' AND `MatKhau`='$pass'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        // Lấy row đầu tiên trong kết quả trả về
        $row = mysqli_fetch_assoc($result);
        // Kiểm tra MaQuyen của người dùng
        if ($row['MaQuyen'] == '1') {
            // Người dùng có quyền là quản trị viên, chuyển hướng đến trang quản lý
            $_SESSION['login'] = true;
             $_SESSION['isLoggedIn'] = true;
            $_SESSION['my_var'] = $user;
            header("Location: ../../index.php");
            exit(); // Dừng script ngay sau khi chuyển hướng trang
        } 
//        else if ($row['MaQuyen'] == '2') {
//            // Người dùng là người dùng thường, chuyển hướng đến trang người dùng
//            $_SESSION['login'] = true;
//             $_SESSION['isLoggedIn'] = true;
//            $_SESSION['my_var'] = $user;
//            header("Location: ../../index-user.php");
//            exit(); // Dừng script ngay sau khi chuyển hướng trang
//        }
//    } 
    else {
        // Thông tin đăng nhập không hợp lệ
        $_SESSION['login'] = false;
         $_SESSION['isLoggedIn'] = false;
        header("Location: ../../login-form.php");
        exit(); // Dừng script ngay sau khi chuyển hướng trang
    }
    
}
}
$conn->close();
?>