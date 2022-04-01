<?php
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    // ALERT_js($glo_lang['hien_chua_co_san_pham_nao_trong_gio_hang']);
    LOCATION_js($full_url);
}
if (isset($_POST['xoa_sp'])) {
    if (isset($_SESSION['cart'][$_POST['id_die']])) unset($_SESSION['cart'][$_POST['id_die']]);
    if (count($_SESSION['cart']) == 0) unset($_SESSION['cart']);
}
$thongtin_step = DB_que("SELECT * FROM `#_step` WHERE `showhi` = 1 AND `id` = 3 LIMIT 1");
$thongtin_step = mysql_fetch_assoc($thongtin_step);

$link_cart = GET_link($full_url, SHOW_text(laySeoName('seo_name', '#_step', '`showhi` = 1 AND `step` = 2')));
if (isset($_SESSION['email'])) {
    $info_acc = DB_fet("*", "#_members", "`email` = '" . $_SESSION['email'] . "' AND `phanquyen` = 0", "`id` DESC");
    $info_acc = mysql_fetch_assoc($info_acc);
    $hoten = $info_acc['hoten'];
    $sodienthoai = $info_acc['sodienthoai'];
    $email = $info_acc['email'];
    $diachi = $info_acc['diachi'];
} else {
    $hoten = '';
    $sodienthoai = '';
    $email = '';
    $diachi = '';
}
?>
<?php
$thongtin_step['id'] = 3;
//include _source . 'banner_child.php';
//include _source. "paypal.php";
?>
<div class="title_page">
    <h3><?= $glo_lang['dat_hang'] ?></h3>
    <ul>
        <li><i class="fa fa-home"></i><a href="<?= $full_url . '/'; ?>"><?= $glo_lang['trang_chu']; ?></a>
            <i class="fa fa-angle-double-right"></i><a href="<?= $full_url . '/gio-hang/' ?>"><?= $glo_lang['gio_hang'] ?></a>
            <i class="fa fa-angle-double-right"></i><a href="<?= $full_url . '/dat-hang/' ?>"><?= $glo_lang['dat_hang'] ?></a>
        </li>
    </ul>
    <div class="clr"></div>
</div>
            <div class="padding_pagewrap">
                <div class="contact contact_lh no_box">

                    <form class="formBox" method="post" name="FormNameContact_cart" id="FormNameContact_cart">
                        <input type="hidden" name="gui_donhang">
                        <input type="hidden" class="lang_ok" value="<?= $glo_lang['don_hang_cua_ban_da_duoc_gui'] ?>">
                        <input type="hidden" class="lang_false" value="<?= $glo_lang['nhap_ma_bao_ve_chua_dung'] ?>">
                        <input type="hidden" id="id_token" value="gui_donhang">
                        <div class="left">
                            <h2><?= $glo_lang['thong_tin_nguoi_mua_hang'] ?></h2>
                            <li class="name">
                                <input type="hidden" name="s_fullname_s"
                                       value="<?= base64_encode($glo_lang['ho_va_ten']) ?>">
                                <input class="cls_data_check_form" data-rong="1" name="s_fullname" id="s_fullname"
                                       type="text"
                                       placeholder="<?= $glo_lang['ho_va_ten'] ?> (*)"
                                       value="<?= !empty($_POST['s_fullname']) ? $_POST['s_fullname'] : @$hoten ?>"
                                       onFocus="if (this.value == '<?= $glo_lang['ho_va_ten'] ?> (*)'){this.value='';}"
                                       onBlur="if (this.value == '') {this.value='<?= $glo_lang['ho_va_ten'] ?> (*)';}"
                                       data-name="<?= $glo_lang['ho_va_ten'] ?> (*)"
                                       data-msso="<?= $glo_lang['nhap_ho_ten'] ?>"/>
                            </li>
                            <li class="phone">
                                <input type="hidden" name="s_dienthoai_s"
                                       value="<?= base64_encode($glo_lang['so_dien_thoai']) ?>">
                                <input class="cls_data_check_form" data-rong="1" data-phone="1" name="s_dienthoai"
                                       id="s_dienthoai"
                                       type="text" placeholder="<?= $glo_lang['so_dien_thoai'] ?> (*)"
                                       value="<?= !empty($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : @$sodienthoai ?>"
                                       onFocus="if (this.value == '<?= $glo_lang['so_dien_thoai'] ?> (*)'){this.value='';}"
                                       onBlur="if (this.value == '') {this.value='<?= $glo_lang['so_dien_thoai'] ?> (*)';}"
                                       data-name="<?= $glo_lang['so_dien_thoai'] ?> (*)"
                                       data-msso="<?= $glo_lang['nhap_so_dien_thoai'] ?>"
                                       data-msso1="<?= $glo_lang['so_dien_thoai_khong_hop_le'] ?>"/>
                            </li>
                            <li class="mail">
                                <input type="hidden" name="s_email_s" value="<?= base64_encode($glo_lang['email']) ?>">
                                <input data-rong="1" data-email="1" name="s_email" id="s_email"
                                       type="text"
                                       placeholder="<?= $glo_lang['email'] ?>"
                                       value="<?= !empty($_POST['s_email']) ? $_POST['s_email'] : @$email ?>"
                                       onFocus="if (this.value == '<?= $glo_lang['email'] ?> (*)'){this.value='';}"
                                       onBlur="if (this.value == '') {this.value='<?= $glo_lang['email'] ?>';}"
                                       data-msso="<?= $glo_lang['chua_nhap_dia_chi_email'] ?>"
                                       data-msso1="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>"/>
                            </li>
                            <li class="local">
                                <input type="hidden" name="s_address_s"
                                       value="<?= base64_encode($glo_lang['dia_chi']) ?>">
                                <input name="s_address" id="s_address" type="text"
                                       placeholder="<?= $glo_lang['dia_chi'] ?>"
                                       value="<?= !empty($_POST['s_address']) ? $_POST['s_address'] : @$diachi ?>"
                                       onFocus="if (this.value == '<?= $glo_lang['dia_chi'] ?>'){this.value='';}"
                                       onBlur="if (this.value == '') {this.value='<?= $glo_lang['dia_chi'] ?>';}"/>
                            </li>
                        </div>
                        <div class="right">
                            <li class="mess">
                                <input type="hidden" name="s_message_s"
                                       value="<?= base64_encode($glo_lang['noi_dung_lien_he']) ?>">
                                <textarea style="height: 200px;" data-rong="1" name="s_message"
                                          id="s_message" cols=""
                                          rows=""
                                          placeholder="<?= $glo_lang['noi_dung'] ?>"
                                          data-msso="<?= $glo_lang['nhap_noi_dung'] ?>"><?= !empty($_POST['s_message']) ? $_POST['s_message'] : '' ?></textarea>
                                <div class="clr"></div>
                            </li>

                            <li class="code">
            <span style="line-height: 0;padding-right: 0;"><img src="<?= $full_url . "/load-capcha/" ?>"
                                                                alt="CAPTCHA code"
                                                                style="height: 37px; width: auto; cursor: pointer; position: relative; top: 1px; right: 1px;"
                                                                onclick="$(this).attr('src','<?= $full_url . "/load-capcha/" ?>')"
                                                                id="img_contact_cap"><i class="fa fa-refresh"
                                                                                        style="position: absolute; right: 3px; bottom: 3px; font-size: 10px; color: #666;"
                                                                                        onclick="$('#img_contact_cap').attr('src','<?= $full_url . "/load-capcha/" ?>')"></i></span>
                                <input class="cls_data_check_form" data-rong="1" name="mabaove" id="mabaove" type="text"
                                       placeholder="<?= $glo_lang['ma_bao_ve'] ?> (*)" value=""
                                       onFocus="if (this.value == '<?= $glo_lang['ma_bao_ve'] ?> (*)'){this.value='';}"
                                       onBlur="if (this.value == '') {this.value='<?= $glo_lang['ma_bao_ve'] ?> (*)';}"
                                       data-msso="<?= $glo_lang['vui_long_nhap_ma_bao_ve'] ?>"/>
                            </li>
<!--                            <p class="require_pc" style="color:red;">--><?//= $glo_lang['thong_tin_bat_buoc'] ?><!--</p>-->
                            <div id="payment_method">
                                <h3><?= $glo_lang['phuong_thuc_thanh_toan'] ?> (*)</h3>
                                <ul>
                                    <li class="payment_method_input">
                                        <label>
                                            <input type="radio" value="1" name="type_payment"
                                                   id="type1" <?= empty($_POST['type_payment']) || $_POST['type_payment'] == 1 ? 'checked="checked"' : '' ?> >
                                            <span><?= $glo_lang['thanh_toan_tien_mat'] ?></span>
                                            <div class="clr"></div>
                                        </label>
                                    </li>
                                    <li class="payment_method_input">
                                        <label>
                                            <input type="radio" value="2" name="type_payment"
                                                   id="type2" <?= !empty($_POST['type_payment']) && $_POST['type_payment'] == 2 ? 'checked="checked"' : '' ?>><span><?= $glo_lang['thanh_toan_chuyen_khoan'] ?></span>
                                            <div class="clr"></div>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <a onclick="RefreshFormMailContact(FormNameContact_cart)" style="cursor:pointer"
                               class="button"><?= $glo_lang['lam_lai'] ?></a>
                            <a onclick="return CHECK_send_lienhe('<?= $full_url ?>/','#FormNameContact_cart','.cls_data_check_form')"
                               style="cursor:pointer"
                               class="button"><?= $glo_lang['gui_don_hang'] ?> <img src="images/loading2.gif"
                                                                                    class="ajax_img_loading"></a>
                        </div>
                        <div class="clr"></div>
                    </form>
                </div>

            </div>
        </div>
        <div class="box_id_home">
            <div class="title_id">
                <h3><?=$glo_lang['thong_tin_don_hang']?></h3>
            </div>
            <div class="padding_pagewrap">
                <div id="cart_list">
                    <form action="" method="post">
                        <div id="cart_list" class="dv-table-reposive">
                            <table width="100%" border="0" cellspacing="1" cellpadding="5">
                                <tr>
                                    <th width="7%"><?= $glo_lang['cart_hinh'] ?></th>
                                    <th width="38%"><?= $glo_lang['cart_ten_sp'] ?></th>
                                    <th width="10%"><?= $glo_lang['cart_ma_sp'] ?></th>
                                    <th width="12%"><?= $glo_lang['cart_qty'] ?></th>
                                    <th width="10%"><?= $glo_lang['cart_dongia'] ?></th>
                                    <th width="10%"><?= $glo_lang['cart_thanhtien'] ?></th>
                                    <th width="10%"><?= $glo_lang['cart_thaotac'] ?></th>
                                </tr>
                                <?php
                                $tongtien = 0;
                                $stt = 0;
//                                $tamtinh = 0;
                                foreach ($_SESSION['cart'] as $key => $value) {
                                    $sanpham = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` = 1 AND `id` = '" . $key . "' LIMIT 1");
                                    if (mysql_num_rows($sanpham) > 0) {
                                        $sanpham = mysql_fetch_array($sanpham);
                                        $dongia = $sanpham['giatien'];
                                        $idsp = $sanpham['id'];
                                        $giasp = $sanpham['giatien'];
                                        $giakm = $sanpham['giakm'];
                                        $optkm = $sanpham['opt_km'];
                                        $giamgiaphantram = 0;
                                        if ($giakm < 100 && $giakm > 0) {
                                            $giamgiaphantram = $giakm;
                                        }
                                        if ($optkm > 0 && $giakm > 0) {
                                            $temp = $giasp;
                                            $giasp = $giakm;
                                            $giakm = $temp;
                                            $dongia = $giasp;
                                            if ($giamgiaphantram > 0) {

                                                $dongia = $giakm - ($giakm * ($giamgiaphantram / 100));
                                            }
                                        }
                                        $thanhtien = $dongia * $value;
                                        $tongtien += $thanhtien;
//                                        $tamtinh += $thanhtien;
                                        $size = 1;
                                        $stt++;
                                        ?>
                                        <tr>
                                            <td title="<?= $glo_lang['cart_hinh'] ?>" class="cls_cart_mb">
                                                <img src="<?= checkImage($fullpath, $sanpham['icon'], $sanpham['duongdantin'], 'thumb_') ?>"
                                                     alt="<?= SHOW_text($sanpham['tenbaiviet_' . $_SESSION['lang']]) ?>"/>
                                            </td>
                                            <td title="<?= $glo_lang['cart_ten_sp'] ?>" style="text-align:left">
                                                <a href="<?= GET_link($full_url, SHOW_text($sanpham['seo_name'])) ?>"><?= SHOW_text($sanpham['tenbaiviet_' . $_SESSION['lang']]) ?></a>
                                            </td>
                                            <td title="<?= $glo_lang['cart_ma_sp'] ?>"
                                                class="cls_cart_mb"><?= SHOW_text($sanpham['p1']) ?></td>
                                            <td title="<?= $glo_lang['cart_qty'] ?>">

                                                <div class="mobileqty">
                                                    <input type="button"
                                                           value="-"
                                                           class="qtyminus"
                                                           field="quantity"
                                                           onclick="TextBox_AddToIntValue(<?= $idsp ?>,-1,'<?= $full_url . "/update-qty/" ?>')">
                                                    <input id="product-quantity-<?= $idsp ?>"
                                                           name="" value="<?= $value ?>"
                                                           type="text"
                                                           onchange='updateQty("<?= $full_url . "/update-qty/" ?>","<?= $key ?>", this,<?= $size ?>)'/>
                                                    <input type="button"
                                                           value="+"
                                                           class="qtyplus"
                                                           field="quantity"
                                                           onclick="TextBox_AddToIntValue(<?= $idsp ?>,+1,'<?= $full_url . "/update-qty/" ?>')">
                                                </div>
                                            </td>
                                            <td title="<?= $glo_lang['cart_dongia'] ?>"
                                                style="text-align:right"><?= ($dongia == 0) ? 0 : NUMBER_fomat($dongia) ?></td>
                                            <td title="<?= $glo_lang['cart_thanhtien'] ?>" style="text-align:right"
                                                class="td_thanhtien_<?= $key ?>"><?= ($thanhtien == 0) ? 0 : NUMBER_fomat($thanhtien) ?></td>
                                            <td title="<?= $glo_lang['cart_thaotac'] ?>">
                                                <form action="" method="post">
                                                    <input type="hidden" name="id_die" value="<?= $key ?>">
                                                    <button type="submit" class="pro_del" name="xoa_sp"
                                                            onclick="comfirmNoty({
                                                                    mess: 'Bạn thật sự muốn xóa ?',
                                                                    type: 'warning',
                                                                    postion: 1,
                                                                    submit:'<?= $full_url ?>/dat-hang/?id_die=<?= $key ?>'
                                                                    })"><?= $glo_lang['cart_xoa'] ?></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php }
                                } ?>
                            </table>
                        </div>
                        <table width="100%" border="0" cellspacing="1" cellpadding="5">
                            <tr>
                                <td class="money-total" colspan="7">
                                    <input type="hidden" class="cls_datafalse"
                                           value="<?= $glo_lang['alert_dat_hang'] ?>">
                                    <span id="pro_sum"><?= $glo_lang['cart_tong_tien'] ?>:
                <label class='tb_tongtien'><?= NUMBER_fomat($tongtien) . " " . $glo_lang['dvt']; ?></label>
                </span></td>
                            </tr>
                            <tr>
                                <td colspan="7"><a href="<?= $link_cart ?>"
                                                   class="pro_del mar"><?= $glo_lang['tiep_tuc_mua_hang'] ?></a>
                                    <a onclick="window.location.reload()"
                                       class="cur pro_del mar"><?= $glo_lang['cap_nhat_so_luong'] ?></a>
                                </td>
                            </tr>
                        </table>

                    </form>
                    <div class="clr"></div>
                </div>
            </div>
<script>
    $('#s_tp').change(function () {
        var id = $('#s_tp').val();
        $.post(
            "<?=$full_url . '/thanh-pho'?>",
            {idtp: id},
            function (data) {
                var result = JSON.parse(data);
                $("#s_quan").html(result.dataquan);
                $("#s_phuong").html(result.dataphuong);
            });
    });
    $(document).ready(function () {
        $('#s_quan').change(function () {
            var idtp = $('#s_tp').val();
            var idquan = $('#s_quan').val();
            $.post(
                "<?=$full_url . '/quan'?>",
                {idtp: idtp, idquan, idquan},
                function (data) {
                    var result = JSON.parse(data);
                    $("#s_phuong").html(result.dataphuong);
                });
        });
    });

</script>
