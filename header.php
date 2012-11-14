<?php //header.php ?>
<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="./assets/scripts/javascript.js"></script>
<!-- Bootstrap -->
<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/styles.css" rel="stylesheet">
<head>
	  	<title> Shared Files </title>
	</head>
	<body>
		<div id="container">
			<legend><img src="assets/img/header_logo.png"/>
				<div id="logoutBtn">
					<form action="./logout.php">
						<p>Welcome, <?=$username?>! <input type="submit" class="btn" value="Logout"/></p>
					</form>
				</div>
			</legend>