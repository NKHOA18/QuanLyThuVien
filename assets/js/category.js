//var arr = [];
$(document).ready(function () {

    getData();

//   thêm dữ liệu
    $('#category-form').on('click', '.add-btn', function (event) {
        event.preventDefault();
        var id = $('#category-id').val();
        var name = $('#category-name').val();
        var content = $('#category-content').val();

//        kết nối ajax
        $.ajax({
            url: 'assets/php/category.php',
            method: 'POST',
            data: {id: id, name: name, content: content, action: 'add'},
            success: function (response) {
                alert(response);
                //lam moi form
                getData();
                $('#category-form')[0].reset();


            }
        });
    });

//    xóa dữ liệu
    $('#category-table').on('click', '.delete', function () {
        var id = $(this).parent().attr("data-MaLS");
        $('#category-id').prop('disabled', false);

//kết nối ajax
        if (confirm("Bạn có chắc muốn xóa dữ liệu này?")) {
            $.ajax({
                url: 'assets/php/category.php',
                method: 'POST',
                data: {id: id, action: 'delete'},
                success: function (response) {
                    alert(response);
                    $('#category-table tbody tr:last-child').remove();
                    $('#category-form')[0].reset();

                }
            });
        }
        return false;
    });

//    Sửa dữ liệu 
    $('#category-form').on('click', '.update-btn', function (event) {
        event.preventDefault();
        var id = $('#category-id').val();
        var name = $('#category-name').val();
        var content = $('#category-content').val();
        $('#category-id').prop('disabled', false);

//        kết nối ajax
        $.ajax({
            url: 'assets/php/category.php',
            method: 'POST',
            data: {id: id, name: name, content: content, action: 'update'},
            success: function (response) {
                alert(response);
                $('#category-form')[0].reset();
                getData();

            }
        });
    });

    // Bắt sự kiện click vào ô trong phần nhập dữ liệu
    $('#category-table').on('click', '.edit', function () {
        // Lấy giá trị của ô
        var id = $(this).parent().attr("data-MaLS");
        var name = $(this).parent().attr("data-TenLS");
        var content = $(this).parent().attr("data-Mota");

        // Hiển thị giá trị của ô trên phần nhập dữ liệu
        $('#category-id').val(id);
        $('#category-name').val(name);
        $('#category-content').val(content);
        $('#category-id').prop('disabled', true);
    });

//    get data
    function getData() {
        $.ajax({
            url: 'assets/php/category.php',
            method: 'POST',
            data: {action: 'get'},
            success: function (response) {
                let data = JSON.parse(response);
//                arr = data;
                let s = '';
                if (data.length == 0) {
                    s = '<tr><td> Không có dữ liệu </td></tr>';
                    $("#category-table tbody").html(''); // Loại bỏ toàn bộ nội dung bảng
                } else {
                    for (var i in data) {
                        let d = data[i];
                        s = s + ' <tr >' +
                                '<td>' + d.MaLS + '</td>' +
                                '<td>' + d.TenLS + '</td>' +
                                '<td>' + d.Mota + '</td>' +
                                '<td data-MaLS="' + d.MaLS + '" data-TenLS="' + d.TenLS + '" data-Mota="' + d.Mota + '"><button class="button edit">Sửa</button><button class="button delete">Xóa</button></td>' +
                                '</tr>';

                    }
                    $("#category-table tbody").html(s); // Hiển thị dữ liệu mới
                }
            }
        });
    }

    setInterval(function () {
        getData();
    }, 3000);//reload sau 3s 
});

