<?php
$htqlcl = DB_fet("*",
    "#_baiviet",
    "`showhi` = 1 AND `step` = 5",
    "`catasort` ASC, `id` ASC",1,1,1);
$htqlcl = reset($htqlcl);
$tenbv = $htqlcl['tenbaiviet_'.$lang];
$mota = strip_tags($htqlcl['mota_'.$lang]);
$url = $full_url."/".$htqlcl['seo_name'];
?>
<div class="httql_home">
    <div class="pagewrap">
        <ul>
            <h3 class="limit-row-2 home"><?=$tenbv?></h3>
            <h5></h5>
            <p class="limit-row-7"><?=$mota?></p>
            <h4><a href="<?=$url?>"><?=$glo_lang['xem_chi_tiet']?><i class="fa fa-long-arrow-right"
                                                               aria-hidden="true"></i></a></h4>
        </ul>
        <div class="clr"></div>
    </div>
</div>