<?php
    session_start();
	unset($_SESSION['aname']);
	
	session_destroy();
	header("Location:index1.php");
?>