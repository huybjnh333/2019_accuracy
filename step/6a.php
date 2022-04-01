<?php
include _source . "phantrang_kietxuat.php";
$databaiviet = DB_fet("*", "#_baiviet_img", 'id_parent=' . $arr_running['id'], "", "", "arr", 1);

$numview = 1000000;
$total = count($databaiviet);
$totalpage = floor($total / $numview) + 1;
$start = 0;
$end = $numview;
$page = 1;
if (!empty($_GET['page'])) {
    $page = $_GET['page'];
}
if ($page > 1) {
    $start = $numview * ($page - 1);
    $end = $numview;
}
$data = DB_que("SELECT * FROM `#_baiviet_img` WHERE  `id_parent`=" . $arr_running['id'] . " limit $start,$end");
include _source."box-header.php";
?>
<link href="css/lightgallery.min.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="js/lightgallery-all.js"></script>
<div class="pagewrap page_conten_page">
    <div class="albumView">
        <div id="lightgallery" class="album-zoom-gallery flex">
            <?php
            while ($value = mysql_fetch_array($data)){
                $name = $value['p_name'];
                $image = $fullpath."/datafiles/".$value['duongdantin']."/".$name;
                ?>
            <div class="item" data-src ="<?= $image ?>">
                <a><img src="<?= $image ?>" alt="<?= $name ?>" /></a>
            </div>
            <?php }?>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#lightgallery').lightGallery();
        });
    </script>
    <div class="clr"></div>
    <div class="nums">
        <ul>
            <?= PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty, $_SERVER['QUERY_STRING']) ?>
        </ul>
        <div class="clr"></div>
    </div>
</div>
