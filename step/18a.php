<?php
include _source . 'box-header.php';
$images = $fullpath . '/' . $arr_running['duongdantin'] . '/' . $arr_running['icon'];

$chucdanh = array();
$array_tempchucdanh = DB_fet("*",
    "#_danhmuc",
    "`showhi` = 1 AND `step` = 5",
    "`catasort` DESC, `id` DESC",
    "",
    1,
    1);
foreach ($array_tempchucdanh as $rowchucdanh) {
    $chucdanh[$rowchucdanh['id']] = $rowchucdanh['tenbaiviet_' . $lang];
}
$idparent = $arr_running['id_parent'];

$giangvienlienquan = $array_tempchucdanh = DB_fet("*",
    "#_baiviet",
    "`showhi` = 1 and step=5 and id_parent=" . $idparent,
    "RAND()",
    "8",
    1,
    1, "");


?>
<div class="pagewrap page_conten_page">
    <div class="padding_pagewrap">
        <div class="images_gs_id">
            <img alt="<?= $arr_running['tenbaiviet_' . $lang] ?>" src="<?= $images ?>"/>
        </div>
        <div class="chitiet_gs">
            <div class="showText">
                <h2><?= $arr_running['tenbaiviet_' . $lang] ?></h2>
                <h3><?= $chucdanh[$idparent] ?></h3>
                <p><?= $arr_running['noidung_' . $lang] ?> </p>
            </div>
            <div id="sharelink">
                <!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style "><a class="addthis_button_facebook_like"
                                                                       fb:like:layout="button_count"></a> <a
                            class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone"
                                                                 g:plusone:size="medium"></a> <a
                            class="addthis_counter addthis_pill_style"></a></div>
                <script type="text/javascript"
                        src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-502225fb496239a5"></script>

                <!-- AddThis Button END -->
            </div>
        </div>
        <div class="clr"></div>
        <?php include _source . "y-kien-ban-doc.php"; ?>
    </div>

</div>

<div class="box_giaovien_home">
    <div class="pagewrap">
        <div class="title_id"><?= $glo_lang['dangkyungtuyen'] ?></div>
        <div class="padding_pagewrap">

            <div class="contact">
                <form action="" class="formBox no_box" method="post" accept-charset="UTF-8" name="formnamecontact"
                      id="formnamecontact">
                    <input type="hidden" name="dangky-ungtuyen">
                    <input type="hidden" class="lang_ok" value="<?= $glo_lang['yeu_cau_cua_ban_da_duoc_gui'] ?>">
                    <input type="hidden" class="lang_false" value="<?= $glo_lang['nhap_ma_bao_ve_chua_dung'] ?>">
                    <input type="hidden" name="tieude_lienhe"
                           value="<?= base64_encode($glo_lang['dangkyungtuyen']) ?>">
                    <div class="left">
                        <li class="name">
                            <input type="hidden" name="s_fullname_s"
                                   value="<?= base64_encode($glo_lang['ho_va_ten']) ?>">
                            <input class="cls_data_check_form form-control" data-rong="1" name="s_fullname"
                                   id="s_fullname" type="text"
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
                            <input class="cls_data_check_form form-control" data-rong="1" data-phone="1"
                                   name="s_dienthoai" id="s_dienthoai"
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
                            <input class="cls_data_check_form form-control" data-rong="1" data-email="1"
                                   name="s_email" id="s_email" type="text"
                                   placeholder="<?= $glo_lang['email'] ?> (*)"
                                   value="<?= !empty($_POST['s_email']) ? $_POST['s_email'] : '' ?>"
                                   onFocus="if (this.value == '<?= $glo_lang['email'] ?> (*)'){this.value='';}"
                                   onBlur="if (this.value == '') {this.value='<?= $glo_lang['email'] ?> (*)';}"
                                   data-msso="<?= $glo_lang['chua_nhap_dia_chi_email'] ?>"
                                   data-msso1="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>"/>
                        </li>
                    </div>
                    <div class="right">
                        <li class="local">
                            <input type="hidden" name="s_address_s" value="<?= base64_encode($glo_lang['dia_chi']) ?>">
                            <input name="s_address" id="s_address" type="text" placeholder="<?= $glo_lang['dia_chi'] ?>"
                                   value="<?= !empty($_POST['s_address']) ? $_POST['s_address'] : @$diachi ?>"
                                   onFocus="if (this.value == '<?= $glo_lang['dia_chi'] ?>'){this.value='';}"

                                   onBlur="if (this.value == '') {this.value='<?= $glo_lang['dia_chi'] ?>';}"/>
                        </li>
                        <li class="row-frm">
                            <input type="hidden" name="s_rank_s" value="<?= base64_encode($glo_lang['rank']) ?>">
                            <select data-rong="1" data-msso="<?= $glo_lang['thongtincapbac'] ?>"
                                    name="s_rank"
                                    id="s_rank"
                                    class="cls_data_check_form form-control">
                                <option value=""><?= $glo_lang['choncapbac'] ?></option>
                                <?php foreach ($chucdanh as $k => $row) { ?>
                                    <option value="<?= $row ?>"><?= $row ?></option>
                                <?php } ?>
                            </select>
                        </li>
                        <li class="code">
                        <span style="line-height: 0;padding-right: 0;"><img src="<?= $full_url . "/load-capcha/" ?>"
                                                                            alt="CAPTCHA code"
                                                                            style="height: 37px; width: auto; cursor: pointer; position: relative; top: 1px; right: 1px;"
                                                                            onclick="$(this).attr('src','<?= $full_url . "/load-capcha/" ?>')"
                                                                            id="img_contact_cap"><i
                                    class="fa fa-refresh"
                                    style="position: absolute; right: 3px; bottom: 3px; font-size: 10px; color: #666;"
                                    onclick="$('#img_contact_cap').attr('src','<?= $full_url . "/load-capcha/" ?>')"></i></span>
                            <input class="cls_data_check_form_dangkyhoc" data-rong="1" name="mabaove" id="mabaove"
                                   type="text"
                                   placeholder="<?= $glo_lang['ma_bao_ve'] ?> (*)" value=""
                                   onFocus="if (this.value == '<?= $glo_lang['ma_bao_ve'] ?> (*)'){this.value='';}"
                                   onBlur="if (this.value == '') {this.value='<?= $glo_lang['ma_bao_ve'] ?> (*)';}"
                                   data-msso="<?= $glo_lang['vui_long_nhap_ma_bao_ve'] ?>"/>
                        </li>
                        <a onclick="RefreshFormMailContact(formnamecontact)" style="cursor:pointer"
                           class="button"><?= $glo_lang['lam_lai'] ?></a>
                        <a onclick="return CHECK_send_lienhe('<?= $full_url ?>/','#formnamecontact','.cls_data_check_form')"
                           style="cursor:pointer"
                           class="button"><?= $glo_lang['gui'] ?> <img src="images/loading2.gif"
                                                                       class="ajax_img_loading"></a>
                    </div>
                    <div class="clr"></div>
                    <input name="mabaovehidden" type="hidden" id="mabaovehidden" value="489540">
                </form>
            </div>
        </div>
    </div>
</div>
<div class="tintuc_box_home">
    <div class="pagewrap">
        <div class="titBox left cus">
            <div class="tit"><?= $glo_lang['bai_viet_lien_quan'] ?></div>
        </div>
        <div class="bs_gv_id">
            <div class="placeSlide_main">
                <div class="owl-carousel owl-theme flex placeSlide_3" id="owl-giangvien">
                    <?php foreach ($giangvienlienquan as $row) {
                        $images = $fullpath . '/' . $row['duongdantin'] . '/' . $row['icon'];
                        $tenbaiviet = $row['tenbaiviet_' . $lang];
                        $seo_name = $full_url . '/' . $row['seo_name'];
                        $mota = $row['mota_' . $lang];
                        $idparent = $row['id_parent'];
                        ?>
                        <div class="item">
                            <ul>
                                <li><img alt="<?= $tenbaiviet ?>" src="<?= $images ?>"/></li>
                                <h3><?= $tenbaiviet ?></h3>
                                <h4><?= $chucdanh[$idparent] ?></h4>
                                <div class="bg_ct_gv"><a href="<?= $seo_name ?>">
                                        <h3><?= $tenbaiviet ?></h3>
                                        <h4><?= $chucdanh[$idparent] ?></h4>
                                        <p><?= $mota ?></p>
                                    </a></div>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
                <script type="text/javascript">
                    jQuery(document).ready(function () {
                        jQuery("#owl-giangvien").owlCarousel({
                            lazyLoad: true,
                            loop: <?= (count($giangvienlienquan) > $width1199) ? true : false?>,
                            nav: true,
                            autoplay: true,
                            autoplayTimeout: 5000,
                            autoplayHoverPause: true,
                            responsiveClass: true,
                            responsive: {
                                0: {
                                    items: <?=$width479?>
                                }, 319: {
                                    items: <?=$width479?>
                                }, 479: {
                                    items: <?=$width479?>
                                }, 767: {
                                    items: <?=$width767?>
                                }, 991: {
                                    items:<?=$width991?>
                                }, 1199: {
                                    items: <?=$width1199?>
                                }
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>