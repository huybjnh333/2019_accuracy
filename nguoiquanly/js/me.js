function On_focus(id1, id2) {
    $("#" + id2).hide();
    $("#" + id1).show();
    $('#' + id1).focus();
}

function On_out(id1, id2) {
    if ($("#" + id1).val().length < 1) {
        $("#" + id1).hide();
        $("#" + id2).show();
    }
}

function center_modal(modal_id) {

    var that = $('#' + modal_id);
    var modalheight = that.outerHeight();

    var top, left, topx, leftx;

    top = Math.max($("#overlay").height() - that.outerHeight(), 0) / 2;
    left = Math.max($("#overlay").width() - that.outerWidth(), 0) / 2;
    topx = top + $("#overlay").scrollTop();
    leftx = left + $("#overlay").scrollLeft();

    that.css({
        'top': topx,
        'left': leftx,
        "position": "absolute",
        "z-index": 9999
    });
}

function close_modal() {
    $('html').removeClass("ov");
    $('#overlay').hide();
    $('.modal_window').hide();
    //history.pushState(null, null, url);
}

function show_modal(modal_id, modal_true) {
    var window_width = $(window).width();
    var window_height = $(document).height();
    var that = $('#' + modal_id);

    $("#overlay").css({
        'display': 'block'
    });
    if (modal_true) {
        $("#overlay_in").removeAttr('onclick');
        $("#overlay_in").css({
            'height': 0,
            'cursor': 'auto'
        });
    } else {
        $("#overlay_in").attr('onclick', 'close_modal();');
        $("#overlay_in").css({
            'height': that.height(),
            'cursor': 'pointer'
        });
    }
    $('html').addClass("ov");
    center_modal(modal_id);
    that.show();
}

function Change_Tabs(name, tongso, id) {
    var i;
    for (i = 1; i <= tongso; i++) {
        if (i == id) {
            $("#" + name + id).addClass('active');
            $("#content_" + name + id).show();
        } else {
            $("#" + name + i).removeClass('active');
            $("#content_" + name + i).hide();
        }
    }
}

function ajaxloader(name, url) {
    $("#" + name).html("<img src='<?=$fullpath?>/images/loading/loading7.gif' alt='loading 1ty.vn'/>");
    $("#" + name).load(url);
}

function ShowLostPass() {
    $("#lostpass").show();
}

function MM_jumpMenu(targ, selObj, restore) { //v3.0
    eval(targ + ".location='" + selObj.options[selObj.selectedIndex].value + "'");
    if (restore) selObj.selectedIndex = 0;
}

function MM_swapImgRestore() { //v3.0
    var i, x, a = document.MM_sr;
    for (i = 0; a && i < a.length && (x = a[i]) && x.oSrc; i++) x.src = x.oSrc;
}

function MM_preloadImages() { //v3.0
    var d = document;
    if (d.images) {
        if (!d.MM_p) d.MM_p = new Array();
        var i, j = d.MM_p.length,
            a = MM_preloadImages.arguments;
        for (i = 0; i < a.length; i++)
            if (a[i].indexOf("#") != 0) {
                d.MM_p[j] = new Image;
                d.MM_p[j++].src = a[i];
            }
    }
}

function MM_findObj(n, d) { //v4.01
    var p, i, x;
    if (!d) d = document;
    if ((p = n.indexOf("?")) > 0 && parent.frames.length) {
        d = parent.frames[n.substring(p + 1)].document;
        n = n.substring(0, p);
    }
    if (!(x = d[n]) && d.all) x = d.all[n];
    for (i = 0; !x && i < d.forms.length; i++) x = d.forms[i][n];
    for (i = 0; !x && d.layers && i < d.layers.length; i++) x = MM_findObj(n, d.layers[i].document);
    if (!x && d.getElementById) x = d.getElementById(n);
    return x;
}

function MM_swapImage() { //v3.0
    var i, j = 0,
        x, a = MM_swapImage.arguments;
    document.MM_sr = new Array;
    for (i = 0; i < (a.length - 2); i += 3)
        if ((x = MM_findObj(a[i])) != null) {
            document.MM_sr[j++] = x;
            if (!x.oSrc) x.oSrc = x.src;
            x.src = a[i + 2];
        }
}

function checkadminlogin() {
    var mk = $("#adminmatkhau").val();
    if ($("#admintentruycap").val() == '') {
        alert("Hãy nhập vào tên truy cập của bạn!");
        admintentruycap.focus();
        return false;
    }
    if ($("#adminmatkhau").val() == '') {
        alert("Hãy nhập vào mật khẩu của bạn!");
        adminmatkhau.focus();
        return false;
    }
    document.getElementById('adminmatkhau').value = MD5('1ty.vn' + document.getElementById('adminmatkhau').value);
    return true;
}

function CheckRegForm() {
    with(document.TheForm) {
        if (tentruycap.value == "") {
            alert("Hãy nhập vào tên truy cập của bạn!");
            tentruycap.focus();
            return false;
        }
        if (matkhau.value == "") {
            alert("Mật khẩu truy cập của bạn là gì?");
            matkhau.focus();
            return false;
        }
        matkhau.value = MD5('1ty.vn' + matkhau.value);
    }
    return true;
}
$(window).on('load', function() {
    $("img").each(function() {
        if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
            this.src = 'images/noimage.png';
        }
    });
});

function SetCurrency(obj) {
    var myvalue = $(obj).val();
    if (myvalue == '') {
        $(obj).val(0);
        return;
    }
    myvalue = myvalue.replace(/\./g, '');
    myvalue = parseInt(myvalue);
    myvalue = addCommas(myvalue);
    $(obj).val(myvalue);
}

function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}

function MM_jumpMenu(targ, selObj, restore) {
    eval(targ + ".location='" + selObj.options[selObj.selectedIndex].value + "'");
    if (restore) selObj.selectedIndex = 0;
}

$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
});

function convertVietnamese2(str) {
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "-");
    str = str.replace(/-+-/g, "-");
    str = str.replace(/^\-+|\-+$/g, "");
    return str;
}

function convertVN(obj) {
    var str = convertVietnamese2($("#tenbaiviet_vi").val());
    $("#seo_name").val(str);
}

function MM_jumpMenu(targ, selObj, restore) {
    eval(targ + ".location='" + selObj.options[selObj.selectedIndex].value + "'");
    if (restore) selObj.selectedIndex = 0;
}

function CHECK_TIMKIEM(url) {
    if ($(".ksearch").length > 0) {
        url += "&ksearch=" + $(".ksearch").val();
    }
    if ($(".js_trangthai_js").length > 0) {
        url += "&sta=" + $(".js_trangthai_js").val();
    }
    window.location.href = url;
}

function CHECK_phone(cls) {
    var flag = false;
    var phone = $(cls).val().trim();
    phone = phone.replace('(+84)', '0');
    phone = phone.replace('+84', '0');
    phone = phone.replace('0084', '0');
    phone = phone.replace(/ /g, '');
    if (phone != '') {
        var firstNumber = phone.substring(0, 2);
        if ((firstNumber == '09' || firstNumber == '08') && phone.length == 10) {
            if (phone.match(/^\d{10}/)) {
                flag = true;
            }
        } else if (firstNumber == '01' && phone.length == 11) {
            if (phone.match(/^\d{11}/)) {
                flag = true;
            }
        }
    }
    return flag;
}

function CHECK_email(email) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    }
    return true;
}
var send_mkad = 0;

function LAYMK_admin() {
    if ($("#qmk_email").val().trim() == '') {
        $("#qmk_email").focus();
        alert("Nhập địa chỉ email!");
    } else if (!CHECK_email($("#qmk_email").val().trim())) {
        $("#qmk_email").focus();
        alert("Địa chỉ email không hợp lệ!");
    } else if ($("#qmk_mabaove").val().trim() == '') {
        $("#qmk_mabaove").focus();
        alert("Nhập mã bảo vệ!");
    } else if (send_mkad == 0) {
        $(".img_loadding_ad").show();
        send_mkad = 1;
        $.ajax({
            type: "POST",
            url: "index.php",
            data: {
                'email': $("#qmk_email").val().trim(),
                "mabaove": $("#qmk_mabaove").val().trim(),
                "ajax_action": "quenmatkhau"
            },
            success: function(data) {
                send_mkad = 0;
                $(".img_loadding_ad").hide();
                if (data == 1) alert("Mã bảo vệ không đúng!");
                else if (data == 2) alert("Email không tồn tại trong hệ thống!");
                else {
                    alert("Thông tin lấy mật khẩu đã được gửi , vui lòng kiểm tra email để lấy mật khẩu mới!");
                    window.location.href = "index.php?module=login";
                }
            }
        });
    }
}

function RETURN_checkpass() {
    if ($("#chang_matkhau").val().trim().length < 6) {
        alert("Mật khẩu phải dài hơn 6 kí tự!");
        $("#chang_matkhau").focus();
        return false;
    }
    if ($("#chang_matkhau_rt").val() != $("#chang_matkhau").val()) {
        alert("Mật khẩu nhập lại chưa đúng!");
        $("#chang_matkhau_rt").focus();
        return false;
    }
    return true;
}

function CHECK_name_emty() {
    var i = 0;
    $(".cls_emty_name").each(function() {
        if ($(this).val().trim() == '') {
            alert("Tiêu đề không được để trống!");
            $(this).focus();
            i++;
            return false;
        };
    });
    var num_del = 0;
    $(".cls_showxoa").each(function(){
        if($(this).is(":checked")){
            num_del++;
        }
    });
    if (i) return false;
    if(num_del){
        var cf =  confirm("Bạn đang chọn xóa "+num_del+" mục. Bạn có chắc xóa?");
        if(!cf){
            return false;
        }
    }
    return true;
}

function XEM_video(id_video) {
    $(".dv-popup-video iframe").attr("src", "https://www.youtube.com/embed/" + id_video + "?rel=0&autoplay=1");
    $(".dv-popup-video").show();
}

function CLOSE_dvvideo() {
    $(".dv-popup-video").hide();
    $(".dv-popup-video iframe").attr("src", "");
}

function CHECK_sb() {
    var icheck = 0;
    $(".cls_ms").each(function() {
        if ($(this).val().trim() == '' && icheck == 0) {
            alert($(this).attr("message"));
            $(this).focus();
            icheck++;
        }
    });
    if (icheck) return false;
    else true;
}
$('.cls_showxoa_all').on('ifChecked', function(event) {
    $('.cls_showxoa').iCheck('check');
});
$('.cls_showxoa_all').on('ifUnchecked', function(event) {
    $('.cls_showxoa').iCheck('uncheck');
});

$('.auto_menu_lienket').on('ifChecked', function(event) {
    $('.nhom_lienket').show();
    $('.nhom_module_menu').hide();
});
$('.auto_menu_module').on('ifChecked', function(event) {
    $('.nhom_module_menu').show();
    $('.nhom_lienket').hide();
});
$(function(){
    if($(".auto_menu_lienket").is(":checked")){
        $('.nhom_lienket').show();
        $('.nhom_module_menu').hide();
    }
    else if($(".auto_menu_module").is(":checked")){
        $('.nhom_module_menu').show();
        $('.nhom_lienket').hide();
    }
});


$(function(){
    $('[data-tooltip]').each(function () {
        $(this).popover({
            placement: 'top',
            trigger: 'hover',
            html: true,
            content: '<div class="media-body tool-tip"><p>'+$(this).data('tooltip')+'</p></div>'
        });
    });
});

$('.auto_get_link').on('ifChecked', function(event) {
    var str = convertVietnamese2($("#tenbaiviet_vi").val());
    $("#seo_name").val(str);
});
$("#tenbaiviet_vi").keyup(function(){
    if($(".auto_get_link").is(":checked")){
        var str = convertVietnamese2($("#tenbaiviet_vi").val());
        $("#seo_name").val(str);
    }
});

function CHECK_delimg() {
    var num_del = 0;
    $(".cls_showxoa").each(function(){
        if($(this).is(":checked")){
            num_del++;
        }
    });
    if(num_del){
        var cf =  confirm("Bạn đang chọn xóa "+num_del+" mục. Bạn có chắc xóa?");
        if(!cf){
            return false;
        }
    }
    return true;
}
function LOAD_danhmuc_mn(obj){
    $.ajax({
        type: "POST",
        url: "index.php",
        data: {
            'id': $(obj).val().trim(),
            "ajax_action": "LOAD_danhmuc_mn"
        },
        success: function(data) {
            $(".form-control-dm-menu").html(data);
            console.log(data);
        }
    });
}