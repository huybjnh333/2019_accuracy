<?php
include 'header_bar.php';
?>
<section class="content">
    <div class="row">
        <section class="col-lg-12">
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="h2_title">
                        <i class="fa fa-dashboard"></i>
                        Lượt truy cập trong 10 ngày gần nhất
                    </h2>
                </div>
                <div class="box-body">
                    <div id="bar-chart" style="height: 300px;"></div>
                </div>
                <div class="box-footer">
                    <?php
                    $tong_luot = DB_fet("SUM(count) AS `tong_luot`", "#_count_date");
                    echo 'Tổng lượt truy cập: ' . mysql_result($tong_luot, 0, "tong_luot");
                    ?>
                </div>
            </div>
        </section>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function () {
        <?php
        $string_data = '';
        for ($i = 9; $i >= 0; $i--) {
            $d = date('d-m-Y', time() - $i * 86400);
            $date = explode('-', $d);
            $sl = so_luong_theo_dmy($date[0], $date[1], $date[2]);
            $string_data .= "['$d',$sl],";
        }
        ?>
        var bar_data = {
            data: [<?=trim($string_data, ',')?>],
            color: '#3c8dbc'
        };
        $.plot('#bar-chart', [bar_data], {
            grid: {
                borderWidth: 1,
                borderColor: '#f3f3f3',
                tickColor: '#f3f3f3'
            },
            series: {
                bars: {
                    show: true,
                    barWidth: 0.5,
                    align: 'center'
                }
            },
            xaxis: {
                mode: 'categories',
                tickLength: 0
            }
        });
    });
</script>