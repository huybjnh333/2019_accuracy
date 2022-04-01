<?php
$table = '#_lien_ket_nhanh';
$id = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        ${$key} = $value;
    }
    $catasort = str_replace(".", "", $_REQUEST['catasort']);
    $showhi = isset($_POST['showhi']) ? 1 : 0;
}


if (!empty($_POST)) {

    $data = array();
    $data['tenbaiviet_vi'] = $tenbaiviet_vi;
    $data['tenbaiviet_en'] = $tenbaiviet_en;
    $data['catasort'] = $catasort;
    $data['showhi'] = $showhi;
    $data['lien_ket_vi'] = $lien_ket_vi;
    $data['lien_ket_en'] = $lien_ket_en;
    $data['target'] = $target;
    $data['typelienket'] = $typelienket;


    if ($id == 0) {
        $id = ACTION_db($data, $table, 'add', NULL, NULL);
        $_SESSION['show_message_on'] = "Thêm liên kết nhanh thành công!";
        LOCATION_js($url_page . "&edit=" . $id);
        exit();
    } else {
        ACTION_db($data, $table, 'update', NULL, "`id` = " . $id);
        $_SESSION['show_message_on'] = "Cập nhật liên kết nhanh thành công!";
    }
}


if ($id > 0) {
    $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
    $sql_se = mysql_fetch_array($sql_se);

    foreach ($sql_se as $key => $value) {
        ${$key} = SHOW_text($value);
    }

} else {
    $catasort = layCatasort($table);
    $catasort = number_format(SHOW_text($catasort), 0, ',', '.');
}
?>

<section class="content-header">
    <h1>Danh sách liên kết nhanh</h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Liên kết nhanh</li>
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
                            <i class="fa fa-pencil-square-o"></i><?= $id > 0 ? 'Sửa' : 'Thêm' ?> liên kết nhanh
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                            <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i
                                        class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                            <a href="<?= $url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i>
                                Thêm mới</a>
                            <a href="<?= $url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
                        </h3>
                    </div>
                </div>
            </section>
            <section class="col-lg-12">
                <div class="nav-tabs-custom" style="margin-bottom: 0;">
                    <?php include _source . "lang.php" ?>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="form-group">
                                <label>Tên chủ đề</label>
                                <input type="text" class="form-control"
                                       value="<?= !empty($tenbaiviet_vi) ? SHOW_text($tenbaiviet_vi) : '' ?>"
                                       name="tenbaiviet_vi" id="tenbaiviet_vi">
                            </div>
                            <div class="form-group">
                                <label>Liên kết</label>
                                <input type="text" class="form-control"
                                       value="<?= !empty($lien_ket_vi) ? SHOW_text($lien_ket_vi) : '' ?>"
                                       name="lien_ket_vi" id="lien_ket_vi">
                            </div>
                        </div>
                        <?php if ($lang_nb2) { ?>
                            <div class="tab-pane" id="tab_2">
                                <div class="form-group">
                                    <label>Tên chủ đề (<?= _lang_nb2_key ?>)</label>
                                    <input type="text" class="form-control"
                                           value="<?= !empty($tenbaiviet_en) ? SHOW_text($tenbaiviet_en) : '' ?>"
                                           name="tenbaiviet_en" id="tenbaiviet_en">
                                </div>
                                <div class="form-group">
                                    <label>Liên kết (<?= _lang_nb2_key ?>)</label>
                                    <input type="text" class="form-control"
                                           value="<?= !empty($lien_ket_en) ? SHOW_text($lien_ket_en) : '' ?>"
                                           name="lien_ket_en" id="lien_ket_en">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="box p10">
                   <!-- <div class="form-group">
                        <label>Target</label>
                        <select name="target" class="form-control">
                            <option value="">Mặc định</option>
                            <option value="_blank" <?= !empty($target) && $target == '_blank' ? 'selected="selected"' : '' ?> >
                                Cửa sổ mới
                            </option>
                        </select>
                    </div>
                    <?php
                    $array_link = array(
                        1 => 'Hướng dẫn thanh toán',
                        2 => 'Chính sách bán hàng',
//                        3 => 'Dịch Vụ',
                    );
                    ?>
                   <div class="form-group">
                        <label>Loại Liên Kết</label>
                        <select name="typelienket" class="form-control">
                            <?php
                            foreach ($array_link as $k => $rowtypelienket) {
                                $select = '';
                                if ($typelienket == $k) {
                                    $select = 'selected';
                                }
                                ?>
                                <option <?= $select ?> value="<?= $k ?>"><?= $rowtypelienket ?></option>
                            <?php } ?>
                        </select>
                    </div>-->
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
            alert("Hãy nhập tên liên kết nhanh!");
            $("#tenbaiviet_vi").focus();
            return false;
        }
        document.getElementById("form_submit").submit();
    }
</script>