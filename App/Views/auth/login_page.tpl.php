<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Login Admin</title>
      <style media="screen">
         * {
            padding : 0;
            margin : 0;
         }
         body {
            font-family: Helvetica, sans-serif;
            background-color : #1d2024;
         }
         .login-container {
            margin: 0 auto;
            width : 375px;
         }
         .login-header {
            display: block;
            margin : 30px;
         }
         .login-header h1 {
            text-align: center;
            color : #fff;
            font-weight: lighter;
            font-size: 2em;
         }
         .login-header h1 span {
            color : #dd5a3c;
         }
         .box {
            background-color: #f7f7f7;
            border : 5px solid rgba(0,0,0,0.5);
         }
         .box-content{
            padding : 30px;
         }
         .box-header {
            color : rgba(0,83,193,0.5);
            font-size: 1.2em;
            text-align: center;
            margin-bottom : 20px;
         }
         .box-content input{
            width  :100%;
            height : 20px;
            padding : 5px;
            border : 1px solid rgba(0,0,0,0.2);
            color : rgba(0,0,0,0.5);
            font-weight: bold;
            margin-bottom: 20px;
         }
         .clear{
            clear: both;
         }
         .box-content button {
            color : #fff;
            background-color:#428BCA;
            padding : 10px;
            width : 100px;
            font-weight: bolder;
            border : none;
            float : right;
            cursor: pointer;
         }
	</style>
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