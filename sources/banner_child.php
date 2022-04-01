<?php
$sql = DB_que("SELECT * FROM `#_step_img` WHERE `id_parent`='" . $thongtin_step['id'] . "' ORDER BY `sort` ASC");
if (mysql_num_rows($sql)) {
    ?>
    <link href="slider/slick.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="slider/slick.js"></script>
    <div class="dv-slider dv-slider-child">
        <div id="pa-slider">
            <?php
            while ($rows = mysql_fetch_array($sql)) {
                ?>
                <div class="item">
                    <div class="img">
                        <a href="<?= GET_link($full_url, SHOW_text($rows['p_note'])) ?>" target="_self">
                            <img src="<?= $fullpath . "/datafiles/" . $rows['duongdantin'] . "/" . $rows['p_name'] ?>"
                                 alt="">
                        </a>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#pa-slider").slick({
                dots: true,
                speed: 800,
                fade: true,
                arrows: true,
                cssEase: 'linear',
                autoplay: true,
                //pauseOnHover: true,
                autoplaySpeed: 8000
            });
            $("#pa-slider").addClass("active");
        });

    </script>
<?php } ?>