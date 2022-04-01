<div class="hinhanh_ct_right">
    <div class="slideshow-container">
        <?php
        foreach ($img_baiviet as $row) {
            $imagesurl = $fullpath . '/datafiles/' . $row['duongdantin'] . '/' . $row['p_name'];
            ?>
            <div class="mySlides fade"><img src="<?= $imagesurl ?>" style="width:100%"></div>
        <?php } ?>
        <?php if (count($img_baiviet) > 0) { ?>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        <?php } ?>
    </div>
    <br>
    <div style="text-align:center; margin-bottom:10px;">
        <?php
        $count = 1;
        foreach ($img_baiviet as $row) { ?>
            <span class="dot" onclick="currentSlide(<?= $count ?>)"></span>
            <?php
            $count++;
        } ?>
    </div>
</div>
<?php if (count($img_baiviet) > 0) { ?>
    <script>
        // slider
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }

    </script>
<?php } ?>