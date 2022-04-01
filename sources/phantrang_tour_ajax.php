<?php 
    if(!defined("MOTTY")) die('???');
    $page                   = $_POST['page'];
    $lay_all_kx_id          = $_POST['id'];
    $step                   = $_POST['step'];
    $key                    = $_POST['key'];
    $total                  = $_POST['total'];
    $numview                = $_POST['numview'];


    if(!is_numeric($numview))  $numview      = 16; 
    
    // $key = str_replace("+", " ", strip_tags($key));

    if ($page < 1)  $page = 1;
    $start = ($numview * $page) - $numview;

    $lay_all_kx = LAYDANHSACH_idkietxuat($lay_all_kx_id, $step);
    $lay_all_kx = str_replace(",", "|", $lay_all_kx);
    $wh = "  AND CONCAT(',', `detail_en`, ',') REGEXP ',(".$lay_all_kx."),' ";

    if($key != '') {
        $key  = explode("|", $key);
        $from = $key[0];
        $tour = $key[1];
        $des  = $key[2];
        $day  = $key[3];
        $day_end  = $key[4];
        
        $key_search = "$from|$tour|$des|$day|$day_end";
            
        if($tour != '') {
          $lay_all_kx = LAYDANHSACH_idkietxuat($tour, $slug_step);
          $lay_all_kx = str_replace(",", "|", $lay_all_kx);
          $wh = "  AND CONCAT(',', `detail_en`, ',') REGEXP ',(".$lay_all_kx."),' ";
        }
        if($from != '') $wh .= " AND `mt_2_vi` = '".$from."' ";
        if($des != '') $wh  .= " AND fiND_IN_SET(".$des.", `detail_vi`) ";
        if($day != '') {
          $day_int = explode("-", $day);
          $day_int = @strtotime($day_int[2]."-".$day_int[1]."-".$day_int[0]." ".date("0:0:0"));
          $wh     .= " AND `mt_9_vi` >= '".$day_int."' ";
        }
        if($day_end != '') {
          $day_end_int = explode("-", $day_end);
          $day_end_int = @strtotime($day_end_int[2]."-".$day_end_int[1]."-".$day_end_int[0]." ".date("23:59:59"));
          $wh     .= " AND `mt_10_vi` <= '".$day_end_int."' ";
        }
    }

    // if($key != '')
    // $wh .= " AND (`tenbaiviet_vi` LIKE '%".$key."%' OR `tenbaiviet_en` LIKE '%".$key."%' OR `p1` = '".$key."')";

    $nd_kietxuat  = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$step.") $wh ORDER BY `catasort` DESC LIMIT $start,".$numview);

    // echo "SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$step.") $wh ORDER BY `catasort` DESC LIMIT $start,".$numview;

    $i = 0;
    $tinhnang    = DB_fet("*", "#_baiviet_tinhnang", "`showhi` = 1 AND `step` = 2","`catasort` DESC, `id` DESC", "" , "arr", 1);
    while ($rows = mysql_fetch_assoc($nd_kietxuat)) { 
    $i ++;
    $gia = GET_gia($rows['giatien'], $rows['giakm'], $rows['opt_km']);
?>
<div class="dv-ds-tour-child">
    <li class="onePro_2"> 
        <?php if($i == 1){ ?><div class="ajax_scron ajax_scron_<?=$page ?>"></div> <?php } ?>
        <a href="<?=GET_link($full_url, SHOW_text($rows['seo_name'])) ?>">
            <?php if($gia['pt'] != 0){ ?><div class="label_giamgia">-<?=$gia['pt'] ?>%</div><?php } ?>
            <div  class="proImg"><img src="<?=checkImage($fullpath, $rows['icon'], $rows['duongdantin'], 'thumb_') ?>"   alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></div>
            <h1><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h1>
            <p><?=$tinhnang[$rows['mt_1_vi']]['tenbaiviet_'.$lang] ?><span><?=date('d/m/Y', $rows['mt_9_vi']) ?></span> </p>
            <h2><?=$gia['km'] <> 0 ? "<span>". number_format($gia['gia'])." ".$glo_lang['dvt']."</span>" : "" ?>
            <?=($gia['km'] <> 0 ? number_format($gia['km']) : number_format($gia['gia'])). " ".$glo_lang['dvt'] ?></h2>
        </a> 
    </li>
</div>
<?php } ?>
<?php 
    if ($total <= $start){
        echo '<script language="javascript">stopped = true; $(".more_tour").hide(); </script>';
    }
?>