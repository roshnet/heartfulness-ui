<?php
	session_start();
	if (!isset($_SESSION['curr_uid'])){
		header("Location: ../index_.php?status=illegalattempt");
		exit();
	}
	else $uid = $_SESSION['curr_uid'];
?>
<!DOCTYPE html><html>
<head>
	<title>My Questions | Heartfulness QRS</title>
	<link rel="stylesheet" type="text/css" href="../css/styler.css"/>
	<meta charset="uft8mb4"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
	<link rel="icon" type="image/png" href="../css/favicon.png"/>
	<script type="text/javascript" src="../js/jquery-3.3.1.js"></script>
</head>
<body>

<div id="fluid-container">

	<header class="header">HEARTFULNESS</header>

	<div id="content-space">
			<a href="questions.php">
				<button class="__button__ v-spacer" style="font-size: 200%;">
				&lt;&lt;&lt;
				</button>
			</a>
		<br/>

		<h2 class="title">Questions you asked</h2>
		<hr class="decent-hr v-spacer"/>
		<form id="ans-form" method="POST" action="self_q_ans.php"></form>
		<div id="qfeed">
<?php
include_once '../included/dbconnection.php';
// simply echo out all questions by current user //
$res = mysqli_query($conn, "SELECT qid,questext,askedon FROM questions WHERE askedby='$uid';");
if ($res){
	if (mysqli_num_rows($res) == 0) {
		echo '<p class="screen-msg">You have not asked any questions yet.';
		mysqli_free_result($res);
	}
	else
		while ($row = mysqli_fetch_assoc($res)){
		echo '<div class="qa-box">';

		echo '<p class="__asker__">'.$row['askedon'].'</p>';
		echo '<p class="qbody">';
		echo $row['questext'];
		echo '</p>';
		echo '<a href="answers.php?ques='.md5($row['qid']).'">'; //showOff
		echo '<button form="ans-form" name="q-curr" value="'.$row['qid'].'" class="__button__ ans-btn">';
		echo 'Answers</button></a>';
		echo '</div>';
	}
}
else{
	header('Location: questions.php?stat=sqlerror');
	exit();
}
?>
		</div>
	</div>
</div>
</body>
</html>