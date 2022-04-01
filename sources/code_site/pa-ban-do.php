<?php
$databando = DB_fet("*",
    "#_seo_name",
    "id=" . $_GET['id'],
    "",
    "",
    "arr",
    1);
$databando = reset($databando);
$map = $databando['lien_ket'];
?>


<div class="login_id_popup">
    <div class="map_cotact">
        <iframe src="<?= $map ?>"
                width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</div>