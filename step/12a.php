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
  $nd_total     = DB_que("SELECT `id` FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh");
  $nd_total     = mysql_num_rows($nd_total);
  $anhcon       = LAY_anhstep($thongtin_step['id'], 1);
?>
<div class="link_page" style="background-image:url('<?=$fullpath."/datafiles/".$anhcon[0]['duongdantin']."/".$anhcon[0]['p_name'] ?>');">
  <div class="pagewrap">
    <ul>
      <h2><?=SHOW_text($kietxuat_name) ?></h2>
      <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><?=GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table) ?></li>
      <div class="clr"></div>
    </ul>
  </div>
</div>
<div class="pagewrap page_conten_page page_conten_page_div_v2">
  <div class="dv-vanphong-left">
    <div class="right_ct_vanphong">
      <div class="ct_vp_id">
        <ul>
          <h3><?=SHOW_text($arr_running['tenbaiviet_'.$_SESSION['lang']]) ?></h3>
          <h2><?=$glo_lang['gia'] ?> <?=$arr_running['giatien'] != 0 ? number_format($arr_running['giatien']). " ".$arr_running['p1'] : $glo_lang['lien_he'] ?></h2>

          <div class="mota_detal">
            <?=SHOW_text($arr_running['mota_'.$_SESSION['lang']]) ?>
            <ul>
              <?php 
              $tinhnang   = GET_tinhnang();
              $detail_vi  = explode(",", $arr_running['detail_vi']);

              foreach ($tinhnang as $val) { 
                if($val['id_parent'] != 0 || ($val['id'] != 5 && $val['id'] != 10 )) continue;
                foreach ($tinhnang as $value) { 
                  if($value['id_parent'] != $val['id']) continue;
                  if(in_array($value['id'], $detail_vi)){
                    echo '<li><strong>'.SHOW_text($val['tenbaiviet_'.$lang]).'</strong>: '.SHOW_text($value['tenbaiviet_'.$lang]).'</li>';
                    break;
                  }
                }
              } 
            ?>
            </ul>
          </div>
          <div class="clr"></div>
          <li style="margin-bottom: 15px">
            <div id="div_id" class="map_3" style="height: 260px; width: 100% ; "></div>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJLjDfTYI_LgZhh5DcwkB3cGxMZwdUXko&callback=initMap" async defer></script>
            <script type="text/javascript">
            var map;
            function initialize() {
              var myLatlng = new google.maps.LatLng(<?=SHOW_text($arr_running['p3']) ?>);
              var myOptions = {
                zoom: 16,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById("div_id"), myOptions);
            var text;
            text= "<b style='color:#00F' style='text-align:center'><b style='color:#333; font-size: 14px; margin-bottom: 3px; display: inline-block;'><?=SHOW_text($arr_running['tenbaiviet_'.$_SESSION['lang']]) ?></b>";
            var infowindow = new google.maps.InfoWindow(
                { content: text,
                    size: new google.maps.Size(100,50),
                    position: myLatlng
                });
            infowindow.open(map);
            var marker = new google.maps.Marker({
              position: myLatlng,
              map: map,
              title: "<?=SHOW_text($arr_running['tenbaiviet_'.$_SESSION['lang']]) ?>"
            });
            }
   
            jQuery(window).load(function() {
              initialize();
            });
            </script>
          </li>
        </ul>
      </div>
    </div>
    <div class="clr"></div>
    <div class="showText">
      <div>
        <?=SHOW_text($arr_running['noidung_'.$_SESSION['lang']]) ?>
      </div>
    </div>
    <div class="dv-hinhanh-ds dv-hinhanh-ds-new no_box">
        <img class="demo cursor img_shhow_cont img_shhow_cont_0 active" data="0" src="<?=checkImage($fullpath, $arr_running['icon'], $arr_running['duongdantin'] ) ?>" style="width:100%" alt="<?=SHOW_text($arr_running['tenbaiviet_'.$_SESSION['lang']]) ?>">
        <?php 
            $i = 0;
            $danhsach_img = LAY_anhcon($arr_running['id']);
            foreach ($danhsach_img as $r_img) {
              $i++;
          ?>
        <img class="demo cursor img_shhow_cont img_shhow_cont_<?=$i ?>" data="<?=$i ?>" src="<?=checkImage($fullpath, $r_img['p_name'], 'datafiles/'.$r_img['duongdantin']) ?>" style="width:100%; " alt="<?=SHOW_text($arr_running['tenbaiviet_'.$_SESSION['lang']]) ?>"> 
          <?php } ?>
      <div class="clr"></div>
      <div class="dv-top-right">
        <a class="cur" onclick="SHOW_hinhanh('+')"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
        <a class="cur" onclick="SHOW_hinhanh('-')"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
        <script>
          function SHOW_hinhanh(id){
            var num_anh = $(".img_shhow_cont").length;
            var active  = $(".img_shhow_cont.active").attr('data');
            if(id == "-"){
              if(active < (num_anh - 1)) active++;
              else active = 0;
            } 
            if(id == "+"){
              if(active > 0) active--;
              else active = num_anh - 1;
            }  
            $(".img_shhow_cont").removeClass("active");
            $(".img_shhow_cont_"+active).addClass("active");
          }
        </script>
      </div>
    </div>
    <div>
      <?php include _source."fb_coment.php";?>
    </div>
  </div>
  <div class="dv-vanphong-right">
    <div class="dv-timkiem-vpct" id="dv-timkiem-vpct">
      <h3><?=$glo_lang['dang_ky_thue_phong'] ?></h3>
      <p><?=SHOW_text($arr_running['tenbaiviet_'.$_SESSION['lang']]) ?></p>
      <hr> 
      <div class="dv-form-dangky-cogo">
      	<form action="" class="formBox no_box" method="post" name="dangkyvanphong" id="dangkyvanphong">
			<input type="hidden" name="send_lienhe">
			<input type="hidden" class="lang_ok" value="<?=$glo_lang['yeu_cau_cua_ban_da_duoc_gui'] ?>">
			<input type="hidden" class="lang_false" value="<?=$glo_lang['nhap_ma_bao_ve_chua_dung'] ?>">
	      	<div class="gr">
	      		<p><?=$glo_lang['ho_va_ten'] ?> (*)</p>
	      		<input type="text" name="s_fullname" id="s_fullname" data-name="<?=$glo_lang['ho_va_ten'] ?> (*)" data-msso="<?=$glo_lang['nhap_ho_ten'] ?>">
	      	</div>
	      	<div class="gr">
	      		<p><?=$glo_lang['email'] ?> (*)</p>
	      		<input type="text" name="s_email" id="s_email"  data-msso="<?=$glo_lang['dia_chi_email_khong_hop_le'] ?>">
	      	</div>
	      	<div class="gr">
	      		<p><?=$glo_lang['so_dien_thoai'] ?> (*)</p>
	      		<input type="text" name="s_dienthoai" id="s_dienthoai"  data-name="<?=$glo_lang['so_dien_thoai'] ?> (*)" data-msso="<?=$glo_lang['nhap_so_dien_thoai'] ?>" data-msso1="<?=$glo_lang['so_dien_thoai_khong_hop_le'] ?>">
	      	</div>
	      	<div class="gr">
	      		<p><?=$glo_lang['nhan_vien'] ?></p>
	      		<select class="n_vien" name="s_address" class="form-control">
                	<option value=""><?=$glo_lang['nhan_vien'] ?></option>
	                <?php 
	                  $tinhnang = GET_tinhnang();
	                  foreach ($tinhnang as $rows) { 
	                    if($rows['id_parent'] != 13) continue;
	                ?>
	                <option value="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></option>
	                <?php } ?>
	            </select>
	      	</div>
			<div class="gr">
				<input type="hidden" name="s_message" value="<?=$arr_running['id'] ?>">
				<input type="hidden" name="id_loai" value="1">
				<input name="mabaove" type="hidden"  value="<?=$_SESSION['captcha']['code'] ?>"/>
	      		<button type="button" onclick="return CHECK_datphongchothue_cogo('<?=$full_url ?>/')"><?=$glo_lang['gui_dang_ky_thue_phong'] ?> <img src="images/loading2.gif" class="ajax_img_loading"></button>
	      	</div>
	      	<div class="dv-dt">
	      		<?=$glo_lang['dang_ky_mo_ta'] ?>
	      	</div>
	    </form>
      </div>
    </div>
  </div>
  <div class="clr"></div> 
</div>
 
<script>
  var initOffset  = $('.dv-timkiem-vpct').offset().top - 30;
  var botOffset   = 0;
  $('.dv-vanphong-left').on('DOMSubtreeModified', function () {
   botOffset = initOffset + $('.dv-vanphong-left').height() - $('.dv-timkiem-vpct').height();
  });
  $(window).scroll(function () {
    if ($(this).width() >= 992) {
      // $('.dv-vanphong-right').toggleClass('fixed', $(window).scrollTop() >= initOffset && $(window).scrollTop() <= botOffset); 
        $('.dv-vanphong-right').toggleClass('fixed', ($(window).scrollTop() + 141) >= initOffset && $(window).scrollTop() <= (botOffset - 225)); 
        // console.log($(window).scrollTop()+"-"+(botOffset - 225));

        // if($(window).scrollTop() > (botOffset - 225) && initOffset > 0){
        //   var height = $('.dv-vanphong-left').height() - $(".dv-timkiem-vpct").height() - 80 ; 
        //   $(".dv-vanphong-right").attr("style", "transform: translate3d(0px, "+height+"px, 0px)");
        // }else{
        //   $(".dv-vanphong-right").attr("style", "transform:none ");
        // } 
    }
  });
  var i_check_cogo = 0;
  function CHECK_datphongchothue_cogo(url){
    if (i_check_cogo == 0) {
        $(".ajax_img_loading").show();
        if ($("#s_fullname").val().trim() == '' || $("#s_fullname").val().trim() == $("#s_fullname").attr('data-name')) {
            alert($("#s_fullname").attr('data-msso'));
            $("#s_fullname").focus();
            $(".ajax_img_loading").hide();
            return false;
        }
        
        var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test($("#s_email").val().trim())) {
            alert($("#s_email").attr('data-msso'));
            $("#s_email").focus();
            $(".ajax_img_loading").hide();
            return false;
        }

        if ($("#s_dienthoai").val().trim() == '' || $("#s_dienthoai").val().trim() == $("#s_dienthoai").attr('data-name')) {
            alert($("#s_dienthoai").attr('data-msso'));
            $("#s_dienthoai").focus();
            $(".ajax_img_loading").hide();
            return false;
        }
        if (!CHECK_phone("#s_dienthoai")) {
            alert($("#s_dienthoai").attr('data-msso1'));
            $("#s_dienthoai").focus();
            $(".ajax_img_loading").hide();
            return false;
        }

        i_check_cogo == 1;
        $.ajax({
            type: "POST",
            url: url,
            data: $("#dangkyvanphong").serialize(),
            success: function (data) {
                console.log(data);
                $(".ajax_img_loading").hide();
                if (data == 1) {
                    alert($(".lang_ok").val());
                    window.location.reload();
                    console.log(data);
                }
                else {
                    alert($(".lang_false").val());
                    console.log(data);
                    window.location.reload();
                }
            }
        });
    }
    return false;
  }
</script>
