<ul class="menu no_box">
  <?=GET_menu_new($full_url, $lang, '', 'sub', '') ?>
</ul>
<script>
	$(function(){
		if($(".menu.add").length == 0){
			$(".menu").addClass('add');
			<?php
				$hinhanh = LAY_step(1);
				if($hinhanh[0]['icon'] != ""){
			?>
			$("li.sub.hide_3 > ul").append('<li class="mn_r"><img src="<?=checkImage($fullpath, $hinhanh[0]['icon'], $hinhanh[0]['duongdantin']) ?>" alt=""></li>');
			$("li.sub.hide_3 > ul").addClass("ul_left_img");
			<?php } ?>
			<?php
				$hinhanh = LAY_step(3);
				if($hinhanh[0]['icon'] != ""){
			?>
			$("li.sub.hide_5 > ul").append('<li class="mn_r"><img src="<?=checkImage($fullpath, $hinhanh[0]['icon'], $hinhanh[0]['duongdantin']) ?>" alt=""></li>');
			$("li.sub.hide_5 > ul").addClass("ul_left_img");
			<?php } ?>
			<?php
				$hinhanh = LAY_step(4);
				if($hinhanh[0]['icon'] != ""){
			?>
			$("li.sub.hide_6 > ul").append('<li class="mn_r"><img src="<?=checkImage($fullpath, $hinhanh[0]['icon'], $hinhanh[0]['duongdantin']) ?>" alt=""></li>');
			$("li.sub.hide_6 > ul").addClass("ul_left_img");
			<?php } ?>
			<?php
				$hinhanh = LAY_step(6);
				if($hinhanh[0]['icon'] != ""){
			?>
			$("li.sub.hide_8 > ul").append('<li class="mn_r"><img src="<?=checkImage($fullpath, $hinhanh[0]['icon'], $hinhanh[0]['duongdantin']) ?>" alt=""></li>');
			$("li.sub.hide_8 > ul").addClass("ul_left_img");
			<?php } ?>


			<?php
				$hinhanh = LAY_step(5);
				if($hinhanh[0]['icon'] != ""){
			?>
			$("li.sub.hide_7 > ul").append('<li class="mn_r"><img src="<?=checkImage($fullpath, $hinhanh[0]['icon'], $hinhanh[0]['duongdantin']) ?>" alt=""></li>');
			$("li.sub.hide_7 > ul").addClass("ul_left_img");
			<?php } ?>

			<?php
				$hinhanh = LAY_step(2);
				if($hinhanh[0]['icon'] != ""){
			?>
			$("li.sub.hide_4 > ul").append('<li class="mn_r"><img src="<?=checkImage($fullpath, $hinhanh[0]['icon'], $hinhanh[0]['duongdantin']) ?>" alt=""></li>');
			$("li.sub.hide_4 > ul").addClass("ul_left_img");
			<?php } ?>
			<?php
				$danhmuc = LAY_danhmuc(2,4,"`opt` = 1");
				if(count($danhmuc) > 0){
					$text = "";
					foreach ($danhmuc as $rows) {
						$text .= '<div class="nav-catg-box"><a href="'.GET_link($full_url, SHOW_text($rows['seo_name'])).'"> <span class="nav-catg-image"> <img class="lazy" width="58" height="58" src="'.checkImage($fullpath, $rows['icon'], $rows['duongdantin']).'" alt=""> </span><span class="nav-catg-title">'.SHOW_text($rows['tenbaiviet_'.$lang]).'</span> </a></div>';
					}
					if($text != ""){
			?>
			$("li.sub.hide_4 > ul").prepend('<div class="nav-top-block"><div class="nav-cat-block"><?=$text ?></div></div>');
			<?php }} ?>
		}
	})
</script>



<div class="mn-mobile" >
<!-- <a href="<?=$full_url ?>" class="a_trangchu_mb"><?=$glo_lang['trang_chu'] ?></a> -->
<div class="menu-bar hidden-md hidden-lg">
	<a href="#nav-mobile">
		<img src="images/menu-mobile-lh.png" alt="">
	</a>
</div>

<div id="nav-mobile" style="display: none">
	<ul>
		<?=GET_menu_new($full_url, $lang, '', '', '') ?>
	</ul>
</div>

</div>
<script>
	$(function(){
		$(".menu > li").each(function(){
			if($("ul", this).length > 0){
				var a_ok = $("a",this).eq(0).attr('addok');
				if(a_ok != "ok"){
					$("a",this).eq(0).append('<i class="fa fa-angle-down"></i>');
					$("a",this).eq(0).attr("addok","ok");
				}
			}
		});
	});
</script>