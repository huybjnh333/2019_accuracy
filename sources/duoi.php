<!--<div class="clr"></div>-->

<?php include "footer.php"; ?>
<?php foreach ($js as $k => $v) { ?>
    <script type="text/javascript" src="<?= $k ?>"></script>
<?php } ?>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/jquery.marquee@1.5.0/jquery.marquee.min.js"></script>
<!--<script type="text/javascript" src="js/jquery.carouFredSel.js"></script>-->
<!--<script type='text/javascript' src='js/jquery.dcjqaccordion.2.7.min.js'></script>-->
<!--<script src="js/galleria.folio.min.js"></script>-->
<script async src="//cdn.iframe.ly/embed.js" charset="utf-8"></script>
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));

        if ("IntersectionObserver" in window) {
            let lazyImageObserver = new IntersectionObserver(function (entries, observer) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        let lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.srcset = lazyImage.dataset.srcset;
                        lazyImage.classList.remove("lazy");
                        lazyImageObserver.unobserve(lazyImage);
                    }
                });
            });

            lazyImages.forEach(function (lazyImage) {
                lazyImageObserver.observe(lazyImage);
            });
        } else {
        }
    });
</script>
<script>
    $(document).ready(function () {
        // $(function () {
        //     $(".datetimepicker").each(function () {
        //         $(this).datepicker({
        //             minDate: new Date(),
        //             disabledDates: [new Date()]
        //         });
        //     })
        // });
        // $('.marquee').marquee({
        //     duration: 19000,
        //     gap: 0,
        //     delayBeforeStart: 0,
        //     direction: 'up',
        //     duplicated: true,
        //     startVisible: true
        // });
        // function detectScreen() {
        //     var widthScreen = screen.width;
        //     var heightUL = $(".left_tt_home ul").height();
        //     if (widthScreen <= 1200) {
        //         var heightUL = $(".left_tt_home ul").outerHeight();
        //         $(".right_tt_home.flex").css('height', heightUL);
        //         $(".right_tt_home.flex .marquee").css('height', "100%");
        //     } else {
        //         $(".right_tt_home.flex").css('height', (heightUL + 20));
        //         $(".right_tt_home.flex .marquee").css('height', "100%");
        //     }
        // }
        // $('#accordion-1').dcAccordion({
        //     eventType: 'click',
        //     autoClose: true,
        //     saveState: true,
        //     disableLink: true,
        //     speed: 'slow',
        //     showCount: false,
        //     autoExpand: true,
        //     cookie: 'dcjq-accordion-1',
        //     classExpand: 'dcjq-current-parent'
        // });
    });


</script>

<script>
    jQuery(document).ready(function () {
        jQuery("#owl-banner").owlCarousel({
            items: 1,
            lazyLoad: true,
            loop: true,
            nav: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true
        });
        // setHeightbox();

    });
    //
    // function setHeightbox() {
    //
    //     $(".box_title_banner").each(function () {
    //         var heightimg = $(this).outerHeight();
    //         heightimg = heightimg / 2;
    //         $(this).css("top", "calc(50% - " + heightimg + "px");
    //     });
    // }
    //
    // $(window).resize(function () {
    //     setHeightbox();
    // });
</script>

<script>
    $(document).ready(function () {
        $('h1.tlt').on('change', function () {
            $('h1.tlt').textillate({
                loop: true,
                in: {
                    effect: 'flipInY',
                },
                out: {
                    effect: 'flipInY',
                    callback: function () {
                    }
                }
            });
            ;
        }).trigger('change');

        $('h2.tlt2').on('change', function () {
            $('h2.tlt2').textillate({
                initialDelay: 2000,
                loop: true,
                in: {
                    effect: 'flipInY',
                },
                out: {
                    effect: 'flipInY',
                    callback: function () {
                    }
                }
            });
            ;
        }).trigger('change');

        $('h3.tlt3').on('change', function () {
            $('h3.tlt3').textillate({
                initialDelay: 2000,
                loop: true,
                in: {
                    effect: 'fadeInDown',
                },
                out: {
                    effect: 'fadeOutDown',
                    callback: function () {
                    }
                }
            });
        }).trigger('change');
        $('h4.tlt4').on('change', function () {
            $('h4.tlt4').textillate({
                initialDelay: 3500,
                loop: true,
                in: {
                    effect: 'fadeInDown',
                },
                out: {
                    effect: 'fadeOutDown',
                    callback: function () {
                    }
                }
            });
        }).trigger('change');
    });
</script>

<script>
    $(document).ready(function () {
        // hide #back-top first
        $("#back-top").hide();

        // fade in #back-top
        $(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 100) {
                    $('#back-top').fadeIn();
                } else {
                    $('#back-top').fadeOut();
                }
            });

            // scroll body to 0px on click
            $('#back-top a').click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        });
        // $("img.isload").lazyload({
        //     load: function () {
        //         this.style.opacity = 1;
        //         // $(this).addClass("lazydone")
        //     },
        //     // effect : "fadeIn",
        //     threshold: 100
        //     // event : "mouseover"
        // });


    });
    $(document).ready(function () {
        $('.js-marquee .js-marquee-wrapper').css('display', 'none');
    });
</script>
<script>
    $("#nav-mobile").mmenu();
    $("#nav-mobile").show();
    $(document).ready(function () {

        $("ul.menu > li").each(function () {
            var addchua = $("a", this).eq(0).attr('add');
            if ($("ul", this).length > 0 && addchua != 'ok') {
                $("a", this).eq(0).append('<i class="fa fa-angle-down"></i>');
                $("a", this).eq(0).attr('add', 'ok');
                // $(">a", this).removeAttr('href');
            }
        });
        // new WOW().init();
    });

    $(window).resize(function () {
        screenresize();
    });


    function screenresize() {
        var widthscreen = $(window).width();
        var heightscreen = $(window).height();
        widthscreen = parseInt(widthscreen) * 0.85;
        heightscreen = parseInt(heightscreen) * 0.85;
        if (widthscreen > 1200) {
            widthscreen = 1200
        }
        if (heightscreen > 800) {
            heightscreen = 800
        }
        $('.main_img').css('width', widthscreen);
        $('.main_img').css('height', heightscreen);

    }

</script>
<noscript id="deferred-styles">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/fork-awesome@1.1.5/css/fork-awesome.min.css" rel="stylesheet"/>
    <?php
    foreach ($cssduoi as $k => $v) { ?>
        <link href="<?= $k ?>" rel="stylesheet" type="text/css" media="all"/>
    <?php } ?>

</noscript>

<script src='//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
<script language="JavaScript">
    window.onload = function () {
        document.addEventListener("contextmenu", function (e) {
            e.preventDefault();
        }, false);
        document.addEventListener("keydown", function (e) {
            //document.onkeydown = function(e) {
            // "I" key
            if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                disabledEvent(e);
            }
            // "J" key
            if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                disabledEvent(e);
            }
            // "S" key + macOS
            if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                disabledEvent(e);
            }
            // "U" key
            if (e.ctrlKey && e.keyCode == 85) {
                disabledEvent(e);
            }
            // "F12" key
            // if (event.keyCode == 123) {
            //     disabledEvent(e);
            // }
        }, false);

        function disabledEvent(e) {
            if (e.stopPropagation) {
                e.stopPropagation();
            } else if (window.event) {
                window.event.cancelBubble = true;
            }
            e.preventDefault();
            return false;
        }
    };
</script>
<!--<script type="text/javascript">-->
<!--    $("#pro_tabs ul").idTabs();-->
<!--</script>-->
<!--<script type="text/javascript">-->
<!--    function showhinh(data) {-->
<!--        if (!$(data).hasClass("fancybox.ajax")) {-->
<!--            $(".lg-backdrop.in").css("display", "block");-->
<!--            $(".lg-outer").css("display", "block");-->
<!--        } else {-->
<!--            $(".lg-backdrop.in").css("display", "none");-->
<!--            $(".lg-outer").css("display", "none");-->
<!--        }-->
<!--    }-->
<!--</script>-->

<script>
    var loadDeferredStyles = function () {
        var addStylesNode = document.getElementById("deferred-styles");
        var replacement = document.createElement("div");
        replacement.innerHTML = addStylesNode.textContent;
        document.body.appendChild(replacement)
        addStylesNode.parentElement.removeChild(addStylesNode);
    };
    var raf = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
        window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
    if (raf) raf(function () {
        window.setTimeout(loadDeferredStyles, 0);
    });
    else window.addEventListener('load', loadDeferredStyles);
</script>
<?php if (!empty($slug_step)) { ?>
    <script>$(".hide_<?=$slug_step ?>").addClass("acti")</script>
<?php } else { ?>
    <script>$(".hide_0").addClass("acti")</script>
<?php } ?>
</body>
</html>