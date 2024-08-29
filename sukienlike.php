<?php

// Insert new Like record into the database
$conn = mysqli_connect('localhost', 'root', '', 'sqlquanlythuvien');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$flag = $_POST['flag'];
if ($flag == 'bolike') {
    $email = $_POST['email'];
    $masach = $_POST['mas'];
    $sql = "DELETE FROM `likesach` WHERE MaND = (SELECT MaND FROM nguoidung WHERE Email = '$email') and MaS ='$masach'";
    $conn->query($sql);
} else {
    $email = $_POST['email'];
    $masach = $_POST['mas'];
    $sql = "INSERT INTO `likesach` (`MaND`, `MaS`) 
            SELECT `MaND`, $masach FROM `nguoidung` WHERE `Email` = '$email';";
    $conn->query($sql);
}
$conn->close();
?>
