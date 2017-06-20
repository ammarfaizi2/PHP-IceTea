<!DOCTYPE html>
<html>
<head>
	<title><?php print $u['nama']; ?></title>
	<?php css("header"); ?>
	<?php css("profile"); ?>
	<?php js("crayner") ?>
	<?php js("header"); ?>
	<script type="text/javascript">
		var h = new header("<?php print router_url(); ?>");
		window.onload = function(){
			h.navbar();
		}
	</script>
</head>
<body>
	<div id="cgf"></div>
	<center>
	<div class="pcg">
		<div id="fnm">
			<h2><?php print $u['nama']; ?></h2>		
		</div>
		<div id="fpt">
			<img src="" class="fimg">
		</div>
	</div>
	</center>
</body>
</html>