<?php
$title = "Thống kê";
if (!empty($motty) && !empty($_GET['action'])) {
    $actionname = $_GET['action'];
    $arr_running = DB_fet("*", "#_module_tinhnang", "`showhi` = 1 AND `m_action` = '" . $actionname . "'", "", 1, 1, 1);
    $arr_running = reset($arr_running);
    $title = $arr_running['ten_vi'];
}

?>

<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active"><?= $title ?></li>
    </ol>
</section>