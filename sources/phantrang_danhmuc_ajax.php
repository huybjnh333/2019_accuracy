<?php 
    if(!defined("MOTTY")) die('???');
    $page       = $_POST['page'];
    $id         = $_POST['id'];
    $step       = $_POST['step'];
    $key        = $_POST['key'];
    $total      = $_POST['total'];
    $numview    = $_POST['numview'];
    $id_run     = !empty($_POST['id_run']) && is_numeric($_POST['id_run']) ? $_POST['id_run'] : 0;

    if(!is_numeric($numview))  $numview      = 6; 
    

    if ($page < 1)  $page = 1;
    $start = ($numview * $page) - $numview;
    $wh = "";

    if($id != 0 && $id != "")
        $wh .= " AND `id_parent` in (".$id.") ";

    if($id_run > 0){
      $wh .= " AND `id` <> ".$id_run." ";
    }
    if($key != '')
      $wh .= " AND (`tenbaiviet_vi` LIKE '%".$key."%' OR `tenbaiviet_en` LIKE '%".$key."%')";

    $nd_kietxuat  = DB_que("SELECT * FROM `#_danhmuc` WHERE `showhi` =  1 AND `step` = '".$step."' $wh ORDER BY `catasort` DESC LIMIT $start,".$numview);

    // echo "SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` = '".$step."' $wh ORDER BY `catasort` DESC LIMIT $start,".$numview;

    $i = 0;
    while ($rows = mysql_fetch_assoc($nd_kietxuat)) { 
      $i ++;
  
        $lay_all_kx = LAYDANHSACH_idkietxuat($rows['id'], $slug_step);
        $baiviet    = LAY_baiviet($rows['step'], 0, "`id_parent` IN (".$lay_all_kx.") ");

  ?>
      <div class="box_dl_id">
        <?php if($i == 1){ ?><div class="ajax_scron ajax_scron_<?=$page ?>"></div> <?php } ?>
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
        </div>
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

      <?php } ?> 
<?php 
    if ($total <= ($numview * $page)){
        echo '<script language="javascript">stopped = true; $(".bottom_more").hide();  </script>';
    }
?>