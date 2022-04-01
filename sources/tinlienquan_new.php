<?php
//hàm trả về id của tin mới nhất
function idtintuc_moi(){
    $tintuc_moi = danhSachTinTuc("`showhi` = 1 AND `step` = 3",
        "`id` DESC",
        "1");
    foreach ($tintuc_moi as $value){
        $id = $value['id'];
    }
    return $id;
}
function danhSachTinTuc($where, $order, $limit)
{
    $danhsachtintuc = DB_fet("*",
        "#_baiviet",
        $where,
        $order,
        $limit,
        1,
        1);
    return $danhsachtintuc;
}
$tintuc_moi = danhSachTinTuc("`showhi` = 1 AND `id_parent` != 17 AND `step` = $slug_step ",
    "`id` DESC",
    "1");
$tintuc_moi_right = danhSachTinTuc("`showhi` = 1 AND `id_parent` != 17 AND `step` = " . $slug_step . " AND id !=" . idtintuc_moi(),
    "`catasort` DESC, `id` DESC, `soluotxem` DESC",
    "5");
if((($slug_step != $slug_id) || $slug_table == 'danhmuc')) {
    $tintuc_moi = danhSachTinTuc("`showhi` = 1 AND `id_parent` != 17 AND  `step` = $slug_step AND `id_parent` = $slug_id",
        "`id` DESC",
        "1");
    $tintuc_moi_right = danhSachTinTuc("`showhi` = 1 AND `id_parent` != 17 AND `id_parent` = $slug_id AND `step` = " . $slug_step . " AND id !=" . idtintuc_moi(),
        "`catasort` DESC, `id` DESC, `soluotxem` DESC",
        "5");
}
?>
<div class="new_top_id">
    <?php
    foreach ($tintuc_moi as $value){
        $tenbaiviet = $value['tenbaiviet_' . $lang];
        $image = $fullpath . '/' . $value['duongdantin'] . '/' . $value['icon'];
        $seo_name = $full_url. '/'. $value['seo_name'];
        $mota = $value['mota_'.$lang];
        ?>
        <div class="one_new_home">
            <li><a href="<?= $seo_name ?>"><img alt="<?= $tenbaiviet ?>" src="<?= $image ?>"/></a></li>
            <ul>
                <h3><a href="<?= $seo_name ?>" class="limit-row-3" ><?= $tenbaiviet ?></a></h3>
                <p class="limit-row-4"><?= $mota ?></p>
            </ul>
            <div class="clr"></div>
        </div>
    <?php }?>
    <div class="one_new_home_right">
        <?php
        foreach ($tintuc_moi_right as $value){
            $tenbaiviet = $value['tenbaiviet_' . $lang];
            $image = $fullpath . '/' . $value['duongdantin'] . '/' . $value['icon'];
            $seo_name = $full_url. '/'. $value['seo_name'];
            $mota = $value['mota_'.$lang];
        ?>
            <ul>
                <li><a href="<?= $seo_name ?>"><img alt="<?= $tenbaiviet ?>" src="<?= $image ?>"/></a></li>
                <h3><a  class="limit-row-3" href="<?= $seo_name ?>"><?= $tenbaiviet ?></a></h3>
                <div class="clr"></div>
            </ul>
        <?php } ?>
    </div>
    <div class="clr"></div>
</div>
