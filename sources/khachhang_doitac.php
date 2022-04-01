<div class="khachhang_home">
  <div class="pagewrap">
    <h2><?=khach_hang_noi_ve_chung_toi ?></h2>
    <div id="owl-demo" class="owl-carousel owl-theme dv-ow-slider">
      <?php 
        $banner_top = LAY_banner(" AND `id_parent` = 11", 0);
        while($r = mysql_fetch_array($banner_top))
        {
      ?>
        <ul class="item">
          <li><img src="<?=$fullpath."/".$r['duongdantin']."/".$r['icon'] ?>" width="200" height="200" /></li>
          <p>“<?=SHOW_text(strip_tags($r['noidung_'.$lang])) ?>”</p>
          <h2><?=SHOW_text($r['tenbaiviet_'.$lang]) ?></h2>
          <h3><?=SHOW_text($r['mota_'.$lang]) ?></h3>
        </ul>
      <?php } ?>
      
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $(".dv-ow-slider").owlCarousel({
          navigation : true,
          slideSpeed : 300,
          paginationSpeed : 400,
          items : 1,
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
          autoPlay: true,
          navigationText : ["‹","›"]
        });
      });
    </script>
    <div class="clr"></div>
  </div>
</div><div class="doitac_home">
  <div class="pagewrap">
    <h2><?=doi_tac ?></h2>
    <p><?=doi_tac_mesage ?></p>
    <div class="page_bs_id">
      <div class="placeSlide_main">
        <div class="placeSlide_doitac">
          <div id="owl-demo" class="owl-carousel owl-theme dv-ow-doitac">
          <?php 
            $banner_top = LAY_banner(" AND `id_parent` = 12", 0);
            while($r = mysql_fetch_array($banner_top))
            {
          ?>
            <ul class="item">
              <li class="logo_thuonghieu"> <a href="<?=GET_link($full_url, SHOW_text($r['lien_ket'])) ?>/" target="_blank"><img src="<?=$fullpath."/".$r['duongdantin']."/".$r['icon'] ?>" width="117" height="67" alt="<?=SHOW_text($r['tenbaiviet_'.$lang]) ?>"/></a></li>
            </ul>
          <?php } ?>
          
        </div>
        <script type="text/javascript">
          $(document).ready(function() {
            $(".dv-ow-doitac").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              items : 1,
              itemsCustom : [
                [0, 1],
                [450, 2],
                [600, 3],
                [700, 3],
                [1000, 4],
                [1200, 5],
                [1400, 5],
                [1600, 5]
                ],
              autoPlay: true,
              navigationText : ["‹","›"]
            });
          });
        </script> 
        </div>
      </div>
    </div>
  </div>
</div>