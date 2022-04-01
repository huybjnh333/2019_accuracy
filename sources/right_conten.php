<?php
$tintuchot = DB_fet("*", "#_baiviet", "`showhi` = 1 and step=7", "catasort desc", "6", 1);
$tintuthongbao = DB_fet("*", "#_baiviet", "`showhi` = 1 and step=3", "catasort desc", "6", 1);
$QC1 = LAY_banner(" AND `id_parent` = 28");
$QC2 = LAY_banner(" AND `id_parent` = 25");
$arraydiff = array(8,9);
if (!empty($slug_step) && !in_array($slug_step,$arraydiff)) {
    $datastepright = DB_fet("*", "#_step", "`showhi` = 1 and id=" . $slug_step, "", "1", 1);
    $datastepright = reset($datastepright);
    $databv = DB_fet("*", "#_baiviet", "`showhi` = 1 and step=$slug_step", "catasort desc", "5", 1);
    $array_data = array(3, 4, 5, 6, 7);
    if (in_array($slug_step, $array_data)) {
        $databv = DB_fet("*", "#_danhmuc", "`showhi` = 1 and step=" . $slug_step, "", "", 1);
    }

    ?>
    <div class="menu_left_id">
        <ul>
            <h3><?= $datastepright['tenbaiviet_' . $lang] ?></h3>
            <?php foreach ($databv as $row) {
                $seonameleft = $full_url . '/' . $row['seo_name'];
                $tenbv = $row['tenbaiviet_' . $lang];
                ?>
                <li><a href="<?= $seonameleft ?>" title="<?= $tenbv ?>">» <?= $tenbv ?></a></li>
            <?php } ?>

    </div>
<?php }
?>

<div class="box_id_right">
    <div class="tittle_right_id"><?= $glo_lang['tintieudiem'] ?></div>
    <div class="newsRight">
        <div class="slideNews_box">
            <?php foreach ($tintuchot as $row) {
                $tenbv = $row['tenbaiviet_' . $lang];
                $hinhanh = $fullpath . '/' . $row['duongdantin'] . '/' . $row['icon'];
                $url = $full_url . '/' . $row['seo_name'];

                ?>
                <a ta href="<?= $url ?>"
                   title="<?= $tenbv ?>"> <img
                            src="<?= $hinhanh ?>"
                            alt="<?= $tenbv ?>"/>
                    <h2><?= $tenbv ?></h2>
                    <div class="clr"></div>
                </a>
            <?php } ?>
            <div class="clr"></div>
        </div>
    </div>
</div>
<div class="banner_right">
    <ul>
        <?php while ($r = mysql_fetch_array($QC1)) {
            $images = $fullpath . '/' . $r['duongdantin'] . '/' . $r['icon'];
            $link = $r['lien_ket'];
            $blank = $r['blank'];
            ?>
            <li>
                <a href="<?= $link ?>" target="<?= $blank ?>">
                    <img src="<?= $images ?>"/>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>
<div class="box_id_right">
    <div class="tittle_right_id"><?= $glo_lang['thongbao'] ?></div>
    <div class="newsRight">
        <div class="slideNews_box">
            <?php foreach ($tintuthongbao as $row) {
                $tenbv = $row['tenbaiviet_' . $lang];
                $hinhanh = $fullpath . '/' . $row['duongdantin'] . '/' . $row['icon'];
                $url = $full_url . '/' . $row['seo_name'];
                ?>
                <a href="<?= $url ?>"
                   title="<?= $tenbv ?>"> <img
                            src="<?= $hinhanh ?>"
                            alt="<?= $tenbv ?>"/>
                    <h2><?= $tenbv ?></h2>
                    <div class="clr"></div>
                </a>
            <?php } ?>
            <div class="clr"></div>
        </div>
    </div>
</div>
<div class="banner_right">
    <ul>
        <?php while ($r = mysql_fetch_array($QC2)) {
            $images = $fullpath . '/' . $r['duongdantin'] . '/' . $r['icon'];
            $link = $r['lien_ket'];
            $blank = $r['blank'];
            ?>
            <li>
                <a href="<?= $link ?>" target="<?= $blank ?>">
                    <img src="<?= $images ?>"/>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>