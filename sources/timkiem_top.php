<div class="timkiem_top pc">
  <div class="search"> <a onclick="SEARCH_timkiem('<?=$full_url ?>/search/','.input_search')"  style="cursor:pointer"></a>
    <input type="text" onchange="SEARCH_timkiem('<?=$full_url ?>/search/','.input_search')" class="input_search "  placeholder="<?= $glo_lang['nhap_tu_khoa_tim_kiem'] ?>" value="<?php if($motty == "search") echo htmlentities(urldecode($haity)) ?>">
    <div class="clr"></div>
  </div>
</div>