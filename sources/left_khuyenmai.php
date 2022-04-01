<?php
 $sanpham_khuyenmai = DB_fet("*",
     "#_baiviet",
     "`showhi` = 1 AND `step` = 2 AND `opt_km` = 1",
     "id desc",
     "5",
     1);
?>
<div class="box_km">
    <h1><?= $glo_lang['san_pham_khuyen_mai'] ?></h1>
    <?php
        foreach ($sanpham_khuyenmai as $value){
            $tenbaiviet = $value['tenbaiviet_'.$lang];
            $seo_name = $full_url. '/' . $value['seo_name'];
            $image = $fullpath. '/'. $value['duongdantin']. '/'. $value['icon'];
            $giatien = $value['giatien'];
            $optkm = $value['opt_km'];
            $giamgiaphantram = 0;
            $giakhuyenmai = $value['giakm'];
            if ($giakhuyenmai > 0 && $giakhuyenmai <= 100) {
                $giamgiaphantram = $giakhuyenmai;
                $giakhuyenmai = number_format($giatien - ($giatien * ($giakhuyenmai / 100))) . ' ' . $glo_lang['dvt'];

            } else if (!empty($giakhuyenmai)) {
                $giakhuyenmai = number_format($giakhuyenmai) . ' ' . $glo_lang['dvt'];
            }
            if ($giatien <= 0) {
                $giatien = $glo_lang['lien_he'];
            } else {
                $giatien = number_format($giatien) . ' ' . $glo_lang['dvt'];
            }
            if($giakhuyenmai > 0  AND $optkm == 1){
    ?>
    <ul>
      <li>
          <a href="<?= $seo_name ?>">
              <div class="discount-tag <?= $giamgiaphantram > 0 && $giamgiaphantram <= 100 ? "" : "hidden" ?>">
                  <span><?= $giamgiaphantram ?>%</span></div>
              <img src="<?= $image ?>" width="350" height="350" />
          </a>
      </li>
      <h3><a href="<?= $seo_name ?>"><?= $tenbaiviet ?></a>
        <h4>
            <?php
            if(!empty($giakhuyenmai)){
                echo $giakhuyenmai;
                ?>
                <span class="<?= (empty($giatien) ? "hidden" : "") ?>"><?= $giatien ?></span>
            <?php } else { echo $giatien; }  ?>
        </h4>
      </h3>
      <div class="clr"></div>
    </ul>
        <?php }} ?>
  </div>
