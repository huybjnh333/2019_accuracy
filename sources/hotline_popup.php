<div class="hotline_popup">
  <h2><?=$glo_lang['hotline'] ?></h2>
  <?php
    $hotline = DB_fet("*", "#_sponline", "`showhi` = 1","","arr");
    $qty_hotline = count($hotline);
    for ($i=0; $i < $qty_hotline; $i++) { 
  ?>
    <ul>
      <li><?=SHOW_text($hotline[$i]['support_name_'.$_SESSION['lang']]) ?></li>
      <a href="tel:<?=SHOW_text($hotline[$i]['phone']) ?>"><p><?=SHOW_text($hotline[$i]['phone']) ?></p></a>
    </ul>
  <?php } ?>
</div>
