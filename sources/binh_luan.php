<?php
$numview = 100;
$pzer = 1;
$vi_tri = PHANTRANG_start($pzer, $numview);
$pzz = 0;

$nd_kietxuat = DB_que("SELECT * FROM `#_binhluan` WHERE `showhi` =  1 AND `id_sp` = '" . $arr_running['id'] . "' AND `id_parent` = 0 ORDER BY `id` DESC LIMIT $vi_tri,$numview");
$nd_total = DB_que("SELECT * FROM `#_binhluan` WHERE `showhi` =  1 AND `id_sp` = '" . $arr_running['id'] . "' AND `id_parent` = 0");

$numlist = @mysql_num_rows($nd_total);
$numshow = ceil($numlist / $numview);
$sotrang = PHANTRANG_findPages($numlist, $numview);

$numlist_list = DB_que("SELECT `id` FROM `#_binhluan` WHERE `showhi` =  1 AND `id_sp` = '" . $arr_running['id'] . "'");
$numlist_list = mysql_num_rows($numlist_list);
?>

<form action="" class="formBox " method="post" accept-charset="UTF-8" name="formnamecontact"
      id="formnamecontact">
    <input type="hidden" name="send_lienhe">
    <input type="hidden" class="lang_ok" value="<?= $glo_lang['yeu_cau_cua_ban_da_duoc_gui'] ?>">
    <input type="hidden" class="lang_false" value="<?= $glo_lang['nhap_ma_bao_ve_chua_dung'] ?>">
    <input type="hidden" name="tieude_lienhe"
           value="<?= (!empty($custometile)) ? base64_encode($custometile) : base64_encode($glo_lang['thongtin_lienhe']) ?>">
    <div class="comment_pro padding_pagewrap">
        <?php
        while ($rows = mysql_fetch_array($nd_kietxuat)) {
            ?>
            <div class="dv-group-bl">
                <div class="dv-bl-cap1">
                    <a>
                        <img src="images/atomix_user31.png" alt="">
                    </a>
                    <div class="nd">
                        <h3><?= SHOW_text($rows['hoten']) ?></h3>
                        <!--						<h3>--><? //=SHOW_text($rows['tenbaiviet_vi']) ?><!--</h3>-->
                        <div class="mt">
                            <?= SHOW_text($rows['noidung_vi']) ?>
                        </div>
                        <div class="dv-like">

                            <p> - <?= CHECK_phut($rows['ngay_dang'], $glo_lang) ?></p>
                            <div class="clr"></div>
                        </div>
                    </div>

                    <div class="clr"></div>
                </div>
                <!-- //cap 2 -->
                <?php
                $binhluan_c2 = DB_que("SELECT * FROM `#_binhluan` WHERE `showhi` =  1 AND `id_sp` = '" . $arr_running['id'] . "' AND `id_parent` = '" . $rows['id'] . "' ORDER BY `id` ASC");
                while ($rows2 = mysql_fetch_array($binhluan_c2)) {
                    ?>
                    <div class="dv-bl-cap2">
                        <div class="img">
                            <img src="images/atomix_user31.png" alt="">
                        </div>
                        <div class="nd">
                            <h3><?= SHOW_text($rows2['tenbaiviet_vi']) ?></h3>
                            <div class="mt">
                                <?= SHOW_text($rows2['noidung_vi']) ?>
                            </div>
                            <div class="dv-like">
                                <a class="cur"
                                   onclick="BL_binhluan('<?= $rows['id'] ?>')"><?= $glo_lang['binh_luan'] ?></a>
                                <p> - <?= CHECK_phut($rows2['ngay_dang'], $glo_lang) ?></p>
                                <div class="clr"></div>
                            </div>
                        </div>

                        <div class="clr"></div>
                    </div>
                <?php } ?>
                <!-- end -->
            </div>
        <?php } ?>
    </div>
    <!--    <div class="dv-phantrang-bl">-->
    <!--        <ul>-->
    <!--            --><? //=PHANTRANG_ajax($pzer, $sotrang, $full_url."/".$motty, $_SERVER['QUERY_STRING']) ?>
    <!--        </ul>-->
    <!--    </div>-->
    <style>
        .dv-noidungbinhluan {
            margin: 20px 0;
        }

        .dv-noidungbinhluan .dv-group-bl {
            margin-bottom: 15px;
        }

        .dv-noidungbinhluan .dv-group-bl .img {
            width: 48px;
            float: left;
            margin-right: 10px;
        }

        .dv-noidungbinhluan .dv-group-bl .nd {
            width: calc(100% - 58px);
            float: left;
        }

        .dv-noidungbinhluan .dv-group-bl .nd h3 {
            color: #365899;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 3px;
            display: block;
        }

        .dv-noidungbinhluan .dv-group-bl .nd .mt {
            font-size: 13px;
            line-height: 1.7;
            color: #333;
        }

        .dv-noidungbinhluan .dv-group-bl .nd .dv-like {
            padding: 5px 0;
        }

        .dv-noidungbinhluan .dv-group-bl .nd .dv-like a {
            color: #4267b2;
            display: inline-block;
            margin-right: 5px;
        }

        .dv-noidungbinhluan .dv-group-bl .nd .dv-like a:hover {
            text-decoration: underline;
        }

        .dv-noidungbinhluan .dv-group-bl .nd .dv-like p {
            display: inline-block;
            font-size: 12px;
            color: #9c9c9c;
            margin: 0;
            padding: 0;
        }

        .dv-noidungbinhluan .dv-group-bl .dv-bl-cap2 {
            margin-left: 58px;
            border-left: 1px dotted #d3d6db;
            padding-left: 10px;
        }

        .dv-noidungbinhluan .dv-group-bl .dv-bl-cap2 .img {
            width: 36px;
        }

        .dv-noidungbinhluan .dv-group-bl .dv-bl-cap2 .nd {
            width: calc(100% - 48px);
        }

        .dv-noidungbinhluan .dv-group-bl .dv-bl-cap2 .nd .dv-like {
            padding: 5px 0 0;
        }
    </style>


    <div class="left">
        <li class="name">
            <input type="hidden" name="s_fullname_s" value="<?= base64_encode($glo_lang['ho_va_ten']) ?>">
            <input class="cls_data_check_form cls_data_check_bl" data-rong="1" name="bl_hoten" id="bl_hoten" type="text"
                   placeholder="<?= $glo_lang['ho_va_ten'] ?> (*)"
                   value="<?= !empty($_POST['s_fullname']) ? $_POST['s_fullname'] : @$hoten ?>"
                   onFocus="if (this.value == '<?= $glo_lang['ho_va_ten'] ?> (*)'){this.value='';}"
                   onBlur="if (this.value == '') {this.value='<?= $glo_lang['ho_va_ten'] ?> (*)';}"
                   data-name="<?= $glo_lang['ho_va_ten'] ?> (*)" data-msso="<?= $glo_lang['nhap_ho_ten'] ?>"/>
            <input type="hidden" name="idbv" value="<?= $arr_running['id'] ?>">
            <input type="hidden" name="id_parent" id="id_id_parent" value="0">
        </li>
        <li class="phone">
            <input type="hidden" name="s_dienthoai_s" value="<?= base64_encode($glo_lang['so_dien_thoai']) ?>">
            <input class="cls_data_check_form cls_data_check_bl" data-rong="1" data-phone="1" name="bl_sodienthoai" id="bl_sodienthoai"
                   type="text" placeholder="<?= $glo_lang['so_dien_thoai'] ?> (*)"

                   onFocus="if (this.value == '<?= $glo_lang['so_dien_thoai'] ?> (*)'){this.value='';}"
                   onBlur="if (this.value == '') {this.value='<?= $glo_lang['so_dien_thoai'] ?> (*)';}"
                   data-name="<?= $glo_lang['so_dien_thoai'] ?> (*)" data-msso="<?= $glo_lang['nhap_so_dien_thoai'] ?>"
                   data-msso1="<?= $glo_lang['so_dien_thoai_khong_hop_le'] ?>"/>
        </li>
    </div>
    <div class="right">
        <li class="subject">
            <input type="hidden" name="s_title_s" value="<?= base64_encode($glo_lang['tieu_de']) ?>">
            <input type="text" name="bl_tieude" id="bl_tieude" class="form-control cls_data_check_bl"
                   placeholder="<?= $glo_lang['tieu_de'] ?> (*)" data-rong="1"
                   data-msso="<?= $glo_lang['nhap_tieu_de'] ?>">
        </li>
        <li class="mess">
            <input type="hidden" name="s_message_s" value="<?= base64_encode($glo_lang['noi_dung_lien_he']) ?>">
            <textarea name="bl_noidung" id="bl_noidung" class="form-control cls_data_check_bl"
                      placeholder="<?= $glo_lang['viet_danh_gia'] ?> (*)" style="height:200px; padding-top:15px;"
                      data-rong="1" data-msso="<?= $glo_lang['nhap_noi_dung'] ?>"></textarea>
            <div class="clr"></div>
        </li>


        <a onclick="RefreshFormMailContact(formnamecontact)" style="cursor:pointer"
           class="button"><?= $glo_lang['lam_lai'] ?></a>
        <a onclick="GUI_danhgia(formnamecontact)"
           style="cursor:pointer"
           class="button"><?= $glo_lang['gui'] ?> <img src="images/loading2.gif" class="ajax_img_loading"></a>
    </div>
    <div class="clr"></div>
</form>

<script type="text/javascript">

    var icheck_danhgia = 0;

    function GUI_danhgia(id_form) {
        if (icheck_danhgia == 0) {
            icheck_danhgia = 1;
            $(".ajax_img_loading").show();
            var check = 0;
            $('.cls_data_check_bl').each(function () {
                var val = $(this).val().trim();
                var id = $(this).attr('id');
                var rong = $(this).attr('data-rong');
                var phone = $(this).attr('data-phone');

                if (rong == 1 && val == "") {
                    alert($(this).attr('data-msso'));
                    $(this).focus();
                    $(".ajax_img_loading").hide();
                    check = 1;
                    icheck_danhgia = 0;
                    return false;
                }if(phone == 1 && !CHECK_phone(this) && val != ""){
                    alert($(this).attr('data-msso1'));
                    $(this).focus();
                    $(".ajax_img_loading").hide();
                    check = 1;
                    icheck_danhgia = 0;
                    return false;
                }
            });
            if (check == 0) {
                $.ajax({
                    type: "POST",
                    url: full_url + "/gui-binh-luan/",
                    data: $(id_form).serialize(),
                    success: function (data) {
                        icheck_danhgia = 0;
                        $(".ajax_img_loading").hide();
                        try {
                            data = JSON.parse(data);
                            if (data.data == 1) {
                                alert($(".lang_ok").val());
                                $(id_form)[0].reset();
                                // window.location.reload();
                            } else {
                                alert($(".lang_false").val());
                                window.location.reload();
                                // console.log(data);
                            }
                            $("#id_token").val(data.token);
                        } catch (e) {
                            alert("ERR#3");
                            console.log(data);
                        }
                    }
                });
            }
        }
        return false;
    }

    function BL_binhluan(id) {
        $("#id_id_parent").val(id);
        GOTO_sport('.contact');
    };
</script>