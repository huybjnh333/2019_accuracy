<div class="box_duan_page">
  <h3><?=$glo_lang['cac_du_an_khac'] ?></h3>
    <div class="placeSlide_main">
      <div class="placeSlide">
        <ul>
          <?php 
             $lay_all_kietxuat     = LAYDANHSACH_idkietxuat($arr_running['id_parent']);
              $nd_kietxuat_lienquan  = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` = '".$slug_step."' AND `id_parent` in (".$lay_all_kietxuat.") ORDER BY `catasort` DESC LIMIT 24");
              while ($r = mysql_fetch_array($nd_kietxuat_lienquan)) 
              {
          ?>
          <li class="onePro">
            <div  class="proImg"> <a href="<?=$fullpath."/".$r['seo_name'] ?>"><img src="<?=$fullpath."/".$r['duongdantin']."/thumb_".$r['icon'] ?>" width="358" alt="<?=SHOW_text($r['tenbaiviet_'.$_SESSION['lang']]) ?>"></a> </div>
            <a href="<?=$fullpath."/".$r['seo_name'] ?>" title="<?=SHOW_text($r['tenbaiviet_'.$_SESSION['lang']]) ?>">
              <h2><?=SHOW_text($r['tenbaiviet_'.$_SESSION['lang']]) ?></h2>
            </a> 
          </li>
          <?php } ?>
        </ul>
      </div>
      <script type="text/javascript">
				jQuery(document).ready(function(){
					var $placeSlide = $('.placeSlide ul');
					$placeSlide.imagesLoaded( function(){
				    	$(".placeSlide ul").carouFredSel({
							circular: false,
							infinite: true,
							auto 	: {
								pauseDuration : 4000,
							},
							scroll	: {
								items	: 1,
								fx		: 'linear'
							},
							prev	: ".placeNav.prev",
							next	: ".placeNav.next",
							swipe: {
								onMouse: true,
								onTouch: true
							},

							items : {
								height: "variable"
							}
						});
					});
		    	});
		    </script> 
    </div>
    <div class="clr"></div>
</div>
