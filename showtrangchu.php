<?php
$conn = mysqli_connect('localhost', 'root', '', 'sqlquanlythuvien');

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$data = $_POST['selectedValue'];
$tam = '';

if ($data == 'tất cả') {
    $sql = 'SELECT sach.MaS, sach.TenS, tacgia.TenTG, theloai.TenLS, sach.TrangThai, nhaxuatban.TenNXB, sach.HinhAnh, sach.SoLuong
        FROM sach
        JOIN tacgia ON sach.MaTG = tacgia.MaTG
        JOIN nhaxuatban ON sach.MaNXB = nhaxuatban.MaNXB
        JOIN theloai ON sach.MaLS= theloai.MaLS';
} else {
    $sql = "SELECT sach.MaS, sach.TenS, tacgia.TenTG, theloai.TenLS, sach.TrangThai, nhaxuatban.TenNXB, sach.HinhAnh, sach.SoLuong
        FROM sach
        JOIN tacgia ON sach.MaTG = tacgia.MaTG
        JOIN nhaxuatban ON sach.MaNXB = nhaxuatban.MaNXB
        JOIN theloai ON sach.MaLS = theloai.MaLS
        WHERE theloai.TenLS LIKE '%$data%' OR sach.TenS LIKE '%$data%' OR tacgia.TenTG LIKE '%$data%'";
}

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $t = 0;

  while ($row = mysqli_fetch_assoc($result)) {
$tam = $tam .                         
                                    ' <div class="c3 col mt-16" >
                                    <img class="c1" border="1" width="200px" height="500px" src="img/'.$row["HinhAnh"].'" onclick="location.href=\'chitiet.php?masach='.$row["MaS"].'\'">

                                    <div class="mt-16">
                                        <b>Tên Sách: '.$row["TenS"]. ' </b>
                                        
                                    </div>       
                                </div>
';}

    echo $tam;
} else {
    echo "Không có dữ liệu.";
}
mysqli_close($conn);
?>