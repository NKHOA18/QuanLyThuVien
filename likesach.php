<?php
// Retrieve Likes data from the database
$conn = mysqli_connect('localhost', 'root', '', 'sqlquanlythuvien');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$masach = $_POST['mas'];
$sql = "SELECT MaND =(SELECT MaND FROM nguoidung WHERE Email = '$email') as like_count FROM `likesach` WHERE MaS = '$masach'";
$result = $conn->query($sql);

// Output Likes data as HTML table rows
$tong= 0;
$user = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
         if($row['like_count']!=0){
             $user = 1 ;
         }
         $tong +=1;
    }
    echo $tong.' '.$user;
} else {
    echo "Chưa có lượt like";
}

$conn->close();
?>
