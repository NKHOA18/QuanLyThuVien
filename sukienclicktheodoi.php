<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data'];

    $conn = mysqli_connect('localhost', 'root', '', 'sqlquanlythuvien');
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
}
    switch ($data) {
        case 'dangtheodoi':
            $email = $_POST['email'];
            $masach = $_POST['mas'];
            $sql = "DELETE FROM phieumuon
            WHERE MaS = '$masach' 
            AND MaND IN (SELECT MaND FROM nguoidung WHERE Email = '$email');";
            $result = mysqli_query($conn, $sql);
            echo '<button class="button-follow" id = "kotheodoi">Theo dõi</button>';
            break;
        case 'kotheodoi':
            $email = $_POST['email'];
            $masach = $_POST['mas'];
            $sql = "INSERT INTO `phieumuon` (`MaND`, `MaS`) 
            SELECT `MaND`, $masach FROM `nguoidung` WHERE `Email` = '$email';";
            $result = mysqli_query($conn, $sql);
            echo '<button class="button-follow" id = "dangtheodoi">Đang theo dõi</button>';
            break;
    };
?>