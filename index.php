
<?php
session_start();
// Kiểm tra trạng thái đăng nhập của người dùng
if (!isset($_SESSION['login']) || $_SESSION['login'] !== TRUE) {
    // Người dùng chưa đăng nhập, hiển thị phần đăng nhập
    include 'login-form.php';
    exit();
}
//unset($_SESSION['login']);
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Quản lý thư viện</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/font/themify-icons/themify-icons.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>   
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!--<script src="assets/js/main.js"></script>--> 
        <script src="assets/js/people.js"></script>
        <script src="assets/js/category.js"></script>
        <script src="assets/js/info-user.js"></script>
        <script src="assets/js/author.js"></script>
        <script src="assets/js/nxb.js"></script>
        <script src="assets/js/slip-details.js"></script>
        <script src="assets/js/loan-slip.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Link jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Link jquery-confirm -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
    <head>
        <meta charset="UTF-8">
        <title>Quản lý thư viện</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="assets/css/font/themify-icons/themify-icons.css">



    </head>

    <body>
        <div id="main">
            <!-- bắt đầu header -->
            <div id="header" class="ci">
                <ul class="nav  ci">
                    <li><a href="#"><img src="assets\img\logo.png" alt=""></a> </li>
                    <li>
                        <h3>Quản lý thư viện </h3>
                    </li>
                </ul>

                <ul>
                    <ul class="nav search-header ci">
                        <li><i class="ti-search"></i></li>
                        <li><input type="text" placeholder="Tìm kiếm sách , độc giả , mượn trả ..." class="search-input">
                        </li>
                    </ul>
                </ul>

                <ul class="nav  ci">
                    <li class="dropdown">
                        <i class="ti-bell"></i>
                        <div class="dropdown-content">
                            <div >15 Notifications</div>
                            <a href="#" class="dropdown">
                                <i class="ti-comments"></i> 4 tin nhắn mới
                                <span style="float:right">3 phút</span>
                            </a>
                            <a href="#" class="dropdown">
                                <i class="ti-user"></i> 8 yêu cầu kết bạn
                                <span style="float:right">6 giờ</span>
                            </a>
                            <a href="#" class="dropdown">
                                <i class="ti-file"></i> 3 báo cáo mới
                                <span style="float:right">9 ngày</span>
                            </a>      
                            <a href="#" class="dropdown">Hiện tất cả</a>
                        </div>
                    </li>
                    <li><span id="user-name"></span></li>
                    <li>
                        <i class="ti-angle-down"></i>
                        <ul class="subnav">
                            <li> <img class="image-user" src="" id="subnav-img"> </li>
                            <li><a href="#info-user" onclick="showDiv('info-user')"><i class="ti-id-badge"></i>Thông tin cá nhân</a></li>
                            <li><a href="change-password.php"><i class="ti-lock"></i>Đổi mật khẩu </a></li>
                            <li><a href="login-form.php"><i class="ti-shift-right"></i>Đăng xuất</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
            <!-- kết thúc header -->

            <div id="content" class="">
                <!--            menu form-->
                <div class="content-selection  menu  ">
                    <div class="">
                        <ul>
                            <li><a href="#home" onclick="showDiv('home')"> <i class="ti-home"></i>Trang chủ </a></li>

                            <li><a href="#books" onclick="showDiv('books')"><i class="ti-book"></i>Quản lý sách </a></li>
                            <li><a href="#people" onclick="showDiv('people')"><i class="ti-user"></i>Quản lý người
                                    dùng</a></li>
                            <li><a href="#loan-slip" onclick="showDiv('loan-slip')"><i class="ti-bookmark"></i>Quản lý
                                    phiếu mượn</a></li>
                            <li><a href="#slip-details" onclick="showDiv('slip-details')"><i class="ti-bookmark-alt"></i>Chi
                                    tiết phiếu mượn </a></li>
                            <li><a href="#category" onclick="showDiv('category')"><i class="ti-layers-alt"></i>Quản lý thể
                                    loại</a></li>
                            <li><a href="#author" onclick="showDiv('author')"><i class="ti-user"></i>Quản lý tác giả </a>
                            </li>
                            <li><a href="#publishing" onclick="showDiv('publishing')"><i class="ti-truck"></i>Quản lý nhà
                                    xuất bản </a></li>

                        </ul>
                    </div>

                    <div class="">
                        <ul>
                            <li><a href="index-user.php"><i class="ti-world"> </i>Trang web người dùng</a></li>
                            <li><a href="#contact"onclick="showDiv('contact')"><i class="ti-help-alt"> </i>Liên hệ </a></li>
                        </ul>
                        <footer>
                            <p>&copy; 2023 Quản lí thư viện</p>
                        </footer>
                    </div>
                </div>

                <div class="content-selection ml ">
                    <!-- Trang chủ  -->
                    <div class="manager show" id="home">
                        <main>
                            <div id="slideshow" >
                                <div class="slide-wrapper">
                                    <div class="slide"><img src="assets/img/anhtruot/sach1.png"></div>
                                    <div class="slide"><img src="assets/img/anhtruot/sach2.jpeg"></div>
                                    <div class="slide"><img src="assets/img/anhtruot/sach3.jpeg"></div>
                                </div>
                            </div>

                            <h2>SÁCH MỚI</h2>

                            <div class="top-slip row mt-16"  id="showtrangchu">


                            </div>
                        </main>

                    </div>

                    <!-- sách -->
                    <div class="manager hide" id="books">
                        <main class="row">
                            <h2>Danh sách sách</h2>
                            <div class="mt-24 form col c1">
                                <h3>Thêm sách mới</h3>

                                <form id="book">
                                    <div class="row mt-8">
                                        <div class="col c6">
                                            <div class=" row mt-8 ">
                                                <div class="c2 col mt-16">
                                                    <label for="">Mã sách </label>
                                                    <input type="text" name="mas" id="mas" required>
                                                </div>
                                                <div class="c2 col mt-16">
                                                    <label for="">Tên sách </label>
                                                    <input type="text" name="tens" id="tens" required>
                                                </div>
                                            </div>
                                            <div class=" row mt-8 ">
                                                <div class="c2 col mt-16">
                                                    <label for="">Mã thể loại</label>
        <!--                                            <input type="text" name="mals" id="mals" required>-->

                                                    <select id="mals" name="mals" required>
                                                        <!--  <option value="male">Nam</option>
                                                          <option value="female">Nữ</option>
                                                          <option value="other">Khác</option>-->
                                                    </select>
                                                </div>

                                                <div class="c2 col mt-16">
                                                    <label for="">Mã tác giả </label>
                                                    <select id="matg" name="matg" required>
                                                        <!--  <option value="male">Nam</option>
                                                          <option value="female">Nữ</option>
                                                          <option value="other">Khác</option>-->
                                                    </select>
                                                </div>
                                            </div>

                                            <div class=" row mt-8 ">

                                                <div class="c2 col mt-16">
                                                    <label for="">Mã nhà xuất bản </label>
                                                    <select id="manxb" name="manxb" required>
                                                        <!--  <option value="male">Nam</option>
                                                          <option value="female">Nữ</option>
                                                          <option value="other">Khác</option>-->
                                                    </select>
                                                </div>
                                                <div class="c2 col mt-16">
                                                    <label for="">Số lượng </label>
                                                    <input type="text" name="soluong" id="soluong" required>
                                                </div>
                                            </div>

                                            <div class=" row mt-8 ">
                                                <div class="c2 col mt-16">
                                                    <label for="">Năm xuất bản:</label>
                                                    <input type="year" name="namxb" id="namxb" required>
                                                </div>
                                                <div class="c2 col mt-16">
                                                    <label for="">Trạng thái </label>
                                                    <input type="text" name="trangthai" id="trangthai" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col c3">
                                            <div class="c1 col mt-16 row">
                                                <label for="">Hình ảnh </label>
    <!--                                            <input type="text" id="hinhs" name="hinhs" required>-->
                                                <input type="file" id="hinhsach" accept="image/*" onchange="changeImage()">
                                                <input type="text" id="hinhs" name="hinhs" readonly nore>
                                                <div class="col c1 hinhsach"><img class="image"> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn pul-right mt-8 update-btn themsach" type="submit"  id='themsach' name="themsach">Thêm mới</button> 

                                    <button class="btn pul-right mt-8 add-btn capnhat" type="submit"  id='capnhat' name="capnhat">Cập nhật</button> 
                                </form>
                            </div>

                            <div class="mt-24 form col c1">
                                <h3>Danh sách sách</h3>
                                <div class="table row mt-8" id="showsach">

                                </div>
                            </div>
                        </main>
                    </div>

                    <!-- tác giả -->
                    <div class="manager hide" id="author">
                        <main class="row">
                            <h2><i class="ti-user"></i>Quản lý Tác giả </h2>
                            <div class="mt-24 form col c1">
                                <h3><i class="ti-pencil"></i>  Thêm Tác giả mới</h3>
                                <form id="author-form">
                                    <div class=" row mt-8 ">
                                        <div class="c2 col mt-16">
                                            <label for="">Mã Tác giả </label>
                                            <input type="text" id="author-id" required>
                                        </div>
                                        <div class="c2 col mt-16">
                                            <label for="">Tên Tác giả </label>
                                            <input type="text" id="author-name" required>
                                        </div>
                                    </div>
                                    <button class="btn pul-right mt-8 add-btn" type="submit" name="borrow" >Thêm mới</button>
                                    <button class="btn pul-right mt-8 update-btn" type="submit" name="borrow" >Cập nhật </button>

                                </form>
                            </div>
                            <div class="mt-24 form col c1">
                                <h3><i class="ti-receipt"></i>Danh sách tác giả </h3>
                                <div class="table">
                                    <table id="author-table">
                                        <thead>
                                            <tr>
                                                <th>Mã tác giả</th>
                                                <th>Tên tác giả</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </main>
                    </div>
                    <!-- thể loại -->
                    <div class="manager hide" id="category">
                        <main class="row">
                            <h2><i class="ti-layers-alt"></i>Quản lý thể loại </h2>
                            <div class="mt-24 form col c1">
                                <h3><i class="ti-pencil"></i> Thêm thể loại mới</h3>
                                <form  id="category-form">
                                    <div class=" row mt-8 ">
                                        <div class="c3 col mt-16">
                                            <label for="">Mã thể loại </label>
                                            <input type="text" id="category-id"  required>
                                        </div>
                                        <div class="c3 col mt-16">
                                            <label for="">Tên thể loại </label>
                                            <input type="text" id="category-name" required>
                                        </div>
                                        <div class="c3 col mt-16">
                                            <label for="">Mô tả </label>
                                            <input type="text" id="category-content"  required>
                                        </div>
                                    </div>

                                    <button class="btn pul-right mt-8 add-btn" type="submit" name="borrow" >Thêm mới</button>
                                    <button class="btn pul-right mt-8 update-btn" type="submit" name="borrow" >Cập nhật </button>

                                </form>
                            </div>

                            <div class="mt-24 form col c1">
                                <h3><i class="ti-receipt"></i>Danh sách Thể loại </h3>
                                <div class="table" >
                                    <table id="category-table">
                                        <thead>
                                            <tr>    
                                                <th>Mã thể loại</th>
                                                <th>Tên thể loại </th>
                                                <th>Mô tả</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </main>
                    </div>
                    <!-- nhà xuất bản -->
                    <div class="manager hide" id="publishing">
                        <main class="row">
                            <h2><i class="ti-truck"></i>Quản lý nhà xuất bản </h2>
                            <div class="mt-24 form col c1">
                                <h3><i class="ti-pencil"></i>  Thêm nhà xuất bản mới</h3>
                                <form id="nxb-form">
                                    <div class=" row mt-8 ">
                                        <div class="c3 col mt-16">
                                            <label for="">Mã nhà xuất bản </label>
                                            <input type="text" name="" id="nxb-id" required>
                                        </div>
                                        <div class="c3 col mt-16">
                                            <label for="">Tên nhà xuất bản </label>
                                            <input type="text" name="" id="nxb-name" required>
                                        </div>
                                        <div class="c3 col mt-16">
                                            <label for="">Số điện thoại </label>
                                            <input type="number" name="" id="nxb-phone" required>
                                        </div>
                                    </div>

                                    <div class=" row mt-8 ">
                                        <div class="c2 col mt-16">
                                            <label for="">Email</label>
                                            <input type="email" name="" id="nxb-email" required>
                                        </div>
                                        <div class="c2 col mt-16">
                                            <label for="">Địa chỉ </label>
                                            <input type="text" name="" id="nxb-address" required>
                                        </div>
                                    </div>

                                    <button class="btn pul-right mt-8 add-btn" type="submit" name="borrow" >Thêm mới</button>
                                    <button class="btn pul-right mt-8 update-btn" type="submit" name="borrow" >Cập nhật </button>

                                </form>
                            </div>
                            <div class="mt-24 form col c1">
                                <h3><i class="ti-receipt"></i>Danh sách nhà xuất bản </h3>
                                <div class="table">
                                    <table id="nxb-table">
                                        <thead>
                                            <tr>
                                                <th>Mã NXB</th>
                                                <th>Tên NXB</th>
                                                <th>Sđt</th>
                                                <th>Email</th>
                                                <th>Địa chỉ</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </main>
                    </div>
                    <!-- vay mượn sách -->
                    <div class="manager hide" id="loan-slip">
                        <main class="row">

                            <h2><i class="ti-bookmark"></i>Quản lý phiếu mượn </h2>
                            <div class="mt-24 form col c1">
                                <h3><i class="ti-pencil"></i>  Thêm mới phiếu mượn</h3>
                                <form action="" method="post" id="loan-slip_form">
                                    <div class=" row mt-8 ">
                                        <div class="c3 col mt-16">
                                            <label for="">Mã phiếu mượn</label>
                                            <input type="text" id="loan-slip_id" required>
                                        </div>
                                        <div class="c3 col mt-16">
                                            <label for="">Mã số sách:</label>
                                            <select id="book_id" class="col c1" >

                                            </select>                                           
                                        </div>
                                        <div class="c3 col mt-16">
                                            <label for="">Mã người dùng </label>
                                            <select id="user_id" class="col c1" >

                                            </select>
                                        </div>
                                        <div class="c3 col mt-16">
                                            <label for="">Ngày mượn</label>
                                            <input type="date" id="borrow_date" required>
                                        </div>
                                        <div class="c3 col mt-16">
                                            <label for="">Ngày trả </label>
                                            <input type="date" id="return_date" required>
                                        </div>
                                    </div>

                                    <button class="btn pul-right mt-8 add-btn" type="submit" name="borrow" >Thêm mới</button>
                                    <button class="btn pul-right mt-8 update-btn" type="submit" name="borrow" >Cập nhật </button>
                                </form>
                            </div>

                            <div class="mt-24 form col c1">
                                <h3><i class="ti-receipt"></i>Danh sách phiếu mượn</h3>
                                <div class="table">
                                    <table id="loan-slip_table">
                                        <thead>
                                            <tr>
                                                <th>Mã phiếu mượn</th>
                                                <th>Mã sach</th>
                                                <th>Mã nguoidung</th>
                                                <th>Ngày mượn</th>
                                                <th>Ngày trả</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </main>
                    </div>
                    <!-- chi tiết phiếu muọn -->
                    <div class="manager hide" id="slip-details">
                        <main class="row">

                            <h2><i class="ti-bookmark-alt"></i>Chi tiết phiếu mượn </h2>
                            <div class="mt-24 form col c1">
                                <h3><i class="ti-pencil"></i>  Thêm mới chi tiết phiếu mượn</h3>
                                <form action="" method="post" id="slip-details_form">
                                    <div class=" row mt-8 ">
                                        <div class="c2 col mt-16">
                                            <label for="">Mã phiếu mượn</label>
                                            <select id="slip-details_id" class="col c1" >

                                            </select>
                                        </div>                                                                             

                                        <div class="c2 col mt-16">
                                            <label for="">Số Lượng  </label>
                                            <select id="slip-details_quantity" class="col c1" >

                                            </select>
                                        </div>
                                    </div>
                                    <div class=" row mt-8 ">

                                        <div class="c2 col mt-16">
                                            <label for="">Địa chỉ mượn </label>
                                            <input type="text" id="borrow_address" required>
                                        </div>
                                        <div class="c2 col mt-16">
                                            <label for="">Trạng thái </label>
                                            <select id="slip-details_status" class="col c1" >
                                                <option value="Đã Duyệt">Đã Duyệt</option>
                                                <option value="Chưa Được Duyệt">Chưa Được Duyệt</option>
                                            </select>

                                        </div>
                                    </div>
                                    <button class="btn pul-right mt-8 add-btn" type="submit" name="borrow" >Thêm mới</button>
                                    <button class="btn pul-right mt-8 update-btn" type="submit" name="borrow" >Cập nhật </button>

                                </form>
                            </div>
                            <div class="mt-24 form col c1">

                                <h3><i class="ti-receipt"></i>Chi tiết phiếu mượn</h3>
                                <div class="table">
                                    <table id="slip-details_table">
                                        <thead>
                                            <tr>
                                                <th>Mã phiếu mượn</th>
                                                <th>Mã số sách</th>
                                                <th>Mã người dùng</th>
                                                <th>Ngày mượn</th>
                                                <th>So Luong</th>
                                                <th>Dia Chi Muon</th> 
                                                <th>Trang thai</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </main>
                    </div>
                    <!-- quản lý con người-->
                    <div class="manager hide" id="people">
                        <main class="row">
                            <h2><i class="ti-user"></i>Quản lý người dùng </h2>
                            <div class="mt-24 form col c1">
                                <h3><i class="ti-pencil"></i>  Thêm người dùng mới</h3>
                                <form action="" method="post" id="people-form">
                                    <div class=" row mt-8 ">

                                        <div class="c3 col mt-16">
                                            <label for="">Mã người dùng </label>
                                            <input type="text"  id="people-id" required>
                                        </div>
                                        <div class="c3 col mt-16">
                                            <label for="">Tên người dùng </label>
                                            <input type="text"  id="people-name" required>
                                        </div>
                                        <div class="c3 col mt-16">
                                            <label for="">Giới tính </label>
                                            <!--<input type="text"  id="people-sex" required>-->
                                            <select id="people-sex" class="col c1" >
                                                <option value="null"> Chọn giới tính </option>
                                                <option value="nam">Nam</option>
                                                <option value="nu">Nữ</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class=" row mt-8 ">
                                        <div class="c3 col mt-16">
                                            <label for="">Số điện thoại </label>
                                            <input type="number"  id="people-phone" required>
                                        </div>
                                        <div class="c3 col mt-16">
                                            <label for="">Email </label>
                                            <select id="people-email" class="col c1" >

                                            </select>
    <!--                                            <input type="option" name="" id="people-email" required>-->
                                        </div>
                                        <div class="c3 col mt-16">
                                            <label for="">Địa chỉ</label>
                                            <input type="text" id="people-address" required>
                                        </div>
                                    </div>
                                    <button class="btn pul-right mt-8 add-btn" type="submit" name="borrow" >Thêm mới</button>
                                    <button class="btn pul-right mt-8 update-btn" type="submit" name="borrow" >Cập nhật </button>


                                </form>
                            </div>

                            <div class="mt-24 form col c1">
                                <h3><i class="ti-receipt"></i>Danh sách người dùng </h3>
                                <div class="table">
                                    <table id="people-table">
                                        <thead>
                                            <tr>
                                                <th>Mã người dùng</th>
                                                <th>Tên người dùng</th>
                                                <th>Giới tính</th>
                                                <th>Số điện thoại</th>
                                                <th>Email</th>
                                                <th>Địa chỉ</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </main>
                    </div>
                    <!--Trang thông tin cá nhân--> 
                    <div class="manager hide" id="info-user">
                        <main>
                            <div class="container">
                                <h1>Trang thông tin cá nhân</h1>
                                <form id="myForm">
                                    <div class="form-group">
                                        <label for="avatar">Ảnh đại diện:</label>
                                        <img src="" alt="" id="avatar-preview" >
                                        <br>
                                        <input type="file" class="form-control-file " id="avatar" name="avatar" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Họ và tên:</label>
                                        <input type="text" class="form-control" id="name-info"   disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email-info"  disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại:</label>
                                        <input type="tel" class="form-control" id="phone-info"  disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Địa chỉ:</label>
                                        <input type="text" class="form-control" id="address-info"  disabled>
                                    </div>
                                    <div class="btn-container">
                                        <button type="button" class="btn btn-primary edit-btn">Sửa</button>
                                        <button type="submit" class="btn btn-primary save-btn" disabled>Lưu</button>
                                    </div>

                                </form>
                            </div>
                        </main>
                    </div>
                    <!--Trang thông tin lien he --> 
                    <div class="manager hide" id="contact">
                        <main class="row">
                            <div class="col c1">
                                <h1 class="">Thông Tin Liên Hệ</h1>
                                <div class="mt-24">                                

                                    <h2>Nếu có vấn đề thắc mắc xin vui lòng liên hệ chúng tôi qua các cách sau:</h2>
                                </div>

                                <div class="mt-16">

                                    <p class="mt-8 contact-it">
                                        <i class="ti-mobile"></i>
                                        Phone :<a href="tel:+00 0123456789">+00 123456789.</a>  
                                    </p>
                                    <p class="mt-8 contact-it">
                                        <i class="ti-email"></i>
                                        Email:  <a href="mailto:nguyenvana@gmail.com">nguyenvana@gmail.com</a> 
                                    </p>
                                    <p class="mt-8 contact-it">
                                        <i class="ti-facebook"></i>
                                        Facebook:<a href= " https://www.facebook.com/Doxirin/ " > Phạm Nhật Thanh </a>
                                    </p>
                                </div> 

                                <div class="mt-16">
                                    <h3>Nếu không khả quan vui lòng đến địa chỉ dưới dây. Rất hân hạnh được phụ vụ!</h3>
                                </div>

                                <div class="mt-16 row" >
                                    <div class="col c2">
                                        <iframe
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.24646352093!2d106.70408791455509!3d10.792425961849936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528b38ee53a39%3A0x145252fe8cc97bfc!2zMmEgxJAuIFRyxrDhu51uZyBTYSwgUGjGsOG7nW5nIDE3LCBCw6xuaCBUaOG6oW5oLCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1678547499577!5m2!1svi!2s"
                                            width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                    <div class="col c6 ic">
                                        <h3>Phận Hiệu Đại Học Thủy Lợi</h3>
                                        <h4> 2 Trường Sa, Phường 17, Bình Thạnh, Thành phố Hồ Chí Minh , Việt Nam</h4>
                                        <div class="ci-ar col c1">

                                            <p class="mt-8 contact-it">
                                                <i class="ti-mobile"></i>
                                                Điện Thoại:<a href="tel:+00 01122334455">01122334455.</a>  
                                            </p>

                                            <p class="mt-8 contact-it">
                                                <i class="ti-mobile"></i>
                                                Pax<a href="tel:+00 0123456789"> 23473243294</a>  
                                            </p>
                                        </div>
                                    </div>                                   
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>

            <div id="footer">
                <p>&copy; 2023 Quản lí thư viện</p>
            </div>

        </div>
        <!--link javacript-->
        <script>
            const editBtn = document.querySelector('.edit-btn');
            const saveBtn = document.querySelector('.save-btn');
            const form = document.getElementById('myForm');
            const nameInput = document.getElementById('name-info');
            const emailInput = document.getElementById('email-info');
            const phoneInput = document.getElementById('phone-info');
            const addressInput = document.getElementById('address-info');
            const avatarInput = document.getElementById('avatar');
            const avatarPreview = document.getElementById('avatar-preview');

            editBtn.addEventListener('click', () => {
                nameInput.removeAttribute('disabled');
                //                emailInput.removeAttribute('disabled');
                phoneInput.removeAttribute('disabled');
                addressInput.removeAttribute('disabled');
                avatarInput.removeAttribute('disabled');
                editBtn.style.display = "none";
                saveBtn.removeAttribute('disabled');
            });

            avatarInput.addEventListener('change', () => {
                const file = avatarInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = () => {
                        avatarPreview.src = reader.result;
                        avatarPreview.style.display = "block";
                    }
                    reader.readAsDataURL(file);
                }
            });

            form.addEventListener('submit', (e) => {
                e.preventDefault();

                nameInput.setAttribute('disabled', true);
                //                emailInput.setAttribute('disabled', true);
                phoneInput.setAttribute('disabled', true);
                addressInput.setAttribute('disabled', true);
                avatarInput.setAttribute('disabled', true);


            });







            // Nút tìm kiếm 
            const searchInput = document.getElementById("search-input");
            const searchButton = document.getElementById("search-button");

            searchInput.addEventListener("keypress", function (event) {
                if (event.keyCode === 13) {
                    event.preventDefault(); // loại bỏ hành động mặc định của phím Enter
                    searchButton.click(); // kích hoạt sự kiện click trên nút Tìm kiếm
                }
            });

            function showDiv(divId) {
                // Ẩn toàn bộ các phần tử hiện có
                var divsToHide = document.querySelectorAll('.show');
                for (var i = 0; i < divsToHide.length; i++) {
                    divsToHide[i].classList.remove('show');
                    divsToHide[i].classList.add('hide');
                }

                // Hiển thị phần tử được chỉ định
                var divToShow = document.getElementById(divId);
                divToShow.classList.remove('hide');
                divToShow.classList.add('show');
            }

        </script>


    </body>
    <script>
        function myAlert(message) {
            $('#modal-message').html(message);
            $('#myModal').modal('show');
        }
        function changeImage() {
            var input = document.getElementById("hinhsach");
            var image = document.querySelector('.image');
            const inputElement = document.getElementById("hinhsach");
            const selectedFile = inputElement.files[0];
            document.getElementById("hinhs").value = selectedFile.name;
            // Tạo đối tượng FileReader để đọc file
            var reader = new FileReader();
            reader.onload = function (event) {
                // Sau khi đọc file xong, đặt dữ liệu trong thuộc tính src của hình ảnh
                image.src = event.target.result;

                // Lưu hình ảnh vào localStorage
                localStorage.setItem('.image', event.target.result);
            };

            // Đọc file
            var t = reader.readAsDataURL(input.files[0]);
            var fileName = document.getElementById("hinhs").value;

            // Tạo đường dẫn tới file ảnh
            var imagePath = "./images/" + fileName;

            // Lấy thẻ hình ảnh
            var image = document.querySelector('.image');

            // Đặt đường dẫn tới file ảnh vào thuộc tính src của thẻ hình ảnh
            image.src = imagePath;
        }
        function test() {
            document.getElementById("hinhs");
            // Tạo đường dẫn tới file ảnh
            var imagePath = "./img/" + document.getElementById("hinhs").value;

            // Lấy thẻ hình ảnh
            var image = document.querySelector('.image');

            // Đặt đường dẫn tới file ảnh vào thuộc tính src của thẻ hình ảnh
            image.src = imagePath;
        }

        // Kiểm tra xem đã lưu hình ảnh trong localStorage chưa
        //    if (localStorage.getItem('.image')) {
        //        var image = document.querySelector('.image');
        //        image.src = localStorage.getItem('.image');
        //    }
    </script>
</html>
<script>
    $(document).ready(function () {
        $.ajax({
            url: 'sach.php',
            type: 'post',
            data: {action: 'getmals'},
            success: function (response) {
                $('#mals').html(response);
                //var data = JSON.parse(response);    
            }
        });
        $.ajax({
            url: 'sach.php',
            type: 'post',
            data: {action: 'getmatg'},
            success: function (response) {
                $('#matg').html(response);
                //var data = JSON.parse(response);    
            }
        });
        $.ajax({
            url: 'sach.php',
            type: 'post',
            data: {action: 'getmanxb'},
            success: function (response) {
                $('#manxb').html(response);
                //var data = JSON.parse(response);    
            }
        });
        // show data
        getData();

        function getData() {
            $.ajax({
                url: 'showsach.php',
                type: 'post',
                data: $('#book').serialize(),
                success: function (response) {
                    $('#showsach').html(response);
                    //var data = JSON.parse(response);
                }
            });
        }
        gettrangchu();
        function gettrangchu() {
            $.ajax({
                url: 'showtrangchu.php',
                type: 'post',
                data: {selectedValue: 'tất cả'},
                success: function (response) {
                    $('#showtrangchu').html(response);
                    //var data = JSON.parse(response);
                }
            });
        }
        //   thêm dữ liệu
        $('#book').on('click', '.themsach', function () {
            event.preventDefault();
            var mas = $('#mas').val();
            var mals = $('#mals').val();
            var tens = $('#tens').val();
            var matg = $('#matg').val();
            var soluong = $('#soluong').val();
            var hinhs = $('#hinhs').val();
            var manxb = $('#manxb').val();
            var namxb = $('#namxb').val();
            var trangthai = $('#trangthai').val();

            //        kết nối ajax
            $.ajax({
                url: 'sach.php',
                method: 'POST',
                data: {mas: mas, mals: mals, tens: tens, matg: matg, soluong: soluong, hinhs: hinhs, manxb: manxb, namxb: namxb, trangthai: trangthai, action: 'add'},
                success: function (response) {
                    alert(response);
                    $('#book')[0].reset();
                    getData();
                }
            });
        });


        //    xóa dữ liệu
        $('#showsach').on('click', '.delete', function () {
            var vt = $(this).parent().attr("data-vt");
            //var mas = data[vt].MaS;
            var tdElement = document.querySelector('td[data-vt="' + vt + '"]');
            // Lấy giá trị của thuộc tính data-mas
            var mas = tdElement.getAttribute('data-mas');
            $.confirm({
                title: 'Xác nhận xóa',
                content: 'Bạn có chắc chắn muốn xóa mục đã chọn?',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    confirm: {
                        text: 'Xóa',
                        btnClass: 'btn-danger',
                        action: function () {
                            // Thực hiện xóa
                            $.ajax({
                                url: 'sach.php',
                                method: 'POST',
                                data: {mas: mas, action: 'delete'},
                                success: function (response) {
                                }
                            });
                        }
                    },
                    cancel: {
                        text: 'Hủy',
                        btnClass: 'btn-default',
                        action: function () {
                            // Không thực hiện xóa
                        }
                    }
                }
            });
        });

        //    Sửa dữ liệu 
        $('#showsach').on('click', '.edit', function (event) {
            event.preventDefault();
            var vt = $(this).parent().attr("data-vt");
            var tdElement = document.querySelector('td[data-vt="' + vt + '"]');
            // Lấy giá trị của thuộc tính data-mas
            var mas = tdElement.getAttribute('data-mas');
            var mals = tdElement.getAttribute('data-mals');
            var tens = tdElement.getAttribute('data-tens');
            var matg = tdElement.getAttribute('data-matg');
            var soluong = tdElement.getAttribute('data-soluong');
            var hinhs = tdElement.getAttribute('data-hinhanh');
            var manxb = tdElement.getAttribute('data-manxb');
            var namxb = tdElement.getAttribute('data-namxb');
            var trangthai = tdElement.getAttribute('data-trangthai');
            $('#mas').val(mas);
            $('#mals').val(mals);
            $('#tens').val(tens);
            $('#matg').val(matg);
            $('#soluong').val(soluong);
            $('#hinhs').val(hinhs);
            $('#manxb').val(manxb);
            $('#namxb').val(namxb);
            $('#trangthai').val(trangthai);
            test();

        });
        //        kết nối ajax
        $('#book').on('click', '.capnhat', function () {
            event.preventDefault();
            var mas = $('#mas').val();
            var mals = $('#mals').val();
            var tens = $('#tens').val();
            var matg = $('#matg').val();
            var soluong = $('#soluong').val();
            var manxb = $('#manxb').val();
            var namxb = $('#namxb').val();
            var trangthai = $('#trangthai').val();
            var hinhs = $('#hinhs').val();
            $.ajax({
                url: 'sach.php',
                method: 'POST',
                data: {mas: mas, mals: mals, tens: tens, matg: matg, soluong: soluong, hinhs: hinhs, manxb: manxb, namxb: namxb, trangthai: trangthai, action: 'update'},
                success: function (response) {
                    alert(response);
                    $('#books')[0].reset();
                    getData();
                }
            });
        });
        // Bắt sự kiện click vào ô trong phần nhập dữ liệu
        //        $('#category-table').on('click', '.edit', function () {
        //            // Lấy giá trị của ô
        //            var vt = $(this).parent().attr("data-vt");
        //            // Hiển thị giá trị của ô trên phần nhập dữ liệu
        //            $('#category-id').val(arr[vt].MaLS);
        //            $('#category-name').val(arr[vt].TenLS);
        //            $('#category-content').val(arr[vt].Mota);
        //            $('#category-id').prop('disabled', true);
        //        });

        //    get data

        setInterval(function () {
            getData();
            gettrangchu();
        }, 1000);//reload sau 3s 
    });
</script>
