<?php

session_start();


if(isset($_SERVER['HTTP_REFERER']))
{
	if(isset($_SESSION["userID"]))
	{
		session_destroy();
	}


	$loggedout = trim($_SERVER['HTTP_REFERER']);
	$loggedout = stripslashes($loggedout);
	$loggedout = htmlspecialchars($loggedout);

	header("Location: " . $loggedout);
	exit();
}
else
{
	header("Location: index.php");
	exit();
}



?>