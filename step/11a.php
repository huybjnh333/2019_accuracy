<?php
  // Update Luot view
  $data['soluotxem'] = $arr_running['soluotxem'] + 1;
  ACTION_db($data, '#_baiviet', 'update', NULL, "`id` = ".$arr_running['id']);
  // Update Luot view

  $lis_kietxuat_name = @DB_fet("#_danhmuc", "`showhi` = 1 AND `step` = '".$slug_step."' AND `id` = '".$arr_running['id_parent']."'", "`id` DESC", 1, "arr", 1);
  if(is_array($lis_kietxuat_name)) {
    $kx_seoname    = $thongtin_step['seo_name'];
    $kietxuat_name = $thongtin_step['tenbaiviet_'.$lang];
  }
  else{
    $kx_seoname    = $lis_kietxuat_name[$arr_running['id_parent']]['seo_name'];;
    $kietxuat_name = $lis_kietxuat_name[$arr_running['id_parent']]['tenbaiviet_'.$lang];
  }

  if($slug_table == 'step'){
      $lay_all_kx = LAYDANHSACH_idkietxuat(0, $slug_step);
  }
  else{
      $lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id_parent'], $slug_step);
  }

  $lay_all_kx = str_replace(",", "|", $lay_all_kx);
  $wh = "  AND CONCAT(',', `detail_en`, ',') REGEXP ',(".$lay_all_kx."),' ";

  $danh_sach  = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `id` <> '".$arr_running['id']."' AND `step` = 2 $wh ORDER BY `catasort` DESC, `id` DESC LIMIT 0,30");

  $ds_tinhnang = DB_fet("*","#_baiviet_tinhnang","`showhi` = 1 AND `step` = 2","`catasort` ASC,`id` DESC","","arr",1);
?>
<div class="pagewrap">
  <div class="link_page_id">
    <ul>
      <li><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><?=GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table) ?></li>
    </ul>
  </div>
  <div class="box_sp_id">
    <div class="title_home">
      <h2><?=SHOW_text($kietxuat_name) ?></h2>
      <div class="clr"></div>
    </div>
    <div class="tours_view">
      <div id="hinhanh_tour"><img src="<?=checkImage($fullpath, $arr_running['icon'], $arr_running['duongdantin']) ?>"  alt="<?=SHOW_text($arr_running['tenbaiviet_'.$lang]) ?>"/></div>
      <div id="chitiet_tour_right">
        <ul>
          <?=SHOW_text($arr_running['tenbaiviet_'.$lang]) ?>
        </ul>
        <?php if($arr_running['p1'] != ""){ ?>
          <li><i class="fa fa-qrcode"></i><?=$glo_lang['ma_tour'] ?>: <?=$arr_running['p1'] ?></li>
        <?php } ?>
        <li><i class="fa fa-calendar"></i><strong><?=$glo_lang['thoi_gian'] ?>: <?=$ds_tinhnang[$arr_running['mt_1_vi']]['tenbaiviet_'.$lang] ?></strong></li>
        <li><span class="color_do"><i class="fa fa-money"></i><?=$glo_lang['gia'] ?>: <?php
          $gia = GET_gia($arr_running['giatien'], $arr_running['giakm'], $arr_running['opt_km']);

         ?>
         <?=$gia['km'] <> 0 ? "<span>". number_format($gia['gia'])." ".$glo_lang['dvt']."</span>" : "" ?>
                  <?=($gia['km'] <> 0 ? number_format($gia['km']) : number_format($gia['gia'])). " ".$glo_lang['dvt'] ?>
       </span></li>
        <li><i class="fa fa-street-view"></i><?=$glo_lang['khoi_hanh_tu'] ?>: <?=$ds_tinhnang[$arr_running['mt_2_vi']]['tenbaiviet_'.$lang] ?></li>

        <li><i class="fa fa-calendar-check-o"></i><?=$glo_lang['ngay_khoi_hanh'] ?>: <?=date('d-m-Y', $arr_running['mt_9_vi']) ?></li>
        <li><i class="fa fa-calendar-check-o"></i><?=$glo_lang['ngay_ket_thuc'] ?>: <?=date('d-m-Y', $arr_running['mt_10_vi']) ?></li>

        <li><i class="fa fa-car"></i><?=$glo_lang['phuong_tien'] ?>: <?=$ds_tinhnang[$arr_running['mt_3_vi']]['tenbaiviet_'.$lang] ?></li>
        <li><i class="  fa fa-bank"></i><?=$glo_lang['khach_san'] ?>: <?=$ds_tinhnang[$arr_running['mt_4_vi']]['tenbaiviet_'.$lang] ?></li>
        <li>
          <div id="sharelink">
            <div class="addthis_toolbox addthis_default_style "> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
            <script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js#pubid=xa-502225fb496239a5"></script>
          </div>
          <div id="chiase_link"> <a onclick="window.history.go(-1);">
            <h4><?=$glo_lang['ve_trang_truoc'] ?></h4>
            </a> <a href="<?=$full_url."/dat-tour/?tour=".$arr_running['id'] ?>">
            <h2><?=$glo_lang['dat_tour'] ?></h2>
            </a> </div>
          <div class="clr"></div>
        </li>
      </div>
      <div class="clr"></div>
    </div>
    <div id="pro_tabs">
      <ul class="listtabs">
        <li><a href="#tab1"><?=$glo_lang['chuong_trinh_tour'] ?></a></li>
        <li><a href="#tab2"><?=$glo_lang['chi_tiet_tour'] ?></a></li>
        <li><a href="#tab3"><?=$glo_lang['binh_luan'] ?></a></li>
      </ul>
    </div>
    <div id="tab1" class="conten_tab showText">
      <?=SHOW_text($arr_running['mota_'.$lang]) ?>
    </div>
    <div id="tab2" class="conten_tab showText">
      <?=SHOW_text($arr_running['noidung_'.$lang]) ?>
    </div>

    <div id="tab3" class="conten_tab showText">
    <div class="coment_face">
      <div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/<?php echo $facebooklang ?>/sdk.js#xfbml=1&version=v2.11';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
      <div class="fb-comments" data-href="<?=$full_url."/".$motty ?>" data-width="100%" data-numposts="100"></div>
    </div>

    </div>
    <script type="text/javascript">
      $("#pro_tabs ul").idTabs();
    </script>
  </div>
</div>
<div class="tour_hot_id">
  <div class="pagewrap">
    <div class="title_home">
      <h2><?=$glo_lang['tour_tuong_tu'] ?></h2>
      <li> <a href="<?=GET_link($full_url, SHOW_text($thongtin_step['seo_name'])) ?>"><?=$glo_lang['xem_tat_ca'] ?></a> </li>
      <div class="clr"></div>
    </div>
    <div class="placeSlide_main">
       <!--  -->
        <div class="dv-tinhot none_s">
        <div id="owl-spmoi" class="owl-carousel owl-theme">
          <?php
            while ($rows = mysql_fetch_assoc($danh_sach)) {

            $gia = GET_gia($rows['giatien'], $rows['giakm'], $rows['opt_km']);
          ?>
          <div class="item">
            <li class="onePro"> <a href="<?=GET_link($full_url, SHOW_text($rows['seo_name'])) ?>">
                <?php if($gia['pt'] != 0){ ?><div class="label_giamgia">-<?=$gia['pt'] ?>%</div><?php } ?>
                <div  class="proImg"> <img src="<?=checkImage($fullpath, $rows['icon'], $rows['duongdantin'], 'thumb_') ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></div>
                <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
                <p><?=$ds_tinhnang[$rows['mt_1_vi']]['tenbaiviet_'.$lang] ?><span><?=date('d/m/Y', $rows['mt_9_vi']) ?></span> </p>
                <h2><?=$gia['km'] <> 0 ? "<span>". number_format($gia['gia'])." ".$glo_lang['dvt']."</span>" : "" ?>
                  <?=($gia['km'] <> 0 ? number_format($gia['km']) : number_format($gia['gia'])). " ".$glo_lang['dvt'] ?>
                </h2>
                </a>
            </li>
          </div>
            <?php } ?>
        </div>
      </div>
      <script>
      $(document).ready(function() {
        $("#owl-spmoi").owlCarousel({
          slideSpeed : 1000,
          navigation : true,
          itemsCustom : [
            [0, 1],
            [450, 2],
            [600, 2],
            [700, 3],
            [1000, 4],
            [1200, 4],
            [1400, 4],
            [1600, 4]
            ],
          dots: true,
          autoPlay: false,
          navigationText : ["‹","›"]
        });
      });
      </script>
       <!--  -->
    </div>
  </div>
</div>
