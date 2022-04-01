<?php
if (isset($_SESSION['id'])) LOCATION_js($full_url);
?>
<script src="../../js/jquery-ui.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css">
<div class="ungtuyen_popup">
    <form action="" method="post" name="dangkythanhvien" id="dangkythanhvien">
        <div class="title_id"><?= $glo_lang['title_dang_ky'] ?></div>
        <div class="col-md-4 row-frm">
            <input placeholder="<?= $glo_lang['email'] ?> (*)"
                   type="text"
                   name="email_dk"
                   class="form-control cls_data_check_form_check_dangky" data-rong="1"
                   data-email="1" data-msso="<?= $glo_lang['chua_nhap_dia_chi_email'] ?>"
                   data-msso1="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>">
        </div>
        <div class="col-md-4 row-frm">
            <input placeholder="<?= $glo_lang['login_pass'] ?> (*)"
                   type="password"
                   name="pass_dk"
                   class="form-control cls_data_check_form_check_dangky"
                   id="pass_dk"
                   data-rong="1" data-msso="<?= $glo_lang['login_nhap_mat_khau'] ?>">
        </div>
        <div class="col-md-4 row-frm">
            <input placeholder="<?= $glo_lang['register_repass'] ?> (*)"
                   type="password"
                   name="repass_dk"
                   class="form-control cls_data_check_form_check_dangky" id="repass_dk"
                   id-khac="#pass_dk" data-rong="1" data-khac="1"
                   data-msso="<?= $glo_lang['vui_long_nhap_lai_mat_khau'] ?>"
                   data-msso1="<?= $glo_lang['nhap_lai_mat_khau_khong_chinh_xac'] ?>">
        </div>
        <div class="clr"></div>
        <div class="col-md-4 row-frm">

            <input placeholder="<?= $glo_lang['ho_va_ten'] ?> (*)"
                   type="text"
                   name="fullname_dk"
                   class="form-control cls_data_check_form_check_dangky"
                   data-rong="1"
                   data-msso="<?= $glo_lang['nhap_ho_ten'] ?>">
        </div>
        <div class="col-md-4 row-frm">
            <input placeholder="<?= $glo_lang['so_dien_thoai'] ?> (*)"
                   type="text"
                   id="phone_dk"
                   class="form-control cls_data_check_form_check_dangky"
                   name="phone_dk"
                   data-rong="1"
                   data-phone="1"
                   data-msso="<?= $glo_lang['nhap_so_dien_thoai'] ?>"
                   data-msso1="<?= $glo_lang['so_dien_thoai_khong_hop_le'] ?>">
        </div>
        <div class="col-md-4 row-frm">
            <input placeholder="<?= $glo_lang['dia_chi'] ?> (*)"
                   type="text"
                   name="diachi"
                   class="form-control test">
        </div>
        <label class="checkbox">
            <input type="checkbox" id="thoa_thuan" name="thoa_thuan">
            <?= $glo_lang['dieu_khoan_dk_thanh_vien'] ?></label>
        <div class="box_dangnhap_popup">
            <h2><a class="cur" onClick="check_dangky()"><?= $glo_lang['dang_ky'] ?> <img class="img_load_from_dktv"
                                                                                         src="images/loading2.gif"></a>
            </h2>
        </div>
        <div class="clr"></div>
    </form>
</div>

<script>
    var send_d = 0;

    function check_dangky() {
        var check = 0;
        $(".cls_data_check_form_check_dangky").each(function () {
            var val = $(this).val().trim();
            var id = $(this).attr('id');
            var rong = $(this).attr('data-rong');
            var phone = $(this).attr('data-phone');
            var email = $(this).attr('data-email');
            var d_check = $(this).attr('data-check');
            var place = $(this).attr('placeholder');
            var khac = $(this).attr('data-khac');

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
            else if (phone == 1 && !CHECK_phone(this) && val != "") {
                alert($(this).attr('data-msso1'));
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                send_d = 0;
                return false;
            }
            else if (d_check == 1 && !$(this).is(":checked")) {
                alert($(this).attr('data-msso'));
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                send_d = 0;
                return false;
            }
            else if (khac == 1 && val != $($(this).attr('id-khac')).val()) {
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
                var dataString = $('#dangkythanhvien').serializeArray();
                $.ajax({
                    type: "POST",
                    url: "<?=$full_url . "/check-dang-ky/" ?>",
                    data: dataString,
                    success: function (response) {
                        console.log(response);
                        var obj = jQuery.parseJSON(response);
                        if (obj.error == 10) {
                            alert("<?=$glo_lang['nhap_ma_bao_ve_chua_dung'] ?>");
                            $("#mabaove").focus();
                        }
                        else if (obj.error > 0) {
                            alert("<?=$glo_lang['email_da_duoc_dang_ky']  ?>");
                            $("#email_dk").focus();
                        } else {
                            alert("<?=$glo_lang['dang_ky_tai_khoan_thanh_cong']  ?>");
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
    //         check_dangky();
    //     }
    // });
    // $(function () {
    //     $("#datepicker").datepicker({
    //         autoclose: true,
    //         format: 'dd/mm/yyyy'
    //     });
    // });
</script>