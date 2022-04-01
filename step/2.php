<?php
include _source . "phantrang_kietxuat.php";
$bvlienquan = DB_fet("*", "#_baiviet", "`showhi` = 1 and step = 3", "id asc", "1", 1);
$bvlienquan = reset($bvlienquan);
$noidung = $bvlienquan['noidung_' . $lang];

$danhmuc = DB_fet("*", "#_danhmuc", "`showhi` = 1 AND `id_parent` = 0 and step = " . $slug_step,
    "catasort asc, id asc", "", 1, 1);
$sptn_cha = DB_fet("*",
    "#_baiviet_tinhnang",
    "`showhi` = 1 AND `step` = $slug_step AND id IN(2,3,4,5) AND id_parent = 0",
    "catasort asc, id asc",
    "",
    1,
    1);
?>
<div class="conten">
    <?php include _source . "box-header.php"; ?>
    <div class="pagewrap page_conten_page">
        <div class="pro_home pro_home_2 flex">
            <?php
            if ($nd_total == 0) {
                echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
            } else {
                while ($value = mysql_fetch_array($nd_kietxuat)) {
                    $tbv = $value['tenbaiviet_' . $lang];
                    $ma_sp = $value['p1'];
                    $url = $full_url . "/" . $value['seo_name'];
                    $image = $fullpath . "/" . $value['duongdantin'] . "/" . $value['icon'];
                    $detail_vi = $value['detail_' . $lang];
                    ?>
                    <ul itemscope itemtype="http://schema.org/ScholarlyArticle">
                        <a href="<?= $url ?>">
                            <li>
                                <img class="lazy"
                                     itemprop="image"
                                     alt="<?= $tbv ?>"
                                     src="<?= $fullpath ?>/images/no-image.png"
                                     data-srcset="<?= $image ?> 2x, <?= $image ?> 1x"
                                     data-src="<?= $image ?>"/>
                            </li>
                            <h4 itemprop="headline" class="limit-row-2"><?= $tbv ?></h4>
                            <p class="limit-row-2 <?= empty($ma_sp) ? "hidden" : "" ?>"><?= $glo_lang['cart_ma_sp'] ?>
                                : <?= $ma_sp ?></p>
                            <?php
                            foreach ($sptn_cha as $val) {
                                ?>
                                <p class="limit-row-2 <?= empty(tinhnangsp($val['id'], $detail_vi, 2, $lang)) ? "hidden" : "" ?>"><?= $val['tenbaiviet_' . $lang] ?>
                                    : <?= tinhnangsp($val['id'], $detail_vi, 2, $lang); ?></p>
                            <?php } ?>
                        </a>
                    </ul>
                <?php }
            } ?>
            <div class="clr"></div>
        </div>
        <div class="nums">
            <ul>
                <?= PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty, $_SERVER['QUERY_STRING']) ?>
            </ul>
            <div class="clr"></div>
        </div>
    </div>
</div>


