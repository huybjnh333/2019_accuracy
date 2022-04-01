<form action="" method="post" name="form_datban<?= $id ?>" id="form_datban<?=$id?>" enctype="multipart/form-data">
    <input type="hidden" name="send_datban">
    <input type="hidden" class="lang_ok"
           value="<?= $glo_lang['cam_on_dat_ban'] ?>">
    <input type="hidden" class="lang_false"
           value="<?= $glo_lang['loi_xac_thuc_thu_lai_sau'] ?>">
    <input type="hidden" class="lang_hetban"
           value="<?= $glo_lang['da_het_ban'] ?>">
    <input type="hidden" name="tieude_lienhe"
           value="<?= (!empty($custometile)) ? base64_encode($custometile) : base64_encode($glo_lang['thong_tin_dat_ban']) ?>">
    <?php
    $datban = DB_fet("*", "#_baiviet", "`showhi` = 1 and `id_parent` = $id and step = " . $slug_step,
        "catasort ASC, id ASC", "", 1, 1);
    ?>
    <div class="datban_home">
        <ul>
            <li class="<?=($motty == "" ? "hidden" : "")?>">
                <div class="col-md row-frm">
                    <input type="hidden" name="s_maphong_s" value="<?= base64_encode($glo_lang['ma_phong']) ?>">
                    <select data-rong="1" onchange="submitForm(<?= $id ?>)" name="s_maphong" id="s_maphong<?=$id?>"
                            class="cls_data_check_form form-control"
                            data-msso="<?= $glo_lang['chon_ma_phong'] ?>">
                        <option value=""><?= $glo_lang['ma_phong'] ?></option>
                        <?php foreach ($datban as $rows) {
                            $idb = $rows['id'];
                            $maphong = $rows['p1'];
                            ?>
                            <option value="<?= $idb ?>"><?= $maphong ?></option>
                        <?php } ?>
                    </select>
                </div>
            </li>
            <li class="<?=(($motty == "") ? "hidden" : "")?>">
                <div class="col-md row-frm">
                    <input type="hidden" name="s_thongso_s"
                           value="<?= base64_encode($glo_lang['thong_so']) ?>">
                    <select disabled onchange="onChange(<?=$id?>)" name="s_thongso" id="s_thongso<?=$id?>"
                            class="cls_data_check_form form-control" data-rong="1"
                            data-msso="<?= $glo_lang['chon_thong_so'] ?>">
                        <option value=""><?= $glo_lang['thong_so'] ?></option>
                    </select>
                </div>
            </li>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_ngaydat_s"
                           value="<?= base64_encode($glo_lang['ngay_dat']) ?>">
                    <input disabled onchange="onChange(<?=$id?>)"
                           class="cls_data_check_form form-control datetimepicker"
                           name="s_ngaydat" id="s_ngaydat<?=$id?>" data-rong="1"
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
                    <select disabled onchange="onChange(<?=$id?>)" name="s_thoigian" id="s_thoigian<?=$id?>"
                            class="cls_data_check_form form-control" data-rong="1"
                            data-msso="<?= $glo_lang['nhap_thoi_gian'] ?>">
                        <option value=""><?= $glo_lang['thoi_gian'] ?></option>
                    </select>
                </div>
            </li>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_fullname_s"
                           value="<?= base64_encode($glo_lang['ho_va_ten']) ?>">
                    <input class="cls_data_check_form form-control" name="s_fullname"
                           id="s_fullname" type="text" data-rong="1"
                           placeholder="<?= $glo_lang['ho_va_ten'] ?> (*)"
                           onFocus="if (this.value == '<?= $glo_lang['ho_va_ten'] ?> (*)'){this.value='';}"
                           onBlur="if (this.value == '') {this.value='<?= $glo_lang['ho_va_ten'] ?> (*)';}"
                           data-name="<?= $glo_lang['ho_va_ten'] ?> (*)"
                           data-msso="<?= $glo_lang['nhap_ho_ten'] ?>"/>
                </div>
            </li>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_email_s"
                           value="<?= base64_encode($glo_lang['email']) ?>">
                    <input class="cls_data_check_form form-control" data-rong="1" data-email="1"
                           name="s_email" id="s_email" type="text"
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
                    <input class="cls_data_check_form form-control" name="s_soluong"
                           id="s_soluong" data-rong="1"
                           type="text" placeholder="<?= $glo_lang['so_luong_nguoi'] ?> (*)"
                           onFocus="if (this.value == '<?= $glo_lang['so_luong_nguoi'] ?> (*)'){this.value='';}"
                           onBlur="if (this.value == '') {this.value='<?= $glo_lang['so_luong_nguoi'] ?> (*)';}"
                           data-name="<?= $glo_lang['so_luong_nguoi'] ?> (*)"
                           data-msso="<?= $glo_lang['nhap_so_luong_nguoi'] ?>"/>
                </div>
            </li>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_title_s"
                           value="<?= base64_encode($glo_lang['yeu_cau_them']) ?>">
                    <input class="cls_data_check_form form-control" name="s_title" id="s_title"
                           type="text" placeholder="<?= $glo_lang['yeu_cau_them'] ?>"
                           value="<?= !empty($_POST['s_title']) ? $_POST['s_title'] : '' ?>"
                           onFocus="if (this.value == '<?= $glo_lang['yeu_cau_them'] ?>'){this.value='';}"
                           onBlur="if (this.value == '') {this.value='<?= $glo_lang['yeu_cau_them'] ?>';}"
                           data-name="<?= $glo_lang['yeu_cau_them'] ?>"/>
                </div>
            </li>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_coso_s"
                           value="<?= base64_encode($glo_lang['co_so']) ?>">
                    <select disabled onchange="onChange(<?=$id?>)" class="cls_data_check_form form-control" name="s_coso"
                            id="s_coso<?=$id?>" data-rong="1"
                            data-msso="<?= $glo_lang['chon_co_so'] ?>">
                        <option value=""><?= $glo_lang['co_so'] ?></option>
                    </select>
                </div>
            </li>
            <div class="clr"></div>
            <h3>
                <a id="dat_ban<?=$id?>" onclick="return CHECK_send_datban('<?= $full_url ?>/','#form_datban<?=$id?>', '.cls_data_check_form')">
                    <?= $glo_lang['dat_ban_ngay'] ?><img src="images/loading2.gif"
                                                         class="ajax_img_loading"></a>
                <input type="hidden" name="idform" id="idform" value="<?=$id?>">
                <input type="hidden" name="id_token<?=$id?>" id="id_token<?=$id?>" value="<?= $_SESSION['token'.$id] = md5(RANDOM_chuoi(5)) ?>">
            </h3>
        </ul>
    </div>
</form>