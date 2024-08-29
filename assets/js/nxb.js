var arr = [];
$(document).ready(function () {

    getData();
    getDataEmail();
//   thêm dữ liệu
    $('#nxb-form').on('click', '.add-btn', function (event) {
        event.preventDefault();
        var id = $('#nxb-id').val();
        var name = $('#nxb-name').val();
        var phone = $('#nxb-phone').val();
        var email = $('#nxb-email').val();
        var address = $('#nxb-address').val();

//        kết nối ajax
        $.ajax({
            url: 'assets/php/nxb.php',
            method: 'POST',
            data: {id: id, name: name, phone: phone, email: email, address: address, action: 'add'},
            success: function (response) {
                alert(response);
                $('#nxb-form')[0].reset();

            }
        });
    });

//    xóa dữ liệu
    $('#nxb-table').on('click', '.delete', function () {
     var id = $(this).parent().attr("data-MaNXB");

//kết nối ajax
        if (confirm("Bạn có chắc muốn xóa dữ liệu này?")) {
            $.ajax({
                url: 'assets/php/nxb.php',
                method: 'POST',
                data: {id: id, action: 'delete'},
                success: function (response) {
                    alert(response);
                    $('#nxb-table tbody tr:last-child').remove();

                }
            });
        }
        return false;
    });

//    Sửa dữ liệu 

    $('#nxb-form').on('click', '.update-btn', function (event) {

        event.preventDefault();
        var id = $('#nxb-id').val();
        var name = $('#nxb-name').val();
        var phone = $('#nxb-phone').val();
        var email = $('#nxb-email').val();
        var address = $('#nxb-address').val();
        $('#nxb-id').prop('disabled', false);

//        kết nối ajax
        $.ajax({
            url: 'assets/php/nxb.php',
            method: 'POST',
            data: {id: id, name: name, phone: phone, email: email, address: address, action: 'update'},
            success: function (response) {
                alert(response);
                $('#nxb-form')[0].reset();

            }
        });
    });

    // Bắt sự kiện click vào ô trong phần nhập dữ liệu
    $('#nxb-table').on('click', '.edit', function () {
        // Lấy giá trị của ô
        var id = $(this).parent().attr("data-MaNXB");
        var name = $(this).parent().attr("data-TenNXB");
        var phone = $(this).parent().attr("data-SDT");
        var email = $(this).parent().attr("data-Email");
        var address = $(this).parent().attr("data-DiaChi");
        // Hiển thị giá trị của ô trên phần nhập dữ liệu
        $('#nxb-id').val(id);
        $('#nxb-name').val(name);
        $('#nxb-phone').val(phone);
        $('#nxb-email').val(email);
        $('#nxb-address').val(address);
        $('#nxb-id').prop('disabled', true);

    });

//    get data
    function getData() {
        $.ajax({
            url: 'assets/php/nxb.php',
            method: 'POST',
            data: {action: 'get'},
            success: function (response) {
                let data = JSON.parse(response);
                arr = data;
                let s = '';
//                if (data.length == 0) {
////                    s = '<tr><td> Không có dữ liệu </td></tr>';
//                    $("#nxb-table tbody").html(''); // Loại bỏ toàn bộ nội dung bảng
//                } else {
                for (var i in data) {
                    let d = data[i];
                    s = s + ' <tr>' +
                            '<td>' + d.MaNXB + '</td>' +
                            ' <td>' + d.TenNXB + '</td>' +
                            '<td>' + d.SDT + '</td>' +
                            ' <td>' + d.Email + '</td>' +
                            ' <td>' + d.DiaChi + '</td>' +
                            ' <td data-MaNXB="' + d.MaNXB + '" data-TenNXB="' + d.TenNXB + '" data-SDT="' + d.SDT + '"data-Email="' + d.Email + '" data-DiaChi="' + d.DiaChi + '" ><button class="button edit">Sửa</button><button class="button delete " >Xóa</button> </td>' +
                            '</tr>';
                }
                document.getElementById("nxb-table").getElementsByTagName("tbody")[0].innerHTML = s;

//                }
            }
        });
    }

    //    get data email
    function getDataEmail() {
        $.ajax({
            url: 'assets/php/nxb.php',
            method: 'POST',
            data: {action: 'getemail'},
            success: function (response) {
                var data = JSON.parse(response);
                var ht = '<option value="NULL">Chọn Email </option>';
                for (var i in data) {
                    var d = data[i];
                    ht = ht + '<option value="' + d.Email + '">' + d.Email + '</option>';
                }
                $("#nxb-email").html(ht);
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

