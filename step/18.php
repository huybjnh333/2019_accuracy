<?php
  if((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
      $numview          = 6;
  else $numview         = $thongtin_step['num_view'];

  $nd_kietxuat  = DB_que("SELECT * FROM `#_danhmuc` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") ORDER BY `catasort` DESC LIMIT 0,$numview");
  $nd_total = DB_que("SELECT `id` FROM `#_danhmuc` WHERE `showhi` =  1 AND `step` IN (".$slug_step.")");
  $nd_total = mysql_num_rows($nd_total);
?>
<div class="load_top_id_2"></div>
<div class="pagewrap page_conten_page">
  <div class="padding_pagewrap_with">
    <div class="titBox left">
      <div class="tit"><?=SHOW_text($arr_running['p1_'.$lang]) ?></div>
    </div>
    <div class="dv-daily-ds dv-danhsachpto">
      <?php
        if($nd_total == 0){
          echo "<div class='dv-notfull'>".$glo_lang['khong_tim_thay_du_lieu_nao']."</div>";
        }else{
          while ($rows = mysql_fetch_array($nd_kietxuat))
            {
              $lay_all_kx_bv  = LAYDANHSACH_idkietxuat($rows['id'], $slug_step);
              $baiviet        = LAY_baiviet($rows['step'], 0, "`id_parent` IN (".$lay_all_kx_bv.") ");
      ?>
      <div class="box_dl_id">
        <div class="hinhanh_dl_id">
          <ul>
            <li><img src="<?=checkImage($fullpath, $rows['icon'], $rows['duongdantin']) ?>" width="100%"/></li>
            <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
          </ul>
        </div>
        <div class="danhsachdaily_danhsach ">
          <div id="danhsachdaily_<?=$rows['id'] ?>" class="owl-carousel owl-theme flex">
            <?php foreach ($baiviet as $bv) {  ?>
            <div class="item">
              <ul>
                <h3><?=SHOW_text($bv['tenbaiviet_'.$lang]) ?></h3>
                <div>
                  <?=SHOW_text($bv['mota_'.$lang]) ?>
                </div>
              </ul>
            </div>
            <?php } ?>
          </div>
          <div class="clr"></div>
        </div>
        <div class="clr"></div>
        <script>
          $(document).ready(function() {
            $("#danhsachdaily_<?=$rows['id'] ?>").owlCarousel({
              slideSpeed : 1000,
              navigation : true,
              itemsCustom : [
                [0, 1],
                [450, 1],
                [600, 1],
                [700, 1],
                [1000, 1],
                [1200, 1],
                [1400, 1],
                [1600, 1]
                ],
              dots: true,
              autoPlay: true,
              navigationText : ["‹","›"]
            });
          });
        </script>
      </div>
    <?php }} ?>
  </div>
  <?php if($nd_total != 0 && $nd_total > $numview){ ?>
  <div class="bottom_more">
    <h3><a class='cur' onclick="LOAD_ajax_product('<?=$full_url ?>/load-danhmuc-ajax','<?=@$lay_all_kx ?>','<?=$slug_step ?>','','<?=$nd_total ?>','<?=$numview ?>')"><?=$glo_lang['xem_them'] ?> › <img src="images/loading2.gif" class="ajax_img_loading"></a></h3>
  </div>
  <?php } ?>
  <div class="clr"></div>
</div>
</div>