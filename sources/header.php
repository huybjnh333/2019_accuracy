<?php
$logo = $fullpath . '/' . $thongtin['duongdantin'] . '/' . $thongtin['logo'];
$urllang = $full_url;
$urllang = $fullpath . '/en/' . $motty;

$images_en = $fullpath . '/images/en.png';
$images_vi = $fullpath . '/images/vi.png';
$urlvi = $fullpath;
$urlen = $fullpath . '/en/';
$ctyname = $thongtin['tencongty_' . $lang];
$slogan = $thongtin['logancty_' . $lang];
$email_cf = $thongtin['email_' . $lang];
if (!empty($motty)) {
    $urlvi = $fullpath . '/' . $motty;
    $urlen = $fullpath . '/en/' . $motty;
}
$phone = $thongtin['sodienthoai_' . $lang];
$hotline = $thongtin['hotline_' . $lang];
$email = $thongtin['email_' . $lang];
$numcart = 0;
if (!empty($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    foreach ($cart as $k => $row) {

        $numcart += $row;
    }
}
$url = $full_url;
if (!empty($motty)) {
    $url = $full_url . '/' . $motty;
}
$images = "vi.gif";
$text = "VI";
$url = $full_url . '/';
if ($lang == 'vi') {
    $images = "en.gif";
    $text = "EN";
    $url = $full_url . '/en/';
} else if ($lang == 'en') {
    $images = "vi.gif";
    $text = "VI";
    $url = $fullpath . '/';
}

if (!empty($motty)) {
    $url = $url . $motty . '/';
}

$maplink = $thongtin['maplink'];
$facebooklink = $thongtin['facebooklink'];

$width1199 = 3;
$width991 = 3;
$width767 = 2;
$width479 = 1;
$width319 = 1;

$arraytypedm = array(
    1 => 'banner_home_id_2',
    2 => '',
);
if (!empty($_GET['email']) && !empty($_GET['key'])) {
    ?>
    <script>
        LOAD_popup_new('<?= $full_url ?>/pa-size-child/dang-nhap/');
    </script>
<?php } ?>
<div class="header">
    <div class="pagewrap">
        <div class="right_header">
            <div class="company_time">
                <ul>
                    <li><i class="fa fa-envelope"></i><?=$glo_lang['email']?>: <?=$email_cf?></li>
                    <li><i class="fa fa-volume-control-phone"></i><?=$glo_lang['hotline']?>: <span> <?=$hotline?></span></li>
                </ul>
            </div>
            <div class="clr"></div>
            <div class="lang_top">
                <ul>
                    <li><a href="<?= $urlen ?>"><img src="images/eng.png" width="40" height="40" /></a></li>
                    <li><a href="<?= $urlvi ?>"><img src="images/vn.png" width="40" height="40" /></a></li>
                    <div class="clr"></div>
                </ul>
            </div>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    </div>
</div>
<div class="box_menu">
    <div class="pagewrap">
        <div class="logo_top">
            <li><a href="<?= $full_url ?>"><img src="<?= $logo ?>" alt="logo"/></a></li>
        </div>
        <ul class="menu">
            <?= GET_menu_new($full_url, $lang, '', 'sub', '') ?>
        </ul>
        <div>
            <div class="mn-mobile">
                <div class="menu-bar hidden-md hidden-lg">
                    <a href="#nav-mobile">
            <span>
                <img alt="menu"
                     src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAMAAAC7IEhfAAAAQlBMVEUAAAD///////////////////////////////////////////////////////////////////////////////////8IX9KGAAAAFXRSTlMAAQUREh4gJS0uMTNKVFaVmrS16/1h/XngAAAAU0lEQVQ4y+2Ttw3AMBDEKOcsp9t/VY+gKwQYhsWa1T0f3mO6lOaOAceT1ON5GrOLA6cnNlTLlmbt+CnePC0c3uC1f8L89djhztYr7KFEUaL4ZBQPR3w/3X/Sz4cAAAAASUVORK5CYII=">
            </span>
                    </a>
                </div>
            </div>
            <div id="nav-mobile" style="display:block;" class="mm-menu mm-offcanvas mm-current mm-opened">
                <div class="mm-panel">
                    <div class="mm-panel mm-hasnavbar mm-opened mm-current" id="1">
                        <div class="mm-navbar"><a class="mm-title"><?= $glo_lang['danh_muc'] ?></a></div>
                        <ul class="mm-listview"><?= GET_menu_new($full_url, $lang, '', '', '') ?></ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
</div>


























