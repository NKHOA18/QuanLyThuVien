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
if (mysqli_num_rows($result) > 0) {
    $t=0;
    while ($row = mysqli_fetch_assoc($result)) {
        $t=$t+1;
    }
    echo $t;
} else {
    echo "Không có bản ghi nào.";
}
        ?>
    </body>
</html>
