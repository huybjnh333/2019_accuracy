<?php 
    $npage                = count($exp);
    $pzer                 = $exp[$npage - 1];
    $num_page             = substr($pzer, 0, strrpos($pzer, '?'));

    if (!is_numeric($num_page)) 
        $pzer             = $exp[$npage - 1];
    else 
        $pzer             = $num_page;

    if (!is_numeric($pzer)) 
        $pzer             = '';

    $numview                = 15;


    $vi_tri                 = PHANTRANG_start($pzer, $numview);
    if ($pzer               == "" || $pzer == 0 || $pzer == NULL) 
        $pzz                = 0;
    else $pzz               = $pzer * $numview;

    $key = str_replace("+", " ", urldecode($haity));

   
    $nd_kietxuat  = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` in (4,5) AND (`tenbaiviet_vi` like '%".$key."%' OR `tenbaiviet_en` like '%".$key."%') ORDER BY `catasort` DESC LIMIT $vi_tri,$numview");
    $sqlshownu    = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` in (4,5) AND (`tenbaiviet_vi` like '%".$key."%' OR `tenbaiviet_en` like '%".$key."%')");


    $numlist        = @mysql_num_rows($sqlshownu);
    $numshow        = ceil($numlist / $numview);
    $sotrang        = PHANTRANG_findPages($numlist, $numview);
    $cuter          = 0;
    $array_page     = explode('?', $motty);
    $trangxem       = $full_url . '/' . $array_page[0].'/'.$haity;
?>