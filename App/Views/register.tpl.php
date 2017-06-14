<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<style type="text/css">
		body{
			font-family: Helvetica;
		}
		.mcg{
			margin-top: 4%;
		}
		.fcg{
			border: 2px solid black;
			max-width: 35%;
		}
	</style>
</head>
<body>
<center>
	<div class="mcg">
		<div class="fcg">
		<form action="javascript:void(0);" method="post" id="fr">
			<table>
			<thead>
				<tr><th colspan="3"><h2>Register</h2></th></tr>
			</thead>
			<tbody>
				<tr><td>Nama Lengkap</td><td>:</td><td><input type="text" name="nama" id="name" required></td></tr>
				<tr><td>Tempat Lahir</td><td>:</td><td><input type="text" name="tempat_lahir" id="tempat_lahir" required></td></tr>
				<tr><td>Alamat</td><td>:</td><td><textarea name="alamat" id="alamat" required></textarea></td></tr>
			</tbody>
			</table>
		</form>
		</div>
	</div>
</center>
</body>
</html>