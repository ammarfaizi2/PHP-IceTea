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
   <center>
      <div class="mcg">
         <form method="post" action="javascript:void(0)" id="fr">
            <div class="ifcg">
               <div class="lghd">
                  <h1>Login</h1>
               </div>
               <div class="cgl">
                  <label>Username</label>
               </div>
               <div class="in">
                  <input type="text" name="username" id="u" required>
               </div>
               <div class="cgl">
                  <label>Password</label>
               </div>
               <div class="in">
                  <input type="password" name="password" id="p" required>
               </div>
               <div class="cgbt">
                  <button type="submit" name="login" class="lbt">Login</button>
               </div>
               <div class="crg">
                  <a href="<?php print router_url()."/register"; ?>"><span>Daftar</span></a>
               </div>
            </div>
         </form>
      </div>
   </center>
</body>
</html>