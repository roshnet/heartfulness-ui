<!DOCTYPE html><html>
<head>
	<title>Create an Account | Heartfulness QRS</title>
	<link rel="stylesheet" type="text/css" href="css/styler.css"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
	<link rel="icon" type="image/png" href="css/favicon.png"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
	<script src="js/jquery-3.3.1.js"></script>
	<script src="js/validate.js"></script>
</head>
<body>
<div id="fluid-container">

	<header>
		HEARTFULNESS
	</header>

	<div id="sub-header">
		Query Response System
	</div>

	<div id="sitenav" >
	<ul>
		<a href="index_.php">
			<li>Home</li>
		</a>
		<a href="login.php">
			<li>Log In</li>
		</a>
	</ul>
	</div>

	<div class="content-space">
		<div class="info-header centred">&nbsp;Create an Account</div>
		<form method="POST" action="auth/signup_modf.php" spellcheck="false">
<input class="field" type="text" name="name" placeholder="Name" required="required" minlength="4" maxlength="20"/><br/>
<input class="field" type="text" name="username" placeholder="Set a Username" required="required" minlength="6" maxlength="25" onkeyup="return lowerify(this)"/><br/>
<span id="id-exist" class="user-alert"></span>
<input class="field" type="email" name="email" placeholder="Your Email Address" required="required"/><br/>
<input class="field" type="password" name="passwd" placeholder="Set a Password" required="required" minlength="6" maxlength="20"/><br/>
<input class="field" type="password" name="passwd-verify" placeholder="Confirm the Password" required="required" minlength="6" maxlength="20"/><br/>
<div id="sgp-alert" class="user-alert">
<?php
if (isset($_GET['stat'])){
	$err = $_GET['stat'];
	$errmsg = array('sqlerror' => 'An unknown server error has occurred. Please try again after sometime, or <a href="mailto:reprogram46@gmail.com"> tell the webmaster about this</a>.');
	$errmsg['nametaken'] = 'OOPs! Looks like this username is already taken. Please choose another one (using alphabets, numbers or _ )';
	$errmsg['pswdnotmatch'] = 'Passwords you typed do not match. Try again please.';
	$errmsg['emailx'] = 'Please type a valid email address.';
	$errmsg['namex'] = 'Name should only have alphabets.';
	$errmsg['unamex'] = 'Please choose another username (using alphabets, numbers or _ )';
	$errmsg['shortpswd'] = 'Please type a longer password .';
	$errmsg['shortusername'] = 'Please select a longer username.';
	$errmsg['longusername'] = 'Please select a shorter username, as it might prove inconvenient for you to manage it.';
	// another 'if' to print nothing if user manually sets a GET parameter //
	if(isset($errmsg[$err])){
		echo '<p class="user-alert">';
		echo $errmsg[$err];
		echo "</p>";
	}
}
?>
</div>
<input class="field" type="submit" name="submit" value="Create" onclick="return validate()"/>
		</form>
	</div>
</div>
</body>
</html>