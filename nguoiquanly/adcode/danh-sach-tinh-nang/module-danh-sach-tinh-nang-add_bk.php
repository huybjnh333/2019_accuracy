<?php
$table = '#_baiviet_tinhnang';
$id = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        ${$key} = $value;
    }
    $catasort = str_replace(".", "", $catasort);
    // $val_min        = str_replace(".", "", $val_min);
    // $val_max        = str_replace(".", "", $val_max);

}

if (!empty($_POST)) {

    $_POST['seo_title_vi'] = @$seo_title_vi;
    $_POST['seo_title_en'] = @$seo_title_en;
    $_POST['seo_description_vi'] = @$seo_description_vi;
    $_POST['seo_description_en'] = @$seo_description_en;
    $_POST['seo_keywords_vi'] = @$seo_keywords_vi;
    $_POST['seo_keywords_en'] = @$seo_keywords_en;
    $_POST['step'] = @$step;
    $_POST['catasort'] = @$catasort;
    $_POST['color'] = @$color;
    // $_POST['val_max']               = @$val_max;

    if ($id == 0) {
        $id = ACTION_db($_POST, $table, 'add', NULL, NULL);
        $_SESSION['show_message_on'] = "Thêm tính năng thành công!";
        LOCATION_js($url_page . "&step=" . @$step . "&id_step=" . @$id_step . "&edit=" . $id);
        exit();
    } else {
        ACTION_db($_POST, $table, 'update', NULL, "`id` = " . $id);
        $_SESSION['show_message_on'] = "Cập nhật tính năng thành công!";
    }
}


if ($id > 0) {
    $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
    $sql_se = mysql_fetch_array($sql_se);
    foreach ($sql_se as $key => $value) {
        ${$key} = SHOW_text($value);
    }


    $catasort = number_format($catasort, 0, ',', '.');


} else {
    $catasort = layCatasort($table, '`step` = ' . SHOW_text($_GET['step']));
    $catasort = number_format(SHOW_text($catasort), 0, ',', '.');
    $id_parent = 0;
}
?>

<section class="content-header">
    <h1>Danh sách tính năng</h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Quản lý tính năng</li>
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
                            <i class="fa fa-pencil-square-o"></i><?= GETNAME_step($id_step) ?>
                            > <?= $id > 0 ? 'Sửa' : 'Thêm' ?> tính năng
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                            <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i
                                        class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                            <a href="<?= $url_page ?>&them-moi=true&step=<?= @$_GET['step'] ?>&id_step=<?= @$id_step ?>"
                               class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                            <a href="<?= $url_page ?>&step=<?= @$_GET['step'] ?>&id_step=<?= @$id_step ?>"
                               class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
                        </h3>
                    </div>
                    <div class="nav-tabs-custom">
                        <?php include _source . "lang.php" ?>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="form-group">
                                    <label>Tên tính năng</label>
                                    <input type="text" class="form-control"
                                           value="<?= !empty($tenbaiviet_vi) ? SHOW_text($tenbaiviet_vi) : '' ?>"
                                           name="tenbaiviet_vi" id="tenbaiviet_vi">
                                </div>
                            </div>

                            <?php if ($lang_nb2) { ?>
                                <div class="tab-pane" id="tab_2">
                                    <div class="form-group">
                                        <label>Tên tính năng (EN)</label>
                                        <input type="text" class="form-control"
                                               value="<?= !empty($tenbaiviet_en) ? SHOW_text($tenbaiviet_en) : '' ?>"
                                               name="tenbaiviet_en" id="tenbaiviet_en">
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
                        <label>Nằm trong</label>
                        <select name="id_parent" id="id_parent" class="form-control">
                            <?php //if (isset($_SESSION['admin'])) { ?>
                            <option value="0">Chọn chủ đề con</option>
                            <?php //} ?>
                            <?php
                            $list_array = DB_fet("*", "#_baiviet_tinhnang", "`step` = '$step'", "`catasort` ASC", "", "arr");
                            foreach ($list_array as $val) {
                                if ($val['id_parent'] != 0) continue;
                                echo '<option value="' . $val['id'] . '" ' . (($id_parent == $val['id']) ? 'selected="selected"' : '') . '>' . $val['tenbaiviet_vi'] . '</option>';
                                foreach ($list_array as $val_2) {
                                    if ($val_2['id_parent'] != $val['id']) continue;
                                    echo '<option value="' . $val_2['id'] . '">==> ' . $val_2['tenbaiviet_vi'] . '</option>';

                                    foreach ($list_array as $val_3) {
                                        if ($val_3['id_parent'] != $val_2['id']) continue;
                                        echo '<option value="' . $val_3['id'] . '" disabled="disabled">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;==> ' . $val_3['tenbaiviet_vi'] . '</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Màu sắc</label>
                        <div>
                            <input type="color" name="color" value="<?= $color ?>" onkeyup="SetCurrency(this)"
                            >
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Số thứ tự</label>
                        <input type="text" class="form-control" name="catasort" id="catasort"
                               value="<?= SHOW_text($catasort) ?>" onkeyup="SetCurrency(this)">
                    </div>

                    <div class="form-group">
                        <label class="mr-20">
                            <input type="radio" name="showhi" class="minimal"
                                   value="1" <?= !empty($showhi) ? LAY_checked($showhi, 1) : 'checked' ?>> Hiển
                            thị
                        </label>
                        <label>
                            <input type="radio" name="showhi" class="minimal"
                                   value="2" <?= !empty($showhi) ? LAY_checked($showhi, 2) : '' ?>> Ẩn
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
            <a href="<?= $url_page ?>&them-moi=true&step=<?= @$_GET['step'] ?>&id_step=<?= @$id_step ?>"
               class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
            <a href="<?= $url_page ?>&step=<?= @$_GET['step'] ?>&id_step=<?= @$id_step ?>" class="btn btn-primary"><i
                        class="fa fa-sign-out"></i> Thoát</a>
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