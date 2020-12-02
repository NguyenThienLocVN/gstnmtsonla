var url = window.location.href;
// for treeview which is like a submenu
$('ul.treeview-menu a').filter(function() {
    return this.href === url;
}).parentsUntil(".sidebar-menu > .treeview-menu").siblings().removeClass('active').end().addClass('active');

$('#browse_file').on('click',function () {
    $('#upload_img').click();
});

$('#upload_img').on('change', function () {
    var fileInput = this;
    console.log(fileInput.files[0]);
    if (fileInput.files[0]){
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#img').attr('src', e.target.result);
        };
        reader.readAsDataURL(fileInput.files[0]);
    }
});

//Tạo slug tự động
$('input#name').keyup(function() {
    /* Act on the event */
    var title, slug;

    //Lấy text từ thẻ input title
    title = $(this).val();

    //Đổi chữ hoa thành chữ thường
    slug = title.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    $('input#slug').val(slug);

});

//Viết hoa chữ đầu dòng
$.fn.capitalize = function () {
    $.each(this, function () {
        var split = this.value.split(' ');
        for (var i = 0, len = split.length; i < len; i++) {
            split[i] = split[i].charAt(0).toUpperCase() + split[i].slice(1).toLowerCase();
        }
        this.value = split.join(' ');
    });
    return this;
};

$('input#fullname').on('keyup', function () {
    $(this).capitalize();
}).capitalize();

function selectIdCat(_el, id) {
    var id_type = $(_el).val();
    $.ajax({
        url: './select_id_cat',
        type: 'GET',
        data: {
            id: id,
            id_type: id_type,
        }
    }).done(function (data) {

    });

    return false;
};

function selectAdvertiser (_el, adp_partner_id) {
    var adp_advertiser_user_id   = $(_el).val();
    adp_partner_id          = parseInt(adp_partner_id);
    $.ajax({
        url     : '/advertiser/change-advertiser-for-partner',
        type    : 'POST',
        data    : {
            adp_advertiser_user_id   : adp_advertiser_user_id,
            adp_partner_id      :   adp_partner_id
        },
        success : function (data) {
        }
    });
}

$(document).ready(function () {
    $("#changePassword").change(function () {
        if ($(this).is(":checked")) {
            $(".password").removeAttr('disabled');
            $(".password").css({'cursor': 'auto', 'opacity': '1'});
        }
        else {
            $(".password").attr('disabled', '');
            $(".password").css({'cursor': 'no-drop', 'opacity': '0.5'});
        }
    });
});