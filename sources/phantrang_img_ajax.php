<?php 
    if(!defined("MOTTY")) die('???');
    $page       = isset($_POST['page']) ? $_POST['page'] : "";
    $id         = isset($_POST['id']) ? $_POST['id'] : "";
    $step       = isset($_POST['step']) ? $_POST['step'] : "";
    $key        = isset($_POST['key']) ? $_POST['key'] : "";
    $total      = isset($_POST['total']) ? $_POST['total'] : "";
    $numview    = isset($_POST['numview']) ? $_POST['numview'] : "";
    if(!is_numeric($numview))  $numview      = 12; 
    
    if ($page < 1)  $page = 1;
    $start = ($numview * $page) - $numview;

    $key = str_replace("+", " ", strip_tags($key));

    $wh = "";
    if($id != "")
      $wh = " AND `id_parent` in (".$id.") ";
    
    if($key != '')
      $wh .= " AND (`tenbaiviet_vi` LIKE '%".$key."%' OR `tenbaiviet_en` LIKE '%".$key."%' OR `p1` = '".$key."')";
    
    $nd_kietxuat  = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$step.") $wh ORDER BY `catasort` DESC LIMIT $start,".$numview);
    $i = 0;
    while ($rows = mysql_fetch_assoc($nd_kietxuat)) { 
        $i ++;
?>
    <ul><?php if($i == 1){ ?><div class="ajax_scron ajax_scron_<?=$page ?>"></div> <?php } ?>
      <a href="<?=GET_link($full_url, SHOW_text($rows['seo_name'])) ?>">
      <div class="img"><img src="<?=checkImage($fullpath, $rows['icon'], $rows['duongdantin'], 'thumb_') ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"/></div>
      <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
      </a>
    </ul>
<?php } ?>
<?php 
    if ($total <= ($numview * $page)){
        echo '<script language="javascript">stopped = true; $(".bottom_more").hide();  </script>';
    }
?>