<!DOCTYPE HTML>
<html>
<head>
<title>Amar Ela | Login</title>
<meta charset="UTF-8" />
<meta name="Designer" content="PremiumPixels.com">
<meta name="Author" content="$hekh@r d-Ziner, CSSJUNTION.com">
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/structure.css">
</head>
<body>
<form class="box login" action='process/login.php' method='POST'>
	<fieldset class="boxBody">
		<label>Email</label>
		<input type="text" name="email" tabindex="1" value="<?php if(isset($_COOKIE['songs_email'])){echo $_COOKIE['songs_email'];} ?>" placeholder="john@kaakai.in" required>
		<label><a href="#" class="rLink" tabindex="5">Forget your password?</a>Password</label>
		<input type="password" tabindex="2" name="password" placeholder='&#x25cf;&#x25cf;&#x25cf;&#x25cf;&#x25cf;&#x25cf;&#x25cf;' required>
	</fieldset>
	<footer>
		<label><input type="checkbox" value="yes" name="keep_me" tabindex="3" <?php if(isset($_COOKIE['songs_keep'])){echo "checked";} ?>>Keep me logged in</label>
		<input type="submit" class="btnLogin" value="Login"  name="loginBtn" tabindex="4">
	</footer>
</form>
<footer id="main">
  Bishnupriya Manipuri online song store  <a href='index.php'><b>Amar Ela</b></a> under <a href='http://kaakai.in' target='_blank'>KAAKAI Newspaper</a>
</footer>
</body>
</html>
