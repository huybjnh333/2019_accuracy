<?php
include _source . "phantrang_kietxuat.php";
include _source."box-header.php";
?>
<div class="pagewrap page_conten_page">
    <div class="hinhanh_id flex">
        <?php
            if ($nd_total == 0) {
                echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
            } else {
            while ($rows = mysql_fetch_array($nd_kietxuat)) {
                $tenbaiviet = $rows['tenbaiviet_' . $lang];
                $mota = $rows['mota_' . $lang];
                $url = $full_url . '/' . $rows['seo_name'];
                $ngaydang = $rows['ngaydang'];
                $images = $fullpath . '/' . $rows['duongdantin'] . '/' . $rows['icon'];
        ?>
        <ul>
            <a href="<?= $url ?>">
                <li><img src="<?= $images ?>" alt="<?= $tenbaiviet ?>" width="410" height="270" /></li>
                <h3 class="limit-row-2"><?= $tenbaiviet ?></h3>
            </a>
        </ul>
        <?php } }?>
        <div class="clr"></div>
    </div>
    <div class="nums">
        <ul>
            <?= PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty, $_SERVER['QUERY_STRING']) ?>
        </ul>
        <div class="clr"></div>
    </div>
</div>