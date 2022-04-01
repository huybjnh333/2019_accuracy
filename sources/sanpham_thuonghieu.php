<?php

//include _source . 'box-header.php';
include _source . "phantrang_kietxuat.php";
$baiviet_tinhnang = DB_fet("*",
    "#_baiviet_tinhnang",
    "`showhi` = 1 AND step =2 AND id_parent = 1",
    "catasort asc, id asc",
    "",
    1,
    1
);
?>

<div class="link_page">
    <div class="pagewrap">
        <ul>
            <li><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a></li>
            <li><a href="<?= $full_url ?>/san-pham-thuong-hieu/"><i aria-hidden="true"></i>
                    <?= $glo_lang['thuong_hieu'] ?></a></li>
        </ul>
        <div class="clr"></div>
    </div>
</div>
<div class="clr"></div>
<div class="pagewrap page_conten_page">
    <div class="logo_thuoghieu flex">

                <ul >
                    <?php
                    foreach ($baiviet_tinhnang as $rows){
                    $images = $fullpath . '/' . $rows['duongdantin'] . '/' . $rows['icon'];
                    $tenbv = $rows['tenbaiviet_' . $lang];
                    $urlbv = $full_url. '/san-pham-theo-thuong-hieu/'. $rows['seo_name']. '/'. $rows['id'];
                    ?>
                    <li>
                        <a href="<?= $urlbv ?>">
                            <img alt="<?= $tenbv ?>" src="<?= $images ?>"/>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
        <div class="clr"></div>
    </div>
</div>



