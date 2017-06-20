<!DOCTYPE html>
<html>
<head>
	<title><?php print $u['nama']; ?></title>
	<?php css("header"); ?>
	<?php js("header"); ?>
	<script type="text/javascript">
		var h = new header("<?php print router_url(); ?>");
		window.onload = function(){
			h.navbar();
		}
	</script>
</head>
<body>
	<div id="cgf">
	</div>
	<?php print_r(get_defined_vars()) ?>
</body>
</html>