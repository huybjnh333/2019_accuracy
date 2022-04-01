<?php
  if((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
      $numview          = 16;
  else $numview         = $thongtin_step['num_view'];


  $key       = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
  $is_search = $motty == 'search' ? true : false;

  $lay_all_kx_id    = 0;
  if($is_search){
    $slug_step      = 2;
    $lay_all_kx     = LAYDANHSACH_idkietxuat(0, $slug_step);
    $thongtin_step = DB_que("SELECT * FROM `#_step` WHERE `id` = '$slug_step' LIMIT 1");
    $thongtin_step = mysql_fetch_assoc($thongtin_step);
  }
  else if($slug_table  == 'step'){
      $lay_all_kx = LAYDANHSACH_idkietxuat(0, $slug_step);
      $tenhienthi = SHOW_text($thongtin_step['p1_'.$lang]);
  }
  else{
      $tenhienthi = SHOW_text($arr_running['tenbaiviet_'.$lang]);
      $lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id'], $slug_step);
      $lay_all_kx_id    = $arr_running['id'];
  }


  // if($is_search) $slug_step = "1,2,3";
  $lay_all_kx = str_replace(",", "|", $lay_all_kx);
  $wh = "  AND CONCAT(',', `detail_en`, ',') REGEXP ',(".$lay_all_kx."),' ";

  $key_search = "";
  if($is_search) {
    $from = isset($_GET['from']) && is_numeric($_GET['from']) ? $_GET['from'] : "";
    $tour = isset($_GET['tour']) && is_numeric($_GET['tour']) ? $_GET['tour'] : "";
    $des  = isset($_GET['des']) && is_numeric($_GET['des']) ? $_GET['des'] : "";
    $day  = isset($_GET['day']) ? $_GET['day'] : "";
    $day_end  = isset($_GET['day-end']) ? $_GET['day-end'] : "";

    $key_search = "$from|$tour|$des|$day|$day_end";
        
    if($tour != '') {
      $lay_all_kx = LAYDANHSACH_idkietxuat($tour, $slug_step);
      $lay_all_kx = str_replace(",", "|", $lay_all_kx);
      $wh = "  AND CONCAT(',', `detail_en`, ',') REGEXP ',(".$lay_all_kx."),' ";
    }
    if($from != '') $wh .= " AND `mt_2_vi` = '".$from."' ";
    if($des != '') $wh  .= " AND fiND_IN_SET(".$des.", `detail_vi`) ";
    if($day != '') {
      $day_int = explode("-", $day);
      $day_int = @strtotime($day_int[2]."-".$day_int[1]."-".$day_int[0]." ".date("0:0:0"));
      $wh     .= " AND `mt_9_vi` >= '".$day_int."' ";
    }
    if($day_end != '') {
      $day_end_int = explode("-", $day_end);
      $day_end_int = @strtotime($day_end_int[2]."-".$day_end_int[1]."-".$day_end_int[0]." ".date("23:59:59"));
      $wh     .= " AND `mt_10_vi` <= '".$day_end_int."' ";
    }
  }

  $tinhnang     = DB_fet("*", "#_baiviet_tinhnang", "`showhi` = 1 AND `step` = 2","`catasort` DESC, `id` DESC", "" , "arr", 1);

  $nd_kietxuat  = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh ORDER BY `catasort` DESC LIMIT 0,$numview");


  $nd_total     = DB_que("SELECT `id` FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh");
  $nd_total     = mysql_num_rows($nd_total);
?>
<?php include _source.'banner_child.php'; ?>
<div class="pagewrap">
  <div class="link_page_id">
    <ul>
      <li><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><?=!$is_search ? GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table) : ' » <a href="'.$full_url."/search/?key=".str_replace(" ", "+", $key).'">'.$glo_lang['tim_kiem'].'</a></li>' ?></li>
    </ul>
  </div>
  <div class="box_sp_id">
    <div class="title_home">
      <h2><?=!$is_search ? SHOW_text($arr_running['tenbaiviet_'.$lang]) : $glo_lang['tim_kiem'] ?></h2>
      <div class="clr"></div>
    </div>
    <div class="dv-ds-tour dv-danhsachpto flex">
      <?php 
        if($nd_total == 0){
          echo "<div class='dv-notfull'>".$glo_lang['khong_tim_thay_du_lieu_nao']."</div>";
        }
      else{
        while ($rows = mysql_fetch_assoc($nd_kietxuat)) { 
        $gia = GET_gia($rows['giatien'], $rows['giakm'], $rows['opt_km']);
      ?>
      <div class="dv-ds-tour-child">
        <li class="onePro_2"> <a href="<?=GET_link($full_url, SHOW_text($rows['seo_name'])) ?>">
          <?php if($gia['pt'] != 0){ ?><div class="label_giamgia">-<?=$gia['pt'] ?>%</div><?php } ?>
            <div  class="proImg"><img src="<?=checkImage($fullpath, $rows['icon'], $rows['duongdantin'], 'thumb_') ?>"   alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></div>
            <h1><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h1>
            <p><?=$tinhnang[$rows['mt_1_vi']]['tenbaiviet_'.$lang] ?><span><?=date('d/m/Y', $rows['mt_9_vi']) ?></span> </p>
            <h2><?=$gia['km'] == 0 ? "<span>". number_format($gia['gia'])." ".$glo_lang['dvt']."</span>" : "" ?>
                  <?=($gia['km'] <> 0 ? number_format($gia['km']) : number_format($gia['gia'])). " ".$glo_lang['dvt'] ?></h2>
            </a> 
        </li>
      </div>
      <?php }} ?>
      
    </div>
  
    <div class="clr"></div>
    <?php if($nd_total != 0){ ?>
    <div class="more_tour">
      <h2><a class='cur' onclick="LOAD_ajax_product('<?=$full_url ?>/load-tour-ajax','<?=$lay_all_kx_id ?>','<?=$slug_step ?>','<?=$key_search ?>','<?=$nd_total ?>','<?=$numview ?>','<?=$glo_lang['khong_tim_thay_tour_nao'] ?>')"><?=$glo_lang['xem_them'] ?> › <img src="images/loading2.gif" class="ajax_img_loading"></a> </h2>
    </div>
    <?php } ?>
  </div>
</div>
