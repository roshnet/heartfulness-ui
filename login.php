<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login | Heartfulness QRS</title>
	<link rel="stylesheet" type="text/css" href="css/styler.css"/>
	<link rel="icon" type="image/png" href="css/favicon.png"/>
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
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

	<div id="sitenav" class="centred">
	<ul>
		<a href="index_.php">
			<li>Home</li>
		</a>
		<a href="signup.php">
			<li>Sign Up</li>
		</a>
	</ul>
	</div>

	<div class="content-space">
		<div class="info-header centred">Log In</div>
		<form method="POST" action="auth/login_modf.php" spellcheck="on">
			<input class="field" placeholder="Username" type="text" name="username" required="required" onkeyup="return lowerify(this)" /><br/>
			<input class="field" placeholder="Password" type="password" name="passwd" required="required"/><br/>
			<div id="lgn-alert" class="user-alert">
		<?php
		if (isset($_GET['stat']))
			$err = $_GET['stat'];
		
		$errmsg = array('sqlerror' => 'An unknown server error has occurred. Please try again after sometime, or <a href="mailto:reprogram46@gmail.com"> tell the webmaster about this</a>.');

		$errmsg['illegalattempt'] = 'You must Log In first !';

		$errmsg['nousername'] = 'The username you entered was not found.';
		$errmsg['wrongpswd'] = 'The password you entered was incorrect. Try again.';
		$errmsg['loggedout'] = 'Please log in to continue.';
		if (isset($err)){
			echo '<p class="user-alert">';
			if (isset($errmsg[$err]))
				echo $errmsg[$err];
			echo "</p>";
		}
		// may give error if someone assigns $err an undefined string //
		// verified on localhost that does not give erorrs //

	?>

			</div><br/>
			<input class="field" type="submit" name="submit" value="Log In" onclick="return validate()" />
		</form>

	</div>

</div>
</body>
</html>