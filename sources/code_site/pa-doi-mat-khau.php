<?php
if (!isset($_SESSION['id'])) {
    LOCATION_js($full_url);
    exit();
} else {
    $table = "#_members";
    $sql = DB_que("SELECT * FROM $table WHERE `showhi` = 1 AND `id` = '" . $_SESSION['id'] . "' AND `phanquyen` = 0 LIMIT 1");
    $row = mysql_fetch_array($sql);
    $sql_keypass = SHOW_text($row['keypass']);
    $sql_matkhau = SHOW_text($row['matkhau']);
    $hoten = SHOW_text($row['hoten']);

}
?>
<div class="link_page">
    <div class="pagewrap">
        <ul>
            <li><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a></li>
            <li><a href="<?= $_SERVER['REQUEST_URI'] ?>"><i aria-hidden="true"></i>
                    <?= $glo_lang['thay_doi_mat_khau'] ?></a></li>
        </ul>
        <div class="clr"></div>
    </div>
</div>
<div class="clr"></div>
<div class="pagewrap page_conten_page reorder-div">
    <div class="left_conten item2">
        <div class="menu_left">
            <h3>Thông tin quản lý</h3>
            <ul>
                <li><a href="<?= $full_url.'/tai-khoan' ?>"><?= $glo_lang['thong_tin_tai_khoan'] ?></a></li>
                <li><a href="<?= $full_url.'/mat-khau' ?>"><?= $glo_lang['thay_doi_mat_khau'] ?></a></li>
<!--                <li><a href="--><?//= $full_url.'/lich-su-dat-hang' ?><!--">--><?//= $glo_lang['lich_su_dat_hang'] ?><!--</a></li>-->
            </ul>
        </div>
    </div>

    <div class="right_conten">
        <div class="box_page">
            <div class="title_id"><?= $glo_lang['thay_doi_mat_khau'] ?></div>
            <div class="dv-dangnhap">
                <form action="" method="post" name="dangkythanhvien" id="dangkythanhvien" enctype="multipart/form-data">
                    <div class="dangnhap_popup no_box">
                        <div class=" row-frm">
                            <p><?= $glo_lang['nhap_mat_khau_cu'] ?></p>
                            <input type="password" id="passold_dk" name="passold_dk"
                                   class="form-control cls_data_check_form_check_dangky" data-rong="1"
                                   data-msso="<?= $glo_lang['vui_long_nhap_mat_khau_cu'] ?>">
                        </div>
                        <div class=" row-frm">
                            <p><?= $glo_lang['nhap_mat_khau_moi'] ?></p>
                            <input type="password" id="pass_dk" name="pass_dk" class="form-control cls_data_check_form_check_dangky"
                                   data-rong="1" data-msso="<?= $glo_lang['nhap_mat_khau_moi'] ?>">

                        </div>
                        <div class=" row-frm">
                            <p><?= $glo_lang['nhap_lai_mat_khau_moi'] ?></p>
                            <input type="password" id="repass_dk" name="repass_dk" class="form-control cls_data_check_form_check_dangky"
                                   id="repass_dk" id-khac="#pass_dk" data-rong="1" data-khac="1"
                                   data-msso="<?= $glo_lang['vui_long_nhap_lai_mat_khau'] ?>"
                                   data-msso1="<?= $glo_lang['nhap_lai_mat_khau_khong_chinh_xac'] ?>">

                        </div>

                        <div class="box_dangnhap_popup">
                            <h2>
                            <a class="cur" onClick="return check_capnhat()"><?= $glo_lang['luu_thay_doi'] ?>
                                <img class="img_load_from_dktv" src="images/loading2.gif"></a>
                            </h2>
                        </div>

                        <div class="clr"></div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    var send_d = 0;

    function check_capnhat() {
        var check = 0;
        $(".cls_data_check_form_check_dangky").each(function () {
            var val = $(this).val().trim();
            var id = $(this).attr('id');
            var rong = $(this).attr('data-rong');
            var khac = $(this).attr('data-khac');

            var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (rong == 1 && val == "") {
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
                    url: "<?=$full_url . "/doi-mat-khau/" ?>",
                    data: dataString,
                    success: function (response) {
                        if (response == 1) {
                            alert("<?=$glo_lang['doi_mat_khau_thanh_cong'] ?>");
                            window.location.href = "<?=$full_url ?>";
                        } else {
                            alert("<?=$glo_lang['mat_khau_cu_khong_dung'] ?>")
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
    //         check_capnhat();
    //     }
    // });
</script>