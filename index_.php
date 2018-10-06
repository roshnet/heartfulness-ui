<!DOCTYPE html><html>
<head>
	<link rel="stylesheet" type="text/css" href="css/styler.css"/>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=0.3"/>
	<script src="js/jquery-3.3.1.js"></script>
	<script type="text/javascript">
$(document).ready(function(){
	// startup
	$("#signup-space").hide();
	$("#login-space").hide();
	$(".moretext").hide();
	var	active = 1;

	$("#lgn-btn").click(function(){
		if (active == 1){
			$("#intro-space").fadeOut();
			$("#login-space").fadeIn(200);
			active = 2;
			$("#sgp-btn").css("opacity", "0.6");
			$("#sgp-btn").show();
			$("#lgn-btn").css("opacity", "1.0");
		}
		else if (active == 3){
			$("#signup-space").fadeOut();
			$("#login-space").fadeIn(200);
			active = 2;
			$("#sgp-btn").css("opacity", "0.6");
			$("#lgn-btn").css("opacity", "1.0");
		}
	});

	$("#sgp-btn").click(function(){
		if (active == 1) {
			$("#intro-space").fadeOut();
			$("#signup-space").fadeIn(200);
			active = 3;
			$("#lgn-btn").css("opacity", "0.6");
			$("#lgn-btn").show(); // add = 1
			$("#sgp-btn").css("opacity", "1.0");
		}
		else if (active == 2) {
			$("#login-space").fadeOut();
			$("#signup-space").fadeIn(200);
			active = 3;
			$("#lgn-btn").css("opacity", "0.6");
			$("#lgn-btn").show(); // add = 1
			$("#sgp-btn").css("opacity", "1.0");
		}
	});
});
</script>

<script src="js/validate.js"></script>
<?php
	echo "<script>";
	echo '$(document).ready(function(){';
	$btns = array("b0","b1", "b2");
	$txts = array("t0", "t1", "t2");
	for ($i=0; $i < 3; $i++) {
		echo "$(\".$btns[$i]\").click(function(){";
		echo "$(\".$btns[$i]\").hide();";
		echo "$(\".$txts[$i]\").fadeIn(400);";
		echo "});";
	}
	echo '});'; // end of document.ready() //
	echo "</script>";
?>
	<style type="text/css">
		hr{color: blue;width:70%;}
	</style>
	<title>Ask and Answer Queries | Heartfulness QRS</title>
	<style type="text/css">
footer{font-family:montserrat;text-align:center;font-size:140%;
	margin-top:80px;color:#ffffff;background-color:rgb(57,57,155);}
@media all and (min-width: 250px) and (max-width: 320px){
	footer{font-size: 90%;padding: 5%;letter-spacing: 1px;}
}
@media all and (min-width: 321px){
	footer{font-size: 140%;padding: 3%;letter-spacing: 3px;}
}
	</style>

</head>

<body>

<div id="fluid-container">

	<header class="header">
		HEARTFULNESS
	</header>

	<div id="sitenav" class="centred">
		<ul>
			<a id="sgp-btn">
				<li>Sign Up</li>
			</a>
			<a id="lgn-btn">
				<li>Sign In</li>
			</a>
		</ul>
	</div>

	<div id="sub-header">
		Query Response System
	</div>

	<div class="content-space">

		<DIV id="intro-space">

			<div class="info-header centred">
				What's this About
			</div>

			<div class="info centred">
				HFN Query Response System is a platform 
				where the experienced practitioner helps 
				the inexperienced. <br/>
				<span class="mt-btn b0 __button__">More</span>
				<p class="moretext t0">
				The platform aims at enabling people to answer
				the questions and queries raised by	experienced 
				as well as new meditators,
				to help them overcome the obstacles in their 
				Heartfulness practices.
				</p>
			</div>
			<hr/>

			<div class="info-header centred">
				How to Use This
			</div>

			<div class="info centred">
				Simple as anything!<br/>
				Sign up or Log in, and post the thing which bugs you.<br/>
				Your post will then be visible to every other
				user on the site.<br/>
				<span class="mt-btn b1 __button__">More</span>
				<p class="moretext t1">
				People finding themselves capable to answer the
				question, will then answer your question.<br/>
				You can also answer your own questions, as a measure 
				to let others know your current thoughts about the question.
				</p>
			</div>
			<hr/>

			<div class="info-header centred">
				What to Avoid
			</div>

			<div class="info centred">
				Try not to ask easily answerable questions.
				<br/>
				<span class="mt-btn b2 __button__">More</span>
				<p class="moretext t2">
				Like "How to deal with
				flooding thoughts in meditation" et cetera.<br/>
				However, if the need still persists, the platform is 
				always open!
				</p>
			</div>
			<hr/>

			<div class="info centred">
				After all, Heartfulness isn't just about a couple hours 
				meditation.
				<p class="highlight">It tends to be a part of us.</p>
			</div>
		</DIV>

		<DIV id="signup-space">
		<div class="info-header centred">Create an Account</div>
		<form method="POST" action="auth/signup_modf.php" spellcheck="false" autocorrect="off">
	<input class="field" type="text" name="name" placeholder="Name" required="required" minlength="4" maxlength="30"/><br/>
	<input class="field" type="text" name="username" placeholder="Set a Username" required="required" minlength="6" maxlength="25" onkeyup="return lowerify(this)"/><br/>
	<!-- <span id="id-exist" class="user-alert" style="width: 80%;"></span> -->
	<input class="field" type="email" name="email" placeholder="Your Email Address" required="required"/><br/>
	<input class="field" type="password" name="passwd" placeholder="Set a Password" required="required" minlength="6" maxlength="20"/><br/>
	<input class="field" type="password" name="passwd-verify" placeholder="Confirm the Password" required="required" minlength="6" maxlength="20"/><br/>
	<span id="sgp-alert" class="user-alert"></span><br/>
	<input class="field" type="submit" name="submit" value="Create" onclick="return validate()"/>
			</form>
		</DIV>


		<DIV id="login-space">
		<div class="info-header centred">Log In</div>
			<form method="POST" action="auth/login_modf.php">
				<!-- <span id="lgn-alert" class="user-alert"></span> -->
			<input class="field" type="text" name="username" placeholder="Username" onkeyup="return lowerify(this)" /><br/>
			<input class="field" type="password" name="set-password" placeholder="Password" /><br/>
			<span id="lgn-alert" class="user-alert"></span><br/>
			<input class="field" type="submit" name="submit" value="Log In"/>
			</form>
		</DIV>

	</div>
	<footer style="margin-top:80px;">
		"Its natural to be spiritual"<br/>
		<i>- Daaji</i>
	</footer>
</div>
</body>
</html>