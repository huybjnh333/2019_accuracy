<?php
  // Update Luot view
  $data['soluotxem'] = array();
  $data['soluotxem'] = $arr_running['soluotxem'] + 1;
  ACTION_db($data, '#_baiviet', 'update', NULL, "`id` = ".$arr_running['id']);
  // Update Luot view
  if($slug_step == "0"){
    $data['soluotxem'] = array();
    $data['soluotxem'] = $arr_running['soluotxem'] + 1;
    ACTION_db($data, '#_baiviet', 'update', NULL, "`id` = ".$arr_running['id']);
    $bre  = SHOW_text($arr_running['tenbaiviet_'.$lang]);
  }
  else if(!empty($thongtin_step)){
    $bre  = SHOW_text($thongtin_step['tenbaiviet_'.$lang]);
  }
?>
<div class="bg_link_page" style="background-image:url('<?=checkImage($fullpath, $thongtin_step['icon'], $thongtin_step['duongdantin']) ?>');"> </div>
<div class="link_page">
  <div class="pagewrap">
    <ul>
      <li><a href="<?=$full_url ?>"><i class="fa fa-home"></i></a></li>
      <li><a><?=$bre ?></a></li>
      <div class="clr"></div>
    </ul>
  </div>
</div>
<div class="pagewrap page_conten_page">
  <div class="title_page">
    <h3><?=SHOW_text($arr_running['tenbaiviet_'.$_SESSION['lang']]) ?></h3>
  </div>
  <div class="padding_pagewrap">
    <div class="hinhanh_ct_right">
      <div class="slideshow-container">
        <?php 
            $list_hinhcon = LAY_hinhanhcon($arr_running['id'], 20);
            $i = 0;
            foreach ($list_hinhcon as $r_img) {  
              $i++;
        ?>
        <div class="mySlides fade"> <img src="<?=checkImage($fullpath, $r_img['p_name'], 'datafiles/'.$r_img['duongdantin'], "thumb_") ?>" style="width:100%"> </div>
        <?php } ?>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a> <a class="next" onclick="plusSlides(1)">&#10095;</a> </div>
      <br>
      <div style="text-align:center; margin-bottom:10px;"> 
        <?php for ($j=1; $j <= $i; $j++) {   ?>
        <span class="dot" onclick="currentSlide(<?=$j ?>)"></span>
        <?php } ?>
      </div>
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
    </div>
    <div class="noidung_ct_left">
      <div class="showText"><?=SHOW_text($arr_running['noidung_'.$_SESSION['lang']]) ?><div class="clr"></div></div>
    </div>
    
    <div class="clr"></div>
    <?php include _source. "fb_coment.php";?>
  </div>
</div>