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
	<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
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
<?php
/* JS code to separate and highlight the last word as
and when a ' ' is entered;
// to be done in advanced version //
*/
/*
<select name="q-anyms" form="usr-ques-form">
	<option value="0">I prefer anonymity</option>
	<option value="1">Its OK otherwise</option>
</select>
*/
?>

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

$(document).ready(function(){

	var actiques = 5;
	// var _maxLimit_ = $('input[name="max-eff-limit"]').val();
	$("#old-ques-btn").click(function(){
		actiques = actiques + 5;
		$("#qfeed").load("more-ques.php",{
			q_visib_count: actiques
		});
	});
});


</script>

































































<?php
/*
Because we are not a social network site, we do not 
collect data from you which social sites generally collect.
Your name, and email: that's all.
However, if you want others to recognise you and know more about you, 
please <a href="usr_info.php">provide more details about yourself.</a>

///// IN THE NEXT PAGE /////
We don't know what information you are willing to share.
So, along with a basic list of things, we provide an additional 
feature, called 'modified parameters'.
For example, if you want to share your hobby, type:
<i>
	HOBBY: playing guitar
	VOLUNTEERING: Loves volunteer work
	ANY-OTHER-THING: informatoin-about-it
</i>

//You are presented with two inline boxes, and numerous such pairs(AccToYou).
Type feature_name in first, feature_value in another // 


//However, if you like to have social features in here, 
//add a brief review about what exactly it is.


*/


?>

<?php
/*

NOW , THE PROBLEM IS TO 
link the upvote btns to their respective 
questions ..
If that hapens successfully, then an upvote on a 
question will increase positives of THAT QUESTION ONLY.

SOLUTIONS: 
One poor way is to php-echo out JQ code (in an ID'd script tag) to attach a click handler to
send AJAX data (JQ load()) to a php script to update the count of respectie attribs. Also, this will require a slight modification in the echoed php code,,
result will be a button with an id="ques12" (say),
and the echoed JQ code will add event handler to #ques12..
And, when the page activates the next set of questions (5-Questions), 
then the php code will overwrite the JQ code in that ID'd script tag, like it does for 
questions...


*/

/*
I feel restlessness in meditation,
and even relaxation did not help.
Some preceptors say its a test by master,
some say its a suffering which needs to be accepted.
What do i do? Fight or let go ?
*/


?>