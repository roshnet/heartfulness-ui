<?php

session_start();
	// if (!isset($_SESSION['curr_uid'])){
		// header("Location: ../index_.php");
		// exit();
	// }

include_once '../../included/newmysqli.php';

if (isset($_POST['submit'])) {

	if (empty($_POST['q-text'])){
		header('Location: ../answers.php?stat='.md5('shortans'));
		exit();
	}
	if ($stmt=$mysqli->prepare("INSERT INTO answers (aqid,ansText,ansdBy,ansdOn) VALUES (?,?,?,?)")){
		$today = date("d-M-Y");
		$stmt->bind_param("isss",$_POST['q-curr'],$_POST['q-text'],$_SESSION['curr_uid'],$today);
		if($stmt->execute()){
			$stmt->free_result();
			$uid = $_SESSION['curr_uid'];
			$updt_res = $mysqli->query("UPDATE usercreds SET answered=answered+1 WHERE username='$uid'");
			header("Location: ../questions.php?submit=success");
			$mysqli->close();
			exit();
		}
		else{
			echo $mysqli->error;
		}
	}
	else{
		header('Location: ../questions.php?stat=sqlerror');
		exit();
	}
}
else{
	header('Location: ../questions.php?stat=unauth');
	exit();
}

/*
ERROR CODES:
shortans
sqlerror
unauth
*/
?>