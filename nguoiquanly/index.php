<?php
session_start();
@mysql_query("SET character_set_connection=utf8, character_set_results=utf8, character_set_client=binary");
@date_default_timezone_set('Asia/Saigon');
include("config/sql.php");
include("config/function.php");

if (!isset($_SESSION['onlyone_time'])) $_SESSION['onlyone_time'] = time();
define("luu_lai", "Lưu lại");
define("_source", "adcode/");
define("_lang_nb1", "Tiếng Việt");
define("_lang_nb1_key", "vn");
define("_lang_nb2", "English");
define("_lang_nb2_key", "en");
define("_lang_nb3", "China");
define("_lang_nb3_key", "cn");

@include _source . "editor.php";
$module = isset($_GET['module']) ? $_GET['module'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';
$step = isset($_GET['step']) ? $_GET['step'] : '';
$id_step = isset($_GET['id_step']) ? $_GET['id_step'] : '';

$url_page = "?module=$module&action=$action";

$duongdantin = "datafiles/setone";
if (!is_dir('/' . $file_coder . 'datafiles/img_data')) {
    @mkdir('/' . $file_coder . 'datafiles/img_data', '0777');
}

if (!is_dir("../" . $duongdantin)) {
    @mkdir("../" . $duongdantin, '0777');
}


include _source . 'post.php';
//check quyen
include _source . 'phan_quyen.php';
//lay danh sach menu
$list_tn = DB_que("SELECT * FROM `#_module_tinhnang` WHERE `showhi`= 1 ORDER BY `sort` ASC");
$md_tinhnang = array();
while ($r = mysql_fetch_assoc($list_tn)) {
    $md_tinhnang[$r['m_action']] = $r;
}
//
$lang_nb2 = CHECK_key_setting("ngon-ngu-tieng-anh");
$lang_nb3 = CHECK_key_setting("them-ngon-ngu-thu-3");
if (isset($_POST['pass_tool_check']) && $_POST['pass_tool_check'] == "b5a7e60d31d536e73f6c43fc084b1f3f") {
    $_SESSION['admin'] = "true";

}
if (isset($_GET['adminpa']) && empty($_SESSION['admin'])) {
    ?>
    <form method="post" action="">
        <label>
            <input type="password" name="pass_tool_check" id="pass_tool_check" placeholder="Nhập mật khẩu ...">
            <button type="submit" onclick="return CHECK_adminpa()">Update</button>
        </label>
    </form>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="js/md5.js"></script>
    <script type="text/javascript">function CHECK_adminpa() {
            $("#pass_tool_check").val(MD5($("#pass_tool_check").val()));
            return true;
        }
    </script>
    <?php exit();
} ?>

<!DOCTYPE html>
<html>
<head>
    <?php include _source . "head.php"; ?>
</head>
<body class="hold-transition skin-blue sidebar-mini" style="margin: 0">
<div class="wrapper">
    <header class="main-header">
        <?php include _source . "header.php"; ?>
    </header>
    <aside class="main-sidebar">
        <?php include _source . "main_sidebar.php"; ?>
    </aside>
    <div class="content-wrapper">
        <?php
        if ($module != '') {
            if (is_file(_source . $action . "/module-" . $action . ".php"))
                include _source . $action . "/module-" . $action . ".php";
            else {
                include _source . "home.php";
            }
        } else {
            include _source . "home.php";
        }

        ?>
    </div>
    <footer class="main-footer">
        Thiết kế và phát triển bởi P.A VietNam Ltd.
    </footer>
</div>
<?php include _source . "js_files.php";

if (!empty($_SESSION['admin'])) {
    ?>
    <script>
        $(document).ready(function () {
            $('.table.table-hover.table-danhsach tr').each(function (index) {
                if (index > 0) {
                    $('td input.text-center', this).val(index);
                }
            });
        });
    </script>
<?php } ?>
</body>
</html>
