<?php
$conn = mysqli_connect('localhost', 'root', '', 'sqlquanlythuvien');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
if (isset($_GET['masach'])) {
    $masach = $_GET['masach'];
    $sql = "SELECT sach.MaS, sach.TenS, tacgia.TenTG, theloai.Mota, theloai.TenLS, sach.TrangThai, nhaxuatban.TenNXB, sach.HinhAnh
            FROM sach
            
            JOIN tacgia ON sach.MaTG = tacgia.MaTG
            JOIN nhaxuatban ON sach.MaNXB = nhaxuatban.MaNXB
            JOIN theloai ON sach.MaLS = theloai.MaLS
            WHERE sach.MaS = $masach";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $masach = $row['MaS'];
        $ten_sach = $row['TenS'];
        $tac_gia = $row['TenTG'];
        $nha_xuat_ban = $row['TenNXB'];
        $the_loai = $row['TenLS'];
        $trang_thai = $row["TrangThai"];
        $mo_ta = $row["Mota"];
    } else {
        echo "Không tìm thấy sách.";
    }
}
?>
<head>
    <meta charset="UTF-8">
    <title>Thông tin Sách</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <div class="book-container">

        <div class="book-image">
            <img src="img/<?php echo $row['HinhAnh']; ?>" width="500x" height="500px">
        </div>

        <div class="book-text">
            <h1><?php echo $ten_sach; ?></h1>
            <p><strong>Tác giả:</strong> <?php echo $tac_gia; ?></p>
            <p><strong>Nhà xuất bản:</strong> <?php echo $nha_xuat_ban; ?></p>
            <p><strong>Thể loại:</strong> <?php echo $the_loai; ?></p>
            <p><strong>Trạng thái:</strong> <?php echo $trang_thai; ?></p>
            <p><strong>#Bản Full</strong><br></p>
            <h3 id="one">Sách đã được chúng tôi xin phép hoặc đã mua lại bản quyền từ tác giả, nhà phân phối</h3>

            <p>© Bản quyền  thuộc về Thư Viện Nhóm 4 <br>
                © Copyright by Thư Viện Nhóm 4 ☞ Do not Reup</p>
            <!-- Thêm nút Like -->
            <button class="button-like" id="likeButton">Like</button> <p id='showlike'></p>
            <!-- Thêm nút Theo dõi -->

            <p id ='showtheodoi'> </p>
            <!-- Thêm các thông tin khác ở đây -->
        </div>

    </div>

    <div class="book-description">
        <h2>Mô tả sách</h2>
        <p><?php echo $mo_ta; ?></p>
    </div>

</body>

<style>
    /* CSS cho phần tử cha */
    .book-container {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
    }

    /* CSS cho phần tử hình ảnh */
    .book-image {
        margin-left: 100px;
        margin-right: 100px;
    }

    /* CSS cho phần tử văn bản */
    .book-text {
        flex-grow: 1;
        line-height: 35px;
    }

    /* CSS cho phần tử mô tả */
    .book-description {

        background-color:beige ;
        margin-top: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
    }

    /* Thêm định dạng cho tiêu đề mô tả */
    .book-description h2 {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;

    }
    .button-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    /* CSS cho nút Like */
    .button-like {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 10px;
        cursor: pointer;
        border-radius: 10px;
    }

    /* CSS cho nút Theo dõi */
    .button-follow {
        background-color: blue;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 10px;
        cursor: pointer;
        border-radius: 10px;
    }
    #one{
        color:#4CAF50;
    }
</style>
<script>
    // Lấy đối tượng nút like

// Đăng ký sự kiện click cho nút like

    $(document).ready(function () {
        var email = localStorage.getItem('email');
        var mas = <?php echo $masach ?>;
        $.ajax({
            url: 'theodoi.php',
            type: 'post',
            data: {email: email, mas: mas},
            success: function (response) {
                $('#showtheodoi').html(response);
                //var data = JSON.parse(response);    
            }
        });
        $.ajax({
            url: "likesach.php",
            method: "POST",
            data: {email: email, mas: mas},
            success: function (data) {
                const arr = data.split(" "); // tách chuỗi thành mảng các phần tử được phân tách bởi khoảng trắng
                const tong = arr[0]; // gán giá trị của phần tử đầu tiên cho biến tam
                const user = arr[1];
                $("#showlike").html(tong + " lượt like");
                if (user == 1) {
                    const likeButton = document.getElementById('likeButton');
                    likeButton.style.backgroundColor = 'grey';
                } else {
                    const likeButton = document.getElementById('likeButton');
                    likeButton.style.backgroundColor = 'green';
                }
            }
        });
        // Handle Like button click

        $("#likeButton").click(function () {
            var buttonColor = $(this).css("background-color");
            if (buttonColor == "rgb(128, 128, 128)") {
                var flag = 'bolike';
            } else
                var flag = 'like';
            $.ajax({
                url: "sukienlike.php",
                method: "POST",
                data: {flag: flag, email: email, mas: mas}, // Change MaND and MaS values as needed
                success: function () {
                    // Reload Likes data after successful add
                    $.ajax({
                        url: "likesach.php",
                        method: "POST",
                        data: {email: email, mas: mas},
                        success: function (data) {
                            const arr = data.split(" "); // tách chuỗi thành mảng các phần tử được phân tách bởi khoảng trắng
                            const tong = arr[0]; // gán giá trị của phần tử đầu tiên cho biến tam
                            const user = arr[1];
                            $("#showlike").html(tong + " lượt like");
                            if (user == 1) {
                                const likeButton = document.getElementById('likeButton');
                                likeButton.style.backgroundColor = 'grey';
                            } else {
                                const likeButton = document.getElementById('likeButton');
                                likeButton.style.backgroundColor = 'green';
                            }
                        }
                    });
                }
            });
        });
        $('#showtheodoi').on('click', '.button-follow', function () {
            var data = $(this).attr('id');
            $.ajax({
                url: "sukienclicktheodoi.php",
                method: "POST",
                data: {data: data, email: email, mas: mas},
                success: function (response) {
                    $('#showtheodoi').html(response);
                },
                error: function () {
                    console.log("Lỗi khi thực hiện Ajax.");
                }
            });
        });
    });



</script>
