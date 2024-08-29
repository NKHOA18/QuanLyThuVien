$(document).ready(function () {
//    toast({title: 'success', massage: 'success', type: 'success', duration: 3000});

    SaveInfoLogin();
//  Đăng nhập 
    $('#login-form').on('click', '.login-btn', function (event) {
        event.preventDefault();
        var email = $('#Email-login').val();
        var password = $('#MatKhau-login').val();

        // kết nối AJAX
        $.ajax({
            url: 'assets/php/user.php',
            method: 'POST',
            dataType: 'json',
            data: {email: email, password: password, action: 'login'},
            success: function (response) {
                console.log(response);

                if (response.success) {
                    // nếu đăng nhập thành công, ẩn thẻ <li> chứa button đăng nhập
                    localStorage.setItem('email', email);
                    $('#modal-login').removeClass('open');
                    $('.info-user').removeClass('hide');
                    $('.btn-login,#modal-login').addClass('hide');
//                    $('#email-info').attr('email', email);

                    getDataInfo(email);
                    getDataBook(email);

                }
                toast({title: response.title, message: response.message, type: response.type, duration: 3000});
//                console.log(response.type);
            }
        });
    });

//   ĐĂng xuất 
    $('.logout').click(function () {
        localStorage.removeItem('email');
        // Hiển thị button đăng nhập
        $('.btn-login').removeClass('hide');
        // Ẩn thông tin người dùng
        $('.info-user').addClass('hide');
    });

// Lưu thông tin đăng nhập 
    function SaveInfoLogin() {
        var email = localStorage.getItem('email');
        if (email) {
            $('#modal-login').removeClass('open');
            $('.info-user').removeClass('hide');
            $('.btn-login,#modal-login').addClass('hide');
//                    $('#email-info').attr('email', email);
            getDataInfo(email);
            getDataBook(email);
        } else {
            // Hiển thị button đăng nhập
            $('.btn-login').removeClass('hide');
        }
    }


    //  Đăng ký 
    $('#signup-form').on('click', '.signup-btn', function (event) {
        event.preventDefault();
        var email = $('#Email-signup').val();
        var password = $('#MatKhau-signup').val();
        var passconfirm = $('#MatKhau-confirm').val();

        // kết nối AJAX
        $.ajax({
            url: 'assets/php/user.php',
            method: 'POST',
            dataType: 'json',
            data: {email: email, password: password, passconfirm: passconfirm, action: 'signup'},
            success: function (response) {
                console.log(response);

                if (response.success) {
                    // nếu đăng ký thành công,sẽ chuyển qua trang đăng nhập

                    $('#modal-login').removeClass('hide');
                    $('#modal-login').addClass('open');
                    $('#modal-signup').removeClass('open');
                    $('#modal-signup').addClass('hide');
                }
                toast({title: response.title, message: response.message, type: response.type, duration: 3000});

            }
        });
    });

    // quên mật khẩu 
    $('#forgot-form').on('click', '.forgot-btn', function (event) {
        event.preventDefault();
        var email = $('#email-forgot').val();

        // kết nối AJAX
        $.ajax({
            url: 'assets/php/user.php',
            method: 'POST',
            dataType: 'json',
            data: {email: email, action: 'forgot'},
            success: function (response) {
                console.log(response);
                if (response.success) {
                    // nếu đăng ký thành công,sẽ chuyển qua trang đăng nhập
                    $('#modal-login').removeClass('hide');
                    $('#modal-login').addClass('open');
                    $('#modal-forgot').removeClass('open');
                    $('#modal-forgot').addClass('hide');
                }
                toast({title: response.title, message: response.message, type: response.type, duration: 3000});

            }
        });
    });

    //Đổi mật khẩu 
    $('#change-form').on('click', '.change-btn', function (event) {
        event.preventDefault();
        var email = $(this).data('email');
        var password = $('#MatKhau-change').val();
        var passwordnew = $('#MatKhau-new').val();
        var passwordcofirn = $('#MatKhau-confirn1').val();
        console.log($('.change-btn').data('email'));
        console.log(email);

        // kết nối AJAX
        $.ajax({
            url: 'assets/php/user.php',
            method: 'POST',
            dataType: 'json',
            data: {email: email, password: password, passwordnew: passwordnew, passwordcofirn: passwordcofirn, action: 'change'},
            success: function (response) {
                console.log(response);

                if (response.success) {
                    $('#modal-changepass').removeClass('open');
                    $('#modal-changepass').addClass('hide');
                }
                toast({title: response.title, message: response.message, type: response.type, duration: 3000});

            }
        });
    });

    //sửa thông tin cá nhân
    $('#myForm').on('click', '.save-btn', function () {
        const editBtn = document.querySelector('.edit-btn');
        const saveBtn = document.querySelector('.save-btn');
        var name = $('#name-info').val();
        var email = $('#email-info').val();
        var phone = $('#phone-info').val();
        var address = $('#address-info').val();
        var img = $('#avatar').val().replace(/C:\\fakepath\\/i, '');
        editBtn.style.display = "inline";
        saveBtn.setAttribute('disabled', true);

        $.ajax({
            url: 'assets/php/user.php',
            method: 'POST',
            dataType: 'json',
            data: {email: email, name: name, phone: phone, address: address, img: img, action: 'update'},
            success: function (response) {
                toast({title: response.title, message: response.message, type: response.type, duration: 3000});
            }
        });
    });

    // Kiểm tra thông tin  người dùng và show 
    function getDataInfo(email) {

        $.ajax({
            url: 'assets/php/user.php',
            method: 'POST',
            dataType: 'json',
            data: {email: email, action: 'info'},
            success: function (response) {

                $('#user-name').text(response[0].HoTen);
                $('#name-info').val(response[0].HoTen);
                $('#email-info').val(response[0].Email);
                $('#phone-info').val(response[0].SDT);
                $('#address-info').val(response[0].DiaChi);
                $('#subnav-img').attr('src', 'img/' + response[0].image);
                $('#avatar-preview').attr('src', 'img/' + response[0].image);
//                 giá trị này sẽ được lưu trữ trong HTML DOM (Document Object Model) của trang web.
//                $('.change-btn').attr('data-email',  response[0].Email);
//                  giá trị  được lưu trữ trong bộ nhớ của trình duyệt
                $('.change-btn').data('email', response[0].Email);

            }
        });
    }

    // Kiểm tra thông tin sách đang theo dõi và show
    function getDataBook(email, search = '') {
//          var email = $('#email-info').attr("email");
        $.ajax({
            url: 'assets/php/user.php',
            method: 'POST',
            data: {email: email, search: search, action: 'book'},
            success: function (response) {
                let data = JSON.parse(response);
                let s = '';
                let ht = '';

                for (var i in data) {
                    let d = data[i];
                    s = s + ' <tr data-MaS="' + d.MaS + '" data-TenS="' + d.TenS + '" data-TenLS="' + d.TenLS + '" data-TrangThai="' + d.TrangThai + '" data-NgayMuon="' + d.NgayMuon + '" data-TenTG="' + d.TenTG + '">' +
                            '<td>' + d.TenS + '</td>' +
                            '<td>' + d.TenTG + '</td>' +
                            '<td>' + d.TenLS + '</td>' +
                            '<td>' + d.TrangThai + '</td>' +
                            '<td>' + d.NgayMuon + '</td>' +
                            '</tr>';
                    ht = ht + '<div class="c3 col mt-16 img-book" data-MaS="' + d.MaS + '">' +
                            '<img class="c1" border="1" width="200px" height="500px" src="img/' + d.HinhAnh + '">' +
                            '<div class="mt-16">  </div></div>';
                }
                $("#book-table tbody").html(s);
                $("#img-booklist").html(ht);
            }
        });
    }

    //tìm kiếm sách trong lịch sử 
    $('#search-form').on('click', '#search', function (event) {
        event.preventDefault();
        var email = localStorage.getItem('email');
        var search = $('.search-input').val();
        console.log(email);
        console.log(search);
        getDataBook(email, search);
    });

    $('.search-input').click(function () {
        $('.search-input').val('');
    });

//    show trang sach
    $('#book-table').on('click', 'tr', function () {
        var id = $(this).attr('data-MaS');
        console.log(id);
        // Thay đổi URL để chuyển sang trang khác
        window.location.href = 'chitiet.php?masach=' + id;
//        window.open('chitiet.php?masach=' + id);

    });
    $('#img-booklist').on('click', '.img-book', function () {
        var id = $(this).attr('data-MaS');
        console.log(id);
        // Thay đổi URL để chuyển sang trang khác
        window.location.href = 'chitiet.php?masach= ' + id;
//        window.open('chitiet.php?masach=' + id);

    });

//reset du lieu nguoi dung
    $('.reset-book').click(function () {
        var email = localStorage.getItem('email');
        getDataBook(email, '');
    });

//thông báo message
    function toast( { title = '', message = '', type = '', duration = 3000 }) {
        const icons = {
            success: 'fas fa-check-circle',
            info: 'fas fa-info-circle',
            warning: 'fas fa-exclamation-circle',
            error: 'fas fa-exclamation-circle'
        };
        const icon = icons[type];

        const toast = $(`<div class="toast toast--${type}">
        <div class="toast__icon">
            <i class="${icon}"></i>
        </div>
        <div class="toast__body">
            <h3 class="toast__title">${title}</h3>
            <p class="toast__message">${message}</p>
        </div>
        <div class="toast__close">
            <i class="fa-sharp fa-solid fa-xmark"></i>
        </div>
    </div>`);

        $('#toast').append(toast);

        toast.fadeIn('fast', function () {
            setTimeout(function () {
                toast.fadeOut('slow', function () {
                    toast.remove();
                });
            }, duration);
        });

        toast.find('.toast__close').on('click', function () {
            toast.fadeOut('slow', function () {
                toast.remove();
            });
        });
    }

});

