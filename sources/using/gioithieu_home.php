<?php
$gt = DB_fet("*", "#_step", "`showhi` = 1 AND `step` = 1", "`id` ASC",
    "1", 1, 1);
$gt = reset($gt);
$tengt = $gt['tenbaiviet_'.$lang];
$span = $gt['p1_'.$lang];
$mota = $gt['p3_'.$lang];
$images2 = $fullpath . '/' . $gt['duongdantin'] . '/' . $gt['icon2'];
$linkkhac = $full_url."/".$gt['linkkhac'];
?>
<div class="homeabout">
    <div class="pagewrap">
        <ul>
            <h3><?=$tengt?><span><?=$span?></span></h3>
            <p class="limit-row-7"><?=strip_tags($mota)?></p>
            <h4><a href="<?=$linkkhac?>"><?=$glo_lang['xem_chi_tiet']?>
                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
            </h4>
            <div class="clr"></div>
        </ul>
        <li><img src="<?=$images2?>" alt="<?=$tengt?>"/></li>
        <div class="clr"></div>
    </div>
</div>