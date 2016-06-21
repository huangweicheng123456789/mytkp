<?php 
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>登录界面</title>
        <link rel="stylesheet" type="text/css" href="../../Public/css/style.css" />
        <link rel="stylesheet" type="text/css" href="../../Public/css/animate.css" />
        <script type="text/javascript" src="../../Public/js/login.js"></script>
        <script type="text/javascript" src="../../Public/js/jquery.min.js"></script>	  
    	<script type="text/javascript">
    	 var snow = function() {
        if(1==1) {
          $("body").append('<canvas id="christmasCanvas" style="top: 0px; left: 0px; z-index: 5000; position: fixed; pointer-events: none;"></canvas>');
          var b = document.getElementById("christmasCanvas"), a = b.getContext("2d"), d = window.innerWidth, c = window.innerHeight;
          b.width = d;
          b.height = c;
          for(var e = [], b = 0;b < 70;b++) {
            e.push({x:Math.random() * d, y:Math.random() * c, r:Math.random() * 4 + 1, d:Math.random() * 70})
          }
          var h = 0;
          window.intervral4Christmas = setInterval(function() {
            a.clearRect(0, 0, d, c);
            a.fillStyle = "rgba(255, 255, 255, 0.6)";
            a.shadowBlur = 5;
            a.shadowColor = "rgba(255, 255, 255, 0.9)";
            a.beginPath();
            for(var b = 0;b < 70;b++) {
              var f = e[b];
              a.moveTo(f.x, f.y);
              a.arc(f.x, f.y, f.r, 0, Math.PI * 2, !0)
            }
            a.fill();
            h += 0.01;
            for(b = 0;b < 70;b++) {
              if(f = e[b], f.y += Math.cos(h + f.d) + 1 + f.r / 2, f.x += Math.sin(h) * 2, f.x > d + 5 || f.x < -5 || f.y > c) {
                e[b] = b % 3 > 0 ? {x:Math.random() * d, y:-10, r:f.r, d:f.d} : Math.sin(h) > 0 ? {x:-5, y:Math.random() * c, r:f.r, d:f.d} : {x:d + 5, y:Math.random() * c, r:f.r, d:f.d}
              }
            }
          }, 70)
        }
      }
      snow();
	</script>

    </head>
 
    <body>
        <canvas id="christmasCanvas" style="top: 0px; left: 0px; z-index: 5000; position: fixed; pointer-events: none;" width="1285" height="100%"></canvas>
        <h2 align="center">登陆界面</h2>
        
        <div class="login_frame"></div>
        <form action="index.php" method="post">
        	<div>
            	<input type="hidden" name="controller" value="UserController">
        		<input type="hidden" name="methodName" value="login">
        			<div class="LoginWindow">
        				<div class="login">
    					<p id="loginError">
    						<?php 
                    		    if (isset($_SESSION["loginError"])){
                    		        echo $_SESSION["loginError"];
                    		        unset($_SESSION["loginError"]);
                    		    }
                    		?>
    					</p>
    					<p><input type="text"  id="id" placeholder="用户名" name="userName"></p>
    					<p><input type="password"  id="password" placeholder="密码" name="userPass"></p>
    					<p class="login-submit"><button type="submit" class="login-button" id ="submit">登录</button></p>
        			</div>
        			<p class="registration  btn" id="regiest"><a>快速注册</a></p>
        		</div>
        	</div>	
    	</form>	
    </body>
</html>