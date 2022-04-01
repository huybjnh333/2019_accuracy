<?php
$table = "#_clanguage";
$id = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        ${$key} = $value;
    }

}
if (!empty($_POST)) {

    $data = array();
    $data['code_lang'] = $code_lang;
    $data['lang_vi'] = @$lang_vi;
    $data['lang_en'] = @$lang_en;
    $data['lang_cn'] = @$lang_cn;

    if ($id == 0) {
        $id = ACTION_db($data, $table, 'add', NULL, NULL);
        $_SESSION['show_message_on'] = "Thêm ngôn ngữ thành công!";
        LOCATION_js($url_page . "&edit=" . $id);
        exit();
    } else {
        ACTION_db($data, $table, 'update', NULL, "`id` = '" . $id . "'");
        $_SESSION['show_message_on'] = "Cập nhật ngôn ngữ thành công!";
    }
}

if ($id > 0) {
    $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
    $sql_se = mysql_fetch_assoc($sql_se);
    foreach ($sql_se as $key => $value) {
        ${$key} = SHOW_text($value);
    }
}
?>
<section class="content-header">
    <h1>Quản lý ngôn ngữ</h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Quản lý ngôn ngữ</li>
    </ol>
</section>

<form id="form_submit" name="form_submit" action="" method="post">
    <section class="content form_create">
        <div class="row">
            <section class="col-lg-12">
                <?php include _source . "mesages.php"; ?>
                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="h2_title">
                            <i class="fa fa-pencil-square-o"></i> <?= $id > 0 ? 'Sửa' : 'Thêm' ?> ngôn ngữ
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                            <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i
                                        class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                            <a href="<?= $url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
                        </h3>
                    </div>
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="form-group">
                                <label>Mã ngôn ngữ</label>
                                <input type="text" class="form-control" id="code_lang" name="code_lang"
                                       value="<?= (isset($code_lang)) ? $code_lang : '' ?>" <?= ($id > 0 ? 'readonly' : '') ?>>
                            </div>
                            <div class="form-group">
                                <label>Ngôn ngữ (<?= _lang_nb1_key ?>)</label>
                                <input type="text" class="form-control" name="lang_vi"
                                       value="<?= !empty($lang_vi) ? $lang_vi : '' ?>">
                            </div>
                            <?php if ($lang_nb2) { ?>
                                <div class="form-group tienganh">
                                    <label>Ngôn ngữ (<?= _lang_nb2_key ?>)</label>
                                    <input type="text" class="form-control" name="lang_en"
                                           value="<?= !empty($lang_en) ? $lang_en : '' ?>">
                                </div>
                            <?php } ?>
                            <?php if ($lang_nb3) { ?>
                                <div class="form-group tienganh">
                                    <label>Ngôn ngữ (<?= _lang_nb3_key ?>)</label>
                                    <input type="text" class="form-control" name="lang_cn"
                                           value="<?= !empty($lang_cn) ? $lang_cn : '' ?>">
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <div class="box-header mb-40">
        <h3 class="box-title box-title-td pull-right">
            <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i
                        class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
            <a href="<?= $url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
        </h3>
    </div>
</form>
<script>
    function checkSubmit() {
        if ($("#code_lang").val() == '') {
            alert("Hãy nhập Mã ngôn ngữ!");
            $("#code_lang").focus();
            return false;
        }
        // document.getElementById("form_submit").submit();
    }
</script>