<?php // logout.php
	//this script destroys the current session and redirects to the homepage
	session_start();
	session_destroy();
	header("Location: ./index.php");
	?>