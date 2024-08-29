<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
$conn = mysqli_connect('localhost', 'root', '', 'sqlquanlythuvien');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
$sql = 'SELECT * FROM `sach` WHERE 1';
$result = mysqli_query($conn, $sql);
$tam = '<table id="sachtable">
                                    <thead>
                                        <tr>
                                            <th>Mã sách</th>
                                            <th>Tên sách</th>
                                            <th>Mã thể loại</th>
                                            <th>Mã tác giả </th>
                                            <th>Mã nhà xuất bản</th>
                                            <th>Số lượng</th>
                                            <th>Năm xuất bản</th>
                                            <th>Trạng thái</th>
                                            <th>Hình ảnh</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
';
if (mysqli_num_rows($result) > 0) {
    $t=0;
    while ($row = mysqli_fetch_assoc($result)) {
        $tam = $tam . ' <tr>
                                            <td>' . $row["MaS"] . '</td>
                                            <td>' . $row["TenS"] . '</td>
                                            <td>' . $row["MaLS"] . '</td>
                                            <td>' . $row["MaTG"] . '</td>
                                            <td>' . $row["MaNXB"] . '</td>
                                            <td>' . $row["SoLuong"] . '</td>
                                            <td>' . $row["NamXB"] . '</td>
                                            <td>' . $row["TrangThai"] . '</td>
                                            <td>' . $row["HinhAnh"] . '</td>
                                                <td  data-vt="'.$t.'" data-mas="'.$row["MaS"].'" data-tens="'.$row["TenS"].'" data-mals="'.$row["MaLS"].'" data-matg="'.$row["MaTG"].'" data-manxb="'.$row["MaNXB"].'" data-soluong="'.$row["SoLuong"].'" data-namxb="'.$row["NamXB"].'" data-trangthai="'.$row["TrangThai"].'" data-hinhanh="'.$row["HinhAnh"].'">
                                                <button class="button edit">Sửa</button><button class="button delete" >Xóa</button> 
                                            </td>
                                        </tr>
';
        $t=$t+1;
    }
    $tam=$tam.' </tbody>
                                </table>';
    echo $tam;
} else {
    echo "Không có bản ghi nào.";
}
?>
    </body>
</html>
