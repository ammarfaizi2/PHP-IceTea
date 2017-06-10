<?php
$list = array('asuna2','asuna3','bg1','bg3');
$list = $list[rand(0, count($list)-1)];
?>
<!DOCTYPE html>
<html>
<head>
	<title>404 Mboten Kepanggih</title>
	<style type="text/css">
		body{
			font-family: Helvetica, Arial;
		}
		.gbr{
			width:50%;
			height:50%;
			border: 4px solid black;
			border-radius: 10px;
			margin-bottom: 100px;
			margin-top: 30px;
		}
		.hi{
			font-size: 64px;
		}
	</style>
	<meta property="og:title" content="404 Not Found !"/>
	<meta property="og:description" content="404 Mboten kepanggih !"/>
	<meta property="og:image" content="<?php print base_url().'/img/'.($list).'.jpg'; ?>"/>
</head>
<body>
<center>
<a href="<?php print base_url(); ?>"><h2>Halaman Utama</h2></a>
<h1 class="hi">404 Not Found !</h1>
<h2>Halaman sing digolek'i mboten kepanggih</h2>
<img class="gbr" src="<?php print base_url().'/img/'.($list).'.jpg'; ?>">
</center>
</body>
</html>