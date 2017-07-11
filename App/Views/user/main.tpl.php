<!DOCTYPE html>
<html>
<head id="crayner_head">
	<title></title>
	<?php css("header"); ?>
    <?php js("crayner") ?>
    <?php js("header"); ?>
    <?php js("loader"); ?>
	<script type="text/javascript">
		var cr 	= new crayner,
			h 	= new header("<?php print router_url(); ?>"),
			l 	= new loader(cr, "<?php print str_replace("=", "__", (teacrypt(teacrypt(($page??"home"))))); ?>", "<?php print router_url(); ?>");
		window.onload = function(){
			var rt = l.init_load();
			h.navbar();
			setTimeout(function(){
				l.npr();
			},1000);
			var inter = setInterval(function(){
				if(rt.readyState === 4){
					clearInterval(inter);
				}
				l.npr();
				console.log(rt.readyState);
			},500);
		}
	</script>
</head>
<body id="crayner">
</body>
</html>