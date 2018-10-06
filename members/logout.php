<?php
    session_start();
    if (isset($_SESSION['curr_uid'])){
        $SESSION = null;
    	session_destroy();
    	header('Location: ../login.php?stat=loggedout');
    	exit();
    }
    else{
        header('../signup.php?stat=illegal');
        exit();
    }

?>