<?php
/*
[+]Receives and echoes data on questions.php;
[+]Called by jQ load() //
*/

/*
if (!isset($_SESSION['curr_uid'])){
	header('Location: ../../signup.php?stat=illegal');
	exit();
}
*/


include '../included/newmysqli.php';
// defines $mysqli //


// =====================================
// DEFINING q_max ONLY ONCE AT A PAGE //
// WILL BE UPDATED ON PAGE REFRESH //
// =====================================



if($res = $mysqli -> query("SELECT COUNT(qid) FROM questions;"))
	$q_max = $res -> num_rows();


if($stmt=$mysqli->prepare("SELECT qid,questext,askedby FROM questions HAVING qid>$q_max-? ORDER BY qid DESC LIMIT 5;")) {
	$stmt -> bind_param("i",$_POST['q_ctr']); // i -> d;
	$stmt -> execute();
	$stmt -> store_result();
}

// echoing data //
while ($row = $stmt -> fetch_assoc()) {

	echo '<p class="asker">';
	echo '<span class="__asker__">' . $row['askedby'] . '</span>';
	echo 'asked: ';
	echo '</p>';

	echo '<p class="qbody">';
	echo $row['questext'];
	echo '</p>';
	echo '<span class="__button__ ans-btn">';
	echo '<a href="../answers.php?ques='.$row['qid'].'">Answers</a></span>';

	echo '<span class="__icon__ vt-btn psv"> + </span>';
	echo '<span class="__icon__ vt-btn ngv"> - </span>';
	echo '<span class="__icon__ vt-btn inapr">Inappropriate Content</span>';
	echo '<br/>';

}

?>










<?php




/*
ABOUT $q_ctr:
[+]Obtained by this script via JQ load() on 'questions.php';
[+]Is actually the MOST IMPORTANT VARIABLE, responsible for keeping track of 
actively displayed 5-question-set on the client's page;
[+]Is altered by client-side JS;
[+]Since load() calls are post requests, so $_POST['q_ctr'];
[+] ? in the prepare_stmt is actually a placeholder for $q_ctr;

*/







?>