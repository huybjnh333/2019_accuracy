
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="bower_components/Flot/jquery.flot.js"></script>
<script src="bower_components/Flot/jquery.flot.resize.js"></script>
<script src="bower_components/Flot/jquery.flot.pie.js"></script>
<script src="bower_components/Flot/jquery.flot.categories.js"></script>
<script src="bower_components/Flot/jquery.flot.categories.js"></script>
<script src="js/me.js?v=1"></script>
<script type="text/javascript">
	$(function () {
	    $(".sidebar-menu a").each(function () {
	    	var url_goc = "<?php 
	        	if(isset($_GET['them-moi']) && isset($_GET['step'])) echo $url_page."&step=".@$_GET['step']."&id_step=".@$_GET['id_step'];
	        	else if(isset($_GET['step'])) echo $url_page."&step=".@$_GET['step']."&id_step=".@$_GET['id_step'];
	        	else echo $url_page;
	         ?>";
	        var href = $(this).attr("href");
	        var full = "<?php 

	        
	        	if(isset($_GET['noi-dung'])) echo $url_page."&noi-dung=true";
	        	else if(isset($_GET['them-moi']) && !isset($_GET['step'])) echo $url_page."&them-moi=true";
	        	else if(isset($_GET['them-moi']) && isset($_GET['step'])) echo $url_page."&them-moi=true&step=".@$_GET['step']."&id_step=".@$_GET['id_step'];
	        	else if(isset($_GET['step'])) echo $url_page."&step=".@$_GET['step']."&id_step=".@$_GET['id_step'];
	        	else echo $url_page;
	         ?>";
	        var check_ok = $(this).attr("check");
	        if (href == full || (check_ok == "ok") && url_goc == href) {
	            $(this).parent().addClass("active");
	            $(this).parent().parent().parent("li.treeview").addClass("menu-open");
	            $(this).parent().parent().parent("li.treeview").addClass("active");
	            $(this).parent().parent().parent().parent().parent("li.treeview").addClass("menu-open");
	            $(this).parent().parent().parent().parent().parent("li.treeview").addClass("active");
	        } 
	    })
	});
 	<?php if($lang_nb2 || $lang_nb3){  ?>
	jQuery(window).scroll(function(){   
		if($(".nav-tabs-custom").length > 0){
			var hei = $('.nav-tabs-custom').offset().top;
			if( jQuery(window).scrollTop() >= hei ) {
				jQuery('.nav-tabs-custom > .nav-tabs').addClass('fixed');
			} else {
				jQuery('.nav-tabs-custom > .nav-tabs').removeClass('fixed');
			} 
		}
	  
	});
	<?php } ?>
</script>	