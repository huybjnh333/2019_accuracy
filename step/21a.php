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
  $numview      = 3;
  $nd_kietxuat  = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh ORDER BY `catasort` DESC LIMIT 0,$numview");
  $nd_total = DB_que("SELECT `id` FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh");
  $nd_total = mysql_num_rows($nd_total);
  
?>
<div class="pagewrap id_pagewrap">
  <div class="left_conten">
    <div class="conten_load_id">
      <div class="titBox left">
        <div class="tit"><?=SHOW_text($arr_running['tenbaiviet_'.$_SESSION['lang']]) ?></div>
      </div>
      <div class="slideshow-container">
        <?php 
            $i = 0;
            $list_hinhcon = LAY_hinhanhcon($arr_running['id'], 100);
            if(!count($list_hinhcon)){
              echo '<div class="mySlides fade"> <img src="'.checkImage($fullpath, $arr_running['icon'], $arr_running['duongdantin']).'" alt="'.SHOW_text($arr_running['tenbaiviet_'.$lang]).'" style="width:100%"> </div>';
            }else{
              
              foreach ($list_hinhcon as $r_img) {  
                $i++;
          ?>
          <div class="mySlides fade"> <img src="<?=checkImage($fullpath, $r_img['p_name'], 'datafiles/'.$r_img['duongdantin']) ?>" alt="<?=SHOW_text($arr_running['tenbaiviet_'.$lang]) ?>" style="width:100%"> </div>
          <?php 
              } if($i > 1){ 
          ?>
          <a class="prev" onclick="plusSlides(-1)">&#10094;</a> <a class="next" onclick="plusSlides(1)">&#10095;</a>
          <?php }} ?>
      </div>
      <br>
      <?php if($i > 1){ ?>
      <div style="text-align:center; margin-bottom:10px;"> 
        <?php for ($j=1; $j <= $i; $j++) {   ?>
        <span class="dot" onclick="currentSlide(<?=$j ?>)"></span>
        <?php } ?>
      </div>
      <?php } ?>
      <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
          showSlides(slideIndex += n);
        }

        function currentSlide(n) {
          showSlides(slideIndex = n);
        }

        function showSlides(n) {
          var i;
          var slides = document.getElementsByClassName("mySlides");
          var dots = document.getElementsByClassName("dot");
          if (n > slides.length) {slideIndex = 1}    
          if (n < 1) {slideIndex = slides.length}
          for (i = 0; i < slides.length; i++) {
              slides[i].style.display = "none";  
          }
          for (i = 0; i < dots.length; i++) {
              dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";  
          dots[slideIndex-1].className += " active";
        }
      </script>
      <div class="mt_ct">
        <ul>
          <h4><span><?=$glo_lang['gia_ban'] ?></span>: <strong><?=GET_tienty($arr_running['giatien'], $glo_lang['ty'], $glo_lang['dvt']) ?></strong></h4>
          <h4><span><?=$glo_lang['gia_m2'] ?></span>: <strong><?=GET_tienty($arr_running['giakm'], $glo_lang['ty'], $glo_lang['dvt']) ?></strong></h4>
          <div>
            <?=$arr_running['mota_'.$lang] ?>
          </div>
        </ul>
      </div>
      <div class="book_hen_id">
        <input type="hidden" class="cls_link_now" value="<?=$full_url."/".$motty."/" ?>">
        <ul>
          <h3><a class="cur" onclick="LOAD_popup_new('<?=$full_url ?>/pa-size-child/datmua/')"><?=$glo_lang['dat_hang'] ?></a></h3>
          <h3><a class="cur" onclick="LOAD_popup_new('<?=$full_url ?>/pa-size-child/hendixem/')"><?=$glo_lang['hen_di_xem'] ?></a></h3>
          <div class="clr"></div>
        </ul>
      </div>
    </div>
    <div class="conten_load_id">
      <div class="titBox left">
        <div class="tit"><?=$glo_lang['noi_dung'] ?></div>
      </div>
      <div class="showText">
        <?=$arr_running['noidung_'.$lang] ?>
      </div>
      <div id="sharelink"> 
        <div class="addthis_toolbox addthis_default_style "> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
        <script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js#pubid=xa-502225fb496239a5"></script>
      </div>
    </div>
  </div>
  <div class="right_conten">
    <div class="map_bds">
        <div id="div_id" class="map_3" style="height: 450px; width: 100% "></div>
        <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyDJLjDfTYI_LgZhh5DcwkB3cGxMZwdUXko&callback=initMap" async defer></script>
            <script type="text/javascript">
            var map;
            function initialize() {
              var myLatlng = new google.maps.LatLng(10.759328, 106.706326);
              var myOptions = {
                zoom: 16,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById("div_id"), myOptions);
            var text;
            text= "<b style='color:#00F' style='text-align:center'> <b style='font-size: 13px; color: #333; margin-bottom: 3px; width: 140px; float: left; font-weight: 400;'><img src='<?=checkImage($fullpath, $arr_running['icon'], $arr_running['duongdantin']) ?>' alt='' style='width: 65px; float: left; margin-right: 10px;'><?=$arr_running['tenbaiviet_'.$lang] ?></b>";
            var infowindow = new google.maps.InfoWindow(
                { content: text,
                    size: new google.maps.Size(100,50),
                    position: myLatlng
                });
            infowindow.open(map);
            var marker = new google.maps.Marker({
              position: myLatlng,
              map: map,
              title: ""
            });
            }
            </script>
            <script type="text/javascript">
            jQuery(window).load(function() {
              initialize();
            });
            </script>
    </div>
    
  </div>
  <div class="clr"></div>
</div>
 <div class="dv-popup-new no_box">
  <div class="dv-popup-new-child">
    <a class="popup-close" href="javascript:;"></a>
    <div class="dv-nd-popup"></div>
  </div>
</div>