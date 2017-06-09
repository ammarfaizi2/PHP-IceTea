<!DOCTYPE html>
<html>
   <head>
   <meta charset="utf-8">
   <title>Login Admin</title>
   <?php css("login"); ?>
   <?php js("crayner"); ?>
   <?php js("login"); ?>
	<script type="text/javascript">var a=new login("<?php print rstr(72); ?>");setInterval(function(){a.l("<?php print router_url(); ?>/login/user_check");},6000);window.onload=function(){document.getElementById("fr").addEventListener("submit",function(){var u=document.getElementById("u").value,p=document.getElementById("p").value;(u!=""&&p!="")&&a.lg("<?php print router_url(); ?>/login/action",u,p,"<?php print strrev($token); ?>","<?php print sha1($token) ?>");});};</script>
   </head>
   <body>
      <div class="login-container">
         <div class="login-header">
            <h1>Login <span>Admin</span></h1>
         </div>
         <div class="box">
            <div class="box-content">
            <form method="post" action="javascript:void(0);" id="fr">
               <div class="box-header">
                  Please Enter Your Information
               </div>
               <input type="text" name="" value="" placeholder="Username" id="u">
               <input type="text" name="" value="" placeholder="Password" id="p">
               <input type="hidden" name="dynamic_token" value="<?php print rstr(72); ?>" id="dt">
               <button type="submit" name="Login">Login</button>
               <div class="clear">
               </div>
			</form>
            </div>
         </div>
      </div>
   </body>
</html>