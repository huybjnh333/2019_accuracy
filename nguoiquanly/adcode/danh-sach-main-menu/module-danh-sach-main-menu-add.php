<?php
if (!isset($_GET['edit']) && !isset($_SESSION['admin'])) LOCATION_js("index.php");
$id = isset($_GET['edit']) && is_numeric($_GET['edit']) ? $_GET['edit'] : 0;
$table = '#_step';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    foreach ($_POST as $key => $value) {
        ${$key} = $value;
    }
    $catasort = str_replace(".", "", $_REQUEST['catasort']);

    $seo_title_vi = @LAY_uutien($seo_title_vi, $tenbaiviet_vi);
    $seo_title_en = @LAY_uutien($seo_title_en, $tenbaiviet_en);
    $seo_title_cn = @LAY_uutien($seo_title_cn, $tenbaiviet_cn);
    $seo_description_vi = @LAY_uutien($seo_description_vi, $tenbaiviet_vi);
    $seo_description_en = @LAY_uutien($seo_description_en, $tenbaiviet_en);
    $seo_description_cn = @LAY_uutien($seo_description_cn, $tenbaiviet_cn);
    $seo_keywords_vi = @LAY_uutien($seo_keywords_vi, $tenbaiviet_vi);
    $seo_keywords_en = @LAY_uutien($seo_keywords_en, $tenbaiviet_en);
    $seo_keywords_cn = @LAY_uutien($seo_keywords_cn, $tenbaiviet_cn);

    $num_view = str_replace(".", "", $num_view);
    $key = RANDOM_chuoi(5);
    $step = isset($_POST['step']) ? $_POST['step'] : "";
}

if (!empty($_POST)) {
    $seo_name = LAY_uutien($seo_name, $tenbaiviet_vi);

    $hinhanh = UPLOAD_image("icon", "../" . $duongdantin . "/", time());
    $hinhanh2 = UPLOAD_image("icon2", "../" . $duongdantin . "/", time());
    $_POST['ngaydang'] = time();
    $_POST['duongdantin'] = $duongdantin;
    $_POST['seo_title_vi'] = $seo_title_vi;
    $_POST['seo_title_en'] = $seo_title_en;
    $_POST['seo_title_cn'] = $seo_title_cn;
    $_POST['seo_description_vi'] = $seo_description_vi;
    $_POST['seo_description_en'] = $seo_description_en;
    $_POST['seo_description_cn'] = $seo_description_cn;
    $_POST['seo_keywords_vi'] = $seo_keywords_vi;
    $_POST['seo_keywords_en'] = $seo_keywords_en;
    $_POST['seo_keywords_cn'] = $seo_keywords_cn;

    $_POST['key_security'] = $key;
    $_POST['catasort'] = $catasort;
    $_POST['num_view'] = $num_view;
    $_POST['linkkhac'] = $linkkhac;

    if ($step != null)
        $_POST['step'] = $step;

    if ($hinhanh != false) {
        $_POST['icon'] = $hinhanh;
        TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh, "../" . $duongdantin . "/thumb_" . $hinhanh, 400, 256);
        if (!empty($tenbaiviet_vi)) {
            //xoa anh
            $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
            @unlink("../" . mysql_result($sql_thongtin, 0, "duongdantin") . "/" . mysql_result($sql_thongtin, 0, "icon"));
            @unlink("../" . mysql_result($sql_thongtin, 0, "duongdantin") . "/thumb_" . mysql_result($sql_thongtin, 0, "icon"));
            //end
        }
    }
    if ($hinhanh2 != false) {
        $_POST['icon2'] = $hinhanh2;
        TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh2, "../" . $duongdantin . "/thumb_" . $hinhanh2, 400, 256);
        if (!empty($tenbaiviet_vi)) {
            //xoa anh
            $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
            @unlink("../" . mysql_result($sql_thongtin, 0, "duongdantin") . "/" . mysql_result($sql_thongtin, 0, "icon2"));
            @unlink("../" . mysql_result($sql_thongtin, 0, "duongdantin") . "/thumb_" . mysql_result($sql_thongtin, 0, "icon2"));
            //end
        }
    }
    if ($id == 0) {
        $id = ACTION_db($_POST, $table, 'add', array("themmoi"), NULL);
        $_SESSION['show_message_on'] = "Thêm module thành công!";
        THEM_seoname($id, $seo_name, $table, $id, "0");
        LOCATION_js($url_page . "&edit=" . $id);
        exit();
    } else {
        ACTION_db($_POST, $table, 'update', array("themmoi"), "`id` = " . $id);
        $_SESSION['show_message_on'] = "Cập nhật module thành công!";
        THEM_seoname($id, $seo_name, $table, $id, "1");

    }

}
if ($id > 0) {
    $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
    $sql_se = mysql_fetch_array($sql_se);
    foreach ($sql_se as $key => $value) {
        ${$key} = SHOW_text($value);
    }

    $catasort = number_format($catasort, 0, ',', '.');
    $num_view = number_format($num_view, 0, ',', '.');
    if ($icon != '')
        $icon = "<img src='../$duongdantin/thumb_$icon' width='250px' style='display:block'>";
    if ($icon2 != '')
        $icon2 = "<img src='../$duongdantin/thumb_$icon2' width='250px' style='display:block'>";

} else {
    $step = 1;
    $catasort = layCatasort($table);
    $catasort = number_format(SHOW_text($catasort), 0, ',', '.');
}
?>
    <section class="content-header">
        <h1>Main module</h1>
        <ol class="breadcrumb">
            <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="active">Quản lý main module</li>
        </ol>
    </section>

    <form id="form_submit" name="form_submit" action="" method="post" enctype='multipart/form-data'>
        <section class="content form_create">
            <div class="row">
                <section class="col-lg-12">
                    <?php include _source . "mesages.php"; ?>
                    <div class="box">
                        <div class="box-header with-border">
                            <h2 class="h2_title">
                                <i class="fa fa-pencil-square-o"></i> <?= !empty($tenbaiviet_vi) ? 'Sửa' : 'Thêm' ?>
                                main module
                            </h2>
                            <h3 class="box-title box-title-td pull-right">
                                <button onclick="return CHECK_sb()" type="submit" class="btn btn-primary"><i
                                            class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                                <?php
                                if (isset($_SESSION['admin'])) echo '<a href="?module=' . $module . '&action=' . $action . '&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i>Thêm mới</a>';
                                ?>
                                <a href="<?= $url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
                            </h3>
                        </div>
                        <div class="nav-tabs-custom">
                            <?php include _source . "lang.php" ?>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="form-group">
                                        <label>Tên module</label>
                                        <input type="text" class="form-control cls_ms"
                                               message="Bạn chưa nhập tên module!"
                                               value="<?= !empty($tenbaiviet_vi) ? SHOW_text($tenbaiviet_vi) : '' ?>"
                                               name="tenbaiviet_vi" id="tenbaiviet_vi">
                                    </div>

                                    <div class="form-group">
                                        <label>Tên hiển thị</label>
                                        <input type="text" class="form-control"
                                               value="<?= !empty($p1_vi) ? SHOW_text($p1_vi) : '' ?>" name="p1_vi"
                                               id="p1_vi">
                                    </div>

                                    <?php if (CHECK_key_setting("main-menu-mo-ta")) { ?>
                                        <div class="form-group">
                                            <label>Mô tả</label>
                                            <textarea id="p3_vi" name="p3_vi" rows="10"
                                                      cols="80"><?= !empty($p3_vi) ? SHOW_text($p3_vi) : '' ?></textarea>
                                        </div>
                                    <?php } ?>

<!--                                    <div class="form-group">-->
<!--                                        <label>Nội dung</label>-->
<!--                                        <textarea id="noidung_vi" name="noidung_vi" rows="10"-->
<!--                                                  cols="80">--><?//= !empty($noidung_vi) ? SHOW_text($noidung_vi) : '' ?><!--</textarea>-->
<!--                                    </div>-->

                                    <div class="form-group">
                                        <label>Seo Title</label>
                                        <input type="text" class="form-control" name="seo_title_vi"
                                               value="<?= !empty($seo_title_vi) ? Show_text($seo_title_vi) : "" ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Seo Description</label>
                                        <input type="text" class="form-control" name="seo_description_vi"
                                               value="<?= (!empty($seo_description_vi)) ? Show_text($seo_description_vi) : "" ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Seo keywords</label>
                                        <input type="text" class="form-control" name="seo_keywords_vi"
                                               value="<?= !empty($seo_keywords_vi) ? Show_text($seo_keywords_vi) : "" ?>">
                                    </div>
                                </div>
                                <?php if ($lang_nb2) { ?>
                                    <div class="tab-pane" id="tab_2">
                                        <div class="form-group">
                                            <label>Tên module (<?= _lang_nb2_key ?>)</label>
                                            <input type="text" class="form-control cls_ms"
                                                   message="Bạn chưa nhập Tên module (<?= _lang_nb2_key ?>)!"
                                                   value="<?= !empty($tenbaiviet_en) ? SHOW_text($tenbaiviet_en) : '' ?>"
                                                   name="tenbaiviet_en" id="tenbaiviet_en">
                                        </div>

                                        <div class="form-group">
                                            <label>Tên hiển thị (<?= _lang_nb2_key ?>)</label>
                                            <input type="text" class="form-control"
                                                   value="<?= !empty($p1_en) ? SHOW_text($p1_en) : '' ?>" name="p1_en"
                                                   id="p1_en">
                                        </div>
                                        <?php if (CHECK_key_setting("main-menu-mo-ta")) { ?>
                                            <div class="form-group">
                                                <label>Mô tả (<?= _lang_nb2_key ?>)</label>
                                                <textarea id="p3_en" name="p3_en" rows="10"
                                                          cols="80"><?= !empty($p3_en) ? SHOW_text($p3_en) : '' ?></textarea>
                                            </div>
                                        <?php } ?>
<!--                                        <div class="form-group">-->
<!--                                            <label>Nội dung (--><?//= _lang_nb2_key ?><!--)</label>-->
<!--                                            <textarea id="noidung_en" name="noidung_en" rows="10"-->
<!--                                                      cols="80">--><?//= !empty($noidung_en) ? SHOW_text($noidung_en) : '' ?><!--</textarea>-->
<!--                                        </div>-->

                                        <div class="form-group">
                                            <label>Seo Title (<?= _lang_nb2_key ?>)</label>
                                            <input type="text" class="form-control" name="seo_title_en"
                                                   value="<?= !empty($seo_title_en) ? Show_text($seo_title_en) : "" ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Seo Description (<?= _lang_nb2_key ?>)</label>
                                            <input type="text" class="form-control" name="seo_description_en"
                                                   value="<?= !empty($seo_description_en) ? Show_text($seo_description_en) : "" ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Seo keywords (<?= _lang_nb2_key ?>)</label>
                                            <input type="text" class="form-control" name="seo_keywords_en"
                                                   value="<?= !empty($seo_keywords_en) ? Show_text($seo_keywords_en) : "" ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if ($lang_nb3) { ?>
                                    <div class="tab-pane" id="tab_3">
                                        <div class="form-group">
                                            <label>Tên module (<?= _lang_nb3_key ?>)</label>
                                            <input type="text" class="form-control cls_ms"
                                                   message="Bạn chưa nhập Tên module (<?= _lang_nb3_key ?>)!"
                                                   value="<?= !empty($tenbaiviet_cn) ? SHOW_text($tenbaiviet_cn) : '' ?>"
                                                   name="tenbaiviet_cn" id="tenbaiviet_cn">
                                        </div>

                                        <div class="form-group">
                                            <label>Tên hiển thị (<?= _lang_nb3_key ?>)</label>
                                            <input type="text" class="form-control"
                                                   value="<?= !empty($p1_cn) ? SHOW_text($p1_cn) : '' ?>" name="p1_cn"
                                                   id="p1_cn">
                                        </div>
                                        <?php if (CHECK_key_setting("main-menu-mo-ta")) { ?>
                                            <div class="form-group">
                                                <label>Mô tả (<?= _lang_nb3_key ?>)</label>
                                                <textarea id="p3_cn" name="p3_cn" rows="10"
                                                          cols="80"><?= !empty($p3_cn) ? SHOW_text($p3_cn) : '' ?></textarea>
                                            </div>
                                        <?php } ?>
                                        <div class="form-group">
                                            <label>Nội dung (<?= _lang_nb3_key ?>)</label>
                                            <textarea id="noidung_cn" name="noidung_cn" rows="10"
                                                      cols="80"><?= !empty($noidung_cn) ? SHOW_text($noidung_cn) : '' ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Seo Title (<?= _lang_nb3_key ?>)</label>
                                            <input type="text" class="form-control" name="seo_title_cn"
                                                   value="<?= !empty($seo_title_cn) ? Show_text($seo_title_cn) : "" ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Seo Description (<?= _lang_nb3_key ?>)</label>
                                            <input type="text" class="form-control" name="seo_description_cn"
                                                   value="<?= !empty($seo_description_cn) ? Show_text($seo_description_cn) : "" ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Seo keywords (<?= _lang_nb3_key ?>)</label>
                                            <input type="text" class="form-control" name="seo_keywords_cn"
                                                   value="<?= !empty($seo_keywords_cn) ? Show_text($seo_keywords_cn) : "" ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="col-lg-12">
                    <div class="box p10">
                        <div class="form-group">
                            <label>Seo name <a
                                        data-tooltip="Đường dẫn chuẩn bao gồm các ký tự [a-zA-Z0-9-]."> </a></label>
                            <input type="text" class="form-control" name="seo_name" id="seo_name"
                                   value="<?= !empty($seo_name) ? Show_text($seo_name) : "" ?>">
                            <label class="noweight noweight-top checkbox-mini">
                                <input class="minimal auto_get_link"
                                       type="checkbox" <?= empty($id) || $id == 0 ? 'checked="checked"' : '' ?>> Lấy
                                đường dẫn tự động
                            </label>
                        </div>

                        <div class="form-group">
                            <label>Link khác<a></a></label>
                            <input type="text" class="form-control" name="linkkhac" id="linkkhac"
                                   value="<?= !empty($linkkhac) ? Show_text($linkkhac) : "" ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Hình đại diện</label>
                            <?= !empty($icon) ? $icon : '' ?>
                            <input name="icon" type="file" class="form-control" id="exampleInputFile">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Hình ảnh trang chủ(nếu có)</label>
                            <?= !empty($icon2) ? $icon2 : '' ?>
                            <input name="icon2" type="file" class="form-control" id="exampleInputFile">
                        </div>
                        <?php
                        if ($step == 5) {
                            ?>
                           <!-- <div class="form-group">
                                <label>Google map</label>
                                <input type="text" class="form-control" name="map_google" id="map_google"
                                       value="<?= !empty($map_google) ? SHOW_text($map_google) : '' ?>">
                            </div>-->
                            <?php
                        }
                        ?>

                        <?php if (isset($_SESSION['admin'])) { ?>
                            <div class="form-group">
                                <label>Kiểu hiển thị</label>
                                <?= DANHSACH_page(@$step, 'step', 'form-control', 0) ?>
                            </div>
                        <?php } ?>

                        <div class="form-group">
                            <label>Số lượng bài viết hiển thị trên 1 trang</label>
                            <input type="text" class="form-control" name="num_view"
                                   value="<?= !empty($num_view) ? SHOW_text($num_view) : "0" ?>"
                                   onkeyup="SetCurrency(this)">
                        </div>

                        <div class="form-group">
                            <label>Số thứ tự</label>
                            <input type="text" class="form-control" name="catasort" id="catasort"
                                   value="<?= !empty($catasort) ? SHOW_text($catasort) : "0" ?>"
                                   onkeyup="SetCurrency(this)">
                        </div>

                        <div class="form-group">
                            <label class="mr-20">
                                <input type="radio" name="showhi"
                                       value="1" <?= !empty($showhi) ? LAY_checked($showhi, 1) : 'checked' ?>> Hiện thị
                            </label>
                            <label>
                                <input type="radio" name="showhi"
                                       value="2" <?= !empty($showhi) ? LAY_checked($showhi, 2) : '' ?>> Ẩn
                            </label>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        <div class="box-header mb-60">
            <h3 class="box-title box-title-td pull-right">
                <button onclick="return CHECK_sb()" type="submit" class="btn btn-primary"><i
                            class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                <?php
                if (isset($_SESSION['admin'])) echo '<a href="?module=' . $module . '&action=' . $action . '&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i>Thêm mới</a>';
                ?>
                <a href="<?= $url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
            </h3>
        </div>
    </form>
<?php $ckeditor->replace('noidung_vi'); ?>
<?php $ckeditor->replace('p3_vi'); ?>
<?php if ($lang_nb2) {
    $ckeditor->replace('noidung_en');
    $ckeditor->replace('p3_en');
} ?>
<?php if ($lang_nb3) {
    $ckeditor->replace('noidung_cn');
    $ckeditor->replace('p3_cn');
} ?>