<?php

//`
define("edoc", "8169$#");
include("connect.php");


if(isset($_GET["email"], $_GET["settp"]) === true)
{
	//get params
	$email = test_input($_GET["email"]);
	$temp_pass_check = test_input($_GET["settp"]);

	
	$verify = $connect->prepare("SELECT * FROM members WHERE email = :email AND temp_password = :tp LIMIT 1");
	$verify->bindParam(":email", $email);
	$verify->bindParam(":tp", $temp_pass_check);
	$verify->execute();

	$verify_result = $verify->rowCount();

	$verify->setFetchMode(PDO::FETCH_ASSOC); 
	$row = $verify->fetch();
	$temp_pass_state = $row["temp_password"];
	$activated__state = $row["activated"];

	
	if($verify_result === 0)
	{
		echo "<h2>Oops...</h2><br>";
		echo "There was a problem activating your temporary password:<br /> The email address may not be registered. You can register <a href='<?php get_the_permalink();?>?page_id=110'>Here</a>";
	}
	else if($verify_result > 0 && $temp_pass_state === "" || $verify_result > 0 && $temp_pass_state === NULL || $verify_result > 0 && empty($temp_pass_state))
	{

		header("Location: index.php");
		exit();
	}
	else if($verify_result > 0 && $temp_pass_state === $temp_pass_check)
	{
		$temp_pass_state = "$2y$10$" . $temp_pass_state;

		//Activate user temp password
		$activate_temp_pass = $connect->prepare("UPDATE members SET password = :pass, temp_password = NULL, activated = 'temp_password' WHERE email = :email AND temp_password = :temp_pass");
		$activate_temp_pass->bindParam(":pass", $temp_pass_state);
		$activate_temp_pass->bindParam(":temp_pass", $temp_pass_check);
		$activate_temp_pass->bindParam(":email", $email);
		$activate_temp_pass->execute();

		echo "<h2>Temporary Password Activated!</h2><br>";
		echo "Your temporary password has been activated. You can now login with it at the <a href='<?php get_the_permalink();?>?page_id=108'>Login Page.</a>";
	}
	else
	{
		echo "<h2>Oops...</h2><br>";
		echo "There was a problem activating your temporary password:<br /> The email address may not be registered. You can register <a href='<?php get_the_permalink();?>?page_id=110'>Here</a>";
	}

}
else
{
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