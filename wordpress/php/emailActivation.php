<?php

//`
define("edoc", "8169$#");
include("connect.php");


if(isset($_GET["email"], $_GET["activate"]) === true)
{

	$email = test_input($_GET["email"]);
	$activation_code = test_input($_GET["activate"]);


	$verify = $connect->prepare("SELECT * FROM members WHERE email = :email AND activation_code = :act LIMIT 1");
	$verify->bindParam(":email", $email);
	$verify->bindParam(":act", $activation_code);
	$verify->execute();

	$verify_result = $verify->rowCount();

	$verify->setFetchMode(PDO::FETCH_ASSOC); 
	$row = $verify->fetch();
	$already_activated = $row["activated"];


	if($verify_result === 0 && $already_activated === '0')
	{
		//Couldn't find any account with email and activation code
		echo "<h2>Oops...</h2><br>";
		echo "There was a problem activating your account:<br /> The email address may not be registered. You can register <a href='<?php get_the_permalink();?>?page_id=110'>Here</a>";//.<br /> Or the activation code may be incorrect. <a href='#'>Click here</a> to have a new activation code sent to your email.";
	}
	else if($already_activated == 1)
	{
		//Your account is already activated
		header('Location: index.php');
		exit();
	}
	else if($verify_result > 0 && $already_activated === '0')
	{
		//Update user activation state
		$activate_account = $connect->prepare("UPDATE members SET activated = '1' WHERE email = :email AND activation_code = :act");
		$activate_account->bindParam(":email", $email);
		$activate_account->bindParam(":act", $activation_code);
		$activate_account->execute();

		echo "<h2>Your account is now activated!</h2>";
		echo "<p>You can now <a href='<?php get_the_permalink();?>?page_id=108'>login</a></p>";
		echo "<p><a href='index.php'>return to homepage</a></p>";

	}
	else
	{
		echo "<h2>Oops...</h2><br>";
		echo "There was a problem activating your account:<br /> The email address may not be registered. You can register <a href='<?php get_the_permalink();?>?page_id=110>Here</a>";//.<br /> Or the activation code may be incorrect. <a href='#'>Click here</a> to have a new activation code sent to your email.";
	}

}
else
{
	//No link prams were found!
	header("Location: index.php");
	exit();
}




function test_input($input) 
{
	$input = trim($input);
  	$input = stripslashes($input);
  	$input = htmlspecialchars($input);
  	return $input;
}


$connect = NULL;
?>