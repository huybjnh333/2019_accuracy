<?php
  if((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
      $numview          = 16;
  else $numview         = $thongtin_step['num_view'];


  // $key       = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
  // $is_search = $motty == 'search' ? true : false;


  $is_search = isset($_GET['pla']) || isset($_GET['emp']) ? true : false;
  $pla       = isset($_GET['pla']) && is_numeric($_GET['pla']) ? $_GET['pla'] : "";
  $emp       = isset($_GET['emp']) && is_numeric($_GET['emp']) ? $_GET['emp'] : ""; 

  if($is_search){
    // $slug_step      = 3;
    // $lay_all_kx     = LAYDANHSACH_idkietxuat(0, $slug_step);
    // $thongtin_step  = DB_que("SELECT * FROM `#_step` WHERE `id` = '$slug_step' LIMIT 1");
    // $thongtin_step  = mysql_fetch_assoc($thongtin_step);
    $lay_all_kx = LAYDANHSACH_idkietxuat(0, $slug_step);
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
  if($is_search) {
    if($pla != '')
      $lay_all_kx = LAYDANHSACH_idkietxuat($pla, $slug_step);
    if($emp != '')
      $wh .= " AND FIND_IN_SET(".$emp.", `detail_vi`) > 0 ";
    
    // $wh .= " AND (`tenbaiviet_vi` LIKE '%".$key."%' OR `tenbaiviet_en` LIKE '%".$key."%' OR `p1` = '".$key."')";
  }
  $wh .= "  AND `id_parent` in (".$lay_all_kx.") ";
  // $nd_kietxuat  = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh ORDER BY `catasort` DESC LIMIT 0,$numview");
  // $nd_total     = DB_que("SELECT `id` FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh");
  // $nd_total     = mysql_num_rows($nd_total);

  include _source."phantrang_kietxuat.php";

  $anhcon   = LAY_anhstep($thongtin_step['id'], 1);
?>
<div class="link_page" style="background-image:url('<?=$fullpath."/datafiles/".$anhcon[0]['duongdantin']."/".$anhcon[0]['p_name'] ?>');">
  <div class="pagewrap">
    <ul>
      <h2><?=!$is_search ? $tenhienthi : $glo_lang['tim_kiem'] ?></h2>
      <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><?=!$is_search ? GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table) : ' // <a>'.$glo_lang['tim_kiem'].'</a></li>' ?></li>
      <div class="clr"></div>
    </ul>
  </div>
</div>
<div class="pagewrap page_conten_page">
  <div class="padding_pagewrap">
    <ul class="accordion" id="accordion-1">
      <div class="dv-ds-hoidap flex no_box">
        <?php 
          if($nd_total == 0){
              echo "<div class='dv-notfull'>".$glo_lang['khong_tim_thay_du_lieu_nao']."</div>";
          }else{
            $i = $vi_tri;
          while ($rows = mysql_fetch_assoc($nd_kietxuat)) { 
            // $gia = GET_gia($rows['giatien'], $rows['giakm'], $rows['opt_km'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", $glo_lang['gia'], $glo_lang['gia_km'] );
            $i++;
        ?>
        <li><a class="menu_parent" href="#"><?=$i ?>. <?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a>
          <ul>
            <?=SHOW_text($rows['noidung_'.$lang]) ?>
          </ul>
        </li>
        <?php }} ?>
      </div>
      <div class="clr"></div>
    </ul>
    <div class="nums">
      <ul>
        <?=PHANTRANG($pzer, $sotrang, $full_url."/".$motty, $_SERVER['QUERY_STRING']) ?>
      </ul>
      <div class="clr"></div>
    </div>
    <div class="contact">
      <h2><?=$glo_lang['dat_cau_hoi'] ?></h2>
      <?php include _source."lien_he_form.php"; ?>
    </div>
  </div>
</div>

 