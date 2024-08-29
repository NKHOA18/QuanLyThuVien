var arr = [];
$(document).ready(function () {
    getData();


//    Sửa dữ liệu 
    $('#myForm').on('click', '.save-btn', function (event) {
        event.preventDefault();
        const editBtn = document.querySelector('.edit-btn');
        const saveBtn = document.querySelector('.save-btn');
        var name = $('#name-info').val();
        var phone = $('#phone-info').val();
        var email = $('#email-info').val();
        var address = $('#address-info').val();
        var img = $('#avatar').val().replace(/C:\\fakepath\\/i, '');
        console.log(img);
        editBtn.style.display = "inline";
        saveBtn.setAttribute('disabled', true);
//        kết nối ajax
        $.ajax({
            url: 'assets/php/info-user.php',
            method: 'POST',
            data: {name: name, phone: phone, email: email, address: address, img: img, action: 'update'},
            success: function (response) {
                alert(response);
                getData();

            }
        });
    });

//    get data
    function getData() {

        $.ajax({
            url: 'assets/php/info-user.php',
            method: 'POST',
            data: {action: 'get'},
            success: function (response) {
                let data = JSON.parse(response);
                $('#user-name').text(data[0].HoTen);
                $('#name-info').val(data[0].HoTen);
                $('#phone-info').val(data[0].SDT);
                $('#email-info').val(data[0].Email);
                $('#address-info').val(data[0].DiaChi);
                $('#avatar-preview').attr('src', 'img/' + data[0].image);
              $('#subnav-img').attr('src', 'img/' + data[0].image);
            }
        });
    }

    setInterval(function () {
        getData();
//        getDataEmail();
    }, 30000);//reload sau 3s 
});

