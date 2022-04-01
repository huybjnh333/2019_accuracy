if (check == 0) {
    $.ajax({
        type: "POST", url: url, data: $(id_form).serialize(), success: function (data) {
            icheck_lienhe = 0;
            $(".ajax_img_loading").hide();
            if ($("#id_token").length == 0) {
                if (data == 1) {
                    cusNotify({mess: $(".lang_ok").val(), type: 'success', postion: 1});
                    $(id_form)[0].reset();
                    setTimeout(function () {
                        window.location.reload();
                    }, timeout);

                } else {
                    $("#mabaove").focus();
                    cusNotify({mess: $(".lang_false").val(), type: 'error', postion: 1});
                    console.log(data);
                }
            } else {
                try {
                    data = JSON.parse(data);
                    if (data.error == 1) {
                        cusNotify({mess: $(".lang_ok").val(), type: 'success', postion: 1});
                        $(id_form)[0].reset();
                        if (data.type == 3) {
                            $(".dv-paypal").show();
                            $(".dv-paypal-cont").show();
                            TIEN_paypal(data.money, data.madh);
                            $(".paypal_form_new").click();
                        } else if (data.type == 6) {
                            $(".dv-paypal").show();
                            $(".dv-paypal-cont").show();
                            $("#vpc_Amount").val(data.money);
                            $("#vpc_OrderInfo").val(data.madh);
                            $(".onepay_noidia").click();
                        } else if (data.type == 7) {
                            $(".dv-paypal").show();
                            $(".dv-paypal-cont").show();
                            $("#vpc_Amount_quocte").val(data.money);
                            $("#vpc_OrderInfo_quocte").val(data.madh);
                            $(".onepay_quocte").click();
                        } else {
                            window.location.href = full_url + '/thong-tin-dat-hang/' + data.madh + '/';
                        }
                    } else {
                        cusNotify({mess: $(".lang_false").val(), type: 'error', postion: 1});
                        setTimeout(function () {
                            window.location.reload();
                        }, timeout);
                    }
                    $("#id_token").val(data.token);
                } catch (e) {
                    cusNotify({mess: 'ERR#3', type: 'error', postion: 1});
                    console.log(data);
                }
            }
        }
    });
}