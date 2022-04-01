<?php
$foot = DB_fet("*",
    "#_baiviet",
    "`showhi` = 1 AND step = 6",
    "catasort desc, `id` desc",
    "",
    1,
    1
);
?>
<?=$glo_lang['biet_them_chi_tiet']?>
<h2><?= $thongtin['tencongty_' . $lang] ?></h2>
    <?php
    foreach ($foot as $rows) {
        ?>
        <p>
            <?= $rows['noidung_' . $lang] ?>
        </p>
    <?php } ?>
