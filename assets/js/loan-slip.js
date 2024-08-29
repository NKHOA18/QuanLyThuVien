var arr = [];
$(document).ready(function () {

    getData();
    getDataMaND();
    getDataMaS();
//   thêm dữ liệu
    $('#loan-slip_form').on('click', '.add-btn', function (event) {
        event.preventDefault();
        var idPM = $('#loan-slip_id').val();
        var idS = $('#book_id').val();
        var idND = $('#user_id').val();
        var borrowdate = $('#borrow_date').val();
        var returndate = $('#return_date').val();
       

//        kết nối ajax
        $.ajax({
            url: 'assets/php/loan-slip.php',
            method: 'POST',
            data: {idPM: idPM, idS: idS, idND: idND, borrowdate: borrowdate, returndate: returndate, action: 'add'},
            success: function (response) {
                alert(response);
                $('#loan-slip_form')[0].reset();

            }
        });
    });

//    xóa dữ liệu
    $('#loan-slip_table').on('click', '.delete', function () {
        var vt = $(this).parent().attr("data-vt");
        var idPM = arr[vt].MaPM;


//kết nối ajax
        if (confirm("Bạn có chắc muốn xóa dữ liệu này?")) {
            $.ajax({
                url: 'assets/php/loan-slip.php',
                method: 'POST',
                data: {idPM: idPM, action: 'delete'},
                success: function (response) {
                    alert(response);
                    $('#loan-slip_table tbody tr:last-child').remove();

                }
            });
        }
        return false;
    });

//    Sửa dữ liệu 
    $('#loan-slip_form').on('click', '.update-btn', function (event) {
        event.preventDefault();
        var idPM = $('#loan-slip_id').val();
        var idS = $('#book_id').val();
        var idND = $('#user_id').val();
        var borrowdate = $('#borrow_date').val();
        var returndate = $('#return_date').val();
        $('#loan-slip_id').prop('disabled', false);

//        kết nối ajax
        $.ajax({
            url: 'assets/php/loan-slip.php',
            method: 'POST',
            data: {idPM: idPM, idS: idS, idND: idND, borrowdate: borrowdate, returndate: returndate, action: 'update'},
            success: function (response) {
                alert(response);
                $('#loan-slip_form')[0].reset();

            }
        });
    });

    // Bắt sự kiện click vào ô trong phần nhập dữ liệu
    $('#loan-slip_table').on('click', '.edit', function () {
        // Lấy giá trị của ô
        var vt = $(this).parent().attr("data-vt");
        // Hiển thị giá trị của ô trên phần nhập dữ liệu
        $('#loan-slip_id').val(arr[vt].MaPM);
        $('#book_id').val(arr[vt].MaS);
        $('#user_id').val(arr[vt].MaND);
        $('#borrow_date').val(arr[vt].NgayMuon);
        $('#return_date').val(arr[vt].NgayTra);
        $('#loan-slip_id').prop('disabled', true);

    });

//    get data
    function getData() {
        $.ajax({
            url: 'assets/php/loan-slip.php',
            method: 'POST',
            data: {action: 'get'},
            success: function (response) {
                let data = JSON.parse(response);
                arr = data;
                let s = '';

                for (var i in data) {
                    let d = data[i];
                    s = s + ' <tr>' +
                            '<td>' + d.MaPM + '</td>' +
                            ' <td>' + d.MaS + '</td>' +
                            ' <td>' + d.MaND + '</td>' +
                            '<td>' + d.NgayMuon + '</td>' +
                            ' <td>' + d.NgayTra + '</td>' +
                            ' <td data-vt=' + i + ' idPM="' + d.MaPM + '" idS="' + d.MaS + '" idND="' + d.MaND + '" borrowdate="' + d.NgayMuon + '" returndate="' + d.NgayTra + '"><button class="button edit">Sửa</button><button class="button delete " >Xóa</button> </td>' +
                            '</tr>';
                }
                document.getElementById("loan-slip_table").getElementsByTagName("tbody")[0].innerHTML = s;

//                }
            }
        });
    }

    //    get data ma nguoi dung
    function getDataMaND() {
        $.ajax({
            url: 'assets/php/loan-slip.php',
            method: 'POST',
            data: {action: 'getmanguoidung'},
            success: function (response) {
                var data = JSON.parse(response);
                var ht = '<option value="NULL">Chọn Ma nguoi dung </option>';
                for (var i in data) {
                    var d = data[i];
                    ht = ht + '<option value="' + d.MaND + '">' + d.MaND + '</option>';
                }
                $("#user_id").html(ht);
            }
        });
    }

    function getDataMaS() {
        $.ajax({
            url: 'assets/php/loan-slip.php',
            method: 'POST',
            data: {action: 'getmasach'},
            success: function (response) {
                var data = JSON.parse(response);
                var ht = '<option value="NULL">Chọn Ma sach </option>';
                for (var i in data) {
                    var d = data[i];
                    ht = ht + '<option value="' + d.MaS + '">' + d.MaS + '</option>';
                }
                $("#book_id").html(ht);
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

