<?php
  if((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
      $numview          = 16;
  else $numview         = $thongtin_step['num_view'];


  // $key       = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
  // $is_search = $motty == 'search' ? true : false;


  $is_search = isset($_GET['pla']) || isset($_GET['emp']) || isset($_GET['key']) ? true : false;
  $pla       = isset($_GET['pla']) && is_numeric($_GET['pla']) ? $_GET['pla'] : "";
  $emp       = isset($_GET['emp']) && is_numeric($_GET['emp']) ? $_GET['emp'] : ""; 
  $key       = isset($_GET['key']) && is_numeric($_GET['key']) ? $_GET['key'] : ""; 

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
    if($key != '')
      $wh .= " AND (`tenbaiviet_vi` LIKE '%".str_replace("+", " ", $_GET['key'])."%' OR `tenbaiviet_en` LIKE '%".str_replace("+", " ", $_GET['key'])."%') ";
    
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

<div class="pagewrap page_conten_page ">
  <div class="dv-left">
    <div class="padding_pagewrap">
      <div class="box_search_diadiem_top">
      <div class="search_diadiem_top">
        <ul>
          <li> <?=$glo_lang['dia_diem'] ?>
            <div class="col-md-1 row-frm">
              <select class="d_diem" class="form-control">
                <option value=""><?=$glo_lang['dia_diem'] ?></option>
                <?php 
                  $thongtin = LAY_danhmuc(2, 0 ,"`id_parent` = 0");
                  foreach ($thongtin as $rows) { 
                ?> 
                <option <?=$pla == $rows['id'] ? 'selected="selected"' : "" ?> value="<?=SHOW_text($rows['id']) ?>"><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></option>
                <?php } ?>
              </select>
            </div>

          </li>
          <li> <?=$glo_lang['nhan_vien'] ?>
            <div class="col-md-1 row-frm">
              <select class="n_vien" class="form-control">
                <option value=""><?=$glo_lang['nhan_vien'] ?></option>
                <?php 
                  $tinhnang = GET_tinhnang();
                  foreach ($tinhnang as $rows) { 
                    if($rows['id_parent'] != 13) continue;
                ?>
                <option <?=$emp == $rows['id'] ? 'selected="selected"' : "" ?> value="<?=$rows['id'] ?>"><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></option>
                <?php } ?>
              </select>
            </div>
          </li>
          <h3><a class="cur" onclick="SEARCH_diadiem()"><?=$glo_lang['tim_kiem'] ?></a></h3>
          <div class="clr"></div>
          <script>
            function SEARCH_diadiem(){
              window.location.href = '<?=$full_url."/".$thongtin_step['seo_name'] ?>/?pla='+$(".d_diem").val()+'&emp='+$(".n_vien").val();
            }
          </script>
        </ul>
      </div>
      <div class="text_box">
      <ul>
        <?=SHOW_text($thongtin_step['noidung_'.$lang]) ?>
      </ul>
      </div>
      </div>
    </div>
    <div class="dv-ds-diadiem flex no_box">
      <?php 
        $array_google = "";
        if($nd_total == 0){
            echo "<div class='dv-notfull'>".$glo_lang['khong_tim_thay_du_lieu_nao']."</div>";
        }else{
        while ($rows = mysql_fetch_assoc($nd_kietxuat)) { 
          // $gia = GET_gia($rows['giatien'], $rows['giakm'], $rows['opt_km'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", $glo_lang['gia'], $glo_lang['gia_km'] );
        $array_google .= '['.$rows['p3'].", '<div style=\"width: 160px;border: none;  padding: 0;\" class=\"diadiem_id_cont\"><div style=\"padding: 0; border: none;\" class=\"diadiem_id_page\"><li style=\"    border: none;\"><a href=\"".GET_link($full_url, SHOW_text($rows['seo_name']))."\"><img src=\"".checkImage($fullpath, $rows['icon'], $rows['duongdantin'], 'thumb_')."\" /></a></li><h2><a style=\"    font-size: 13px;    padding-top: 0;\" href=\"".GET_link($full_url, SHOW_text($rows['seo_name']))."\">".SHOW_text($rows['tenbaiviet_'.$lang])."</a></h2><p style=\"font-size: 13px; line-height: 1.6;padding-bottom: 0;\">".SHOW_text(strip_tags($rows['mt_1_'.$lang]))."</p><div></div></div></div>'".', "images/icon_map.png"],';
      ?>

      <div class="diadiem_id_cont">
        <div class="diadiem_id_page">
          <li><a href="<?=GET_link($full_url, SHOW_text($rows['seo_name'])) ?>"><img src="<?=checkImage($fullpath, $rows['icon'], $rows['duongdantin'], 'thumb_') ?>"  alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>" /></a></li>
          <h2><a href="<?=GET_link($full_url, SHOW_text($rows['seo_name'])) ?>"><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h2>
          <p><?=SHOW_text(strip_tags($rows['mt_1_'.$lang])) ?></p>
          <div>
            <?=SHOW_text($rows['mt_2_'.$lang]) ?>
          </div>
          <h5><a href="<?=GET_link($full_url, SHOW_text($rows['seo_name'])) ?>"><?=$glo_lang['ghe_tham_van_phong'] ?></a></h5>
        </div>
      </div>
      <?php }} ?>
    </div>
   
    <div class="clr"></div>
    <div class="nums">
      <ul>
        <?=PHANTRANG($pzer, $sotrang, $full_url."/".$motty, $_SERVER['QUERY_STRING']) ?>
      </ul>
      <div class="clr"></div>
    </div>
  </div>
  <div class="dv-right dv-right-js">
    <div class="dv-right-js-cont">
      <!-- lksad -->
        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBbMFk4Nq2FN6fQ2hJ8miU7h1aXG7Z0pto&sensor=false"></script>
        <script type="text/javascript">
            function initialize() {
              var mapStyle = [
                  {
                    featureType: "administrative",
                    elementType: "labels",
                    stylers: [
                      { visibility: "on" }
                    ]
                  },{
                    featureType: "poi",
                    elementType: "labels",
                    stylers: [
                      { visibility: "off" }
                    ]
                  },{
                    featureType: "water",
                    elementType: "labels",
                    stylers: [
                      { visibility: "off" }
                    ]
                  },{
                    featureType: "road",
                    elementType: "labels",
                    stylers: [
                      { visibility: "off" }
                    ]
                  }
                ]
                var mapOptions = {
                    center: new google.maps.LatLng(),
                    zoom: 8,
                    scrollwheel: false,
                    zoomControl: true
                };
                var map = new google.maps.Map(document.getElementById("map-canvas_cv"), mapOptions);
                var bounds = new google.maps.LatLngBounds();
                var infowindow = new google.maps.InfoWindow();
                for (var i in LocationData) {
                    var p = LocationData[i];
                    var latlng = new google.maps.LatLng(p[0], p[1]);
                    bounds.extend(latlng);
                    var marker = new google.maps.Marker({
                        position: latlng,
                        icon: p[3],
                        map: map,
                        title: p[2]
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.setContent(this.title);
                        infowindow.open(map, this);
                    });
                }
                map.fitBounds(bounds);
                map.set('styles', mapStyle);
            }
            var LocationData = [<?=trim($array_google, ",") ?>];
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
        <div class="fix_w_c_f" id="map-canvas_cv" style="width: 100%;  "></div>
        <!--  -->
      </div>
    </div>
  <div class="clr"></div>
</div>
 
<script>
  $(function () {
    var he_docu  = $(window).height();
    var hr_ifram = he_docu - 71;
    $("#map-canvas_cv").height(hr_ifram);

    var height = $(document).height();

    $(window).scroll(function () {
      
      var h_top  = $('.box_search_diadiem_top').offset().top;
      var h_now  = $(this).scrollTop();
      var go_top = h_top - h_now - 71;
      if (go_top <= 0) {
        $('.dv-right-js').addClass("fixed");
      } else {
        $('.dv-right-js').removeClass("fixed");
      }
    });
  });
</script>