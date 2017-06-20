<!DOCTYPE html>
<html>
<head>
	<title>Input Siswa</title>
</head>
<body>
<form action="<?php print router_url()."/input_siswa/action" ?>" method="post">
	<label>Nama (string): </label><input type="text" name="nama"><br>
	<label>Kelas (string): </label><input type="text" name="kelas"><br>
	<label>Nilai (int): </label><input type="text" name="nilai"><br>
	<input type="submit" name="act">
</form>
</body>
</html>