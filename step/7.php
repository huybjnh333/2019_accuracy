<?php
include _source . "phantrang_kietxuat.php";
include _source . 'box-header.php';
?>
<div class="pagewrap conten_page">
    <div class="conten_left">
        <?php include _source . "left_conten.php"; ?>
    </div>
    <div class="conten_right">
        <div class="box_id_home">
            <div class="title_tin_id">
                <h3><?= $nametitle ?></h3>
            </div>
            <div class="padding_pagewrap">
                <div class="tailieu_id">
                    <?php
                    $array = array(
                        'docx' => 'fa-file-word-o',
                        'pdf' => 'fa-file-pdf-o',
                        'xls' => 'fa-file-excel-o',
                        'png' => 'fa-file-image-o',
                        'jpg' => 'fa-file-image-o',
                    );
                    $count = 1;
                    while ($news = mysql_fetch_array($nd_kietxuat)) {
                        $total = $news['totaldownload'];
                        $css_dl = ($news['dowload'] != '') ? '' : 'hide_dowload';
                        $link_dl = ($news['dowload'] != '') ? 'href="' . $fullpath . "/datafiles/files/" . $news['dowload'] . '" download' : 'href="JavaScript:"';
                        $tenbaiviet = $news['tenbaiviet_' . $lang];
                        $mota = $news['mota_' . $lang];
                        $namefile = "fa-file-excel-o";
                        $check = explode('.', $news['dowload']);
                        if (!empty($news['dowload'])) {
                            $namefile = $array[$check[count($check) - 1]];
                        } ?>
                        <ul>
                            <p><?= $count ?></p>
                            <h3><?= $tenbaiviet ?></h3>
                            <li><a <?= $link_dl ?>><i class="fa fa-download" aria-hidden="true"></i>download</a></li>
                            <div class="clr"></div>
                        </ul>
                        <?php
                        $count++;
                    } ?>
                </div>
                <div class="nums">
                    <ul>
                        <?= PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty, $_SERVER['QUERY_STRING']) ?>
                    </ul>
                    <div class="clr"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="clr"></div>
</div>


<script>
    function countDownload(idbv, total) {
        $.post("<?=$full_url . '/addtotal'?>", {idbv: idbv, total: total});

    }
</script>