
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Thư viện Số </title>
        <link rel="stylesheet" href="assets/css/style-user.css">
        <link rel="stylesheet" href="assets/css/font/themify-icons/themify-icons.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <script src="assets/js/user.js"></script>
        <script src="assets/js/genre.js"></script>


    </head>

    <body>
        <div>
            <div id="main">
                <!-- bắt đầu header -->
                <div id="header" class="ci">

                    <ul class="nav  ci">
                        <li><a href="#home" onclick="showDiv('home')" id="home-header"><img src="assets\img\logo.png" alt=""></a> </li>
                        <li>
                            <h3 >Thư viện nhóm 4</h3>
                        </li>
                    </ul>

                    <ul>
                        <ul class="nav search-header ci">
                            <li><i class="ti-search"></i></li>
                            <li>
                                <form id="search-form">
                                    <input type="text" placeholder="Tìm kiếm sách, độc giả, mượn trả..." class="search-input">
                                    <button  id ='search'>Tìm kiếm</button>
                                </form>
                            </li>
                        </ul>
                    </ul>

                    <ul class="nav ci ">
                        <li class="nav ci btn-login"> <button class="login-form">Đăng nhập </button> </li>
                        <li class="nav ci btn-login"> <button class="signup-form">Đăng ký </button> </li>
                        <li class="nav info-user hide">
                            <i class="ti-bell info-user hide "></i>
                            <ul class="subnav">
                                15 Notifications
                                <li>
                                    <a href="#" class="dropdown">
                                        <i class="ti-comments"></i> 4 tin nhắn mới
                                        <span style="float:right">3 phút</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown">
                                        <i class="ti-user"></i> 8 yêu cầu kết bạn
                                        <span style="float:right">6 giờ</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown">
                                        <i class="ti-file"></i> 3 báo cáo mới
                                        <span style="float:right">9 ngày</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown">Hiện tất cả</a>
                                </li>
                            </ul>
                        </li>
                        <li class="info-user hide"><span id="user-name"></span></li>
                        <li  class="info-user hide">
                            <i class="ti-angle-down"></i>
                            <ul class="subnav">
                                <li> <img class="image" src="" id="subnav-img"> </li>
                                <li><a href="#info-user" onclick="showDiv('info-user')"><i class="ti-id-badge"></i>Thông tin cá nhân</a></li>
                                <li><a href="#" onclick="showDiv('history-book')"><i class="ti-time"></i>Lịch sử</a></li>
                                <li><a href="#" class="change-password"><i class="ti-lock "></i>Đổi mật khẩu </a></li>
                                <li><a href="#" class="logout"><i class="ti-shift-right"></i>Đăng xuất</a></li>
                            </ul>
                        </li>


                        <li class="nav ci"> <i class="ti-menu"></i>
                            <ul class="subnav">

                                <li><a href="#home" onclick="showDiv('home')"> <i class="ti-home"></i>Trang chủ </a></li>
                                <li><a href="#about" onclick="showDiv('about')"><i class="ti-book"></i>Giới thiệu thư viện số</a></li>
                                <li><a href="#contact" onclick="showDiv('contact')"><i class="ti-book"></i>thông tin liên hệ</a></li>
                                <li class="dropdown"><a href="#genre" onclick="showDiv('genre')"><i class="ti-layout-grid3"></i>Thể loại</a>

                                    <ul class="dropdown-content div_mid">
                                        <script>
                                            getgenre();
                                            function getgenre() {
                                                $.ajax({
                                                    url: 'genre.php',
                                                    method: 'POST',
                                                    data: {action: 'getTenLS'},
                                                    success: function (response) {
                                                        var data = JSON.parse(response);
                                                        var ht = '<p><a title="tất cả" value="tất cả" class="genre">tất cả</a></p>';

                                                        for (var i in data) {
                                                            var d = data[i];
                                                            ht = ht + '<p><a title="' + d.TenLS + '" value="' + d.TenLS + '" class="genre">' + d.TenLS + '</a></p>';
                                                        }
                                                        $(".div_mid").html(ht);

                                                    }
                                                });
                                            }

                                        </script>
                                    </ul>

                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- kết thúc header -->
                <!-- slide -->
                <div id="slide">

                </div>
                <!--Kết thúc slide-->
                <!--bắt dầu nội dung-->
                <div id="content" class="center">

                    <div class="content-selection  ">
                        <!-- Trang chủ  -->
                        <div class="manager show" id="home">
                            <main>
                                <div id="slideshow">
                                    <div class="slide-wrapper">
                                        <div class="slide"><img src="assets/img/anhtruot/sach1.png"></div>
                                        <div class="slide"><img src="assets/img/anhtruot/sach2.jpeg"></div>
                                        <div class="slide"><img src="assets/img/anhtruot/sach3.jpeg"></div>
                                    </div>
                                </div>
                                <h2>SÁCH MỚI</h2>

                                <div class="top-slip row mt-16" id="showtrangchu">
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
                                            <label for="avatar">Ảnh đại diện:</label><br>                                                                                       
                                            <img src="" alt="" id="avatar-preview"><br>                                          
                                            <input type="file" class="form-control-file " id="avatar" name="avatar"disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Họ và tên:</label>
                                            <input type="text" class="form-control" id="name-info" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email-info" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Số điện thoại:</label>
                                            <input type="tel" class="form-control" id="phone-info" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Địa chỉ:</label>
                                            <input type="text" class="form-control" id="address-info" disabled>
                                        </div>
                                        <div class="btn-container">
                                            <button type="button" class="btn btn-primary edit-btn">Sửa</button>
                                            <button type="submit" class="btn btn-primary save-btn" disabled>Lưu</button>
                                        </div>

                                    </form>
                                </div>
                            </main>
                        </div>
                        <!--Trang Giới thiệu -->
                        <div class="manager hide" id="about">
                            <main class="row">
                                <div class="col c1">
                                    <h1>Giới thiệu</h2>
                                        <div class="mt-24">
                                            <ul class="about-nav">
                                                <li> <h2> Thư viện</h2>
                                                    <ul class="about-subnav mt-16"> 
                                                        <li > Thư viện là một kho sưu tập các nguồn thông tin, được chọn lọc bởi các chuyên gia và có thể được tiếp cận để tham khảo hay mượn, thường là trong một môi trường yên tĩnh phù hợp cho học tập. Kho tàng của một thư viện có thể chứa đến hàng triệu đầu mục, bao gồm nhiều định dạng như sách, ấn phẩm định kỳ, báo, thủ bản, phim, bản đồ, văn kiện… và nhiều thể loại khác. Thông tin, tư liệu trong thư viện có thể cung cấp một lượng tri thức lớn để phát triển con người về chất một cách lý tưởng nhất và được trao đổi chuyển giao thông tin, tri thức của mỗi quốc gia dân tộc và phục vụ cho sự phát triển bền vững của kinh tế và xã hội.
                                                            Trong phạm vi bài viết này, Luật Hoàng Anh sẽ làm rõ các nội dung về thư viện đại học theo Điều 14 Luật Thư viện số 46/2019/QH14 ngày 21 tháng 11 năm 2019 (sau đây được gọi tắt là Luật Thư viện năm 2019).
                                                        </li>
                                                        <li>Các tài liệu của thư viện số thường được cấp phép hoặc mua bản quyền, khiến cho người đọc có thể truy cập và tìm kiếm các tài liệu học tập và nghiên cứu chất lượng cao để giúp họ nghiên cứu, nghiên cứu, học tập và nâng cao kiến thức của mình. Hơn nữa, các tài liệu này thường được lưu trữ và quản lý một cách rõ ràng và có thể tìm kiếm thuận tiện, tránh phải tốn khoảng thời gian lớn để tìm kiếm thông tin của một cuốn sách hoặc tài liệu cụ thể.
                                                        </li>
                                                        <li> Thư viện số có thể được sử dụng trên các thiết bị di động và máy tính, giúp cho người dùng dễ dàng tìm kiếm, lưu trữ và quản lý các tài liệu học tập và nghiên cứu từ xa. Điều này giúp những người đọc bận rộn hoặc không tiện truy cập thư viện truyền thống vẫn có thể tiếp cận với các tài liệu học tập và nghiên cứu.
                                                        </li>
                                                        <li> Thư viện số đem lại nhiều lợi ích với người sử dụng, giúp họ tiết kiệm thời gian và chi phí cho việc tìm kiếm và sử dụng các tài liệu học tập và nghiên cứu, đồng thời giúp nâng cao kiến ​​thức và kỹ năng cần thiết cho cuộc sống và công việc của họ.
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li> <h2> Chức năng và nhiệm vụ</h2>                                             
                                                    <ul class="about-subnav mt-16">        
                                                        <li> Cung cấp tài liệu học tập và nghiên cứu: Thư viện số cung cấp cho người dùng các tài liệu học tập và nghiên cứu như sách, bài báo, tạp chí và hồ sơ khoa học. Những tài liệu này được tổ chức và lưu trữ một cách có hệ thống, giúp người dùng dễ dàng tìm kiếm và truy cập.			
                                                        </li>
                                                        <li> Hỗ trợ nghiên cứu và học tập: Thư viện số giúp người sử dụng có thể tiếp cận với các tài liệu học tập và nghiên cứu chất lương cao, giúp cho quá trình nghiên cứu và học tập trở nên hiệu quả hơn.			
                                                        </li>
                                                        <li> Tư vấn và hỗ trợ người dùng: Thư viện số cung cấp dịch vụ tư vấn và hỗ trợ người dùng, giúp họ tìm kiếm và sử dụng các tài liệu một cách hiệu quả.
                                                        </li>
                                                        <li> Quản lý tài liệu: Thư viện số đảm bảo việc quản lý, bảo quản và cập nhật các tài liệu, đồng thời giúp cho người dùng có thể tìm kiếm và truy cập các tài liệu một cách dễ dàng và thuận tiện.
                                                        </li>
                                                        <li> Cung cấp dịch vụ mượn tài liệu: Thư viện số cho phép người dùng mượn và trả các tài liệu học tập và nghiên cứu một cách trực tuyến.
                                                        </li>
                                                        <li> Hội nhập với các hệ thống thư viện khác: Thư viện số hội nhập với các hệ thống thư viện khác, giúp người dùng có thể truy cập đến các tài liệu từ nhiều nguồn khác nhau.									
                                                        </li>
                                                        <li>Triết lý của thư viện số là chia sẻ kiến thức, giúp người dùng có thể đạt được sự tiến bộ và phát triển bản thân. Các chức năng và nhiệm vụ của thư viện số đóng vai trò quan trọng trong việc đạt được mục tiêu này.						
                                                        </li>
                                                        <li> Thư viện cung cấp hàng ngàn sách điện tử và tài liệu học tập cho sinh viên, giảng viên và cộng đồng.
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <center><img src="https://tlus.edu.vn/wp-content/uploads/2021/03/IMG_5102-660x330.png"></center>


                                            <p>Trường phân hiệu Đại học Thủy Lợi</p>
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
                                                    Email: <a href="mailto:nguyenvana@gmail.com">nguyenvana@gmail.com</a>
                                                </p>
                                                <p class="mt-8 contact-it">
                                                    <i class="ti-facebook"></i>
                                                    Facebook:<a href=" https://www.facebook.com/Doxirin/ "> Phạm Nhật Thanh </a>
                                                </p>
                                            </div>

                                            <div class="mt-16">
                                                <h3>Nếu không khả quan vui lòng đến địa chỉ dưới dây. Rất hân hạnh được phụ vụ!</h3>
                                            </div>

                                            <div class="mt-16 row">
                                                <div class="col c2">
                                                    <iframe
                                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.24646352093!2d106.70408791455509!3d10.792425961849936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528b38ee53a39%3A0x145252fe8cc97bfc!2zMmEgxJAuIFRyxrDhu51uZyBTYSwgUGjGsOG7nW5nIDE3LCBCw6xuaCBUaOG6oW5oLCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1678547499577!5m2!1svi!2s"
                                                        width="100%" height="200" style="border:0;" allowfullscreen=""
                                                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                </div>
                                                <div class="col c2 ic">
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
                                <!-- Lịch sử sách  -->
                                <div class="manager hide" id="history-book">
                                    <main>
                                        <div class="mt-24 form col c1">
                                            <h3><i class="ti-receipt"></i>Danh sách sách đang theo dõi <i class="ti-loop reset-book"></i></h3>

                                            <div class="table mt-24">
                                                <table id="book-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Tên sách </th>
                                                            <th>Tên tác giả </th>
                                                            <th>Tên thể loại</th>
                                                            <th>Trạng thái </th>
                                                            <th>Ngày thêm</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="mt-24 form row c1" id="img-booklist">

                                        </div>

                                    </main>

                                </div>
                        </div>
                    </div>

                    <div id="footer">
                        <p>&copy; 2023 Quản lí thư viện</p>
                    </div>
                </div>
                <!-- form dang nhap  -->
                <div class="modal ci hide " id="modal-login">
                    <div class="modal-contaner">
                        <div class="modal-close">
                            <i class="ti-close"></i>
                        </div>
                        <div class="modal-header">
                            <h2>Đăng nhập </h2>
                        </div>
                        <div class="modal-form mt-8">
                            <form action="" class="form" id="login-form">
                                <label for="Email">Tài khoản:</label>
                                <input type="text" id="Email-login"  >
                                <label for="MatKhau">Mật khẩu:</label>
                                <input type="password" id="MatKhau-login"  >
                                <div class="check">
                                    <label for="" class="remember-login"><input type="checkbox"> Remember login</label>
                                    <a href="#" class="fg-password">Forgot password ?</a>
                                </div>
                                <div class="center mt-24">
                                    <button class="login-btn" type="submit" >ĐĂNG NHẬP</button>
                                </div>
                                <div class="center mt-24">
                                    <p class="text-ac">Bạn chưa có tài khoản ?</p>
                                </div>
                                <div class="center mt-16">
                                    <a href="#" class="signup-form"> ĐĂNG KÝ</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- form dang ky  -->
                <div class="modal ci  hide" id="modal-signup">
                    <div class="modal-contaner">
                        <div class="modal-close">
                            <i class="ti-close"></i>
                        </div>
                        <div class="modal-header">
                            <h2>Đăng ký tài khoản</h2>
                        </div>
                        <div class="modal-form mt-8">
                            <form action="" class="form " id="signup-form">
                                <label for="Email">Email:</label>
                                <input type="email" id="Email-signup" name="Email" required>

                                <label for="MatKhau">Mật khẩu:</label>
                                <input type="password" id="MatKhau-signup" name="MatKhau" required>

                                <label for="confirm-password">Xác nhận mật khẩu:</label>
                                <input type="password" id="MatKhau-confirm" required>

                                <div class="center mt-24">
                                    <button type="submit" class="signup-btn">Đăng Ký</button>
                                </div>
                                <div class="center mt-24">
                                    <p class="text-ac">Bạn đã có tài khoản ?</p>
                                </div>
                                <div class="center mt-16">
                                    <a href="#" class="login-form"> ĐĂNG NHẬP </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- form quen mat khau  -->
                <div class="modal ci  hide" id="modal-forgot">
                    <div class="modal-contaner">
                        <div class="modal-close">
                            <i class="ti-close"></i>
                        </div>
                        <div class="modal-header">
                            <h2>Quên mật khẩu </h2>
                        </div>
                        <div class="modal-form mt-8">
                            <form action="" class="form" id="forgot-form">
                                <label for="Email">Email:</label>
                                <input type="email" id="email-forgot"  required>

                                <div id="error" class="error-message"></div>
                                <div class="center">
                                    <button type="submit" class="forgot-btn">Lấy lại mật khẩu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- form đổi mật khẩu  -->
                <div class="modal ci  hide" id="modal-changepass">
                    <div class="modal-contaner">
                        <div class="modal-close">
                            <i class="ti-close"></i>
                        </div>
                        <div class="modal-header">
                            <h2>Thay đổi mật khẩu </h2>
                        </div>
                        <div class="modal-form mt-8">
                            <form action="" class="form" id="change-form">
                                <!--                            <label for="Email">Email:</label>
                                                            <input type="email" id="Email-change"  required>-->
                                <label for="MatKhau">Mật khẩu cũ:</label>
                                <input type="password" id="MatKhau-change"  required>

                                <label for="MatKhau">Mật khẩu mới:</label>
                                <input type="password" id="MatKhau-new"  required>

                                <label for="confirm-password1">Xác nhận mật khẩu:</label>
                                <input type="password" id="MatKhau-confirn1" required>

                                <div class="center"><button type="submit" class="change-btn">Đổi mật khẩu </button> </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--thông báo message-->
                <div id="toast">

                </div>

                <script>
                    //                window.addEventListener("beforeunload", function (e) {
                    //                    // Hủy bỏ sự kiện mặc định của trình duyệt
                    //                    e.preventDefault();
                    //                    // Gửi yêu cầu xác nhận trước khi thoát khỏi trang
                    //                    e.returnValue = "";
                    //                });
                </script>
                <!-- click modal -->
                <script>

                    const signupForms = document.querySelectorAll('.signup-form');
                    const loginForms = document.querySelectorAll('.login-form');
                    const forgotPassForm = document.querySelector('.fg-password');
                    const changePassForm = document.querySelector('.change-password');
                    const btnLogout = document.querySelector('.logout');
                    const infoUsers = document.querySelectorAll('.info-user');
                    const modals = document.querySelectorAll('.modal');
                    const btnLogins = document.querySelectorAll('.btn-login');

                    //sự kiện ẩn thông tin người dùng và show nut đăng nhập nút đăng ký 
                    btnLogout.addEventListener('click', function () {
                        for (const infoUser of infoUsers) {
                            infoUser.classList.add('hide');
                        }
                        for (const btnLogin of btnLogins) {
                            btnLogin.classList.remove('hide');
                        }
                        window.location.replace('index-user.php');
                    });
                    //                sự kiện ẩn các modal khi ấn vào nút đóng hoặc ấn bên ngoài form
                    for (const modal of modals) {
                        const modalCloses = modal.querySelectorAll('.modal-close');
                        modal.addEventListener('click', function (event) {
                            // kiểm tra xem phần tử được nhấp chuột có phải là modal hoặc nút đóng hay không bằng cách kiểm tra xem `event.target`
                            if (event.target === modal || event.target.classList.contains('modal-close')) {
                                modal.classList.remove('open');
                                modal.classList.add('hide');
                            }
                        });
                        for (const modalClose of modalCloses) {
                            modalClose.addEventListener('click', function () {
                                modal.classList.remove('open');
                                modal.classList.add('hide');
                            });
                        }
                    }

                    //sự kiện ấn show trang quên mật khẩu 
                    forgotPassForm.addEventListener('click', function () {
                        showModal('modal-forgot');
                    });

                    //sự kiện ấn show trang đổi mật khẩu 

                    changePassForm.addEventListener('click', function () {
                        showModal('modal-changepass');
                    });

                    //sự kiện ấn show trang đăng ký
                    for (const signupForm of signupForms) {
                        signupForm.addEventListener('click', function () {
                            showModal('modal-signup');
                        });
                    }

                    //sự kiện ấn show trang đăng nhập  
                    for (const loginForm of loginForms) {
                        loginForm.addEventListener('click', function () {
                            showModal('modal-login');
                        });
                    }

                    //sự kiện ấn vào menu
                    function showModal(divId) {
                        var hiddenModal = document.querySelectorAll('.open');
                        for (var i = 0; i < hiddenModal.length; i++) {
                            hiddenModal[i].classList.remove('open');
                            hiddenModal[i].classList.add('hide');
                        }
                        var showModal = document.getElementById(divId);
                        showModal.classList.remove('hide');
                        showModal.classList.add('open');
                    }



                </script>

                <!--kiểm tra email trong quên mật khẩu--> 
                <script>
                    //
                    //             function lose(name) {
                    //                document.getElementById('email-forgot').value = name;
                    //                error.innerHTML = "Email không hợp lệ.";
                    //                document.getElementById('email-forgot').focus();
                    //            }
                    //            function load() {
                    //                // Set the number of seconds to countdown
                    //                document.getElementById('hide').style.display = 'block';  
                    //            }
                </script>
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
                        $('#home-header').click(function () {
                            gettrangchu();
                        });
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
                        $("#search").click(function (event) {
                            event.preventDefault();
                            var searchInput = $(".search-input").val();
                            if (searchInput == "") {
                                alert("chưa nhập dữ liệu");
                            } else {
                                $.ajax({
                                    url: "showtrangchu.php",
                                    method: "POST",
                                    data: {selectedValue: searchInput},
                                    success: function (response) {
                                        $('#showtrangchu').html(response);
                                        // Xử lý kết quả trả về từ server
                                    },
                                    error: function () {
                                        console.log("Lỗi khi thực hiện Ajax.");
                                    }
                                });
                            }
                        });
                        setInterval(function () {
                            getData();
                            gettrangchu();
                        }, 100000);//reload sau 3s 
                    });
                </script>