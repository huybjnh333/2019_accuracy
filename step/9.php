<?php
  $arr_running = DB_fet("*", "#_baiviet", "`showhi` = 1 AND `step` = '".$slug_step."'", "`catasort` ASC, `id` DESC", 1); 
  $arr_running = mysql_fetch_assoc($arr_running);
    include "9a.php";
?>