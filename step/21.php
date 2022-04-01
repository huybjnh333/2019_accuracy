<?php
  if((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
      $numview          = 10;
  else $numview         = $thongtin_step['num_view'];


  // $key       = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
  $is_search = $motty == 'search' ? true : false;

  $id_loaitin     = isset($_GET['tin']) && is_numeric($_GET['tin']) ? $_GET['tin'] : 0;
  $id_quan        = isset($_GET['t']) && is_numeric($_GET['t']) ? $_GET['t'] : "";
  $id_huyen       = isset($_GET['q']) && is_numeric($_GET['q']) ? $_GET['q'] : "";
  $id_phuong      = isset($_GET['p']) && is_numeric($_GET['p']) ? $_GET['p'] : "";
  $id_tinhnang    = isset($_GET['tn'])  ? $_GET['tn'] : "";

  
  if($is_search){
    $slug_step      = 1;
    $lay_all_kx     = LAYDANHSACH_idkietxuat($id_loaitin, $slug_step);
    $thongtin_step  = DB_que("SELECT * FROM `#_step` WHERE `id` = '$slug_step' LIMIT 1");
    $thongtin_step  = mysql_fetch_assoc($thongtin_step);
  }
  else if($slug_table  == 'step'){
      $lay_all_kx = LAYDANHSACH_idkietxuat(0, $slug_step);
      $tenhienthi = SHOW_text($thongtin_step['tenbaiviet_'.$lang]);
  }
  else{
      $tenhienthi     = SHOW_text($arr_running['tenbaiviet_'.$lang]);
      $lay_all_kx     = LAYDANHSACH_idkietxuat($arr_running['id'], $slug_step);
  }

  // if($is_search) $slug_step = "1,2,3";
  $wh = "";
  if($lay_all_kx != 0){
    $wh = "  AND `id_parent` in (".$lay_all_kx.") ";
  }
  
  if($id_quan     != "")      $wh .= "  AND `num_1` = '".$id_quan."' ";
  if($id_huyen    != "")      $wh .= "  AND `num_2` = '".$id_huyen."' ";
  if($id_phuong   != "")      $wh .= "  AND `num_3` = '".$id_phuong."' ";
  if($id_tinhnang != ""){
    $id_tinhnang = explode("-", $id_tinhnang);
    foreach ($id_tinhnang as $idtn) {
      if(is_numeric($idtn)){
        $wh .= " AND FIND_IN_SET($idtn, `detail_vi`) > 0 ";
      }
    }
  }
  // if($is_search)
  //   $wh .= " AND (`tenbaiviet_vi` LIKE '%".$key."%' OR `tenbaiviet_en` LIKE '%".$key."%')";

  // $nd_kietxuat  = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh ORDER BY `catasort` DESC LIMIT 0,$numview");
  // $nd_total     = DB_que("SELECT `id` FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh");
  // $nd_total     = mysql_num_rows($nd_total);

  include _source."phantrang_kietxuat.php";

?>
<div class="pagewrap id_pagewrap">
  <div class="left_conten">
    <?php 
      if($nd_total == 0){
        echo "<div class='dv-notfull'>".$glo_lang['khong_tim_thay_du_lieu_nao']."</div>";
      }else{
        while ($rows = mysql_fetch_array($nd_kietxuat)) 
          { 
    ?>
    <div class="box_tin_bds">
        <div class="left-bds">
          <li>
            <a href="<?=GET_link($full_url, SHOW_text($rows['seo_name'])) ?>">
              <img src="<?=checkImage($fullpath, $rows['icon'], $rows['duongdantin'], 'thumb_') ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"/>
            </a> 
          </li>
          <div class="bos_vi">
            <p><strong><?=$glo_lang['ma_bds'] ?>: <?=$rows['p1'] ?></strong></p>
            <p><?=$glo_lang['ngay_dang'] ?>: <?=date('d/m/Y', $rows['ngaydang']) ?></p>
            <p><?=$glo_lang['cap_nhat'] ?>: <?=date('d/m/Y', $rows['capnhat']) ?></p>
            <p><?=$glo_lang['da_xem'] ?>: <?=$rows['view'] ?> <?=$glo_lang['luot'] ?></p>
          </div>
        </div>
        <ul>
          <div class="gia_sp_id_c">
            <h4><span><?=$glo_lang['gia_ban'] ?></span>: <strong><?=GET_tienty($rows['giatien'], $glo_lang['ty'], $glo_lang['dvt']) ?></strong></h4>
            <h4><span><?=$glo_lang['gia_m2'] ?></span>: <strong><?=GET_tienty($rows['giakm'], $glo_lang['ty'], $glo_lang['dvt']) ?></strong></h4>
          </div>
          <div>
            <?=SHOW_text($rows['mota_'.$lang]) ?>
          </div>
        </ul>
      <div class="clr"></div>
    </div>
    <?php }} ?>
    <div class="nums">
      <ul>
        <?=PHANTRANG($pzer, $sotrang, $full_url."/".$motty, $_SERVER['QUERY_STRING']) ?>
      </ul>
      <div class="clr"></div>
    </div>
  </div>
  <div class="right_conten">
    <?php include _source."right_conten.php";?>
  </div>
  <div class="clr"></div>
</div>