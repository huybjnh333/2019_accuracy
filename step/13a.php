<?php
include _source . "phantrang_kietxuat.php";
$databaiviet = DB_fet("*", "#_baiviet", 'showhi=1 and id=' . $slug_id, "", "1", "arr", 1);
$databaiviet = $databaiviet[$slug_id];
$tenbaiviet = $databaiviet['tenbaiviet_' . $lang];
$noidung = $databaiviet['noidung_' . $lang];
$databaivietlienquan = DB_fet("*", "#_baiviet", "showhi=1 and id != " . $arr_running['id'] . " and step=" . $slug_step, "RAND()", "6", "arr", 1);
//include _source . 'box-header.php';
?>
<div class="conten_page">
    <div class="conten_right">
        <?php include _source . "box-header.php"; ?>
        <div class="padding_pagewrap">
            <div class="showText">
                <h2><?= $tenbaiviet ?></h2>
                <?= $noidung ?>
                <?php include _using."thong_tin_lien_he.php";?>
            </div>
            <?php include _using."sharelink.php";?>
        </div>
        <div class="title_page">
            <h3><?=$glo_lang['doi_tac_va_khach_hang']?></h3>
            <div class="clr"></div>
        </div>
        <div class="doitac_id showmoresp flex">
            <?php
            $array = array();
            foreach ($databaivietlienquan as $value) {
                array_push($array,$value['id']);
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
                        <h3 class="limit-row-2" itemprop="headline"><p><?= SHOW_text($tbv) ?></p></h3>
                    </a>
                </ul>
            <?php }
                $dataold = implode(",",$array);
            $countsp = DB_que("SELECT count(*) as `total` FROM `#_baiviet` WHERE `showhi` = 1 AND `id` != " . $arr_running['id'] . " AND `id` NOT IN
                    (" . $dataold . ") AND `step` = ".$slug_step." AND  `id_parent` =  " . $arr_running['id_parent'] . "  ORDER BY `catasort` DESC, `id` DESC");
            $countsp = mysql_fetch_assoc($countsp);
            ?>
            <div class="clr"></div>
        </div>
        <div class="bottom_more <?=$countsp['total'] > 0 ? "" : "hidden"?>">
            <input type="hidden" id="dataold"
                   value="<?= (isset($_POST['showmore-sanpham'])) ? $_POST['dataoldsp'] : $dataold; ?>">
            <h3>
                <a onclick="showmoredata('showmoresp',<?=$slug_step?>,6,'`id_parent` = (<?= $arr_running['id_parent'] ?>)')">
                    <?= $glo_lang['xem_them'] ?><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a>
            </h3>
        </div>
    </div>
    <?php include _using . "left_conten.php"; ?>
    <div class="clr"></div>
</div>
<script>
    function showmoredata(cls, step, limit, wheredata) {
        $.ajax({
            type: "POST",
            url: "<?= $full_url . '/showmore-sanpham/' ?>",
            data: {
                "dataold": $("#dataold").val(),
                "step": step,
                "limit": limit,
                "wheredata": wheredata,
            },
            success: function (data) {
                data = JSON.parse(data);
                $('.' + cls).append(data.data);
                $("#dataold").val(data.dataoldsp);
                if (data.total < limit) {
                    $('.bottom_more').hide();
                }
            }
        });
    }
</script>


 