<!DOCTYPE html>
<html>
<head>
	<title id="tt">Login</title>
	<?php js("crayner"); ?>
	<?php js("login"); ?>
	<script type="text/javascript">var a=new login("<?php print rstr(72); ?>");setInterval(function(){a.l("<?php print router_url(); ?>/login/user_check");},6000);window.onload=function(){document.getElementById("fr").addEventListener("submit",function(){var u=document.getElementById("u").value,p=document.getElementById("p").value;(u!=""&&p!="")&&a.lg("<?php print router_url(); ?>/login/action",u,p,"<?php print strrev($token); ?>","<?php print sha1($token) ?>");});};</script>
	<?php css("login"); ?>
</head>
<body>
<center>
	<div class="maincg">
		<h1>Login</h1>
		<div class="frcg">
			<form method="post" action="javascript:void(0);" id="fr">
				<div class="pcg">
					<div>
						<label>Username :</label>
					</div>
					<input type="text" name="username" id="u" required>
				</div>
				<div class="pcg">
					<div>
						<label>Password :</label>
					</div>
					<input type="password" name="password" id="p" required>
				</div>
				<div class="btcg">
					<input type="hidden" name="dynamic_token" value="<?php print rstr(72); ?>" id="dt">
					<button type="submit" id="sbmt">Login</button>
				</div>
				<div class="rcg">
					<a class="rgp" href="<?php print router_url().'/register?ref=login' ?>">
						<span>Register</span>
					</a>
				</div>
			</form>
		</div>
	</div>
</center>
</body>
</html>