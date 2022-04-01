<?php
include _source . "phantrang_kietxuat.php";
?>
<div class="conten">
    <?php include _source . "box-header.php"; ?>
    <div class="pagewrap page_conten_page">
        <?php
        if ($slug_step == 3) {
            ?>
            <div class="pro_home flex">
                <?php
                if ($nd_total == 0) {
                    echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
                } else {
                    while ($value = mysql_fetch_array($nd_kietxuat)) {
                        $tbv = $value['tenbaiviet_' . $lang];
                        $url = $full_url . "/" . $value['seo_name'];
                        $image = $fullpath . "/" . $value['duongdantin'] . "/" . $value['icon'];
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
                                <h4 class="limit-row-3" itemprop="headline"><?= $tbv ?></h4>
                            </a>
                        </ul>
                    <?php }
                } ?>
                <div class="clr"></div>
            </div>
        <?php } else { ?>
            <div class="tintuc_home_id flex">
                <?php
                if ($nd_total == 0) {
                    echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
                } else {
                    while ($value = mysql_fetch_array($nd_kietxuat)) {
                        $tbv = $value['tenbaiviet_' . $lang];
                        $url = $full_url . "/" . $value['seo_name'];
                        $image = $fullpath . "/" . $value['duongdantin'] . "/" . $value['icon'];
                        $mota = strip_tags($value['mota_' . $lang]);
                        $ngaydang = date("l", $value['ngaydang']);
                        $ngaydang = CONVER_thu($ngaydang, $glo_lang);
                        $giodang = date("H:i", $value['ngaydang']);
                        $date = date("d/m/Y", $value['ngaydang']);
                        ?>
                        <ul itemscope itemtype="http://schema.org/ScholarlyArticle">
                            <li><a href="<?= $url ?>">
                                    <img class="lazy"
                                         itemprop="image"
                                         alt="<?= $tbv ?>"
                                         src="<?= $fullpath ?>/images/no-image.png"
                                         data-srcset="<?= $image ?> 2x, <?= $image ?> 1x"
                                         data-src="<?= $image ?>"/>
                                </a>
                            </li>
                            <h4>
                                <i class="fa fa-calendar"></i><?= " " . $ngaydang . ", " . $giodang . "  " . $glo_lang['date'] . " " . $date ?>
                            </h4>
                            <h3 itemprop="headline" class="limit-row-3 step"><a href="<?= $url ?>"><?= $tbv ?></a></h3>
                            <p class="limit-row-4"><?= $mota ?></p>
                        </ul>
                    <?php }
                } ?>
                <div class="clr"></div>
            </div>
        <?php } ?>
        <div class="nums">
            <ul>
                <?= PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty, $_SERVER['QUERY_STRING']) ?>
            </ul>
            <div class="clr"></div>
        </div>
    </div>
</div>


