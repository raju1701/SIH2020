<?php
    session_start();
	unset($_SESSION['uname']);
	unset($_SESSION['p']);
	session_destroy();
	header("Location:index.php");
?>