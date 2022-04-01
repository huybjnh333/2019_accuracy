<?php 
    if(!defined("MOTTY")) die('???');
     $page      = isset($_POST['page']) ? $_POST['page'] : "";
    $id         = isset($_POST['id']) ? $_POST['id'] : "";
    $step       = isset($_POST['step']) ? $_POST['step'] : "";
    $key        = isset($_POST['key']) ? $_POST['key'] : "";
    $total      = isset($_POST['total']) ? $_POST['total'] : "";
    $numview    = isset($_POST['numview']) ? $_POST['numview'] : "";
    if(!is_numeric($numview))  $numview      = 8; 

    if ($page < 1)  $page = 1;
    $start = ($numview * $page) - $numview;

    $wh     = "";
    if($id != "")
      $wh   = " AND `id_parent` in (".$id.") ";
    
    $nd_kietxuat = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$step.") $wh ORDER BY `catasort` DESC LIMIT $start,".$numview);
    $i = 0;
    while ($news = mysql_fetch_assoc($nd_kietxuat)) { 
        $i ++;
?>
    <ul>
        <?php if($i == 1){ ?><div class="ajax_scron ajax_scron_<?=$page ?>"></div> <?php } ?>
        <a onclick="PLAY_video('<?=GET_ID_youtube($news['mt_1_'.$lang]) ?>')" class="cur ">
            <li><img src="<?=checkImage($fullpath, $news['icon'], $news['duongdantin'], 'thumb_') ?>" width="410" height="270" alt="<?=SHOW_text($news['tenbaiviet_'.$lang]) ?>"/></li>
            <h3><?=SHOW_text($news['tenbaiviet_'.$lang]) ?></h3>
        </a>
    </ul>
<?php } ?>
<?php 
    if ($total <= ($numview * $page)){
        echo '<script language="javascript">stopped = true; $(".bottom_more").hide();  </script>';
    }
?>