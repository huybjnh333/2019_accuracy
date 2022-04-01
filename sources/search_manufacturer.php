<?php
include _source . "phantrang_kietxuat.php";
?>
<div class="link_page">
    <div class="pagewrap">
        <ul>
            <li><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a></li>
            <li>
                <a href="<?= $full_url . '/' . $motty . '/' . $haity . '/' ?>">
                    <i class="fa fa-angle-double-right" aria-hidden="true"></i><?= $glo_lang[$motty] ?>
                </a>
            </li>

        </ul>
        <div class="clr"></div>
    </div>
</div>
<div class="pagewrap conten_page">
    <div class="conten_left">
        <?php include _source . "left_conten.php"; ?>
    </div>
    <div class="conten_right">

        <div class="box_id_home">
            <div class="title_tin_id">
                <h3><?= $glo_lang['danh_sach_san_pham'] ?></h3>
            </div>
            <div class="pro_home_id_2 flex">
                <?php
                if ($nd_total == 0) {
                    echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
                } else {
                    $i = 0;
                    while ($rows = mysql_fetch_array($nd_kietxuat)) {
                        $images = $fullpath . '/' . $rows['duongdantin'] . '/' . $rows['icon'];
                        $tenbv = $rows['tenbaiviet_' . $lang];
                        $mota = $rows['mota_' . $lang];
                        $urlbv = $full_url . '/' . $rows['seo_name'];
                        $ngaydang = date('d/m/Y', $rows['ngaydang']);
                        $giatien = $rows['giatien'];
                        $giamgiaphantram = 0;
                        $giakhuyenmai = $rows['giakm'];
                        if ($giakhuyenmai > 0 && $giakhuyenmai <= 100) {
                            $giamgiaphantram = $giakhuyenmai;
                            $giakhuyenmai = number_format($giatien - ($giatien * ($giakhuyenmai / 100))) . ' ' . $glo_lang['dvt'];

                        } else {
                            $giakhuyenmai = number_format($giakhuyenmai) . ' ' . $glo_lang['dvt'];
                        }
                        if ($giatien <= 0) {
                            $giatien = $glo_lang['lien_he'];
                        } else {
                            $giatien = number_format($giatien) . ' ' . $glo_lang['dvt'];
                        }
                        $masp = $rows['p1'];
                        ?>
                        <ul itemscope itemtype="http://schema.org/ScholarlyArticle">
                            <a href="<?= $urlbv ?>" title="<?= $tenbv ?>">
                                <div class="discount-tag <?= (empty($giamgiaphantram)) ? "hidden" : "" ?>">
                                    <?= $giamgiaphantram ?>%
                                </div>
                                <li>
                                    <img itemprop="image" alt="<?= $tenbv ?>" src="<?= $images ?>"/>
                                </li>
                                <h3 itemprop="headline"><?= $tenbv ?></h3>
                                <?php if ($giakhuyenmai > 0 && $rows['opt_km'] > 0) { ?>
                                    <h4><?= $giakhuyenmai ?> <span><?= $giatien ?></span></h4>
                                <?php } else { ?>
                                    <h4><?= $giatien ?></h4>
                                <?php } ?>
                                <p><?= $glo_lang['cart_ma_sp'] ?>: <?= $masp ?></p>
                            </a>
                        </ul>
                    <?php }
                } ?>
                <div class="clr"></div>
            </div>
            <div class="nums">
                <ul>
                    <?= PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty . '/' . $haity . '/', $_SERVER['QUERY_STRING']) ?>
                </ul>
                <div class="clr"></div>
            </div>
        </div>
    </div>
    <div class="clr"></div>
</div>
