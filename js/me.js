var timeout = 4000;

function SEARCH_product() {
    if ($(".dv-timkiem-active").length == 0) $(".dv-timkiem").addClass("dv-timkiem-active"); else $(".dv-timkiem").removeClass("dv-timkiem-active");
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
    if ($(cls).val() == '') {
        $(cls).focus();
    } else {
        var strredirect = url + $(cls).val().trim().replace(/ /g, "+");
        var datadm = $("#danhmucsp").val();
        if (datadm !== "") {
            strredirect = strredirect + '/';
        }
        window.location.href = strredirect;
    }
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
    var v_phone = $("#ip_sentmail_phone").val();
    $(".ajax_img_loading").show();
    console.log();
    $(".dang_ky").hide();
    $.ajax({
        type: "POST",
        url: url + "/dang-ky-mail/",
        data: {
            "v_email": v_email,
            "v_name": v_name,
            "v_phone": v_phone,
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
            $(".ajax_img_loading").hide();
            $(".dang_ky").show();
            // console.log(data);
        }
    });
}

var check_guisodt = 0;

function GUI_sodienthoai(url) {
    var v_phone = $("#FormNameSDT #s_dienthoai").val();
    $(".ajax_img_loading").show();
    if (!CHECK_phone("#FormNameSDT #s_dienthoai")) {
        $("#FormNameSDT #s_dienthoai").focus();
        alert($("#FormNameSDT #s_dienthoai").attr('errorphone'));
        $(".ajax_img_loading").hide();
    } else {
        if (check_guisodt == 0) {
            check_guisodt = 1;
            $.ajax({
                type: "POST",
                url: url + "/dang-ky-phone/",
                data: {
                    "v_phone": v_phone,
                    "action_ajax": "dang-ky-phone"
                },
                success: function (data) {
                    $(".ajax_img_loading").hide();
                    try {
                        data = JSON.parse(data);
                        alert(data.message);

                    } catch (e) {
                        console.log(data);
                    }
                    check_guisodt = 0;
                    $("#s_dienthoai").focus();
                    $.fancybox.close();
                }
            });
        }
    }
}


function addCart(urlpath, alert_dat_hang, idsp, qty) {
    if (qty == '' || qty == null) {
        qty = 1;
    }
    if (idsp == '' || idsp <= 0 || isNaN(idsp) || qty == '' || qty <= 0 || isNaN(qty)) {
        alert(alert_dat_hang);
    } else {
        $.ajax({
            type: "POST", url: urlpath + "/add-cart/", data: {"idsp": idsp, "qty": qty}, success: function (data) {
                window.location.href = urlpath + "/gio-hang/";
            }
        });
    }
}

function GOTO_sport(cls) {
    var target = $(cls);
    if (target.length) {
        $('html, body').animate({scrollTop: target.offset().top}, 700);
    }
}

var is_busy = false;
var page = 1;
var stopped = false;

function LOAD_ajax_product(url, id, step, key, total, numview, id_run) {
    if (id_run == '') {
        id_run = 0;
    }
    if (is_busy == true) {
        return false;
    }
    if (stopped == true) {
        return false;
    }
    is_busy = true;
    page++;
    $(".ajax_img_loading").show();
    $.ajax({
        type: 'post',
        dataType: 'text',
        url: url,
        data: {"page": page, "id": id, "step": step, "key": key, "numview": numview, "total": total, "id_run": id_run},
        success: function (result) {
            $(".dv-danhsachpto").append(result);
        }
    }).always(function () {
        $(".ajax_img_loading").hide();
        setTimeout(function () {
            GOTO_sport(".ajax_scron_" + page);
        }, 700);
        is_busy = false;
    });
    return false;
}

var data = [];

function LOAD_More_data(url, step, dataold, num, option) {
    var array = [];
    array = dataold.split(",");
    array.forEach(function (element) {
        data.push(element);
    });
    $.ajax({
        type: 'post',
        dataType: 'text',
        url: url,
        data: {"step": step, 'dataold': data.toString(), 'limit': num, 'option': option},
        success: function (result) {
            $(".dv-danhsachpto").append(result);
            console.log(data);
        }
    }).always(function () {
        $(".ajax_img_loading").hide();
        setTimeout(function () {
            GOTO_sport(".ajax_scron_" + page);
        }, 700);
        is_busy = false;
    });
}

function RefreshFormMailContact(FormNameContact) {
    FormNameContact.reset();
}

var icheck_lienhe = 0;
function CHECK_send_lienhe(url, id_form, cls) {
    if (icheck_lienhe == 0) {
        icheck_lienhe = 1;
        $(".ajax_img_loading").show();
        var check = 0;
        $(id_form + " " + cls).each(function () {
            console.log(cls);
            var val = $(this).val().trim();
            var id = $(this).attr('id');
            var rong = $(this).attr('data-rong');
            var phone = $(this).attr('data-phone');
            var email = $(this).attr('data-email');
            var d_check = $(this).attr('data-check');
            var place = $(this).attr('placeholder');
            var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (rong == 1 && (val == "" || val == place)) {
                cusNotify({mess: $(this).attr('data-msso'), type: 'error', postion: 1});
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                icheck_lienhe = 0;
                return false;
            } else if (email == 1 && !regex.test(val) && val != "") {
                cusNotify({mess: $(this).attr('data-msso1'), type: 'error', postion: 1});
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                icheck_lienhe = 0;
                return false;
            } else if (phone == 1 && !CHECK_phone(this) && val != "") {
                cusNotify({mess: $(this).attr('data-msso1'), type: 'error', postion: 1});
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                icheck_lienhe = 0;
                return false;
            } else if (d_check == 1 && !$(this).is(":checked")) {
                cusNotify({mess: $(this).attr('data-msso'), type: 'error', postion: 1});
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                icheck_lienhe = 0;
                return false;
            }
        });
        if (check == 0) {
            $.ajax({
                type: "POST", url: url, data: $(id_form).serialize(), success: function (data) {
                    icheck_lienhe = 0;
                    $(".ajax_img_loading").hide();
                    var idform = ($("#idform").val());
                    if ($("#id_token").length == 0) {
                        if (data == 1) {
                            alert($(".lang_ok").val());
                            $(id_form)[0].reset();
                            window.location.reload();
                        } else {
                            $("#mabaove").focus();
                            alert($(".lang_false").val());
                            console.log(data);
                        }
                    } else {
                        try {
                            data = JSON.parse(data);
                            if (data.err == 1) {
                                cusNotify({mess: $(".lang_ok").val(), type: 'success', postion: 1});
                                $(id_form)[0].reset();
                                setTimeout(function () {
                                    window.location.reload();
                                }, timeout);
                            } else {
                                cusNotify({mess: $(".lang_false").val(), type: 'error', postion: 1});
                                setTimeout(function () {
                                    window.location.reload();
                                }, timeout);
                            }
                            $("#id_token").val(data.token);
                        } catch (e) {
                            alert("ERR#3");
                            console.log(data);
                        }
                    }
                }
            });
        }
    }
    return false;
}

var icheck_lienhe = 0;

function CHECK_send_datban(url, id_form, cls) {
    if (icheck_lienhe == 0) {
        icheck_lienhe = 1;
        $(".ajax_img_loading").show();
        var check = 0;
        $(id_form + " " + cls).each(function () {
            console.log(cls);
            var val = $(this).val().trim();
            var id = $(this).attr('id');
            var rong = $(this).attr('data-rong');
            var phone = $(this).attr('data-phone');
            var email = $(this).attr('data-email');
            var d_check = $(this).attr('data-check');
            var place = $(this).attr('placeholder');
            var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (rong == 1 && (val == "" || val == place)) {
                cusNotify({mess: $(this).attr('data-msso'), type: 'error', postion: 1});
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                icheck_lienhe = 0;
                return false;
            } else if (email == 1 && !regex.test(val) && val != "") {
                cusNotify({mess: $(this).attr('data-msso1'), type: 'error', postion: 1});
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                icheck_lienhe = 0;
                return false;
            } else if (phone == 1 && !CHECK_phone(this) && val != "") {
                cusNotify({mess: $(this).attr('data-msso1'), type: 'error', postion: 1});
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                icheck_lienhe = 0;
                return false;
            } else if (d_check == 1 && !$(this).is(":checked")) {
                cusNotify({mess: $(this).attr('data-msso'), type: 'error', postion: 1});
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                icheck_lienhe = 0;
                return false;
            }
        });
        if (check == 0) {
            $.ajax({
                type: "POST", url: url, data: $(id_form).serialize(), success: function (data) {
                    icheck_lienhe = 0;
                    $(".ajax_img_loading").hide();
                    var idform = ($("#idform").val());
                    // console.log($("#id_token"+idform).val());
                    if ($("#id_token"+idform).length == 0) {
                        if (data == 1) {
                            alert($(".lang_ok").val());
                            $(id_form)[0].reset();
                            window.location.reload();
                        } else {
                            $("#mabaove").focus();
                            alert($(".lang_false").val());
                            console.log(data);
                        }
                    } else {
                        try {
                            data = JSON.parse(data);
                            if (data.err == 1) {
                                cusNotify({mess: $(".lang_ok").val(), type: 'success', postion: 1});
                                $(id_form)[0].reset();
                                setTimeout(function () {
                                    window.location.reload();
                                }, timeout);
                            }else if(data.err == 3){
                                cusNotify({mess: $(".lang_hetban").val(), type: 'error', postion: 1});
                                // $(id_form)[0].reset();
                                setTimeout(function () {
                                    window.location.reload();
                                }, timeout);
                            } else {
                                cusNotify({mess: $(".lang_false").val(), type: 'error', postion: 1});
                                setTimeout(function () {
                                    window.location.reload();
                                }, timeout);
                            }
                            $("#id_token"+idform).val(data.token);
                        } catch (e) {
                            alert("ERR#3");
                            console.log(data);
                        }
                    }
                }
            });
        }
    }
    return false;
}


function updateQty(url, id, obj, size) {
    var qty = $(obj).val();
    if (qty == '' || qty <= 0 || isNaN(qty) || !Number.isSafeInteger(parseFloat(qty))) {
        alert($(".cls_datafalse").val());
        window.location.reload();
    } else {
        if (size > 0) {
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    'id': id,
                    "qty": qty,
                    "size": size,
                    "post": "update-qty"
                }, success: function (data) {
                    if (data != '') {
                        if (data == "reload") {
                            window.location.reload();
                        } else {
                            try {
                                var js_de = JSON.parse(data);
                                $(".td_thanhtien_" + id).html(js_de.thanhtien);
                                $(".tb_tongtien").html(js_de.tongtien);
                                $(".tb_tamtinh").html(js_de.tamtinh);
                            } catch (e) {
                                console.log(data);
                            }
                        }
                    }
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    'id': id,
                    "qty": qty,
                    "post": "update-qty"
                }, success: function (data) {
                    if (data != '') {
                        if (data == "reload") {
                            window.location.reload();
                        } else {
                            try {
                                var js_de = JSON.parse(data);
                                $(".td_thanhtien_" + id).html(js_de.thanhtien);
                                $(".tb_tongtien").html(js_de.tongtien);
                                $(".tb_tamtinh").html(js_de.tamtinh);
                                console.log(333);
                            } catch (e) {
                                console.log(data);
                            }
                        }
                    }
                }
            });
        }

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
        var arrayphone = ['03', '07', '08', '05', '09'];
        if (arrayphone.includes(firstNumber) && phone.length == 10) {
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
};$(".menu-active a").each(function () {
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

function GET_diadiem(obj, cls, text, url) {
    $.ajax({
        type: "POST",
        url: url,
        data: {'action_s': 'get_diadiem', "id": $(obj).val(), "text": text},
        success: function (data) {
            $(cls).html(data);
        }
    });
}

function SHOW_timkiem_bds(url) {
    var uri = "?tin=" + $("#id_loaitin").val();
    if ($("#id_quan").val() != "") uri += "&t=" + $("#id_quan").val();
    if ($("#id_huyen").val() != "") uri += "&q=" + $("#id_huyen").val();
    if ($("#id_phuong").val() != "") uri += "&p=" + $("#id_phuong").val();
    var list_id = "";
    $(".id_tinhnang").each(function () {
        if ($(this).val() != "" && $(this).val() != 0) {
            if (list_id != "") list_id += "-";
            list_id += $(this).val();
        }
    });
    if (list_id != "") uri += "&tn=" + list_id;
    if ($(".cls_nangcao").val() != '') uri += "&nc=true";
    window.location.href = url + uri;
}

function SHOW_timkiemnc() {
    if ($(".hide_search.activex").length > 0) {
        $(".hide_search.activex").removeClass("activex");
        $('.hide_search select option[value=""]').attr('selected', 'selected');
        $(".cls_nangcao").val('');
    } else {
        $(".hide_search").addClass("activex");
        $(".cls_nangcao").val('true');
    }
}

var popup_active = 0;

function LOAD_popup_new(url) {
    console.log(url);
    $("body").append('<div class="dv-loadding-pop"><img src="images/loadernew.gif" alt=""></div>');
    $(".dv-nd-popup").load(url, function () {
        $(".dv-loadding-pop").remove();
        $("body").addClass("body_hide");
        resize_popup_new();
    });
}

function resize_popup_new() {
    popup_active = 1;
    $(".dv-popup-new").addClass("acti");
    if (($(".dv-popup-new-child").height() + 20) > $(window).height()) {
        $(".dv-popup-new-child").addClass("actiok");
    } else {
        $(".dv-popup-new-child").removeClass("actiok");
    }
}

$(window).load(function () {
    if (popup_active == 1) {
        resize_popup_new();
    }
});
$(window).resize(function () {
    if (popup_active == 1) {
        resize_popup_new();
    }
});
$(".popup-close, .dv-popup-new").click(function () {
    $(".dv-nd-popup").html("");
    popup_active = 0;
    $("body").removeClass("body_hide");
    $(".dv-popup-new").removeClass("acti");
});
$(".dv-nd-popup").click(function (event) {
    event.stopPropagation();
});

function LOAD_height(cls) {
    var maxHeight = 0;
    $(cls).each(function () {
        if ($(this).height() > maxHeight) {
            maxHeight = $(this).height();
        }
    });
    if (maxHeight != 0) $(cls).height(maxHeight);
}

function ADD_list_sp(id) {
    alert(id)
}

function Checkbinhluan(id_form, url) {
    if ($("#s_message").val().trim() == '' || $(" #s_message").val().trim() == $("#s_message").attr('data-name')) {
        alert($(" #s_message").attr('data-msso'));
        $(" #s_message").focus();
        $(".ajax_img_loading").hide();
        return false;
    }
    $.ajax({
        type: "POST", url: url, data: $(id_form).serialize(), success: function (data) {
            console.log(data);
            $(".ajax_img_loading").hide();
            data = JSON.parse(data);
            if (data.data == 1) {
                alert($(".lang_ok").val());
                window.location.reload();
            } else {
                alert($(".lang_false").val());
                console.log(data);
            }
        }
    });
}

function TextBox_AddToIntValue(id, num, $url) {
    var total = $("#product-quantity-" + id).val();
    total = parseInt(total);
    $("#product-quantity-" + id).val(total + (num));
    updateQty($url, id, $("#product-quantity-" + id), 1);
}

function isEmpty(val) {
    return (val === undefined || val == null || val.length <= 0) ? true : false;
}

function cusNotify(data) {
    var n = new Noty({
        type: data.type,
        layout: 'bottomRight',
        text: data.mess
    }).show();
    n.setTimeout(timeout);
}

function comfirmNoty(data) {
    var n = new Noty({
        text: data.mess,
        type: data.type,
        layout: 'center',
        buttons: [
            Noty.button('YES', 'btn btn-success', function () {
                window.location.href = data.submit;
            }, {id: 'button1', 'data-status': 'ok'}),

            Noty.button('NO', 'btn btn-error', function () {
                n.close();
            })
        ]
    });
    n.show();
    n.setTimeout(timeout);
}

