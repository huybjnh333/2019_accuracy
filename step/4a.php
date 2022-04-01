<?php
$databaiviet = DB_fet("*", "#_baiviet", 'showhi=1 and id=' . $slug_id, "", "1", "arr", 1);
$databaiviet = $databaiviet[$slug_id];
$tenbaiviet = $databaiviet['tenbaiviet_' . $lang];
$noidung = $databaiviet['noidung_' . $lang];
$mota = $databaiviet['mota_' . $lang];
$img_baiviet = DB_fet("*", "#_baiviet_img", 'id_parent=' . $slug_id, "", "", "arr", 1);
$style = '';
if (count($img_baiviet) == 0) {
    $style = 'style="width: 100%"';
}
$arrbv = DB_fet("*", "#_step", "`showhi` = 1 and id=" . $slug_step, "catasort desc", "1", 1);
$arrbv = reset($arrbv);
$data = DB_fet("*", "#_baiviet", "`showhi` = 1 and step=" . $slug_step, "catasort desc", "", 1);

$bvlienquan = DB_fet("*", "#_baiviet", "`showhi` = 1 and id_parent =" . $arr_running['id_parent'] . " and step=" . $slug_step, "RAND()", "3", 1);

$dichvu_lienquan = DB_fet("*",
    "#_baiviet",
    "`showhi` = 1 AND `step` = " . $slug_step . " AND id !=" . $arr_running['id'],
    "`catasort` desc, `id` desc",
    "10",
    1,
    1);
include _source . "box-header.php";
?>
<div class="pagewrap page_conten_page">
    <div class="padding_pagewrap">
        <div class="showText">
            <p><?= $arr_running['noidung_'.$_SESSION['lang']] ?></p>
        </div>

        <div id="sharelink">
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style "><a class="addthis_button_facebook_like"
                                                                   fb:like:layout="button_count"></a> <a
                        class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone"
                                                             g:plusone:size="medium"></a> <a
                        class="addthis_counter addthis_pill_style"></a></div>
            <script type="text/javascript"
                    src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-502225fb496239a5"></script>
            <!-- AddThis Button END -->
        </div>
    </div>
</div>
