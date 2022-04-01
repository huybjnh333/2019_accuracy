<div class="bannerMain">
    <div class="banner">
        <li style='background-image:url(delete/banner_1.jpg);'>
            <div class="pagewrap">
                <div class="box_title_banner">
                    <ul>
                        <h3>tiêu đề banner silde 1</h3>
                        <p>Chúng tôi cam kết làm hài lòng khách hàng bằng chất lượng dịch vụ vượt trội và tinh thần
                            chuyên nghiệp.</p>
                    </ul>
                </div>
            </div>
        </li>
        <li style='background-image:url(delete/banner_2.jpg);'>
            <div class="pagewrap">
                <div class="box_title_banner">
                    <ul>
                        <h3>tiêu đề banner silde 2</h3>
                        <p>Chúng tôi cam kết làm hài lòng khách hàng bằng chất lượng dịch vụ vượt trội và tinh thần
                            chuyên nghiệp.</p>
                    </ul>
                </div>
            </div>
        </li>
        <li style='background-image:url(delete/banner_3.jpg);'>
            <div class="pagewrap">
                <div class="box_title_banner">
                    <ul>
                        <h3>tiêu đề banner silde 3</h3>
                        <p>Chúng tôi cam kết làm hài lòng khách hàng bằng chất lượng dịch vụ vượt trội và tinh thần
                            chuyên nghiệp.</p>
                    </ul>
                </div>
            </div>
        </li>
        <li style='background-image:url(delete/banner_4.jpg);'>
            <div class="pagewrap">
                <div class="box_title_banner">
                    <ul>
                        <h3>tiêu đề banner silde 4</h3>
                        <p>Chúng tôi cam kết làm hài lòng khách hàng bằng chất lượng dịch vụ vượt trội và tinh thần
                            chuyên nghiệp.</p>
                    </ul>
                </div>
            </div>
        </li>
        <li style='background-image:url(delete/banner_5.jpg);'>
            <div class="pagewrap">
                <div class="box_title_banner">
                    <ul>
                        <h3>tiêu đề banner silde 5</h3>
                        <p>Chúng tôi cam kết làm hài lòng khách hàng bằng chất lượng dịch vụ vượt trội và tinh thần
                            chuyên nghiệp.</p>
                    </ul>
                </div>
            </div>
        </li>
    </div>
    <ul class="pagiBanner">
    </ul>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            $(".banner").carouFredSel({
                circular: true,
                infinite: true,
                responsive: true,
                pagination: '.pagiBanner',
                auto: {pauseDuration: 2000, pauseOnHover: true, duration: 1200, fx: "crossfade",},
                scroll: {
                    fx: "slide", items: 1,
                    onBefore: function (data) {
                        $('.banner li').not(data.items.visible[0]).find('.caption').animate({
                            opacity: 0,
                            visibility: 'hidden',
                            bottom: -50
                        });
                        $(data.items.visible[0]).find('.caption').animate({
                            opacity: 1,
                            visibility: 'visible',
                            bottom: 0
                        }, {queue: false, duration: 1000});
                    },
                },
                prev: false,
                next: false,
                swipe: {onMouse: true, onTouch: true},
                items: {height: "variable", visible: {min: 1, max: 1}}
            });
        });
    </script>
    <div class="clr"></div>
</div>
