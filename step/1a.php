<?php
if ($motty == "404") {
    $nd_404 = DB_que("SELECT * FROM `#_seo_name` WHERE `opt` = 1 LIMIT 1");
    $arr_running = mysql_fetch_assoc($nd_404);
    $bre = SHOW_text($arr_running['tenbaiviet_' . $_SESSION['lang']]);
} else if (!empty($thongtin_step)) {
    $bre = SHOW_text($thongtin_step['tenbaiviet_' . $lang]);
}
?>
<?php if ($motty == "404") {
    ?>
    <div class="pagewrap page_conten_page">
        <h3>
            <div class="title_id"><?= SHOW_text($arr_running['p1_' . $_SESSION['lang']]) ?></div>
        </h3>
        <div class="showText">
            <?= SHOW_text($arr_running['noidung_' . $_SESSION['lang']]) ?>
            <div class="dv_404_gohome">
                <a href="<?= $full_url ?>"><?= $glo_lang['ve_trang_chu'] ?> <span class="time_doi"></span></a>
            </div>
        </div>
    </div>


    <style type="text/css">
        .dv_404_gohome {
            text-align: right;
        }

        .dv_404_gohome a {
            background: url(nguoiquanly/images/icon_menu_home.png) center left no-repeat;
            background-size: 16px;
            padding: 25px;
            color: blue;
        }

        .dv_404_gohome a:hover {
            text-decoration: underline;
        }

        .showText * {
            width: 100%;
        }

        .showText p {
            word-break: break-word;
        }

    </style>
    <script type="text/javascript">
        var time_doi = 11;
        setInterval(function () {
            time_doi--;
            $('.time_doi').html("(" + time_doi + ")");
            if (time_doi < 1) window.location.href = '<?=$full_url ?>'
        }, 1000);
    </script>
    <?php
} else {
    $databaiviet = DB_fet("*", "#_baiviet", 'showhi=1 and id=' . $slug_id, "catasort desc", "1", "arr", 1);
    $databaiviet = reset($databaiviet);
    $tenbaiviet = $databaiviet['tenbaiviet_' . $lang];
    $noidung = $databaiviet['noidung_' . $lang];
    $img_baiviet = DB_fet("*", "#_baiviet_img", 'id_parent=' . $slug_id, "", "", "arr", 1);
    $style = '';
    if (count($img_baiviet) == 0) {
        $style = 'style="width: 100%"';
    }
    ?>
    <?php include _source . "box-header.php"; ?>
    <div class="pagewrap page_conten_page">
        <div class="padding_pagewrap">
            <div class="showText">
                <?= $arr_running['noidung_'.$_SESSION['lang']] ?>
            </div>
        </div>
    </div>
    <div class="clr"></div>
<?php } ?>
<!--<script>
    $('.link_page h3').html('<?=$tenbaiviet?>//');</script>--!>



