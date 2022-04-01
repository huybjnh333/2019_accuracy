<?php 
  $las_url    = "";
  if($motty  != "") $las_url    .= "/".$motty;
  if($haity  != "") $las_url    .= "/".$haity;
  if($baty   != "") $las_url    .= "/".$baty;
  if($bonty  != "") $las_url    .= "/".$bonty;
  if($namty  != "") $las_url    .= "/".$namty;
  if($lang == 'vi'){
?>
<a href="<?=$fullpath.'/en'.$las_url."/" ?>"><img src="images/en.png" width="40" height="40" /></a>
<?php }else{ ?>
<a href="<?=$fullpath.$las_url."/" ?>"><img src="images/vi.png" width="40" height="40" /></a>
<?php } ?>