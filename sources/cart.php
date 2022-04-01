<?php

if (isset($_POST['xoa_sp'])) {
    if (isset($_SESSION['cart'][$_POST['id_die']])) unset($_SESSION['cart'][$_POST['id_die']]);
    if (count($_SESSION['cart']) == 0) unset($_SESSION['cart']);
}
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
    $_SESSION['cart'][$_GET['id']] = 1;
    LOCATION_js($full_url . "/gio-hang/");
}
if (isset($_POST['id_cart'])) {
    $idcart = $_POST['id_cart'];
    $_SESSION['cart'][$idcart] = $_POST['quantity'];
    LOCATION_js($full_url . "/gio-hang/");
}
if (empty($_SESSION['cart'])) {
    LOCATION_js($full_url);
}
?>

<?php
$thongtin_step['id'] = 3;
//include _source . 'banner_child.php';
?>
<div class="title_page">
    <h3><?= $glo_lang['gio_hang'] ?></h3>
    <ul>
        <li><i class="fa fa-home"></i><a href="<?= $full_url . '/'; ?>"><?= $glo_lang['trang_chu']; ?></a>
        <i class="fa fa-angle-double-right"></i><a href="<?= $full_url . '/gio-hang/' ?>"><?= $glo_lang['gio_hang'] ?></a>
        </li>
    </ul>
    <div class="clr"></div>
</div>
<div class="padding_pagewrap">
    <?php
    $link_cart = GET_link($full_url, SHOW_text(laySeoName('seo_name', '#_step', '`showhi` = 1 AND `step` = 2')));
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
        ?>
        <div class="cart-empty"><?= $glo_lang['hien_chua_co_san_pham_nao_trong_gio_hang'] ?></div>
        <div class="continue-shopping"><a href="<?= $link_cart ?>"><?= $glo_lang['tiep_tuc_mua_hang'] ?></a>
        </div>
        <?php
    } else {
        ?>
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
                        //                                    $tamtinh = 0;
                        $tongtien = 0;
                        $stt = 0;
                        foreach ($_SESSION['cart'] as $key => $value) {
                            $sanpham = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` = 1 AND `id` = '" . $key . "' LIMIT 1");
                            if (mysql_num_rows($sanpham) > 0) {
                                $sanpham = mysql_fetch_array($sanpham);
                                $idsp = $sanpham['id'];
                                $dongia = $sanpham['giatien'];
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
//                                            $tamtinh += $thanhtien;
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
                                                    onclick="return confirm('<?= $glo_lang['ban_that_su_muon_xoa'] ?>')"><?= $glo_lang['cart_xoa'] ?></button>
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
                            <a href="<?= $full_url ?>/dat-hang/"
                               class="pro_del mar"><?= $glo_lang['gui_don_hang'] ?></a></td>
                    </tr>
                </table>

            </form>
            <div class="clr"></div>
        </div>

    <?php } ?>
</div>


<script type="text/javascript">
    $(function () {
        $(".dangky_giohang ul h3 a").html("<?php if (isset($_SESSION['cart'])) echo count($_SESSION['cart']); else echo "0"; ?>");
    });

    function Giamgiamoney() {
        var totalmoney = <?= $tamtinh ?>;
        // totalmoney = $('.tb_tamtinh').html();
        // totalmoney = totalmoney.replace("VNĐ", "");
        var magiamgia = $('#magiam-gia').val();
        if (!isEmpty(magiamgia)) {
            $.post("ma-giam-gia", {totalmoney: totalmoney, magiamgia: magiamgia}).done(function (data) {
                    data = JSON.parse(data);
                    if (data.type == 1) {
                        $(".tb_giamgia").html(data.sotien);
                        $(".tb_tongtien").html(data.totalmoney_n);
                    } else {
                        $(".tb_giamgia").html(data.sotien);
                        $(".tb_tongtien").html(data.totalmoney_n);
                        alert(data.mess);
                    }
                }
            );
        }
    }
</script>

