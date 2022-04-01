<?php


?>
<div class="link_page">
    <div class="pagewrap">
        <h3><?= $glo_lang['ty_gia_coin'] ?></h3>
        <ul>
            <li><a href="<?= $full_url ?>"><i class="fa fa-home"></i></a></li>
            <li><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a></li>
            <li><a href="<?= $full_url ?>/ty-gia/"><?= $glo_lang['ty_gia_coin'] ?></a></li>
        </ul>
        <div class="clr"></div>
    </div>
</div>
<div class="pagewrap page_conten_page">
    <?php
    if (!is_connected()) {
        echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
    } else {
        ?>
        <div class="padding_pagewrap" id="tabletygia">
            <table id="tbl-tygia" cellpadding="0" cellspacing="0" style="width:100%">
                <tbody>
                <tr>
                    <th colspan="4"><?= $glo_lang['ty_gia_coin'] ?></th>
                </tr>
                <tr style="text-align: center">
                    <td><?= $glo_lang['stt'] ?></td>
                    <td><?= $glo_lang['name'] ?></td>
                    <td><?= $glo_lang['gia'] ?></td>
                    <td><?= $glo_lang['Change'] ?></td>

                </tr>
                <?php foreach ($araydata as $row) {

                    $class = 'greentext';
                    $change = str_replace("%", "", $row['change']);
                    if ($change < 0) {
                        $class = 'redtext';
                    }
                    ?>
                    <tr>
                        <td style="text-align: center"><?= $row['stt'] ?></td>
                        <td><img src="<?= $row['images'] ?>"><?= $row['name'] ?></td>
                        <td style="text-align: center"><a href="<?= $row['href'] ?>"><?= $row['gia'] ?></a></td>
                        <td class="<?= $class ?>" style="text-align: center"><?= $row['change'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>