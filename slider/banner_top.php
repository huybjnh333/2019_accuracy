<link href="slider/slick.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="slider/slick.js"></script>
<div id="pa-slider">
    <?php 
      $banner_top = LAY_banner(" AND `id_parent` = 16", 0);
      while($r = mysql_fetch_array($banner_top))
      {
    ?>
<!--      <li style='background-image:url("");' --><?php //if($r['lien_ket'] != '') echo 'onclick="window.location.href=\''..'\'"' ?><!-->-->
    </li>
    <div class="item">
	    <div class="img">
	      <a href="<?=GET_link($full_url, SHOW_text($r['lien_ket'])) ?>" target="_self">
	        <img src="<?=$fullpath."/".$r['duongdantin']."/".$r['icon'] ?>" alt="">
	      </a>
	    </div>
	  </div>

    <?php } ?>
</div>
<script>
	$(document).ready(function(){ 
	    $("#pa-slider").slick({
	        dots: true,
	        speed: 800,
	        fade: true,
	        arrows: true,
	        cssEase: 'linear',
	        autoplay: true,
	        //pauseOnHover: true,
	        autoplaySpeed: 8000
	    });
		$("#pa-slider").addClass("active");
	});
 
</script>