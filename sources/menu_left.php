<?php
    $menu_left_parent = DB_fet("*",
        "#_danhmuc",
        "`showhi` = 1 AND `step` = 2 AND id_parent = 0",
        "catasort asc, id asc",
        "",
        1);

$menu_1 = menuChild("`showhi` = 1 AND `step` = 2 AND id_parent = 1");
$menu_2 = menuChild("`showhi` = 1 AND `step` = 2 AND id_parent = 2");
$menu_3 = menuChild("`showhi` = 1 AND `step` = 2 AND id_parent = 3");
$menu_4 = menuChild("`showhi` = 1 AND `step` = 2 AND id_parent = 4");
$menu_5 = menuChild("`showhi` = 1 AND `step` = 2 AND id_parent = 5");
$menu_6 = menuChild("`showhi` = 1 AND `step` = 2 AND id_parent = 6");
function menuChild($where){
    $menu_left_child = DB_fet("*",
        "#_danhmuc",
        $where,
        "catasort asc, id asc",
        "",
        1);
    return $menu_left_child;
}

//$iddm = $arr_running['id_parent'];
//if ($arr_running['id_parent'] == 0) {
//    $iddm = $arr_running['id'];
//}
//$dmuccha = DB_fet("*",
//    "#_danhmuc",
//    "`showhi` = 1 AND `step` = " . $slug_step . " AND id = $iddm",
//    "catasort asc, id asc",
//    1,
//    1);
//$dmuccha = reset($dmuccha);
//
//$danhmuccon = DB_fet("*",
//    "#_danhmuc",
//    "`showhi` = 1 AND `step` = " . $slug_step . " AND id_parent = " . $dmuccha['id'],
//    "catasort asc, id asc",
//    "",
//    1);
//$menu_child = DB_fet("*",
//    "#_danhmuc",
//    "`showhi` = 1 AND id_parent =". $arr_running['id'],
//    "catasort asc, id asc",
//    "",
//    1,
//    1);
include _source . 'menu-child.php' ?>
?>

<div class="dv-menu-left-cont <?= (!empty($motty)) ? 'onchild' : 'home' ?>">
  <div class="pagewrap">
    <div class="dv-menu-left"> <a href=""><i class="fa fa-bars" aria-hidden="true"></i> DANH MỤC SẢN PHẨM</a>
      <ul class="menu-main">
          <?php
            foreach ($menu_left_parent as $value){
                $tenbaiviet = $value['tenbaiviet_'.$lang];
                $seo_name = $full_url . '/' .$value['seo_name'];
          ?>
        <li class="menu-1 has-submenu  "> <a href="<?= $seo_name ?>" class="pl-3 pr-3"> <?= $tenbaiviet ?> </a>
          <ul class="menu-child sub-menu pt-1 ">
              <?php
                foreach ($menu_1 as $value){
                 $tenbaiviet_child = $value['tenbaiviet_'.$lang];

              ?>
            <li class="menu-2 "> <a href="index.php?page=sanpham_id"><?= $tenbaiviet_child ?></a> </li>
              <?php } ?>
<!--            <li class="menu-2 "> <a href="index.php?page=sanpham_id">VINAMILK</a> </li>-->
<!--            <li class="menu-2 "> <a href="index.php?page=sanpham_id">ENFA - MỸ</a> </li>-->
<!--            <li class="menu-2 "> <a href="index.php?page=sanpham_id">NUTI FOOD</a> </li>-->
<!--            <li class="menu-2 "> <a href="index.php?page=sanpham_id">ABBOTT - MỸ</a> </li>-->
<!--            <li class="menu-2 "> <a href="index.php?page=sanpham_id">NESTLÉ</a> </li>-->
<!--            <li class="menu-2 "> <a href="index.php?page=sanpham_id">SỮA NHẬT</a> </li>-->
<!--            <li class="menu-2 "> <a href="index.php?page=sanpham_id">SỮA PHÁP</a> </li>-->
<!--            <li class="menu-2 "> <a href="index.php?page=sanpham_id">FRISO-DUTCH LADY</a> </li>-->
<!--            <li class="menu-2 "> <a href="index.php?page=sanpham_id">ANKA - IRELAND</a> </li>-->
<!--            <li class="menu-2 "> <a href="index.php?page=sanpham_id">S26 GOLD WYETH</a> </li>-->
<!--            <li class="menu-2 "> <a href="index.php?page=sanpham_id">NUTRICARE</a> </li>-->
<!--            <li class="menu-2 "> <a href="index.php?page=sanpham_id">SỮA ĐỨC</a> </li>-->
<!--            <li class="menu-2 "> <a href="index.php?page=sanpham_id">IQLAC PRO</a> </li>-->
<!--            <li class="menu-2 "> <a href="index.php?page=sanpham_id">DANONE</a> </li>-->
<!--            <li class="menu-2 "> <a href="index.php?page=sanpham_id">PRONUBEN BABY</a> </li>-->
<!--            <li class="menu-2 "> <a href="index.php?page=sanpham_id">VITADAIRY</a> </li>-->
<!--            <li class="menu-2 "> <a href="index.php?page=sanpham_id">INFANSURE - ÚC</a> </li>-->
          </ul>
        </li>
          <?php } ?>
      </ul>
    </div>
  </div>
</div>

