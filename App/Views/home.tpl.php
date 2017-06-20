<!DOCTYPE html>
<html>
<head>
	<title>Beranda</title>
	<?php css("header"); ?>
	<?php js("header"); ?>
	<script type="text/javascript">
		var s = new header("<?php print router_url(); ?>");
		window.onload = function(){
			s.navbar();
		}
	</script>
</head>
<body>
	<center>
		<div id="cgf">
			<form id="frb" class="re">
				<input type="text" name="q" id="q">
			</form>
			<div id="nvb" class="re">
				
			</div>
		</div>
	</center>
</body>
</html>