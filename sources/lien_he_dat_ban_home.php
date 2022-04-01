<form action="" method="post" name="form_datbanhome" id="form_datbanhome" enctype="multipart/form-data">
    <input type="hidden" name="send_datban">
    <input type="hidden" class="lang_ok" value="<?= $glo_lang['cam_on_dat_ban'] ?>">
    <input type="hidden" class="lang_false" value="<?= $glo_lang['loi_xac_thuc_thu_lai_sau'] ?>">
    <input type="hidden" name="tieude_lienhe"
           value="<?= (!empty($custometile)) ? base64_encode($custometile) : base64_encode($glo_lang['thong_tin_dat_ban']) ?>">
    <div class="datban_home">
        <ul>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_ngaydat_s"
                           value="<?= base64_encode($glo_lang['ngay_dat']) ?>">
                    <input class="cls_data_check_form form-control datetimepicker" data-rong="1"
                           name="s_ngaydat" id="s_ngaydat"
                           type="text" placeholder="<?= $glo_lang['ngay_dat'] ?> (*)"
                           onFocus="if (this.value == '<?= $glo_lang['ngay_dat'] ?> (*)'){this.value='';}"
                           onBlur="if (this.value == '') {this.value='<?= $glo_lang['ngay_dat'] ?> (*)';}"
                           data-name="<?= $glo_lang['ngay_dat'] ?> (*)"
                           data-msso="<?= $glo_lang['nhap_ngay_dat'] ?>" readonly/>
                </div>
            </li>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_thoigian_s"
                           value="<?= base64_encode($glo_lang['thoi_gian']) ?>">
                    <input class="cls_data_check_form form-control" data-rong="1" name="s_thoigian"
                           id="s_thoigian"
                           type="text" placeholder="<?= $glo_lang['thoi_gian'] ?> (*)"
                           onFocus="if (this.value == '<?= $glo_lang['thoi_gian'] ?> (*)'){this.value='';}"
                           onBlur="if (this.value == '') {this.value='<?= $glo_lang['thoi_gian'] ?> (*)';}"
                           data-name="<?= $glo_lang['thoi_gian'] ?> (*)"
                           data-msso="<?= $glo_lang['nhap_thoi_gian'] ?>"/>
                </div>
            </li>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_fullname_s"
                           value="<?= base64_encode($glo_lang['ho_va_ten']) ?>">
                    <input class="cls_data_check_form form-control" data-rong="1" name="s_fullname"
                           id="s_fullname" type="text"
                           placeholder="<?= $glo_lang['ho_va_ten'] ?> (*)"
                           onFocus="if (this.value == '<?= $glo_lang['ho_va_ten'] ?> (*)'){this.value='';}"
                           onBlur="if (this.value == '') {this.value='<?= $glo_lang['ho_va_ten'] ?> (*)';}"
                           data-name="<?= $glo_lang['ho_va_ten'] ?> (*)"
                           data-msso="<?= $glo_lang['nhap_ho_ten'] ?>"/>
                </div>
            </li>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_email_s" value="<?= base64_encode($glo_lang['email']) ?>">
                    <input class="cls_data_check_form form-control" data-rong="1" data-email="1"
                           name="s_email"
                           id="s_email" type="text"
                           placeholder="<?= $glo_lang['email'] ?> (*)"
                           onFocus="if (this.value == '<?= $glo_lang['email'] ?> (*)'){this.value='';}"
                           onBlur="if (this.value == '') {this.value='<?= $glo_lang['email'] ?> (*)';}"
                           data-msso="<?= $glo_lang['chua_nhap_dia_chi_email'] ?>"
                           data-msso1="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>"/>
                </div>
            </li>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_dienthoai_s"
                           value="<?= base64_encode($glo_lang['so_dien_thoai']) ?>">
                    <input class="cls_data_check_form form-control" data-rong="1" data-phone="1"
                           name="s_dienthoai" id="s_dienthoai"
                           type="text" placeholder="<?= $glo_lang['so_dien_thoai'] ?> (*)"
                           onFocus="if (this.value == '<?= $glo_lang['so_dien_thoai'] ?> (*)'){this.value='';}"
                           onBlur="if (this.value == '') {this.value='<?= $glo_lang['so_dien_thoai'] ?> (*)';}"
                           data-name="<?= $glo_lang['so_dien_thoai'] ?> (*)"
                           data-msso="<?= $glo_lang['nhap_so_dien_thoai'] ?>"
                           data-msso1="<?= $glo_lang['so_dien_thoai_khong_hop_le'] ?>"/>
                </div>
            </li>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_soluong_s"
                           value="<?= base64_encode($glo_lang['so_luong_nguoi']) ?>">
                    <input class="cls_data_check_form form-control" name="s_soluong" id="s_soluong"
                           type="text" placeholder="<?= $glo_lang['so_luong_nguoi'] ?> (*)"
                           onFocus="if (this.value == '<?= $glo_lang['so_luong_nguoi'] ?> (*)'){this.value='';}"
                           onBlur="if (this.value == '') {this.value='<?= $glo_lang['so_luong_nguoi'] ?> (*)';}"
                           data-name="<?= $glo_lang['so_luong_nguoi'] ?> (*)" data-rong="1"
                           data-msso="<?= $glo_lang['nhap_so_luong_nguoi'] ?>"/>
                </div>
            </li>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_title_s"
                           value="<?= base64_encode($glo_lang['yeu_cau_them']) ?>">
                    <input class="cls_data_check_form form-control" name="s_title" id="s_title" type="text"
                           placeholder="<?= $glo_lang['yeu_cau_them'] ?>"
                           value="<?= !empty($_POST['s_title']) ? $_POST['s_title'] : '' ?>"
                           onFocus="if (this.value == '<?= $glo_lang['yeu_cau_them'] ?>'){this.value='';}"
                           onBlur="if (this.value == '') {this.value='<?= $glo_lang['yeu_cau_them'] ?>';}"
                           data-name="<?= $glo_lang['yeu_cau_them'] ?>"/>
                </div>
            </li>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_coso_s" value="<?= base64_encode($glo_lang['co_so']) ?>">
                    <select class="cls_data_check_form form-control" name="s_coso" id="s_coso" data-rong="1"
                            data-msso="<?= $glo_lang['chon_co_so'] ?>">
                        <option value=""><?= $glo_lang['co_so'] ?></option>
                        <?php
                        $i = 1;
                        foreach ($coso_datban as $value) {
                            $tenbaiviet = $value['tenbaiviet_' . $lang];
                            ?>
                            <option value="<?= $tenbaiviet ?>"><?= $tenbaiviet ?>
                            </option>
                            <?php $i++;
                        } ?>
                    </select>
                </div>
            </li>
            <div class="clr"></div>
            <h3>
                <a onclick="return CHECK_send_lienhe('<?= $full_url ?>/','#form_datbanhome', '.cls_data_check_form')">
                    <?= $glo_lang['dat_ban_ngay'] ?><img src="images/loading2.gif" class="ajax_img_loading"></a>
                <input type="hidden" name="id_token" id="id_token"
                       value="<?= $_SESSION['token'] = md5(RANDOM_chuoi(5)) ?>">
            </h3>
        </ul>
    </div>
</form>