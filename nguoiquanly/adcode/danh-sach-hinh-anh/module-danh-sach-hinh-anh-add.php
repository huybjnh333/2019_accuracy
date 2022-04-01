<?php
$table = '#_banner';
$id = isset($_GET['edit']) && is_numeric($_GET['edit']) ? $_GET['edit'] : 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        ${$key} = $value;
    }

    $catasort = str_replace(".", "", $catasort);
    $showhi = isset($_POST['showhi']) ? 1 : 0;
    $check_video = isset($_POST['check_video']) ? 1 : 0;

}
if (!empty($_POST)) {
    $data = array();
    $data['tenbaiviet_vi'] = @$tenbaiviet_vi;
    $data['tenbaiviet_en'] = @$tenbaiviet_en;
    $data['tenbaiviet_cn'] = @$tenbaiviet_cn;
    $data['noidung_vi'] = @$noidung_vi;
    $data['noidung_en'] = @$noidung_en;
    $data['noidung_cn'] = @$noidung_cn;
    $data['mota_vi'] = @$mota_vi;
    $data['mota_en'] = @$mota_en;
    $data['mota_cn'] = @$mota_cn;
    $data['id_parent'] = @$id_parent;
    $data['lien_ket'] = @$lien_ket;
    $data['catasort'] = @$catasort;
    $data['showhi'] = @$showhi;
    $data['check_video'] = @$check_video;
    $data['duongdantin'] = @$duongdantin;
    $data['blank'] = @$blank;
    $data['p1'] = @$p1;
    $data['ngaydang'] = time();
    $data['catasort'] = $catasort;

    $hinhanh = UPLOAD_image("icon", "../" . $duongdantin . "/", time());
    $video = UPLOAD_file("video", "../datafiles/files/", time());

    if ($video) {
        $data['video'] = $video;
    }

    if ($hinhanh) {
        $data['icon'] = $hinhanh;
        TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh, "../" . $duongdantin . "/thumb_" . $hinhanh, 500, 500);
        if ($id > 0) {
            //xoa anh
            $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
            @unlink("../" . mysql_result($sql_thongtin, 0, "duongdantin") . "/" . mysql_result($sql_thongtin, 0, "icon"));
            @unlink("../" . mysql_result($sql_thongtin, 0, "duongdantin") . "/thumb_" . mysql_result($sql_thongtin, 0, "icon"));
            //end
        }
    }
    if ($id == 0) {
        $id = ACTION_db($data, $table, 'add', NULL, NULL);
        $_SESSION['show_message_on'] = "Thêm hình ảnh thành công!";
        LOCATION_js($url_page . "&edit=" . $id);
        exit();
    } else {
        ACTION_db($data, $table, 'update', NULL, "`id` = '" . $id . "'");
        $_SESSION['show_message_on'] = "Cập nhật hình ảnh thành công!";
    }
}

if ($id > 0) {
    $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
    $sql_se = mysql_fetch_array($sql_se);

    foreach ($sql_se as $key => $value) {
        ${$key} = SHOW_text($value);
    }

    $catasort = number_format($catasort, 0, ',', '.');


    if ($icon != '')
        $icon = "<img src='../$duongdantin/$icon' width='255' height='auto' style='display:block'>";
} else {
    $catasort = layCatasort($table);
    $catasort = number_format(SHOW_text($catasort), 0, ',', '.');
}
?>

<section class="content-header">
    <h1>Danh sách hình ảnh</h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Danh sách hình ảnh</li>
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
                            <i class="fa fa-pencil-square-o"></i> <?= $id > 0 ? 'Sửa' : 'Thêm' ?> hình ảnh
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                            <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i
                                        class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                            <a href="<?= $url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i>
                                Thêm mới</a>
                            <a href="<?= $url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>

                        </h3>
                    </div>
                    <div class="nav-tabs-custom">
                        <?php include _source . "lang.php" ?>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="form-group">
                                    <label>Tên banner</label>
                                    <input type="text" class="form-control"
                                           value="<?= !empty($tenbaiviet_vi) ? SHOW_text($tenbaiviet_vi) : '' ?>"
                                           name="tenbaiviet_vi" id="tenbaiviet_vi">
                                </div>
                                <?php
                                $danhsach_hinhanh_mota = CHECK_key_setting("danh-sach-hinh-anh-mota");
                                if ($danhsach_hinhanh_mota) {
                                    ?>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <input type="text" class="form-control" name="mota_vi" id="mota_vi"
                                               value="<?= !empty($mota_vi) ? SHOW_text($mota_vi) : '' ?>">
                                    </div>
                                    <?php
                                }
                                $danhsach_hinhanh_noidung = CHECK_key_setting("danh-sach-hinh-anh-noidung");
                                if ($danhsach_hinhanh_noidung) {
                                    ?>
                                    <div class="form-group">
                                        <label>Nội dung</label>
                                        <textarea id="noidung_vi" name="noidung_vi" rows="10"
                                                  cols="80"><?= !empty($noidung_vi) ? SHOW_text($noidung_vi) : '' ?></textarea>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php if ($lang_nb2) { ?>
                                <div class="tab-pane" id="tab_2">
                                    <div class="form-group">
                                        <label>Tên banner (<?= _lang_nb2_key ?>)</label>
                                        <input type="text" class="form-control"
                                               value="<?= !empty($tenbaiviet_en) ? SHOW_text($tenbaiviet_en) : '' ?>"
                                               name="tenbaiviet_en" id="tenbaiviet_en">
                                    </div>
                                    <?php
                                    if ($danhsach_hinhanh_mota) {
                                        ?>
                                        <div class="form-group">
                                            <label>Mô tả (<?= _lang_nb2_key ?>)</label>
                                            <input type="text" class="form-control" name="mota_en" id="mota_en"
                                                   value="<?= !empty($mota_en) ? SHOW_text($mota_en) : '' ?>">
                                        </div>
                                        <?php
                                    }
                                    if ($danhsach_hinhanh_noidung) {
                                        ?>
                                        <div class="form-group">
                                            <label>Nội dung (<?= _lang_nb2_key ?>)</label>
                                            <textarea id="noidung_en" name="noidung_en" rows="10"
                                                      cols="80"><?= !empty($noidung_en) ? SHOW_text($noidung_en) : '' ?></textarea>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <?php if ($lang_nb3) { ?>
                                <div class="tab-pane" id="tab_3">
                                    <div class="form-group">
                                        <label>Tên banner (<?= _lang_nb3_key ?>)</label>
                                        <input type="text" class="form-control"
                                               value="<?= !empty($tenbaiviet_cn) ? SHOW_text($tenbaiviet_cn) : '' ?>"
                                               name="tenbaiviet_cn" id="tenbaiviet_cn">
                                    </div>
                                    <?php
                                    if ($danhsach_hinhanh_mota) {
                                        ?>
                                        <div class="form-group">
                                            <label>Mô tả (<?= _lang_nb3_key ?>)</label>
                                            <input type="text" class="form-control" name="mota_cn" id="mota_cn"
                                                   value="<?= !empty($mota_cn) ? SHOW_text($mota_cn) : '' ?>">
                                        </div>
                                        <?php
                                    }
                                    if ($danhsach_hinhanh_noidung) {
                                        ?>
                                        <div class="form-group">
                                            <label>Nội dung (<?= _lang_nb3_key ?>)</label>
                                            <textarea id="noidung_cn" name="noidung_cn" rows="10"
                                                      cols="80"><?= !empty($noidung_cn) ? SHOW_text($noidung_cn) : '' ?></textarea>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
            <section class="col-lg-12">
                <div class="box p10">
                    <div class="form-group">
                        <label for="exampleInputFile">Hình ảnh</label>
                        <?= !empty($icon) ? $icon : '' ?>
                        <input name="icon" type="file" class="form-control" id="exampleInputFile">
                    </div>
                    <div class="form-group">
                        <label>Loại banner</label>
                        <select name="id_parent" class="form-control">
                            <option value="0">Chọn loại banner</option>
                            <?php
                            $loaibanner = DB_que('SELECT * FROM `#_banner_danhmuc` WHERE `showhi` = 1 ORDER BY `catasort` ASC');
                            while ($r = mysql_fetch_array($loaibanner)) {
                                echo '<option value="' . $r['id'] . '" ' . LAY_selected($r['id'], $id_parent) . '>' . $r['tenbaiviet_vi'] . ' (' . $r['rong'] . 'x' . $r['cao'] . 'px)</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                    $danhsach_hinhanh_video = CHECK_key_setting("danh-sach-hinh-anh-video");
                    if ($danhsach_hinhanh_video) {
                        ?>
                        <div class="form-group">
                            <label for="exampleInputFile">Video <a
                                        data-tooltip="Chỉ upload 1 file [*.mp4] dung lượng file tối đa 10MB. Chỉ áp dụng cho vide banner"> </a></label>
                            <?= !empty($video) ? '</br>' . $video : '' ?>
                            <input name="video" type="file" class="form-control" id="exampleInputFile">
                            <label style=" margin-top: 10px; margin-bottom: 0;"><input type="checkbox" class="minimal"
                                                                                       name="check_video"
                                                                                       value="1" <?= LAY_checked(@$check_video, 1) ?>>
                                Ưu tiên chạy video</label>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label>Liên kết <a data-tooltip="Nếu Link đến URL của Web khác thì phải có http:// ở đầu."> </a></label>
                        <input type="text" class="form-control" name="lien_ket" id="lien_ket"
                               value="<?= !empty($lien_ket) ? SHOW_text($lien_ket) : '' ?>">
                    </div>
                    <div class="form-group">
                        <label>Hiển thị liên kết</label>
                        <select name="blank" class="form-control">
                            <option value="" <?= LAY_selected(@$blank, "") ?>>Mặc định</option>
                            <option value="_blank" <?= LAY_selected(@$blank, "_blank") ?>>Cửa sổ mới</option>
                        </select>
                    </div>
<!--                    <div class="form-group">-->
<!--                        <label>Vị trí hiển thị text</label>-->
<!--                        <select name="p1" class="form-control">-->
<!--                            --><?php //foreach ($arrayvitri as $k => $v) {
//                                $select = '';
//                                if ($p1 == $k) {
//                                    $select = 'selected="selected"';
//                                }
//
//                                ?>
<!--                                <option --><?//= $select ?><!-- value="--><?//= $k ?><!--">--><?//= $v ?><!--</option>-->
<!--                            --><?php //} ?>
<!--                        </select>-->
<!--                    </div>-->
                    <div class="form-group">
                        <label>Số thứ tự</label>
                        <input type="text" class="form-control" name="catasort" id="catasort"
                               value="<?= SHOW_text($catasort) ?>" onkeyup="SetCurrency(this)">
                    </div>
                    <div class="form-group">
                        <label class="mr-20 checkbox-mini">
                            <input type="checkbox" name="showhi"
                                   class="minimal" <?= isset($showhi) && $showhi == 0 ? '' : 'checked="checked"' ?>>
                            Hiển thị
                        </label>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <div class="box-header mb-60">
        <h3 class="box-title box-title-td pull-right">
            <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i
                        class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
            <a href="<?= $url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
            <a href="<?= $url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
        </h3>
    </div>
</form>

<script>
    function checkSubmit() {
        if ($("#tenbaiviet_vi").val() == '') {
            alert("Hãy nhập tên banner!");
            $("#tenbaiviet_vi").focus();
            return false;
        }
        // document.getElementById("form_submit").submit();
    }
</script>
<?php $ckeditor->replace('noidung_vi'); ?>
<?php if ($lang_nb2) $ckeditor->replace('noidung_en'); ?>
<?php if ($lang_nb3) $ckeditor->replace('noidung_cn'); ?>
 