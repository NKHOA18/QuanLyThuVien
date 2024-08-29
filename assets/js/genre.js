$(document).ready(function () {
    $('.genre').on('click', function () {
        // Lấy giá trị của ô
        var id = $(this).attr("value");
        console.log(id);
        $('#tenlstrangchu').val(id);
        // Hiển thị giá trị cua sach
        getlstrangchu();

        function getlstrangchu() {
            $.ajax({
                url: 'showtrangchu.php',
                type: 'post',
                data: {selectedValue: id},
                success: function (response) {
                    $('#showtrangchu').html(response);
                    //var data = JSON.parse(response);
                }
            });
        }

    });

});