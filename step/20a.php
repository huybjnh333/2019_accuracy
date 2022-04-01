<?php
  // Update Luot view
  $data['soluotxem'] = array();
  $data['soluotxem'] = $arr_running['soluotxem'] + 1;
  ACTION_db($data, '#_baiviet', 'update', NULL, "`id` = ".$arr_running['id']);
  // Update Luot view

  $kietxuat_name = DB_fet("*", "#_danhmuc", "`showhi` = 1 AND `step` = '".$slug_step."' AND `id` = '".$arr_running['id_parent']."'", "`id` DESC", 1, "arr", 1);
  if(empty($kietxuat_name)) 
    $kietxuat_name = $thongtin_step['tenbaiviet_'.$lang];
  else
    $kietxuat_name = $kietxuat_name[$arr_running['id_parent']]['tenbaiviet_'.$lang];

  $lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id_parent'], $slug_step);

  $wh           = "  AND `id_parent` in (".$lay_all_kx.") AND `id` <>  '".$arr_running['id']."'";
  $numview      = 8;
  $nd_kietxuat  = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh ORDER BY `catasort` DESC LIMIT 0,$numview");
  $nd_total = DB_que("SELECT `id` FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh");
  $nd_total = mysql_num_rows($nd_total);
 
  // $anhcon   = LAY_anhstep($thongtin_step['id'], 1);
?>
<div class="bg_header_conten_id">
  <div class="pagewrap">
    <div class="title_page">
      <ul>
        <h3><?=SHOW_text($kietxuat_name) ?></h3>
        <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><?=GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table) ?></li>
        <div class="clr"></div>
      </ul>
    </div>
  </div>
</div>
<div class="page_conten_page">
  <div class="pagewrap"><div class="padding_pagewrap">
      <div class="showText">
        <h2><?=SHOW_text($arr_running['tenbaiviet_'.$_SESSION['lang']]) ?></h2>
        <div>
          <?=SHOW_text($arr_running['noidung_'.$_SESSION['lang']]) ?>  
        </div>
      </div>
    </div> </div>
</div>
<div class="bg_tt_ct">
  <div class="pagewrap">
    <div class="titBox left">
      <h3 class="tit"><?=$glo_lang['san_pham_lien_quan'] ?></h3>
    </div>
    <div class="product_id flex">
      <?php 
        while ($rows = mysql_fetch_assoc($nd_kietxuat)) { 
      ?>
      <ul>
        <a href="<?=GET_link($full_url, SHOW_text($rows['seo_name'])) ?>">
        <li><img src="<?=checkImage($fullpath, $rows['icon'], $rows['duongdantin'], 'thumb_') ?>" width="280" height="280" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"/></li>
        <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
        <p><?=SHOW_text(strip_tags($rows['mota_'.$lang])) ?></p>
        </a>
      </ul>
      <?php } ?>
      <div class="clr"></div>
    </div>
  </div>
</div>