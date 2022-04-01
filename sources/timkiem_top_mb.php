<div class="timkiem_top mobile">
<!--   <form action="" method="post"> -->
    <div class="search"> <a onclick="SEARCH_timkiem_mb()" style="cursor:pointer"></a>
      <input type="text" class="input_search" placeholder="<?= $glo_lang['nhap_tu_khoa_tim_kiem'] ?>" value="<?php if($motty == "search") echo htmlentities(urldecode($haity)) ?>">
      <div class="clr"></div>
    </div>
<!--   </form> -->
</div>
<script>
  function SEARCH_timkiem_mb()
    {
      if($(".mobile .input_search").val() == '')
      {
        $(".mobile .input_search").focus();
      }
      else
        {
          window.location.href= "<?=$full_url ?>/search/" + $(".mobile .input_search").val().trim().replace(/ /g,"+");
        }
    }
  $('.mobile .input_search').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
      SEARCH_timkiem_mb();
    }
  });
</script>