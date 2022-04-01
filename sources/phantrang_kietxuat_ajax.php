<?php
if (!defined("MOTTY")) die('???');
$page = isset($_POST['page']) ? $_POST['page'] : "";
$id = isset($_POST['id']) ? $_POST['id'] : "";
$step = isset($_POST['step']) ? $_POST['step'] : "";
$key = isset($_POST['key']) ? $_POST['key'] : "";
$total = isset($_POST['total']) ? $_POST['total'] : "";
$numview = isset($_POST['numview']) ? $_POST['numview'] : "";
if (!is_numeric($numview)) $numview = 12;

$key = str_replace("+", " ", strip_tags($key));

if ($page < 1) $page = 1;
$start = ($numview * $page) - $numview;

$wh = "";
if ($id != "")
    $wh = " AND `id_parent` in (" . $id . ") ";

if ($key != '')
    $wh .= " AND (`tenbaiviet_vi` LIKE '%" . $key . "%' OR `tenbaiviet_en` LIKE '%" . $key . "%' OR `p1` = '" . $key . "')";

$nd_kietxuat = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (" . $step . ") $wh ORDER BY `catasort` DESC LIMIT $start," . $numview);

$i = 0;
while ($rows_sp = mysql_fetch_assoc($nd_kietxuat)) {
    $i++;
    $list_hinhcon = LAY_hinhanhcon($rows_sp['id'], 2);
    ?>
    <ul>
        <?php if ($i == 1) { ?>
            <div class="ajax_scron ajax_scron_<?= $page ?>"></div> <?php } ?>
        <div class="slideshow-container">
            <a href="<?= GET_link($full_url, SHOW_text($rows_sp['seo_name'])) ?>">
                <div class="mySlides mySlides_gr_<?= $rows_sp['id'] ?> fade" style="display:block">
                    <img src="<?= checkImage($fullpath, $rows_sp['icon'], $rows_sp['duongdantin'], 'thumb_') ?>"
                         alt="<?= SHOW_text($rows_sp['tenbaiviet_' . $lang]) ?>"/>
                </div>
                <?php foreach ($list_hinhcon as $r_img) { ?>
                    <div class="mySlides mySlides_gr_<?= $rows_sp['id'] ?> fade"><img
                                src="<?= checkImage($fullpath, $r_img['p_name'], 'datafiles/' . $r_img['duongdantin'], 'thumb_') ?>"
                                style="width:100%" alt="<?= SHOW_text($rows_sp['tenbaiviet_' . $lang]) ?>"></div>
                <?php } ?>
            </a>
        </div>
        <br>
        <div style="text-align:center" class='dv-cont-slider-aaa'>
            <span class="dot dot_<?= $rows_sp['id'] ?> active" gr="<?= $rows_sp['id'] ?>"
                  onclick="currentSlide(1, <?= $rows_sp['id'] ?>)"></span>
            <?php $i = 1;
            foreach ($list_hinhcon as $r_img) {
                $i++; ?>
                <span class="dot dot_<?= $rows_sp['id'] ?>" gr="<?= $rows_sp['id'] ?>"
                      onclick="currentSlide(<?= $i ?>, <?= $rows_sp['id'] ?>)"></span>
            <?php } ?>
        </div>
        <a href="<?= GET_link($full_url, SHOW_text($rows_sp['seo_name'])) ?>">
            <h3><?= SHOW_text($rows_sp['tenbaiviet_' . $lang]) ?></h3>
            <p><?= SHOW_text(strip_tags($rows_sp['mota_' . $lang])) ?></p>
        </a>
    </ul>
<?php } ?>
<?php
if ($total <= $start) {
    echo '<script language="javascript">stopped = true; $(".bottom_more").hide(); </script>';
}
?>
<script>
    window.onload = function () {
        var arr_height = [];
        $(".product_id ul", this).each(function () {
            var heigh = parseInt($(this).height());
            arr_height.push(heigh + 40);
        });
        var maxheight = Math.max.apply(null, arr_height);
        $(".product_id ul", this).each(function () {
            $(this).css('height', maxheight);
        });
    };
</script>