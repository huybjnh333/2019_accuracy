<?php
$tintuc = DB_fet("*",
    "#_baiviet",
    "`showhi` = 1 AND `step` = 4 AND `opt1` = 1",
    "`catasort` DESC, `id` DESC", "", 1, 1);
?>
<div class="box_ttvb_home">
    <div class="pagewrap flex">
        <div class="titBox left">
            <div class="tit_2"><?=$glo_lang['hoat_dong_cong_ty']?></div>
        </div>
        <div class="ttvb_home_l">
            <?php
            $count = 0;
            $array = array();
            foreach ($tintuc as $value) {
                if ($count == 1)
                    continue;
                array_push($array, $value['id']);
                $tenbaiviet = $value['tenbaiviet_' . $lang];
                $image = $fullpath . "/" . $value['duongdantin'] . "/" . $value['icon'];
                $url = $full_url . "/" . $value['seo_name'];
                $mota = strip_tags($value['mota_' . $lang]);
                ?>
                <ul itemscope itemtype="http://schema.org/ScholarlyArticle">
                    <li><a href="<?= $url ?>">
                            <img class="lazy"
                                 itemprop="image"
                                 alt="<?= $tenbaiviet ?>"
                                 src="<?= $fullpath ?>/images/no-image.png"
                                 data-srcset="<?= $image ?> 2x, <?= $image ?> 1x"
                                 data-src="<?= $image ?>"/>
                        </a>
                    </li>
                    <h3 itemprop="headline"><a class="limit-row-3 home" href="<?= $url ?>"><p><?= $tenbaiviet ?></p></a>
                    </h3>
                    <p class="limit-row-4"><?= $mota ?></p>
                </ul>
                <?php $count++;
            } ?>
        </div>
        <div class="ttvb_home_c">
            <?php
            foreach ($tintuc as $value) {
                if ($count == 3)
                    continue;
                if (in_array($value['id'], $array))
                    continue;
                array_push($array, $value['id']);
                $tenbaiviet = $value['tenbaiviet_' . $lang];
                $image = $fullpath . "/" . $value['duongdantin'] . "/" . $value['icon'];
                $url = $full_url . "/" . $value['seo_name'];
                ?>
                <ul itemscope itemtype="http://schema.org/ScholarlyArticle">
                    <li><a href="<?= $url ?>">
                            <img class="lazy"
                                 itemprop="image"
                                 alt="<?= $tenbaiviet ?>"
                                 src="<?= $fullpath ?>/images/no-image.png"
                                 data-srcset="<?= $image ?> 2x, <?= $image ?> 1x"
                                 data-src="<?= $image ?>"/>
                        </a>
                    </li>
                    <h3 itemprop="headline"><a class="limit-row-3 home" href="<?= $url ?>"><p><?= $tenbaiviet ?></p></a></h3>
                </ul>
                <?php $count++;
            } ?>
        </div>
        <div class="ttvb_home_r">
            <?php
            foreach ($tintuc as $value) {
                if ($count == 9)
                    continue;
                if (in_array($value['id'], $array))
                    continue;
                array_push($array, $value['id']);
                $tenbaiviet = $value['tenbaiviet_' . $lang];
                $date = date("d/m/Y", $value['ngaydang']);

                $url = $full_url . "/" . $value['seo_name'];
                ?>
                <ul itemscope itemtype="http://schema.org/ScholarlyArticle">
                    <h3 itemprop="headline"><a class="limit-row-3" href="<?=$url?>"><?= $tenbaiviet ?></a></h3>
                    <p><i class="fa fa-calendar"></i><?= $glo_lang['date'] . " " . $date ?></p>
                </ul>
                <?php $count++;
            } ?>
        </div>
        <div class="clr"></div>
    </div>
</div>