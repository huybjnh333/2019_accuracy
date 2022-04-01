<div id="navbar"><span onclick="openNav()"><a><span>Menu</span><i class="fa fa-align-justify"></i></a></span>
</div>
<div id="mySidenav" class="sidenav"><a href="javascript:void(0)" class="closebtn"
                                       onclick="closeNav()">&times;</a>
    <div class="logo"><a href="<?= $full_url . '/'; ?>">
            <img src="<?= $image_logo ?>" width="347" height="200"/></a>
    </div>
    <?= GET_menu_new($full_url, $lang, '', '', '') ?>
</div>
<script text="javascript">
    function openNav() {
        $("#mySidenav").addClass('cls_menu_show');
    }

    /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
    function closeNav() {
        $("#mySidenav").removeClass('cls_menu_show');
    }
</script>