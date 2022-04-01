<?php
$duan_noi_bac = DB_fet("*",
    "#_baiviet",
    "`showhi` = 1 AND step in (2,3,4) AND opt1=1",
    "`catasort` DESC, `id` DESC",
    "10",
    1,
    1);
?>

<div class="timkiem_right">
    <h2><?= $glo_lang['timkiembv'] ?></h2>
    <ul>
        <li>
            <div class="col-md-3 row-frm">

                <input onchange="SEARCH_timkiem('<?= $full_url ?>/search-news/', '.input_search.form-control')"
                       placeholder="<?php echo $glo_lang['nhap_tu_khoa_tim_kiem'] ?>"
                       class="input_search form-control"
                       type="text" value="<?php if ($motty == 'search') {
                    echo $haity;
                } ?>"/>
            </div>
            <h3>
                <a onclick="SEARCH_timkiem( '<?= $full_url ?>/search-news/','.input_search.form-control')"><i
                            class="fa fa-search" aria-hidden="true"></i></a></h3></li>

        <div class="clr"></div>
    </ul>
</div>
<div class="calendar-wrapper">
    <button id="btnPrev" type="button">Prev</button>
    <button id="btnNext" type="button">Next</button>
    <div id="divCal"></div>
</div>
<div class="duan_noibat_right">
    <h2><?= $glo_lang['du_an_noi_bac'] ?></h2>
    <div class="marquee_2">
        <?php foreach ($duan_noi_bac as $rows) {
            $tenbaiviet = $rows['tenbaiviet_' . $lang];
            $url = $full_url . '/' . $rows['seo_name'];

            $images = $fullpath . '/' . $rows['duongdantin'] . '/' . $rows['icon'];
            ?>
            <ul itemscope itemtype="http://schema.org/ScholarlyArticle">
                <a href="<?= $url ?>">
                    <li><img itemprop="image" alt="<?= $tenbaiviet ?>" src="<?= $images ?>"/></li>
                    <h3 itemprop="headline"><?= $tenbaiviet ?></h3>
                </a>
            </ul>
        <?php } ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.marquee_2').marquee({
            duration: 19000,
            gap: 0,
            delayBeforeStart: 0,
            direction: 'up',
            duplicated: true,
            startVisible: true
        });
    });

    var Cal = function (divId) {

        //Store div id
        this.divId = divId;

        // Days of week, starting on Sunday
        this.DaysOfWeek = [
            'Sun',
            'Mon',
            'Tue',
            'Wed',
            'Thu',
            'Fri',
            'Sat'
        ];

        // Months, stating on January
        this.Months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        // Set the current month, year
        var d = new Date();

        this.currMonth = d.getMonth();
        this.currYear = d.getFullYear();
        this.currDay = d.getDate();

    };

    // Goes to next month
    Cal.prototype.nextMonth = function () {
        if (this.currMonth == 11) {
            this.currMonth = 0;
            this.currYear = this.currYear + 1;
        }
        else {
            this.currMonth = this.currMonth + 1;
        }
        this.showcurr();
    };

    // Goes to previous month
    Cal.prototype.previousMonth = function () {
        if (this.currMonth == 0) {
            this.currMonth = 11;
            this.currYear = this.currYear - 1;
        }
        else {
            this.currMonth = this.currMonth - 1;
        }
        this.showcurr();
    };

    // Show current month
    Cal.prototype.showcurr = function () {
        this.showMonth(this.currYear, this.currMonth);
    };

    // Show month (year, month)
    Cal.prototype.showMonth = function (y, m) {

        var d = new Date()
            // First day of the week in the selected month
            , firstDayOfMonth = new Date(y, m, 1).getDay()
            // Last day of the selected month
            , lastDateOfMonth = new Date(y, m + 1, 0).getDate()
            // Last day of the previous month
            , lastDayOfLastMonth = m == 0 ? new Date(y - 1, 11, 0).getDate() : new Date(y, m, 0).getDate();


        var html = '<table>';

        // Write selected month and year
        html += '<thead><tr>';
        html += '<td colspan="7">' + this.Months[m] + ' ' + y + '</td>';
        html += '</tr></thead>';


        // Write the header of the days of the week
        html += '<tr class="days">';
        for (var i = 0; i < this.DaysOfWeek.length; i++) {
            html += '<td>' + this.DaysOfWeek[i] + '</td>';
        }
        html += '</tr>';

        // Write the days
        var i = 1;
        do {

            var dow = new Date(y, m, i).getDay();

            // If Sunday, start new row
            if (dow == 0) {
                html += '<tr>';
            }
            // If not Sunday but first day of the month
            // it will write the last days from the previous month
            else if (i == 1) {
                html += '<tr>';
                var k = lastDayOfLastMonth - firstDayOfMonth + 1;
                for (var j = 0; j < firstDayOfMonth; j++) {
                    html += '<td class="not-current">' + k + '</td>';
                    k++;
                }
            }

            // Write the current day in the loop
            var chk = new Date();
            var chkY = chk.getFullYear();
            var chkM = chk.getMonth();
            if (chkY == this.currYear && chkM == this.currMonth && i == this.currDay) {
                html += '<td class="today">' + i + '</td>';
            } else {
                html += '<td class="normal">' + i + '</td>';
            }
            // If Saturday, closes the row
            if (dow == 6) {
                html += '</tr>';
            }
            // If not Saturday, but last day of the selected month
            // it will write the next few days from the next month
            else if (i == lastDateOfMonth) {
                var k = 1;
                for (dow; dow < 6; dow++) {
                    html += '<td class="not-current">' + k + '</td>';
                    k++;
                }
            }

            i++;
        } while (i <= lastDateOfMonth);

        // Closes table
        html += '</table>';

        // Write HTML to the div
        document.getElementById(this.divId).innerHTML = html;
    };

    // On Load of the window
    window.onload = function () {

        // Start calendar
        var c = new Cal("divCal");
        c.showcurr();

        // Bind next and previous button clicks
        getId('btnNext').onclick = function () {
            c.nextMonth();
        };
        getId('btnPrev').onclick = function () {
            c.previousMonth();
        };
    }

    // Get element by id
    function getId(id) {
        return document.getElementById(id);
    }
</script>
