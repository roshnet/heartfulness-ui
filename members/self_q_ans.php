<?php
// self_q_ans.php is SAME AS answers.php, 
// except that the back button (UI) links to self-ques.php
session_start();
if (!isset($_SESSION['curr_uid'])){
	header('Location: ../login.php?stat=illegal');
	exit();
}

?>
<!DOCTYPE html><html>
<head>
	<title>Answers | Heartfulness QRS</title>
	<link rel="stylesheet" type="text/css" href="../css/styler.css"/>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
	<link rel="icon" type="image/png" href="../css/favicon.png"/>
</head>
<body>
<div id="fluid-container">

	<header class="header">HEARTFULNESS</header>


	<div id="content-space">
		<span class="__button__" style="font-size: 200%;">
			<a href="self-ques.php">&lt;&lt;&lt;</a>
		</span>
		<br/>

		<div id="main-ques">
<?php
	include_once '../included/dbconnection.php';
// shows current question from table 'questions' //
	$qid = $_POST['q-curr'];
	$res1 = mysqli_query($conn,"SELECT askedby,questext FROM questions WHERE qid=$qid");
	if ($res1)
		while ($row = mysqli_fetch_assoc($res1)){
			echo "<p class=\"curr_ques\">";
			echo $row['questext'];
			echo "</p>";
			echo "<span class=\"__asker__\"> - ".$row['askedby']."</span>";
			echo "<br/>";
			$asker = $row['askedby'];
		}
	else{
		header('Location: questions.php?stat=sqlerror');
		exit();
	}
	mysqli_free_result($res1);
?>
		</div>

		<div id="usr-ques">
		<?php // user's answer box ?>
			<form action="process/anschk.php" method="POST">
<textarea minlength="20" rows="5" class="field" name="q-text" placeholder="Your answer here..."></textarea><br/>
<input type="hidden" name="q-curr" value='<?php echo $qid; ?>'/>
<input type="submit" name="submit" class="button-btn" value="Answer"/><br/>
			</form>
		</div>

		<div id="all-ques">
<?php
include_once '../included/dbconnection.php';

$res2 = mysqli_query($conn, "SELECT anstext,ansdby FROM answers WHERE aqid=$qid ORDER BY ans_id DESC");

if($res2)
	while ($row = mysqli_fetch_assoc($res2)){
		echo '<div class="qa-box">';

		echo '<p class="asker">';
		echo '<span class="__asker__">' . $row['ansdby'] . '</span>';
		echo ' said:';
		echo '</p>';

		echo '<p class="qbody">';
		echo $row['anstext'];
		echo '</p>';

		echo '</div>';
	}
else{
		header('Location: questions.php?stat=sqlerror');
		exit();
	}
mysqli_free_result($res2);
mysqli_close($conn);

?>
		</div>

	</div>
	<!-- contentspaceendsup -->
</div>
</body>
</html>