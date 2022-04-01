<?php
$databaivietlienquan = DB_fet("*",
    "#_baiviet",
    'showhi=1 and step =2',
    "catasort desc , id desc",
    "",
    "arr",
    1);
?>
<div class="login_id_popup">
    <form action="" class="formBox no_box" method="post" accept-charset="UTF-8" name="formnamecontact"
          id="formnamecontact">
        <input type="hidden" name="dangkykhoahoc" value="1">
        <input type="hidden" class="lang_ok" value="<?= $glo_lang['yeu_cau_cua_ban_da_duoc_gui'] ?>">
        <input type="hidden" class="lang_false" value="<?= $glo_lang['nhap_ma_bao_ve_chua_dung'] ?>">
        <input type="hidden" name="tieude_lienhe"
               value="<?= (!empty($custometile)) ? base64_encode($custometile) : base64_encode($glo_lang['dangkykhoahoc']) ?>">
        <div class="titBox left">
            <h3 class="tit"><?= $glo_lang['dangkykhoahoc'] ?></h3>
        </div>
        <div class="col-md-4 row-frm">
            <input type="hidden" name="s_fullname_s" value="<?= base64_encode($glo_lang['ho_va_ten']) ?>">
            <input class="cls_data_check_form form-control" data-rong="1" name="s_fullname" id="s_fullname" type="text"
                   placeholder="<?= $glo_lang['ho_va_ten'] ?> (*)"
                   value="<?= !empty($_POST['s_fullname']) ? $_POST['s_fullname'] : @$hoten ?>"
                   onFocus="if (this.value == '<?= $glo_lang['ho_va_ten'] ?> (*)'){this.value='';}"
                   onBlur="if (this.value == '') {this.value='<?= $glo_lang['ho_va_ten'] ?> (*)';}"
                   data-name="<?= $glo_lang['ho_va_ten'] ?> (*)" data-msso="<?= $glo_lang['nhap_ho_ten'] ?>"/>
        </div>
        <div class="col-md-4 row-frm">
            <input type="hidden" name="s_dienthoai_s" value="<?= base64_encode($glo_lang['so_dien_thoai']) ?>">
            <input class="cls_data_check_form form-control test" data-rong="1" data-phone="1" name="s_dienthoai"
                   id="s_dienthoai"
                   type="text" placeholder="<?= $glo_lang['so_dien_thoai'] ?> (*)"
                   value="<?= !empty($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : @$sodienthoai ?>"
                   onFocus="if (this.value == '<?= $glo_lang['so_dien_thoai'] ?> (*)'){this.value='';}"
                   onBlur="if (this.value == '') {this.value='<?= $glo_lang['so_dien_thoai'] ?> (*)';}"
                   data-name="<?= $glo_lang['so_dien_thoai'] ?> (*)" data-msso="<?= $glo_lang['nhap_so_dien_thoai'] ?>"
                   data-msso1="<?= $glo_lang['so_dien_thoai_khong_hop_le'] ?>"/>
        </div>
        <div class="col-md-4 row-frm">
            <input type="hidden" name="s_email_s" value="<?= base64_encode($glo_lang['email']) ?>">
            <input class="cls_data_check_form form-control test" data-rong="1" data-email="1" name="s_email"
                   id="s_email"
                   type="text"
                   placeholder="<?= $glo_lang['email'] ?> (*)"
                   value="<?= !empty($_POST['s_email']) ? $_POST['s_email'] : '' ?>"
                   onFocus="if (this.value == '<?= $glo_lang['email'] ?> (*)'){this.value='';}"
                   onBlur="if (this.value == '') {this.value='<?= $glo_lang['email'] ?> (*)';}"
                   data-msso="<?= $glo_lang['chua_nhap_dia_chi_email'] ?>"
                   data-msso1="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>"/>
        </div>
        <div class="col-md-4 row-frm">
            <input type="hidden" name="s_address_s" value="<?= base64_encode($glo_lang['dia_chi']) ?>">
            <input class="form-control test cls_data_check_form"
                   data-rong="1"
                   name="s_address"
                   id="s_address"
                   type="text"
                   data-msso="<?= $glo_lang['chua_nhap_dia_chi'] ?>"
                   placeholder="<?= $glo_lang['dia_chi'] ?> (*)"
                   value="<?= !empty($_POST['s_address']) ? $_POST['s_address'] : @$diachi ?>"
                   onFocus="if (this.value == '<?= $glo_lang['dia_chi'] ?>'){this.value='';}"
                   onBlur="if (this.value == '') {this.value='<?= $glo_lang['dia_chi'] ?>';}"/>
        </div>
        <div class="col-md-4 row-frm">
            <input type="hidden" name="s_khoahoc_s" value="<?= base64_encode($glo_lang['tenkhoahoc']) ?>">
            <select data-rong="1"
                    name="s_khoahoc"
                    id="s_khoahoc"
                    class="form-control cls_data_check_form"
                    data-msso="<?= $glo_lang['chua_chon_khoa_hoc'] ?>">
                <option value=""><?= $glo_lang['chonkhoahoc'] ?></option>
                <?php foreach ($databaivietlienquan as $row) { ?>
                    <option value="<?= $row['id'] ?>"><?= $row['tenbaiviet_' . $lang] ?></option>
                <?php } ?>
            </select>
        </div>
        <label class="checkbox"><input checked="true" disabled type="checkbox" id="thoa_thuan"
                                       name="thoa_thuan"><?= $glo_lang['dongyvoidkhoan'] ?>
        </label>
        <div class="box_dangnhap_popup">
            <h2>
                <a onclick="return CHECK_send_lienhe('<?= $full_url ?>/','#formnamecontact','.cls_data_check_form')"><?= $glo_lang['dang_ky'] ?></a>
            </h2>
        </div>
        <div class="clr"></div>
    </form>
</div>
