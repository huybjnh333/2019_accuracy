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
  $numview      = 6;
  $nd_kietxuat  = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh ORDER BY `catasort` DESC LIMIT 0,$numview");
  $nd_total = DB_que("SELECT `id` FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh");
  $nd_total = mysql_num_rows($nd_total);
 

?>
<?php include _source."timkiem_home.php";?>
<div class="pagewrap conten_page_load">
  <div class="left_conten">
    <div class="box_conten_page">
      <div class="title_conten_id"><?=SHOW_text($arr_running['tenbaiviet_'.$_SESSION['lang']]) ?></div>
      <div class="conten_load_id">
        <div class="tab_ct_id tab_ct_id_canhan">
          <?=SHOW_text($arr_running['noidung_'.$_SESSION['lang']]) ?>
        </div>
        <div class="box_kt_iid">
          <div class="box_kt_iid_left">
            <ul>
              <h3><?=$glo_lang['cmnd'] ?>:</h3>
              <h3><?=$glo_lang['nam_sinh'] ?>:</h3>
              <h3><?=$glo_lang['di_dong'] ?>:</h3>
              <h3><?=$glo_lang['email'] ?>:</h3>
            </ul>
          </div>
          <div class="box_kt_iid_center"> <a href="<?=$full_url ?>/pa-size-child/mokhoa_popup/?id=<?=$arr_running['id'] ?>" class="preview fancybox.ajax">
            <ul>
              <h3><?=$glo_lang['mo'] ?></h3>
              <h4><?=$arr_running['giatien'] == 0 ? : number_format($arr_running['giatien']) ?></h4>
            </ul>
            </a> 
          </div>
          <div class="box_kt_iid_right">
            <ul>
              <h3><?=$glo_lang['luot_mo'] ?>:</h3>
              <?php 
                $list_id  = "";
                $check    = DB_que("SELECT * FROM `#_baiviet_muatin` WHERE `id_baiviet` = '".$arr_running['id']."'");
                while ($r = mysql_fetch_assoc($check)) {
                  $list_id .= $r['id_user'].",";
                }
                $tinnang         = DB_fet("*", "#_tinhnang", "","`catasort` ASC, `id` DESC","", "arr",1);
      
                $congty_check    = DB_que("SELECT * FROM `#_members` WHERE `id` IN (".trim($list_id,",").") ORDER BY `id` DESC");
                while ($row = mysql_fetch_assoc($congty_check)) {
                  echo "<p>".$tinnang[$row['cong_ty']]['tenbaiviet_vi']."</p>";
                }
              ?>
            </ul>
          </div>
          <div class="clr"></div>
        </div>
      </div>
    </div>
  </div>
  <?php include _source."right_conten.php";?>
  <div class="clr"></div>
</div>
