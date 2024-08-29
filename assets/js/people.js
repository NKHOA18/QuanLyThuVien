//var arr = [];
$(document).ready(function () {

    getData();
    getDataEmail();
//   thêm dữ liệu
    $('#people-form').on('click', '.add-btn', function (event) {
        event.preventDefault();
        var id = $('#people-id').val();
        var name = $('#people-name').val();
        var sex = $('#people-sex').val();
        var phone = $('#people-phone').val();
        var email = $('#people-email').val();
        var address = $('#people-address').val();

//        kết nối ajax
        $.ajax({
            url: 'assets/php/people.php',
            method: 'POST',
            data: {id: id, name: name, sex: sex, phone: phone, email: email, address: address, action: 'add'},
            success: function (response) {
                alert(response);
                $('#people-form')[0].reset();

            }
        });
    });

//    xóa dữ liệu
    $('#people-table').on('click', '.delete', function () {
        var id = $(this).parent().attr("data-MaND");

//kết nối ajax
        if (confirm("Bạn có chắc muốn xóa dữ liệu này?")) {
            $.ajax({
                url: 'assets/php/people.php',
                method: 'POST',
                data: {id: id, action: 'delete'},
                success: function (response) {
                    alert(response);
                    $('#people-table tbody tr:last-child').remove();
                    $('#people-form')[0].reset();

                }
            });
        }
        return false;
    });

//    Sửa dữ liệu 
    $('#people-form').on('click', '.update-btn', function (event) {
        event.preventDefault();
        var id = $('#people-id').val();
        var name = $('#people-name').val();
        var sex = $('#people-sex').val();
        var phone = $('#people-phone').val();
        var email = $('#people-email').val();
        var address = $('#people-address').val();
        $('#people-id').prop('disabled', false);
        $('#people-email').prop('disabled', false);

//        kết nối ajax
        $.ajax({
            url: 'assets/php/people.php',
            method: 'POST',
            data: {id: id, name: name, sex: sex, phone: phone, email: email, address: address, action: 'update'},
            success: function (response) {
                alert(response);
                $('#people-form')[0].reset();

            }
        });
    });

    // Bắt sự kiện click vào ô trong phần nhập dữ liệu
    $('#people-table').on('click', '.edit', function () {
        // Lấy giá trị của ô
        var id = $(this).parent().attr("data-MaND");
        var name = $(this).parent().attr("data-HoTen");
        var sex = $(this).parent().attr("data-GioiTinh");
        var phone = $(this).parent().attr("data-SDT");
        var email = $(this).parent().attr("data-Email");
        var address = $(this).parent().attr("data-DiaChi");
        // Hiển thị giá trị của ô trên phần nhập dữ liệu
        $('#people-id').val(id);
        $('#people-name').val(name);
        $('#people-sex').val(sex);
        $('#people-phone').val(phone);
        $('#people-email').val(email);
        $('#people-address').val(address);
        $('#people-id').prop('disabled', true);
        $('#people-email').prop('disabled', true);

    });

//    get data
    function getData() {
        $.ajax({
            url: 'assets/php/people.php',
            method: 'POST',
            data: {action: 'get'},
            success: function (response) {
                let data = JSON.parse(response);
//                arr = data;
                let s = '';
                if (data.length == 0) {
                    s = '<tr><td> Không có dữ liệu </td></tr>';
                    $("#people-table tbody").html(''); // Loại bỏ toàn bộ nội dung bảng
                } else {
                    for (var i in data) {
                        let d = data[i];
                        s = s + ' <tr>' +
                                '<td>' + d.MaND + '</td>' +
                                ' <td>' + d.HoTen + '</td>' +
                                ' <td>' + d.GioiTinh + '</td>' +
                                '<td>' + d.SDT + '</td>' +
                                ' <td>' + d.Email + '</td>' +
                                ' <td>' + d.DiaChi + '</td>' +
                                ' <td  data-MaND="' + d.MaND + '" data-HoTen="' + d.HoTen + '" data-GioiTinh="' + d.GioiTinh + '" data-SDT="' + d.SDT + '" data-Email="' + d.Email + '" data-DiaChi="' + d.DiaChi + '"><button class="button edit">Sửa</button><button class="button delete " >Xóa</button> </td>' +
                                '</tr>';

                    }
                    document.getElementById("people-table").getElementsByTagName("tbody")[0].innerHTML = s;

                }
            }
        });
    }

    //    get data email
    function getDataEmail() {
        $.ajax({
            url: 'assets/php/people.php',
            method: 'POST',
            data: {action: 'getemail'},
            success: function (response) {
                var data = JSON.parse(response);
                var ht = '<option value="NULL">Chọn Email </option>';
                for (var i in data) {
                    var d = data[i];
                    ht = ht + '<option value="' + d.Email + '">' + d.Email + '</option>';
                }
                $("#people-email").html(ht);
            }
        });
    }

// Reload trang web sau khi xóa dữ liệu
//function reloadPage(){
//    location.reload(true);
//}

    setInterval(function () {
        getData();
//        getDataEmail();
    }, 5000);//reload sau 3s 
});

