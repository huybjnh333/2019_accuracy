<?php
$danhmucsp = DB_fet("*",
    "#_danhmuc",
    "`showhi` = 1 AND `step` = 1 AND id_parent = 0",
    "`catasort` asc, `id` asc",
    "", 1, 1);

$limit = 15;
?>

<?php foreach ($danhmucsp as $row) {
    $url = $full_url . '/' . $row['seo_name'];
    $idparent = $row['id'];
    $danhmuc_cap2 = DB_fet("*",
        "#_danhmuc",
        "`showhi` = 1 AND `step` = 1 AND id_parent= $idparent ",
        "`catasort` asc, `id` asc",
        "", 1, 1);
    $totalpage = round(count($danhmuc_cap2) / $limit);
    if (count($danhmuc_cap2) % $limit != 0) {
        $totalpage = $totalpage + 1;
    }
    $array_div = array();
    for ($i = 1; $i <= $totalpage; $i++) {
        $start = 0;
        $end = $limit;
        if ($i > 1) {
            $start = $limit * ($i - 1);
        }
        $arr_temp = array_slice($danhmuc_cap2, $start, $end);
        array_push($array_div, $arr_temp);
    }
    ?>
    <li class="menu-1 has-submenu  "><a href="<?= $url ?>" class="pl-3 pr-3"> <?= $row['tenbaiviet_' . $lang] ?> </a>
        <ul class="menu-child sub-menu pt-1 ">
            <?php
            foreach ($array_div as $rowdiv) {
                foreach ($rowdiv as $row_child) {
                    $tendm_child = $row_child['tenbaiviet_' . $lang];
                    $urlchild = $full_url . '/' . $row_child['seo_name'];
                    ?>
                    <li class="menu-2 "><a href="<?= $urlchild ?>"><?= $tendm_child ?></a></li>
                <?php }
            } ?>
        </ul>
    </li>
<?php } ?>

