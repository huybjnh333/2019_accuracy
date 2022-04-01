<?php
$dmsp = DB_fet("*", "#_danhmuc", "`showhi` = 1 AND `step` = '2' ", "`catasort` asc, `id` asc", "", 1, 1);
$arr_sungdung = DB_fet("*",
    "#_baiviet",
    "`showhi` = 1 AND `step` = 3 AND opt1=1",
    "`catasort` DESC, `id` DESC",
    "",
    1,
    1, "");

$iddm = $arr_running['id'];
if ($slug_table == 'baiviet') {
    $iddm = $arr_running['id_parent'];
}
?>

<div class="left_sanpham">
    <div class="menu_left_sp">
        <ul>
            <h3><?= $glo_lang['san-pham']; ?></h3>
            <?php foreach ($dmsp as $row) {
                $tenbv = $row['tenbaiviet_' . $lang];
                $url = $full_url . '/' . $row['seo_name'];
                $active = "";
                if ($iddm == $row['id']) {
                    $active = "active-menuleft";
                }
                ?>
                <li><a class="<?= $active ?>" href="<?= $url ?>" title="<?= $tenbv ?>"><?= $tenbv ?></a></li>
            <?php } ?>
        </ul>
    </div>
    <div class="ungdung_left_sp">
        <h3><?= $glo_lang['ungdung'] ?></h3>
        <div class="marquee">
            <?php foreach ($arr_sungdung as $row) {
                $tenbv = $row['tenbaiviet_' . $lang];
                $images = $fullpath . '/' . $row['duongdantin'] . '/' . $row['icon'];
                $urlbv = $full_url . '/' . $row['seo_name'];
                ?>
                <ul itemscope itemtype="http://schema.org/ScholarlyArticle">
                    <a href="<?= $urlbv ?>">
                        <li>
                            <img alt="<?= $tenbv ?>" itemprop="image" src="<?= $images ?>"/>
                        </li>
                        <h4 itemprop="headline">
                            <?= $tenbv ?>
                        </h4>
                    </a>
                </ul>
            <?php } ?>
        </div>
        <script>
            $(document).ready(function () {
                $('.marquee').marquee({
                    duration: 25000,
                    gap: 0,
                    delayBeforeStart: 0,
                    direction: 'up',
                    duplicated: true,
                    startVisible: true
                });
            });

        </script>
    </div>
</div>
