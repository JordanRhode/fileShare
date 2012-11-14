<?php // accesscontrol.php

	//use include_once in the case that the code from those scripts
	//has already been included.
	include_once "common.php";


	session_start();//begin session

	//check if username have been submitted via POST or SESSION
	if (isset($_POST["username"]))
	{
		$username = $_POST["username"];
	}
	elseif (isset($_SESSION["username"])) 
	{
		$username = $_SESSION["username"];
	}
	//same thing for password
	if (isset($_POST["password"]))
	{
		$password = md5($_POST["password"]);
	}
	elseif (isset($_SESSION["password"])) 
	{
		$password = $_SESSION["password"];
	}

	//if user hasn't logged in, display login form
	if(!isset($username)) 
	{
		?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
		"http://www.w3.org/TR/html4/strict.dtd">
		<!-- Bootstrap -->
		<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/styles.css" rel="stylesheet">
		<HTML>

		   <HEAD>

		      <TITLE>File Share Login</TITLE>

		   </HEAD>

		   <BODY>

		   		<div id="container">
				<form class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="application/x-www-form-urlencoded">
					<legend>Login to continue</legend>
				  <div class="control-group">
				    <label class="control-label" for="username">Username</label>
				    <div class="controls">
				      <input type="text" id="username" name="username" placeholder="Username">
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="password">Password</label>
				    <div class="controls">
				      <input type="password" id="password" name="password" placeholder="Password">
				    </div>
				  </div>
				  <div class="control-group">
				    <div class="controls">
				      <button type="submit" class="btn">Sign in</button>
				    </div>
				  </div>
				</form>
				
		<?php
			require "footer.php";
			exit;
	}
	
	//set session username and password
	$_SESSION["username"] = $username;
	$_SESSION["password"] = $password;

	//connect to database
	$connection = mysql_connect("localhost", "root", "");
    mysql_select_db("file_share", $connection);

    if(!$connection)
    {
    	echo "Couldn't connect to mySQL.";
    	exit;
    }

    //query getting username, password, and usertype from db
	$query = "SELECT COUNT(`username`) AS `total`, type FROM `login` WHERE `username` = '$username' AND `password` = '$password'";

	$result = mysql_query($query);
	if(!$result)
	{
		error("A database error occured while checking your " .
			  "login details.\\nWe apologize for any inconvenience!");
	}

	//returns array of strings corresponding to the fetched row
	$row = mysql_fetch_assoc($result);

	//if the login failed, display access denied page
	if($row["total"] != 1)
	{	
    	unset($_SESSION["username"]);
    	unset($_SESSION["password"]);
    	?>
    	<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN"
  		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<script type="text/javascript" src="./assets/scripts/javascript.js"></script>
		<!-- Bootstrap -->
		<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/styles.css" rel="stylesheet">
		  <head>
		    <title> Access Denied </title>
		  </head>
		  <body>
		  	<div id="container">
		  <h1> Access Denied </h1>
		  <p>Your user ID or password is incorrect, or you are not a
		     registered user on this site. To try <a href="index.php">logging in</a> again.</p>
		<?php
			require "footer.php";
			exit;
	}
	
	//get the userType from the fetched query
	$userType = $row["type"];
	mysql_close($connection);//close sql connection
	?>