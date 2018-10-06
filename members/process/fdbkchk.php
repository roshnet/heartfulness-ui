<?php

session_start();
if (!isset($_SESSION['curr_uid'])){
	header("Location: ../index_.php?status=illegalattempt");
	exit();
}
else
	$uid = $_SESSION['curr_uid'];


if (!isset($_POST['submit'])){
	header('Location: ../questions.php?stat=illegal');
	exit();
}

include_once '../../included/newmysqli.php';

if($stmt = $mysqli->prepare("INSERT INTO feedbacks(f_text,f_by,f_type,f_on) VALUES(?,?,?,?)")){
	$today = date('d-M-Y');
	$stmt->bind_param("ssss",$_POST['ftext'],$_SESSION['curr_uid'],$_POST['ftype'],$today);
if($stmt -> execute())
	header('Location: ../questions.php?reviewed'); // redirect as soon as statement executes //
	$stmt->free_result();
	$stmt->close();
	$mysqli->close();
	exit();
}
?>