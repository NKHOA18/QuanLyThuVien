
<?php 

    $mas = $_POST['mas'];
    $mals = $_POST['mals'];
    $tens = $_POST['tens'];
    $matg = $_POST['matg'];
    $soluong = $_POST['soluong'];  
    $hinhs = $_POST['hinhs'];
    $manxb = $_POST['manxb'];
    $namxb = $_POST['namxb'];
    $trangthai = $_POST['trangthai'];
    $conn = mysqli_connect('localhost', 'root', '', 'sqlquanlythuvien');
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
      }
    $sql = "INSERT INTO `sach`(`MaS`, `MaLS`, `TenS`, `MaTG`, `SoLuong`,`HinhAnh`, `MaNXB`, `NamXB`, `TrangThai`) VALUES ('$mas','$mals','$tens','$matg','$soluong','$hinhs','$manxb','$namxb','$trangthai')";
    if ($conn->query($sql) === TRUE) {
  echo $mas .
    $mals .
    $tens .
    $matg .
    $soluong . 
    $hinhs .
    $manxb .
    $namxb .
    $trangthai ;
  exit();
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;exit();
}

?>
