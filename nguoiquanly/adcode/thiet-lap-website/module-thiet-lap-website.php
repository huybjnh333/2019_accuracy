<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        ${$key} = $value;
    }
}

$arrayimages = array(
//    "imageshome1" => "Logo Footer",
//    "imageshome2" => "Logo 2",
//    "imageshome3" => "Hình ảnh home 3",
//    "imagestimkiem" => "Hình ảnh tìm kiếm",
);


$array_napas = array(
//    "napas_url" => "Napas URL",
//    "napas_serect" => "Napas Serect",
//    "napas_accessCode" => "Napas AccessCode",
//    "napas_merchant" => "Napas Merchant",
);

$array_social = array(
    'maplink' => "Google Map",
    'youtubelink' => "Youtube",
    'facebooklink' => "Facebook",
    'twitter' => "Twitter",
    'instagram' => "Instagram",
//    'pinterest' => "Pinterest",
//    'zalo' => "Zalo",
//    'skype' => "Skype",
//    'messenger' => "Messenger",
//    'googleplus' => "Google+",
);


if (!empty($_POST)) {
    $data = array();
    $data['seo_title_vi'] = $seo_title_vi;
    $data['seo_description_vi'] = $seo_description_vi;
    $data['seo_keywords_vi'] = $seo_keywords_vi;
    $data['tencongty_vi'] = $tencongty_vi;
    $data['sodienthoai_vi'] = $sodienthoai_vi;
    $data['diachi_vi'] = $diachi_vi;
    $data['hotline_vi'] = $hotline_vi;
    $data['email_vi'] = $email_vi;

    $data['seo_title_en'] = @$seo_title_en;
    $data['seo_description_en'] = @$seo_description_en;
    $data['seo_keywords_en'] = @$seo_keywords_en;
    $data['diachi_en'] = @$diachi_en;
    $data['hotline_en'] = @$hotline_en;
    $data['email_en'] = @$email_en;
    $data['tencongty_en'] = @$tencongty_en;
    $data['sodienthoai_en'] = @$sodienthoai_en;

    $data['seo_title_cn'] = @$seo_title_cn;
    $data['seo_description_cn'] = @$seo_description_cn;
    $data['seo_keywords_cn'] = @$seo_keywords_cn;
    $data['diachi_cn'] = @$diachi_cn;
    $data['hotline_cn'] = @$hotline_cn;
    $data['email_cn'] = @$email_cn;
    $data['tencongty_cn'] = @$tencongty_cn;
    $data['sodienthoai_cn'] = @$sodienthoai_cn;

    $data['robots'] = $robots;
    $data['duongdantin'] = $duongdantin;
    if (!empty($em_ip)) {
        $data['em_ip'] = $em_ip;

    }
    if (!empty($em_taikhoan)) {
        $data['em_taikhoan'] = $em_taikhoan;
    }
    if (!empty($em_pass)) {

        $data['em_pass'] = $em_pass;
    }

    $data['js_google_anilatic'] = $js_google_anilatic;
    foreach ($array_social as $k => $v) {
        if (empty($youtubelink))
            continue;
        $data[$k] = ${$k};
    }
    foreach ($array_napas as $k => $v) {
        if (empty($youtubelink))
            continue;
        $data[$k] = ${$k};
    }
//    $data['logancty_vi'] = $logancty_vi;
//    $data['logancty_en'] = $logancty_en;
    $logo = UPLOAD_image("logo", "../" . $duongdantin . "/", time());
    $favico = UPLOAD_image("favico", "../" . $duongdantin . "/", time());

    foreach ($arrayimages as $k => $row) {
        ${$k} = UPLOAD_image("$k", "../" . $duongdantin . "/", time());
        if (${$k} != '') {
            $data[$k] = ${$k};
            @unlink("../" . mysql_result($sql_thongtin, 0, "duongdantin") . "/" . mysql_result($sql_thongtin, 0, "$k"));
        }
    }
    $sql_thongtin = DB_que("SELECT * FROM `#_seo` LIMIT 1");

    if ($logo != '') {
        $data['logo'] = $logo;
        @unlink("../" . mysql_result($sql_thongtin, 0, "duongdantin") . "/" . mysql_result($sql_thongtin, 0, "logo"));
    }

    if ($favico != '') {
        $data['favico'] = $favico;
        @unlink("../" . mysql_result($sql_thongtin, 0, "duongdantin") . "/" . mysql_result($sql_thongtin, 0, "favico"));
    }


    ACTION_db($data, '#_seo', 'update', NULL, "`id` = 1");
    $_SESSION['show_message_on'] = "Cập nhật dữ liệu thành công!";
}

$sql_se = DB_que("SELECT * FROM `#_seo` LIMIT 1");
$sql_se = mysql_fetch_assoc($sql_se);
foreach ($sql_se as $key => $value) {
    ${$key} = Show_text($value);
    if ($key = 'js_google_anilatic') {
        $js_google_anilatic = $sql_se['js_google_anilatic'];
    }
}
foreach ($arrayimages as $k => $row) {
    if (${$k} != '') {
        ${$k} = "<img src='../$duongdantin/${$k}' style='display:block'>";
    }
}
if ($logo != '') {
    $logo = "<img src='../$duongdantin/$logo' style='display:block'>";
}
if ($favico != '') {
    $favico = "<img src='../$duongdantin/$favico' style='display:block'>";
}
if ($logothanhtoan != '') {
    $logothanhtoan = "<img src='../$duongdantin/$logothanhtoan' style='display:block'>";
}
include _source . '/header_bar.php';

?>

<form id="form_submit" name="form_submit" action="" method="post" enctype='multipart/form-data'>
    <input type="hidden" name="token" value="<?= GET_token() ?>">
    <section class="content form_create">
        <div class="row">
            <section class="col-lg-12">
                <?php include _source . "mesages.php"; ?>
                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="h2_title">
                            <i class="fa fa-pencil-square-o"></i> Cập nhật
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                            <button onclick="return checkSubmit()" type="submit" name="capnhat" class="btn btn-primary">
                                <i class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                        </h3>
                    </div>
                    <div class="nav-tabs-custom">
                        <?php include _source . "lang.php" ?>
                        <div class="tab-content">
                            <div class="tab-pane active row" id="tab_1">
                                <div class="form-group col-lg-6">
                                    <label>Tên công ty</label>
                                    <input type="text" class="form-control" name="tencongty_vi"
                                           value="<?= $tencongty_vi ?>">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Số điện thoại</label>
                                    <input type="text" class="form-control" name="sodienthoai_vi"
                                           value="<?= $sodienthoai_vi ?>">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Hotline</label>
                                    <input type="text" class="form-control" name="hotline_vi"
                                           value="<?= $hotline_vi ?>">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email_vi" value="<?= $email_vi ?>">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Địa chỉ</label>
                                    <input type="text" class="form-control" name="diachi_vi" value="<?= $diachi_vi ?>">
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Seo Title</label>
                                    <input type="text" class="form-control" name="seo_title_vi"
                                           value="<?= $seo_title_vi ?>">
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Seo Description</label>
                                    <input type="text" class="form-control" name="seo_description_vi"
                                           value="<?= $seo_description_vi ?>">
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Seo keywords</label>
                                    <input type="text" class="form-control" name="seo_keywords_vi"
                                           value="<?= $seo_keywords_vi ?>">
                                </div>
                            </div>
                            <?php if ($lang_nb2) { ?>
                                <div class="tab-pane row" id="tab_2">
                                    <div class="form-group col-lg-6">
                                        <label>Tên công ty (<?= _lang_nb2_key ?>)</label>
                                        <input type="text" class="form-control" name="tencongty_en"
                                               value="<?= $tencongty_en ?>">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Số điện thoại (<?= _lang_nb2_key ?>)</label>
                                        <input type="text" class="form-control" name="sodienthoai_en"
                                               value="<?= $sodienthoai_en ?>">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Hotline (<?= _lang_nb2_key ?>)</label>
                                        <input type="text" class="form-control" name="hotline_en"
                                               value="<?= $hotline_en ?>">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Email (<?= _lang_nb2_key ?>)</label>
                                        <input type="text" class="form-control" name="email_en"
                                               value="<?= $email_en ?>">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Địa chỉ (<?= _lang_nb2_key ?>)</label>
                                        <input type="text" class="form-control" name="diachi_en"
                                               value="<?= $diachi_en ?>">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Seo Title (<?= _lang_nb2_key ?>)</label>
                                        <input type="text" class="form-control" name="seo_title_en"
                                               value="<?= $seo_title_en ?>">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Seo Description (<?= _lang_nb2_key ?>)</label>
                                        <input type="text" class="form-control" name="seo_description_en"
                                               value="<?= $seo_description_en ?>">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Seo keywords (<?= _lang_nb2_key ?>)</label>
                                        <input type="text" class="form-control" name="seo_keywords_en"
                                               value="<?= $seo_keywords_en ?>">
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($lang_nb3) { ?>
                                <div class="tab-pane" id="tab_3">
                                    <div class="form-group col-lg-6">
                                        <label>Tên công ty (<?= _lang_nb3_key ?>)</label>
                                        <input type="text" class="form-control" name="tencongty_cn"
                                               value="<?= $tencongty_cn ?>">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Số điện thoại (<?= _lang_nb3_key ?>)</label>
                                        <input type="text" class="form-control" name="sodienthoai_cn"
                                               value="<?= $sodienthoai_cn ?>">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Hotine (<?= _lang_nb3_key ?>)</label>
                                        <input type="text" class="form-control" name="hotline_cn"
                                               value="<?= $hotline_cn ?>">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Email (<?= _lang_nb3_key ?>)</label>
                                        <input type="text" class="form-control" name="email_cn"
                                               value="<?= $email_cn ?>">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Địa chỉ (<?= _lang_nb3_key ?>)</label>
                                        <input type="text" class="form-control" name="diachi_cn"
                                               value="<?= $diachi_cn ?>">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Seo Title (<?= _lang_nb3_key ?>)</label>
                                        <input type="text" class="form-control" name="seo_title_cn"
                                               value="<?= $seo_title_cn ?>">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Seo Description (<?= _lang_nb3_key ?>)</label>
                                        <input type="text" class="form-control" name="seo_description_cn"
                                               value="<?= $seo_description_cn ?>">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Seo keywords (<?= _lang_nb3_key ?>)</label>
                                        <input type="text" class="form-control" name="seo_keywords_cn"
                                               value="<?= $seo_keywords_cn ?>">
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="box p10" style="margin-top: 10px">
                    <div class="form-group">
                        <label for="exampleInputFile">Logo</label>
                        <?= (!empty($logo)) ? $logo : '' ?>
                        <input name="logo" type="file" class="form-control" id="exampleInputFile">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Favico</label>
                        <?= (!empty($favico)) ? $favico : '' ?>
                        <input name="favico" type="file" class="form-control" id="exampleInputFile">
                    </div>
                    <?php foreach ($arrayimages as $k => $row) { ?>
                        <div class="form-group">
                            <label for="exampleInputFile"><?= $row ?></label>
                            <?= (!empty(${$k})) ? ${$k} : '' ?>
                            <input name="<?= $k ?>" type="file" class="form-control" id="exampleInputFile">
                        </div>
                    <?php } ?>
                    <div class="row">
                        <?php foreach ($array_napas as $k => $v) { ?>
                            <div class="form-group col-lg-12">
                                <label><?= $v ?></label>
                                <input type="text" name="<?= $k ?>" value="<?= ${$k} ?>">
                            </div>
                        <?php } ?>
                    </div>
                    <!-- <div class="form-group">
                        <label for="exampleInputFile">Logo thanh toán</label>
                        <?= (!empty($logothanhtoan)) ? $logothanhtoan : '' ?>
                        <input name="logothanhtoan" type="file" class="form-control" id="exampleInputFile">
                    </div>-->
                    <div class="form-group">
                        <label>Robots</label>
                        <textarea name="robots" id="robots" class="form-control" rows="10" cols="80"
                                  style="height: 200px"><?= $robots ?></textarea>
                    </div>
                </div>
                <div class="box p10" style="margin-top: 10px">
                    <div class="row">
                        <?php foreach ($array_social as $k => $v) { ?>
                            <div class="form-group col-lg-12">
                                <label><?= $v ?></label>
                                <input type="text" name="<?= $k ?>" value="<?= ${$k} ?>">
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php if (!empty($_SESSION['admin'])) { ?>
                    <div class="box p10" style="margin-top: 10px">
                        <div class="form-group">
                            <label for="exampleInputFile">Email gửi tin</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">IP/Server</label>
                            <input type="text" class="form-control" name="em_ip" value="<?= $em_ip ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Email</label>
                            <input type="text" class="form-control" name="em_taikhoan" value="<?= $em_taikhoan ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Mật khẩu</label>
                            <input type="text" class="form-control" name="em_pass" value="<?= $em_pass ?>">
                        </div>
                    </div>
                <?php } ?>
                <div class="box p10" style="margin-top: 10px">
                    <div class="form-group" style=" margin-bottom: 5px;">
                        <label for="exampleInputFile">Code Header</label>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="js_google_anilatic"
                                  style="min-height: 200px"><?= $js_google_anilatic ?></textarea>
                    </div>
                </div>
            </section>
            <section class="col-lg-12 ">

            </section>

            <section class="col-lg-12">

            </section>
        </div>
    </section>
    <div class="box-header mb-60">
        <h3 class="box-title box-title-td pull-right">
            <button type="submit" name="capnhat" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?= luu_lai ?>
            </button>
        </h3>
    </div>
</form>