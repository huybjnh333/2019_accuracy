function SEARCH_product() {
    if ($(".dv-timkiem-active").length == 0) $(".dv-timkiem").addClass("dv-timkiem-active");
    else $(".dv-timkiem").removeClass("dv-timkiem-active");
    event.stopPropagation();
}

function TIMKIEM_tinrao(url) {
    var key_timkiem = $(".key_timkiem").val().trim().replace(/ /g, "+");
    var key_linhvuc = $(".key_linhvuc").val();
    var key_sanpham = $(".key_sanpham").val();
    var key_khuvuc = $(".key_khuvuc").val();
    window.location.href = url + "/?key=" + key_timkiem + "&lv=" + key_linhvuc + "&sp=" + key_sanpham + "&kv=" + key_khuvuc;
}

function SEARCH_timkiem(url, cls) {
    if ($(cls).val() == '')
        $(cls).focus();
    else
        window.location.href = url + $(cls).val().trim().replace(/ /g, "+");
}

$('.input_search_enter').keypress(function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        var cls = $(this).attr('data');
        var href = $(this).attr('data-href');
        SEARCH_timkiem(href, cls);
    }
});
var is_key_check = '';

function NOPHOSO_ungtuyen(id, tieude, noidung, key) {
    $(".dv-popup-cont-child .nd textarea.nd_guimail").hide();
    if (key == 'gtbb') {
        $(".noidung_popup").height(80);
        $(".nd_guimail").height(100);
        $(".dv-popup-cont-child .nd textarea.nd_guimail").show();
    } else {
        $(".noidung_popup").height(210);
    }
    $(".dv-popup-cont-child h3 span").html(tieude);
    if (is_key_check != key) {
        $(".dv-popup-cont-child .nd textarea").val('');
        is_key_check == key
    }

    $(".dv-popup-cont-child .nd textarea.noidung_popup").attr('placeholder', noidung);
    $(".key_send").val(key);
    $(".id_send").val(id);
    $(".dv-popup-cont").show();
    $(".dv-popup-cont-child").show();
}

function DONG_popup() {
    $(".dv-popup-cont").hide();
    $(".dv-popup-cont-child").hide();
}

function GUI_noidung_popup() {
    $(".load_popup").show();
    if ($(".noidung_popup").val() == '') {
        $(".noidung_popup").focus();
        $(".load_popup").hide();
    } else {
        $.ajax({
            type: "POST",
            url: "",
            data: {
                "id_send": $(".id_send").val(),
                "key_send": $(".key_send").val(),
                "nd_guimail": $(".nd_guimail").val(),
                "noidung_popup": $(".noidung_popup").val(),
                "cap_popup": $('#cap_popup').val(),
                "action_ajax": "send_popup"
            },
            success: function (data) {
                alert(data);
                $(".load_popup").hide();
                DONG_popup();
            }
        });
    }
}

function DANGKY_email(url) {
    var v_email = $("#ip_sentmail").val();
    var v_name = $("#ip_sentmail_name").val();
    $.ajax({
        type: "POST",
        url: url + "/dang-ky-mail/",
        data: {
            "v_email": v_email,
            "v_name": v_name,
            "capcha_hd": $('#capcha_hd').val(),
            "action_ajax": "dang-ky-email"
        },
        success: function (data) {
            try {
                data = JSON.parse(data);
                $("#capcha_hd").val(data.new_cap);
                alert(data.message);
            } catch (e) {
                alert("ERR!");
            }
            $("#ip_sentmail").focus()
        }
    });
}

var check_guisodt = 0;

function GUI_sodienthoai(url) {
    var v_phone = $("#s_dienthoai").val();
    var v_name = $("#ip_sentmail_name").val();
    $(".ajax_img_loading").show();
    if (!CHECK_phone("#s_dienthoai")) {
        $("#s_dienthoai").focus();
        alert($("#s_dienthoai").attr('err'));
        $(".ajax_img_loading").hide();
    } else {
        if (check_guisodt == 0) {
            check_guisodt = 1;
            $.ajax({
                type: "POST",
                url: url + "/dang-ky-phone/",
                data: {
                    "v_phone": v_phone,
                    "v_name": v_name,
                    "capcha_hd": $('#capcha_hdphone').val(),
                    "action_ajax": "dang-ky-phone"
                },
                success: function (data) {
                    $(".ajax_img_loading").hide();
                    try {
                        data = JSON.parse(data);
                        $("#capcha_hdphone").val(data.new_cap);
                        alert(data.message);
                    } catch (e) {
                        console.log(data);
                    }
                    check_guisodt = 0;
                    $("#s_dienthoai").focus()
                }
            });
        }
    }

}

function addCart(urlpath, alert_dat_hang, idsp, qty = '1') {
    if (idsp == '' || idsp <= 0 || isNaN(idsp) || qty == '' || qty <= 0 || isNaN(qty)) {
        alert(alert_dat_hang);
    }
    else {
        $.ajax({
            type: "POST",
            url: urlpath + "/add-cart/",
            data: {"idsp": idsp, "qty": qty},
            success: function (data) {
                window.location.href = urlpath + "/gio-hang/";
            }
        });
    }
}

function GOTO_sport(cls) {
    var target = $(cls);
    if (target.length) {
        $('html, body').animate({
            scrollTop: target.offset().top
        }, 700);
    }
}

var is_busy = false;
var page = 1;
var stopped = false;

function LOAD_ajax_product(url, id, step, key, total, numview, id_run = 0) {
    if (is_busy == true) {
        return false;
    }
    if (stopped == true) {
        return false;
    }
    is_busy = true;
    page++;
    $(".ajax_img_loading").show();
    $.ajax(
        {
            type: 'post',
            dataType: 'text',
            url: url,
            data: {
                "page": page,
                "id": id,
                "step": step,
                "key": key,
                "numview": numview,
                "total": total,
                "id_run": id_run
            },
            success: function (result) {
                $(".dv-danhsachpto").append(result);
            }
        })
        .always(function () {
            $(".ajax_img_loading").hide();

            setTimeout(function () {
                GOTO_sport(".ajax_scron_" + page);
            }, 700);
            is_busy = false;
        });
    return false;
}

function RefreshFormMailContact(FormNameContact) {
    FormNameContact.reset();
    $("#s_fullname").focus();
}

var icheck_lienhe = 0;

function CHECK_send_lienhe(url, id_form) {
    if (icheck_lienhe == 0) {
        $(".ajax_img_loading").show();
        if ($("#s_fullname").val().trim() == '' || $("#s_fullname").val().trim() == $("#s_fullname").attr('data-name')) {
            alert($("#s_fullname").attr('data-msso'));
            $("#s_fullname").focus();
            $(".ajax_img_loading").hide();
            return false;
        }
        if ($("#s_dienthoai").val().trim() == '' || $("#s_dienthoai").val().trim() == $("#s_dienthoai").attr('data-name')) {
            alert($("#s_dienthoai").attr('data-msso'));
            $("#s_dienthoai").focus();
            $(".ajax_img_loading").hide();
            return false;
        }
        if (!CHECK_phone("#s_dienthoai")) {
            alert($("#s_dienthoai").attr('data-msso1'));
            $("#s_dienthoai").focus();
            $(".ajax_img_loading").hide();
            return false;
        }
        var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test($("#s_email").val().trim())) {
            alert($("#s_email").attr('data-msso'));
            $("#s_email").focus();
            $(".ajax_img_loading").hide();
            return false;
        }

        if ($("#s_title").val().trim() == '' || $("#s_title").val().trim() == $("#s_title").attr('data-name')) {
            alert($("#s_title").attr('data-msso'));
            $("#s_title").focus();
            $(".ajax_img_loading").hide();
            return false;
        }
        if ($("#mabaove").val().trim() == '') {
            alert($("#mabaove").attr('data-msso'));
            $("#mabaove").focus();
            $(".ajax_img_loading").hide();
            return false;
        }
        icheck_lienhe == 1;
        $.ajax({
            type: "POST",
            url: url,
            data: $(id_form).serialize(),
            success: function (data) {
                console.log(data);
                $(".ajax_img_loading").hide();
                if (data == 1) {
                    alert($(".lang_ok").val());
                    window.location.reload();
                    // console.log(data);
                }
                else {
                    alert($(".lang_false").val());
                    console.log(data);
                }
            }
        });
    }
    return false;
}

function updateQty(url, id, obj) {
    var qty = $(obj).val();
    if (qty == '' || qty <= 0 || isNaN(qty) || !Number.isSafeInteger(parseFloat(qty))) {
        alert($(".cls_datafalse").val());
        window.location.reload();
    }
    else {
        $.ajax({
            type: "POST",
            url: url,
            data: {'id': id, "qty": qty, "post": "update-qty"},
            success: function (data) {
                if (data != '') {
                    if (data == "reload") {
                        window.location.reload();
                    }
                    else {
                        try {
                            var js_de = JSON.parse(data);
                            $(".td_thanhtien_" + id).html(js_de.thanhtien);
                            $(".tb_tongtien").html(js_de.tongtien);
                        } catch (e) {
                            console.log(data);
                        }

                    }
                }
            }
        });
    }
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

$("body").click(function () {
    $(".dv-timkiem").removeClass("dv-timkiem-active");
});
$(".body-nohide").click(function (event) {
    event.stopPropagation();
});

function PLAY_video(id) {
    $(".video_view_top iframe").attr("src", "https://www.youtube.com/embed/" + id + "?rel=0&autoplay=1");
    setTimeout(function () {
        GOTO_sport(".id_hide_video");
    }, 200);
};
$(".menu-active a").each(function () {
    var href = $(this).attr("href");
    href = href.replace(fullpath, "");
    href = href.replace(/\//g, "");
    href = href.toLowerCase();
    var url = window.location.href;
    url = url.replace(fullpath, "");
    url = url.replace(/\//g, "");
    url = url.toLowerCase();
    if (href == url) {
        $(this).parents('.menu-active > li').eq(0).addClass("active");
        return;
    }
});

function CHECK_room(id, url) {
    var from = $(".ngayden" + id).val();
    var to = $(".ngaydi" + id).val();
    var adu = $(".nguoilon" + id).val();
    var chil = $(".tremem" + id).val();
    var pro = $(".makhuyemai" + id).val();
    var room = '';
    if (id == 1) {
        room = $(".loaiphong" + id).val();
    }
    window.location.href = url + "/check-room/?from=" + from + "&to=" + to + "&adu=" + adu + "&chil=" + chil + "&pro=" + pro + "&room=" + room;
}

