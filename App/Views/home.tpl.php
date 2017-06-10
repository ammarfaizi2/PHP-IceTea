<!DOCTYPE html>
<html>
<head>
	<title>Beranda</title>
	<?php css("home"); ?>
	<script type="text/javascript">
		function myFunction() {
		    var x = document.getElementById("myTopnav");
		    if (x.className === "topnav") {
		        x.className += " responsive";
		    } else {
		        x.className = "topnav";
		    }
		} 
	</script>
</head>
<body>
	<div class="topnav" id="myTopnav">
		<a href="<?php print router_url()."/home"; ?>">Beranda</a>
		<a href="<?php print router_url()."/profile"; ?>">Profile</a>
		<a href="<?php print router_url()."/settings"; ?>">Settings</a>
		<a href="<?php print router_url()."/logout"; ?>">Log Out</a>
		<a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
	</div>
</body>
</html>