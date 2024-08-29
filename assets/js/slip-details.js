var arr = [];
$(document).ready(function () {

    getData();
    getDataMaPM();
    showSL();
    
//   thêm dữ liệu
    $('#slip-details_form').on('click', '.add-btn', function (event) {
         event.preventDefault();
        var idPM = $('#slip-details_id').val();
        var sl = $('#slip-details_quantity').val();
        var address = $('#borrow_address').val();
        var status = $('#slip-details_status').val();

//        kết nối ajax
        $.ajax({
            url: 'assets/php/slip-details.php',
            method: 'POST',
            data: {idPM: idPM, sl: sl, address: address, status: status, action: 'add'},
            success: function (response) {
                alert(response);
                $('#slip-details_form')[0].reset();

            }
        });
    });

//    xóa dữ liệu
    $('#slip-details_table').on('click', '.delete', function () {
        var vt = $(this).parent().attr("data-vt");
        var idPM = arr[vt].MaPM;


//kết nối ajax
        if (confirm("Bạn có chắc muốn xóa dữ liệu này?")) {
            $.ajax({
                url: 'assets/php/slip-details.php',
                method: 'POST',
                data: {idPM: idPM, action: 'delete'},
                success: function (response) {
                    alert(response);
                    $('#slip-details_table tbody tr:last-child').remove();

                }
            });
        }
        return false;
    });

//    Sửa dữ liệu 
    $('#slip-details_form').on('click', '.update-btn', function (event) {
        event.preventDefault();
        var idPM = $('#slip-details_id').val();
        var sl = $('#slip-details_quantity').val();
        var address = $('#borrow_address').val();
        var status = $('#slip-details_status').val();
        $('#slip-details_id').prop('disabled', false);

//        kết nối ajax
        $.ajax({
            url: 'assets/php/slip-details.php',
            method: 'POST',
            data: {idPM: idPM, sl: sl, address: address, status: status, action: 'update'},
            success: function (response) {
                alert(response);
                $('#slip-details_form')[0].reset();

            }
        });
    });

    // Bắt sự kiện click vào ô trong phần nhập dữ liệu
    $('#slip-details_table').on('click', '.edit', function () {
        // Lấy giá trị của ô
        var idPM = $(this).parent().attr("idPM");
        var sl = $(this).parent().attr("sl");
        var address = $(this).parent().attr("address");
        var status = $(this).parent().attr("status");
        // Hiển thị giá trị của ô trên phần nhập dữ liệu
        $('#slip-details_id').val(idPM);
        $('#slip-details_quantity').val(sl);
        $('#borrow_address').val(address);
        $('#slip-details_status').val(status);
        $('#slip-details_id').prop('disabled', true);

    });

//    get data
    function getData() {
        $.ajax({
            url: 'assets/php/slip-details.php',
            method: 'POST',
            data: {action: 'get'},
            success: function (response) {
                let data = JSON.parse(response);
                arr = data;
                let s = '';
//                if (data.length == 0) {
////                    s = '<tr><td> Không có dữ liệu </td></tr>';
//                    $("#people-table tbody").html(''); // Loại bỏ toàn bộ nội dung bảng
//                } else {
                for (var i in data) {
                    let d = data[i];
                    s = s + ' <tr>' +
                            '<td>' + d.MaPM + '</td>' +
                            ' <td>' + d.MaS + '</td>' +
                            ' <td>' + d.MaND + '</td>' +
                            ' <td>' + d.NgayMuon + '</td>' +
                            ' <td>' + d.SoLuong + '</td>' +
                            ' <td>' + d.DiaChiMuon + '</td>' +
                            ' <td>' + d.TrangThai + '</td>' +
                            ' <td data-vt=' + i + ' idPM="' + d.MaPM + '" sl="' + d.SoLuong + '" address="' + d.DiaChiMuon + '" status="' + d.TrangThai + '" ><button class="button edit">Sửa</button><button class="button delete " >Xóa</button> </td>' +
                            '</tr>';
                }
                document.getElementById("slip-details_table").getElementsByTagName("tbody")[0].innerHTML = s;
                console.log(s);

//                }
            }
        });
    }

    //    get data email
    function getDataMaPM() {
        $.ajax({
            url: 'assets/php/slip-details.php',
            method: 'POST',
            data: {action: 'getmaphieumuon'},
            success: function (response) {
                var data = JSON.parse(response);
                var ht = '<option value="NULL">Chọn Ma phieu muon </option>';
                for (var i in data) {
                    var d = data[i];
                    ht = ht + '<option value="' + d.MaPM + '">' + d.MaPM + '</option>';
                }
                $("#slip-details_id").html(ht);
            }
        });
    }
    function showSL(){
        var html='<option value="NULL">Chọn So luong</option>';
        for(var i=1;i<=100;i++){
            html=html+'<option value="'+i+'">'+i+'</option>';
        }
        $("#slip-details_quantity").html(html);
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

