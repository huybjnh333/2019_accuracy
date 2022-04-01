<div class="formPhone">
    <form class="formBox" action="#" method="post" name="FormNameSDT" id="FormNameSDT"
          accept-charset="utf-8">
        <li>
            <input value="" errorphone="<?= $glo_lang['err_phone'] ?>" name="s_dienthoai" id="s_dienthoai" type="text"
                   placeholder="<?= $thongtin['sodienthoai_' . $lang] ?>">
        </li>
        <li style="cursor:pointer">
            <a onclick="GUI_sodienthoai('<?= $full_url ?>')" style="cursor:pointer"><?= $glo_lang['gui_di'] ?></a>
        </li>
    </form>
    <h3><?= $glo_lang['nhap_so_dt'] ?></h3>
    <li class="social">
        <p><b><?= $glo_lang['lien_he_voi_chung_toi_1'] ?></b><br>
            <i class="fa fa-phone"></i> <?= $thongtin['sodienthoai_' . $lang] ?> <span>-</span>
            <i class="fa fa-envelope"></i>
            <a href="mailto:<?= $thongtin['email_' . $lang] ?>"><?= $thongtin['email_' . $lang] ?></a>
        </p>
    </li>
</div>
