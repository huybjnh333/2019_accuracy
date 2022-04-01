<div class="ungtuyen_popup">

    <div class="title_id"><?= $glo_lang['title_dang_nhap'] ?></div>
    <form action="" method="post" name="dangnhap" id="dangnhap">
        <div class="col-md-4 row-frm">
            <input placeholder="<?= $glo_lang['login_email'] ?> (*)" type="text" name="txt_email" class="form-control cls_data_check_form_check_dangky" data-rong="1"
                   data-email="1" data-msso="<?= $glo_lang['chua_nhap_dia_chi_email'] ?>"
                   data-msso1="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>">
        </div>
        <div class="col-md-4 row-frm">
            <input placeholder="<?= $glo_lang['login_pass'] ?> (*)" type="password" name="txt_pass" id="txt_pass" class="form-control cls_data_check_form_check_dangky"
                   data-rong="1" data-msso="<?= $glo_lang['login_nhap_mat_khau'] ?>">
        </div>
        <li class="bt-login">
            <a href="<?= $full_url.'/pa-size-child/quen-mat-khau'; ?>"
               class="preview fancybox.ajax dk_dangnhap_1 quenmatkhau cur"><?= $glo_lang['quen_mat_khau'] ?></a>
            <a href="<?= $full_url.'/pa-size-child/dang-ky'; ?>"
               class="preview fancybox.ajax dk_dangnhap_2"><?= $glo_lang['dang_ky'] ?></a>
            <div class="clr"></div>
        </li>
        <div class="box_dangnhap_popup">
            <h2><a class="cur" id="dangnhap" onClick="check_dangnhap()"><?= $glo_lang['dang_nhap'] ?> <img
                            class="img_load_from_dktv" src="images/loading2.gif"></a></h2>
        </div>
    </form>

    <div class="clr"></div>
</div>

<script type="text/javascript">
    var send_d = 0;

    function check_dangnhap() {
        var check = 0;
        $(".cls_data_check_form_check_dangky").each(function () {
            var val = $(this).val().trim();
            var id = $(this).attr('id');
            var rong = $(this).attr('data-rong');
            var email = $(this).attr('data-email');
            var place = $(this).attr('placeholder');

            var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (rong == 1 && (val == "" || val == place)) {
                alert($(this).attr('data-msso'));
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                send_d = 0;
                return false;
            }
            else if (email == 1 && !regex.test(val) && val != "") {
                alert($(this).attr('data-msso1'));
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                send_d = 0;
                return false;
            }
        });

        if (check == 0) {
            if (send_d == 0) {
                send_d = 1;
                $(".img_load_from_dktv").show();
                var dataString = $('#dangnhap').serializeArray();
                $.ajax({
                    type: "POST",
                    url: "<?=$full_url . "/check-dang-nhap/" ?>",
                    data: dataString,
                    success: function (response) {
                        var obj = jQuery.parseJSON(response);
                        if (obj.error > 0) {
                            alert("<?=$glo_lang['email_pass_khong_khong_dung']  ?>");
                        } else {
                            window.location.reload();
                        }
                        $(".img_load_from_dktv").hide();
                        send_d = 0;
                    }
                });
            }
        }
    }

    // $('.form-control').keypress(function (event) {
    //     var keycode = (event.keyCode ? event.keyCode : event.which);
    //     if (keycode == '13') {
    //         check_dangnhap();
    //     }
    // });
</script> 