<?php
if(empty($_GET['step'])){
    $_GET['step'] = "";
}
if(isset($_GET['table'])){
    $where = anh("#_danhmuc","`showhi` = 1 AND `step` = ".$_GET['step']." AND `id` = ".$_GET['img-link']);
}else{
    $where = anh("#_baiviet","`showhi` = 1 AND `step` = ".$_GET['step']." AND `id` = ".$_GET['img-link']);
}
function anh($table,$where){
    $anh = DB_fet("*",
        $table,
        $where,
        "`catasort` asc, `id` asc",
        "1", 1, 1);
    $anh = reset($anh);
    return $anh;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Pano demo</title>
    <style>
        html, body {
            height: 100%;
        }

        .pano {
            width: 100%;
            height: 100%;
            margin: 0 auto;
            cursor: move;
            position: absolute;
        }

        .pano img {
            width: 100%;
        }

        .pano .controls {
            position: relative;
            top: 50%;
        }

        .pano .controls a {
            position: absolute;
            display: inline-block;
            text-decoration: none;
            color: #eee;
            font-size: 3em;
            width: 20px;
            height: 20px;
        }

        .pano .controls a.left {
            left: 10px;
        }

        .pano .controls a.right {
            right: 10px;
        }

        .pano.moving .controls a {
            opacity: 0.4;
            color: #eee;
        }


    </style>
</head>
<body>
<div class="main_img">
    <div id="myPano" class="pano">
        <div class="controls">
            <a class="left">&laquo;</a>
            <a class="right">&raquo;</a>
        </div>
    </div>
</div>
<script src="js/jquery.pano.js"></script>
<script>
    /* jshint jquery: true */
    jQuery(document).ready(function ($) {
        $("#myPano").pano({
            img: "<?=$fullpath?>/datafiles/setone/<?=$where['icon']?>"
        });
        screenresize();
    });

</script>
</body>
</html>