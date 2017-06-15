<!DOCTYPE html>
<html>
<head>
	<title>Selamat bergabung <?php print htmlspecialchars($u['nama']); ?></title>
</head>
<body>
Berhasil mendaftar !
<br><br>
Silahkan cek email untuk melakukan verifikasi akun.<br><br><br>
<p>Login disini :</p>
<?php $link = "https://www.crayner.cf/login?ref=reg_success&cr=".rstr(32); ?>
<a href="<?php print $link; ?>"><?php print $link; ?></a>
</body>
</html>