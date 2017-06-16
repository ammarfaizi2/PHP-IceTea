<!DOCTYPE html>
<html>
<head>
	<title>Verified!</title>
	<script type="text/javascript">
		setInterval(function(){
			window.location = "<?php print router_url()."/login?ref=ver&dt=".rstr(72); ?>";
		},1500);
	</script>
</head>
<body>
Redirecting...
</body>
</html>