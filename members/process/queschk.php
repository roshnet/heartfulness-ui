<?php
	session_start();
	if (!isset($_SESSION['curr_uid'])){
		header("Location: ../index_.php?status=illegalattempt");
		exit();
	}
	include_once '../../included/newmysqli.php';

	if (isset($_POST['submit'])) {
		if (empty($_POST['q-text']) || strlen($_POST['q-text']) < 10){
			header('Location: ../questions.php?stat='.md5('shortans'));
			exit();
		}
		if ($stmt = $mysqli->prepare("INSERT INTO questions (questext,askedby,askedon) VALUES (?,?,?)")){
			$today = date('d-M-Y');
			$stmt -> bind_param("sss", $_POST['q-text'], $_SESSION['curr_uid'], $today);
			if ($stmt -> execute()){
				$stmt -> close();
				$uid = $_SESSION['curr_uid'];
				$mysqli -> query("UPDATE usercreds SET asked=asked+1 WHERE username='$uid'");
				header('Location: ../questions.php?submit=success');
				exit();
			}
		}
		else{
			header('Location: ../questions.php?stat=sqlerror');
			exit();
		}
	}
	else{
		header('Location: ../questions.php?stat=illegal');
	}

?>