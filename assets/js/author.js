var arr = [];
$(document).ready(function () {


    getData();


//   thêm dữ liệu
    $('#author-form').on('click', '.add-btn', function (event) {
        event.preventDefault();
        var id = $('#author-id').val();
        var name = $('#author-name').val();

//        kết nối ajax
        $.ajax({
            url: 'assets/php/author.php',
            method: 'POST',
            data: {id: id, name: name, action: 'add'},
            success: function (response) {
                alert(response);
                //lam moi form
                getData();
                $('#author-form')[0].reset();


            }
        });
    });

//    xóa dữ liệu
    $('#author-table').on('click', '.delete', function () {
        var id = $(this).parent().attr("data-MaTG");
//kết nối ajax
        if (confirm("Bạn có chắc muốn xóa dữ liệu này?")) {
            $.ajax({
                url: 'assets/php/author.php',
                method: 'POST',
                data: {id: id, action: 'delete'},
                success: function (response) {
                    alert(response);
//                    $('#author-form')[0].reset();
                    $('#author-table tbody tr:last-child').remove();
                }
            });
        }
        return false;
    });

//    Sửa dữ liệu 
    $('#author-form').on('click', '.update-btn', function (event) {
        event.preventDefault();
        var id = $('#author-id').val();
        var name = $('#author-name').val();
        $('#author-id').prop('disabled', false);

//        kết nối ajax
        $.ajax({
            url: 'assets/php/author.php',
            method: 'POST',
            data: {id: id, name: name, action: 'update'},
            success: function (response) {
                alert(response);
//                $('#author-form')[0].reset();
//                    getData();

            }
        });
    });

    // Bắt sự kiện click vào ô trong phần nhập dữ liệu
    $('#author-table').on('click', '.edit', function () {
        // Lấy giá trị của ô
        var id = $(this).parent().attr("data-MaTG");
        var name = $(this).parent().attr("data-TenTG");
        // Hiển thị giá trị của ô trên phần nhập dữ liệu
        $('#author-id').val(id);
        $('#author-name').val(name);
        $('#author-id').prop('disabled', true);
    });

//    get data
    function getData() {
        $.ajax({
            url: 'assets/php/author.php',
            method: 'POST',
            data: {action: 'get'},
            success: function (response) {
                let data = JSON.parse(response);
                arr = data;
                let s = '';
                if (data.length == 0) {
                    $("#author-table tbody").html(''); // Loại bỏ toàn bộ nội dung bảng
                } else {
                    for (var i in data) {
                        let d = data[i];
                        s = s + ' <tr>' +
                                '<td>' + d.MaTG + '</td>' +
                                ' <td>' + d.TenTG + '</td>' +
                                ' <td  data-MaTG="' + d.MaTG + '" data-TenTG="' + d.TenTG + '" ><button class="button edit">Sửa</button><button class="button delete " >Xóa</button> </td>' +
                                '</tr>';
                    }
                    $("#author-table tbody").html(s); // Hiển thị dữ liệu mới
                }
            }
        });
    }

// Reload trang web sau khi xóa dữ liệu
//function reloadPage(){
//    location.reload(true);
//}

    setInterval(function () {
        getData();
    }, 3000);//reload sau 3s 
});