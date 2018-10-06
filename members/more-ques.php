<?php
/*
[DOCSTRINGS, more-ques.php, linked by questions.php]

Idea below can be highly optimised, 
as it loads all questions from 1 to n each time the button is clicked.
Performance (perhaps) goes down.

After optimisation, functionality may vary as:

	[1]. A page which extends its DOM to add 5 questions on each button click.
OR
	[2]. A page which always shows 5 questions, with contents replaced by older 
	questions on each click, within the same div, total DOM remaining unaffected, (PS: a button
	to control visibility of the newer ones then needs to be added for further 
	functionality).

Need to optimise it in the following manner:
	[1]:
		a: Button clicked, but the handler attached is not 'load()';
		b: Instead, the JS/q handler appends the data to the div.
		c: To display the correct questions, changes in PHP code 
		have to be made to govern the alternative of OFFSET (viz. slow)
		by a WHERE clause.
		The parameter of the prepared statement will then be 'qid', and 
		not limit (which it actually is, now), limit being constant at 5.
	[2]:
		// Sounds expensive in terms of efforts //
*/
?>

<?php

// session_start();
// if (!isset($_SESSION[])) {
// 	# rdr code...
// }
?>




<?php

include_once '../included/newmysqli.php';


if($stmt=$mysqli->prepare("SELECT qid,questext,askedby FROM questions ORDER BY qid DESC LIMIT ?")){
	$stmt -> bind_param("i",$_POST['q_visib_count']);
	$stmt -> execute();
	$res = $stmt->get_result();
	if($_POST['q_visib_count']-5 <= $res->num_rows)
		while($row = $res->fetch_assoc()){
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
	else{
		echo '<script type="text/javascript">';
		echo '$("#old-ques-btn").hide();';
		echo '$("#qnav").html("<br/><br/><span class=\"screen-msg\">No more questions to show </span>");';
		echo '</script>';
		echo '<a class="button-btn" href="questions.php?init">Jump to Start</a>';
	}
}
else{
	header('Location: questions.php?stat=error');
	exit();
}

?>


<?php

/*
[POST DOCSTRINGS]:


// attributes are NOT sensitive, so, no problem if they are displayed on error // 
// hence using vars to hold it //
// $stmt -> bind_result($qid, $questext, $askedby);

// get_result() in place of store_result() will fetch an assoc array:
// EDIT:
// after an answer on stackExchange:
	// "Use get_result() wherever possible, store_result() elsewhere" //
// So, using get_result() as:
	
	$res = $stmt -> get_result();
	if ($res -> num_rows() > 0){
		while ($row = $res -> fetch_assoc()){
			echo $row['qid']; // or any other stuff //
		}
	}

*/
?>