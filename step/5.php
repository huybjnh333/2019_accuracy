<?php
if (isset($_SESSION['email'])) {
    $info_acc = DB_fet("*", "#_members", "`email` = '" . $_SESSION['email'] . "' AND `phanquyen` = 0", "`id` DESC", 1);
    $info_acc = mysql_fetch_assoc($info_acc);

    $hoten = $info_acc['hoten'];
    $sodienthoai = $info_acc['sodienthoai'];
    $email = $info_acc['email'];
    $diachi = $info_acc['diachi'];
}

//$datadmbv = DB_fet("*", "#_danhmuc", 'showhi=1 and step= 8 ', "", "", "arr", 1);
//$chantrang = DB_fet("*", "#_seo_name", "id=16", "", "1", "arr", 1);
//$chantrang = $chantrang[16];
//$noidung = $chantrang['noidung_' . $lang];
//$noidung = str_replace('h3', 'h2', $noidung);

$foot = DB_fet("*",
    "#_baiviet",
    "`showhi` = 1 AND step = " . $slug_step,
    "catasort desc, `id` desc",
    "",
    1,
    1
);
?>
<div class="conten">
    <?php include _source . "box-header.php"; ?>
    <div class="pagewrap page_conten_page">
        <div class="company_contact flex">
            <?php
                foreach ($foot as $value){
                    $tbv = $value['tenbaiviet_'.$lang];
                    $noidung = $value['noidung_'.$lang];
            ?>
            <ul>
                <h3><i class="<?=$value['p1']?>"></i><?=$tbv?></h3>
                <?=$noidung?>
            </ul>
            <?php } ?>

            <div class="clr"></div>
        </div>
        <div class="padding_pagewrap">
            <div class="contact">
                <?php include _using . "lien_he_form.php"; ?>
            </div>
        </div>
    </div>
    <div class="map_contact">
        <iframe data-iframely-url="<?= $thongtin['maplink'] ?>"
                width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
    </div>
</div>

