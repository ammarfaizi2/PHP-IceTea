<?php
$tanggal_lahir = strtotime($u['tanggal_lahir']);
$bln = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
$tanggal_lahir = (int)date("d",$tanggal_lahir)." ".$bln[(int)date("m",$tanggal_lahir)]." ".date("Y", $tanggal_lahir);
?>
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
			var x = JSON.parse('<?php print json_encode([
					"Nama"=>$u['nama'],
					"Alamat"=>$u['alamat'],
					"Tempat Lahir"=>$u['tempat_lahir'],
					"Tanggal Lahir"=> $tanggal_lahir,
					"Nomor HP"=>$u['phone'],
					"E-Mail"=>$u['email']
				]); ?>'), uf = document.getElementById('uf');
			for(q in x){
				uf.innerHTML += "<tr><td>"+q+"</td><td>:</td><td>"+x[q]+"</td></tr>";
			}
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
			<img src="https://scontent-sin6-2.xx.fbcdn.net/v/t1.0-9/19260800_1771475419548778_8925906107652596074_n.jpg?oh=9ac22c6834490d2364c3968ca2ca5da5&oe=59DBB4A0" class="fimg">
		</div>
		<div id="uinfo">
			<table>
				<thead>
					<tr><th colspan="3"></th></tr>
				</thead>
				<tbody id="uf">
				</tbody>
			</table>
		</div>
	</div>
	</center>
</body>
</html>