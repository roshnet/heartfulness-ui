<?php
	session_start();
	if (!isset($_SESSION['curr_uid'])){
		header("Location: ../index_.php?status=illegalattempt");
		exit();
	}

?>
<!DOCTYPE html><html>
<head>
	<title>Questions | Heartfulness QRS</title>
	<link rel="stylesheet" type="text/css" href="../css/styler.css"/>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
	<link rel="icon" type="image/png" href="../css/favicon.png"/>
	<link rel="stylesheet" type="text/css" href="custom.css"/>
	<script type="text/javascript" src="../js/jquery-3.3.1.js"></script>
</head>
<body>

<div id="fluid-container">

	<header class="header">HEARTFULNESS</header>

	<div id="content-space">

		<h2 class="title">Ask a question, <span style="color: #0000ff;font-size: 80%;" class="__asker__">
			<?php 
			echo $_SESSION['curr_uid'];
			?>
		</span> :</h2>
		<div id="usr-ques">
			<form id="usr-ques-form" action="process/queschk.php" method="POST">
<textarea minlength="10" rows="5" class="field" name="q-text" placeholder="Your question here..." required="required"></textarea><br/>
<input type="submit" name="submit" class="button-btn" value="Add to Feed"/><br/>
			</form>
		</div>

		<form id="ans-form" method="POST" action="answers.php"></form>

<hr class="decent-hr v-spacer"/>
		<div id="qfeed">
			<h2>The Feed</h2>
<?php
// code to view latest 5 questions, along with functionality //
include '../included/newmysqli.php';

if($res_init = $mysqli->query("SELECT qid,questext,askedby FROM questions ORDER BY qid DESC LIMIT 5")){
	while ($row = $res_init->fetch_assoc()){
		echo '<div class="qa-box">';
		echo '<p class="asker">';
		echo '<span class="__asker__">' . $row['askedby'] . '</span>';
		echo ' asked:';
		echo '</p>';

		echo '<p class="qbody">';
		echo $row['questext'];
		echo '</p>';
		echo '<a href="answers.php?ques='.md5($row['qid']).'">'; //showOff
		echo '<button form="ans-form" name="q-curr" value="'.$row['qid'].'" class="__button__ ans-btn">';
		echo 'Answers</button></a>';
		echo '</div>';
	}
}
?>
		</div>
		<!-- others-ques endsup -->

		<div id="qnav">
			<button id="old-ques-btn" class="button-btn">Show More</button>
		</div>

	<footer>
		<ul>
			<a href="self-ques.php"><li style="color: aqua;">My Posts</li></a>
			<a href="feedback.php"><li style="color: yellow;">Suggestions</li></a>
			<a href="logout.php"><li style="color: orange;">Logout</li></a>
		</ul>
	</footer>

	</div>
</div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){var a=5;$("#old-ques-btn").click(function(){a+=5;$("#qfeed").load("more-ques.php",{q_visib_count:a})})});
</script>