<?php
//$danhmucsp = datadanhmuc("`showhi` = 1");
//$danhmuc_duocpham = datadanhmuc("`showhi` = 1 AND id=".$arr_running['id']);
//function datadanhmuc($where)
//{
//    $danhmucsp = DB_fet("*",
//        "#_danhmuc",
//        $where,
//        "catasort asc, id asc",
//        "",
//        1);
//    return $danhmucsp;
//}
$logo_thuonghieu = DB_fet("*",
    "#_danhmuc",
    "`showhi` = 1 AND id_parent =". $arr_running['id'],
    "catasort asc, id asc",
    "",
    1,
    1);
?>
<?php
    if($motty != 'san-pham'){
?>
<div class="logo_thuoghieu flex">
  <ul>
      <?php
      foreach ($logo_thuonghieu as $value){
      $image = $fullpath. '/'. $value['duongdantin']. '/'.$value['icon'];
      $url = $full_url. '/'. $value['seo_name'];
      ?>
    <li><a href="<?= $url ?>"><img src="<?= $image ?>" width="280" height="149" /></a></li>
      <?php } ?>
    <div class="clr"></div>
  </ul>
</div>
<?php } ?>
<div class="boder_line"></div>