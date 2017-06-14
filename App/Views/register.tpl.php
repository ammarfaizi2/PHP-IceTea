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
		.sbbt{
			margin-top: 5%;
			margin-bottom: 5%;
		}
		.mg{
			margin-top: 5%;
		}
	</style>
	<?php js("register") ?>
	<script type="text/javascript">
		window.onload = function(){
			tgl(<?php print date("Y") ?>);
		}
	</script>
</head>
<body>
<center>
	<div class="mcg">
		<div class="fcg">
		<form action="javascript:void(0);" method="post" id="fr">
			<table>
			<thead>
				<tr><th colspan="3" align="center"><h2>Register</h2></th></tr>
			</thead>
			<tbody>
				<tr><td>Nama Lengkap</td><td>:</td><td><input type="text" name="nama" id="name" required></td></tr>
				<tr><td>Tempat Lahir</td><td>:</td><td><input type="text" name="tempat_lahir" id="tempat_lahir" required></td></tr>
				<tr><td>Tanggal Lahir</td><td>:</td><td id="tgl"><?php #print $tgl_lahir; ?></td></tr>
				<tr><td>Nomor HP</td><td>:</td><td><input type="text" name="phone" id="phone" required></td></tr>
				<tr><td>E-Mail</td><td>:</td><td><input type="email" name="email" id="email" required></td></tr>
				<tr><td>Alamat</td><td>:</td><td><textarea name="alamat" id="alamat" required></textarea></td></tr>
				<tr><td colspan="3"><div class="mg"></div></td></tr>
			</tbody>
			<thead>
				<tr><th colspan="3" align="center"><h2>Buat Akun</h2></th></tr>
			</thead>
			<tbody>
				<tr><td>Username</td><td>:</td><td><input type="text" name="username" id="username" required></td></tr>
				<tr><td>Password</td><td>:</td><td><input type="password" name="password" id="password" required></td></tr>
				<tr><td>Konfirmasi Password</td><td>:</td><td><input type="password" name="cpassword" id="cpassword" required></td></tr>
			</tbody>
			<tfoot>
				<tr><th colspan="3" align="center"><div class="sbbt"><button>Daftar</button></div></th></tr>
			</tfoot>
			</table>
		</form>
		</div>
	</div>
</center>
</body>
</html>