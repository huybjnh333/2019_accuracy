<?php
$foot = DB_fet("*", "#_seo_name", "`opt` = 0", "`id` asc", "1", 1, 1);
$foot = reset($foot);
include _using."doitac_home.php";
?>
<div class="footer_bottom">
    <div class="pagewrap">
        <div class="flex">
            <div class="footer_company">
                <h2><?= $foot['tenbaiviet_' . $lang] ?></h2>
                <ul>
                    <?= $foot['noidung_' . $lang] ?>
                </ul>
            </div>
            <div class="map_footer">
                <iframe data-iframely-url="<?= $thongtin['maplink'] ?>" width="600" height="450" frameborder="0"
                        style="border:0;"
                        allowfullscreen=""></iframe>
            </div>
            <div class="dangkynhantin_footer">
                <h2><?= $glo_lang['dang_ky_nhan_tin'] ?></h2>
                <p><?= $glo_lang['noidung_dangky_nhantin'] ?></p>
                <ul>
                    <form action="" class="formBox " accept-charset="UTF-8" method="post" name="dk_email_nhantin"
                          id="dk_email_nhantin"
                          enctype="multipart/form-data">
                        <div class="col-md-7 row-frm">
                            <input type="text" name="ip_sentmail" id="ip_sentmail" class="form-control"
                                   placeholder="<?= $glo_lang['diachiemail'] ?> *">
                            <a onclick="DANGKY_email('<?= $full_url ?>')" class="cur">
                                <h4 class="dang_ky"><?= $glo_lang['dang_ky'] ?></h4>
                                <img src="images/loading2.gif" class="ajax_img_loading">
                            </a>
                            <input name="capcha_hd" type="hidden" id="capcha_hd" value="">
                        </div>
                        <div class="clr"></div>
                    </form>
                </ul>
                <div class="clr"></div>
            </div>
        </div>

        <div class="clr"></div>
        <div class="copyright_bottom">
            <p>Copyright © 2019 <?= $glo_lang['ban_quyen_name'] ?> <?= $thongtin['tencongty_' . $lang] ?> <a
                        href="https://web30s.vn/" title="thiết kế website"
                        target="_blank"><?= $glo_lang['thiet_ke_va_phat_trien'] ?></a> <a href="https://web30s.vn/"
                                                                                          target="_blank"> P.A Việt
                    Nam</a></p>
            <p><?= $glo_lang['dang_online'] ?>:<?= ONLINE_user(600, $_SESSION['ttwebsession']) ?> |
                <?= $glo_lang['tong_online'] ?>: <?= THONGKE_online() ?></p>
            <?php include _using . "sharelink_footer.php"; ?>
        </div>
    </div>
</div>
<div id="back-top"><a href="#top">TOP</a></div>
<a href="tel:<?= $thongtin['hotline_' . $lang] ?>" class="popup dmd-phone dmd-green dmd-show mobile"
   title="Hotline">
    <div class="dmd-ph-circle"></div>
    <div class="dmd-ph-circle-fill"></div>
    <div class="dmd-ph-img-circle"></div>
</a>
