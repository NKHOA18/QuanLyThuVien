<?php
// Kiểm tra xem có phiếu mượn nào của người dùng và sách hiện tại hay không
$conn = mysqli_connect('localhost', 'root', '', 'sqlquanlythuvien');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
$email = $_POST['email'];
$masach= $_POST['mas'];
$sql = "SELECT s.MaS, s.TenS, pm.MaPM
        FROM sach s
        JOIN phieumuon pm ON s.MaS = pm.MaS
        JOIN theloai tl ON  s.MaLS = tl.MaLS
        JOIN nguoidung nd ON  pm.MaND= nd.MaND
        JOIN tacgia tg ON  s.MaTG = tg.MaTG
        WHERE nd.Email = '$email' AND s.MaS = '$masach'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) >0 ) {
    // Nếu có, thay đổi nút Theo dõi thành Đang theo dõi
    echo '<button class="button-follow" id="dangtheodoi">Đang theo dõi</button>';
} else {
    // Nếu không có, giữ nguyên nút Theo dõi
    echo '<button class="button-follow" id="kotheodoi">Theo dõi</button>';
}
mysqli_close($conn);
?> 
