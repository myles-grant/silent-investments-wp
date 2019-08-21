<?php

if(edoc !== "8169$#") 
{
    header('HTTP/1.1 404 Not Found');
    echo "<!doctype html>\n<html><head>\n<title>404 Not Found</title>\n</head>";
    echo "<body>\n<h1>Not Found</h1>\n<p>The requested URL ".$_SERVER['REQUEST_URI']." was not found on this server.</p>\n";
    echo "<hr>\n".$_SERVER['SERVER_SIGNATURE']."\n</body></html>\n";
    exit;
}


$first_name = $last_name = $username = $email = $password = $password1 = $password2 = $cookie_pass = $temp_pass_sent = $temp_pass_changed = "";
$GLOBALS["newPassword"] = "";

if(isset($_COOKIE["user"])){
	$username = test_input($_COOKIE["user"]);
	$cookie_pass = $_COOKIE["access"];
}

$error_values_footer = array("", "");
$error_values_sidebar = array("", "");
$error_values_login = array("", "");
$error_values = array("", "", "", "", "", "");
$error_values_forgot = "";
$error_values_change_pass = "";

//$error_values_update = array("", "", "", "", "");
$GLOBALS["error_values_update0"] = "";
$GLOBALS["error_values_update1"] = "";
$GLOBALS["error_values_update2"] = "";
$GLOBALS["error_values_update3"] = "";
$GLOBALS["error_values_update4"] = "";

$regUser = array(false, false, false, false, false, false);
$loginUser = array(false, false);
$regFreeLessonUser = array(false, false);
$forgot_pass = false;
$GLOBALS["changeUserPass"] = false;

//$updateUser = array(false, false, false, false, false);
$GLOBALS["updateUser0"] = "";
$GLOBALS["updateUser1"] = "";
$GLOBALS["updateUser2"] = "";
$GLOBALS["updateUser3"] = "";
$GLOBALS["updateUser4"] = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

	if (isset($_POST['footer']))
	{


		$first_name = test_input($_POST["fname"]);
		$email = test_input($_POST["email"]);


		//Check if email address is already registered
		$looking_email_duplicate = $connect->prepare("SELECT email FROM free_tutorial_members WHERE email = :email LIMIT 1");
		$looking_email_duplicate->bindParam(":email", $email);
		$looking_email_duplicate->execute();
		$caught_email_duplicate = $looking_email_duplicate->rowCount();		

		$input_values = array($first_name, $email);



	  	for($i=0; $i<count($input_values); $i++)
	  	{
	  		//$regFreeLessonUser[$i] = false;
	  		//$error_values_footer[$i] = "";

	  		if (inputValidate($input_values[$i]))
	  		{
	  			$error_values_footer[$i] = "This field must be filled out.";
	  		}
	  		else
	  		{

	  			if($i === 1 && emailValidate($input_values[1]))
	  			{
	  				$error_values_footer[1] = "Not a valid email address.";
	  			}
	  			else
		  		{
					if($i === 1 && $caught_email_duplicate > 0)
		  			{
		  				$GLOBALS['dup_free_user_foot'] = "This email has already been given a free lesson";
		  			}
		  			else
		  			{
		  				$GLOBALS['free_user_foot'] = "Your free tutorial has been sent to the provide email address.";
						$regFreeLessonUser[$i] = "true";
					}
		  		}

	  		}
	  	}

	}
	else if (isset($_POST['sidebar']))
	{


		$first_name = test_input($_POST["fname"]);
		$email = test_input($_POST["email"]);


		//Check if email address is already registered
		$looking_email_duplicate = $connect->prepare("SELECT email FROM free_tutorial_members WHERE email = :email LIMIT 1");
		$looking_email_duplicate->bindParam(":email", $email);
		$looking_email_duplicate->execute();
		$caught_email_duplicate = $looking_email_duplicate->rowCount();		

		$input_values = array($first_name, $email);



	  	for($i=0; $i<count($input_values); $i++)
	  	{
	  		//$regFreeLessonUser[$i] = false;
	  		//$error_values_footer[$i] = "";

	  		if (inputValidate($input_values[$i]))
	  		{
	  			$error_values_sidebar[$i] = "This field must be filled out.";
	  		}
	  		else
	  		{

	  			if($i === 1 && emailValidate($input_values[1]))
	  			{
	  				$error_values_sidebar[1] = "Not a valid email address.";
	  			}
	  			else
		  		{
					if($i === 1 && $caught_email_duplicate > 0)
		  			{
		  				$GLOBALS['dup_free_user_side'] = "This email has already been given a free lesson";
		  			}
		  			else
		  			{
		  				$GLOBALS['free_user_side'] = "Your free tutorial has been sent to the provide email address.";
						$regFreeLessonUser[$i] = "true";
					}
		  		}
	  		}
	  	}

	}
	else if (isset($_POST['login']))
	{
		
		$username = test_input($_POST["username"]);

		if(isset($_POST["remember"]))
		{
			$remember = test_input($_POST["remember"]);
			$remember = preg_replace("#[^a-z]#i", "", $remember);
		}

		$get_account = $connect->prepare("SELECT activated, password, id FROM members WHERE username = :username LIMIT 1");
		$get_account->bindParam(":username", $username);
		$get_account->execute();
		$get_account->setFetchMode(PDO::FETCH_ASSOC); 

		$account_result = $get_account->rowCount();

		$row = $get_account->fetch();
		$activated = $row["activated"];
		$pass_compare = $row["password"];
		$userID = $row["id"];

		$password = crypt($_POST["password"], $pass_compare);

		$verify_account = $connect->prepare("SELECT password FROM members WHERE password = :passwrd LIMIT 1");
		$verify_account->bindParam(":passwrd", $password);
		$verify_account->execute();
		$verify_account->setFetchMode(PDO::FETCH_ASSOC); 

		$verify_account_result = $verify_account->rowCount();

	  	$input_values = array($username, $_POST["password"]);


	  	for($i=0; $i<count($input_values); $i++)
	  	{

	  		if (inputValidate($input_values[$i]))
	  		{
	  			$error_values_login[$i] = "This field must be filled out.";
	  		}
	  		else
	  		{

	  			if($i === 0 && $account_result === 0)
	  			{
	  				$error_values_login[0] = "This username is not registered. Please register <a href='<?php get_the_permalink();?>?page_id=110'>here</a> for account access.";
	  			}
	  			else
	  			{

	  				if($i === 1 && $account_result > 0 && $verify_account_result === 0)
	  				{
	  					$error_values_login[1] = "The password you entered is incorrect.";
	  				}
	  				else
	  				{

	  					if($account_result > 0 && $verify_account_result > 0 && $activated === '0')
	  					{
	  						
	  						$error_values_login[0] = "Your account has not been activated.";
	  					}
	  					else
	  					{
	  						
	  						$loginUser[$i] = "true";
	  					}
	  				}
	  			}
	  		}
	  	}
	}
	else if (isset($_POST['forgot_pass']))
	{

		$email = test_input($_POST["email"]);

		//check if email has already bin sent temp pass
		$get_account = $connect->prepare("SELECT temp_password, activated, username FROM members WHERE email = :email LIMIT 1");
		$get_account->bindParam(":email", $email);
		$get_account->execute();
		$get_account->setFetchMode(PDO::FETCH_ASSOC); 

		$account_result = $get_account->rowCount();

		$row = $get_account->fetch();
		$temp_pass = $row["temp_password"];
		$account_state = $row["activated"];
		$username = $row["username"];


	  		if (inputValidate($email))
	  		{
	  			$error_values_forgot = "This field must be filled out.";
	  		}
	  		else
	  		{
	  			if(emailValidate($email))
	  			{
	  				$error_values_forgot = "Not a valid email address";
	  			}
	  			else
	  			{

		  			if($account_result === 0)
		  			{
		  				$error_values_forgot = "This email address is not registered. Please register <a href='<?php get_the_permalink();?>?page_id=110'>here</a> for account access.";
		  			}
		  			else
		  			{
		  				if($account_state === '0')
		  				{

		  					$error_values_forgot = "This email address is not activated.";
		  				}
		  				else
		  				{

			  				if($account_result > 0 && !inputValidate($temp_pass) || $account_state === "temp")
			  				{
			  				
			  					$error_values_forgot = "This email address has already been sent a temporary password.";
			  				}
			  				else
			  				{
			  					$temp_pass_sent = "A temporary password has been sent to your email address.";
			  					$forgot_pass = "true";	
			  				}
			  			}
		  			}	
	  			}
	  		}
	  		
	}
	else if (isset($_POST['change_pass']))
	{


		$GLOBALS["newPassword"] = password_encrypt($_POST["newPassword"]);

		if(inputValidate($_POST["newPassword"])) {
			$error_values_change_pass = "This field must be filled out.";
		}
		else {
			$temp_pass_changed = "Your password has been changed.";
			$GLOBALS["changeUserPass"] = "true";
		}
	}
	else if (isset($_POST['signup']))
	{

		$first_name = test_input($_POST["fname"]);
		$last_name = test_input($_POST["lname"]);
		$username = test_input($_POST["username"]);
		$email = test_input($_POST["email"]);

		
		//php 5.5 >
		//$password1 = password_hash($_POST["pass1"], PASSWORD_BCRYPT);
		//$password2 = password_hash($_POST["pass2"], PASSWORD_BCRYPT);

		$password1 = password_encrypt($_POST["pass1"]);
		$password2 = crypt($_POST["pass2"], $password1);

		//Check if email address is already registered
		$looking_email_duplicate = $connect->prepare("SELECT email FROM members WHERE email = :email LIMIT 1");
		$looking_email_duplicate->bindParam(":email", $email);
		$looking_email_duplicate->execute();
		$caught_email_duplicate = $looking_email_duplicate->rowCount();

		//Check if username is taken
		$looking_username_duplicate = $connect->prepare("SELECT username FROM members WHERE username = :username LIMIT 1");
		$looking_username_duplicate->bindParam(":username", $username);
		$looking_username_duplicate->execute();
		$caught_username_duplicate = $looking_username_duplicate->rowCount();


	  	$input_values = array($first_name, $last_name, $username, $email, $password1, $password2);


	  	for($i=0; $i<count($input_values); $i++)
	  	{	  		

	  		if (inputValidate($input_values[$i]))
	  		{
	  			$error_values[$i] = "This field must be filled out.";
	  		}
	  		else
	  		{

	  			if($i === 3 && emailValidate($input_values[3]))
	  			{
	  				$error_values[3] = "Not a valid email address.";
	  			}
	  			else
	  			{

			  		if($i === 4 && strlen($_POST["pass1"]) < 6)
					{
			  			$error_values[4] = "Your password must contain atleast a minimum of 6 characters.";
			  		}
			  		else
			  		{

				  		if($i === 5 && passwordValidate($input_values[4], $input_values[5]))
				  		{
				  			$error_values[5] = "The password fields do not match.";
				  		}
				  		else
				  		{

				  			if($i === 2 && $caught_username_duplicate > 0)
						  	{
						  		$error_values[2] = "This username is already taken.";
						  	} 
						  	else
						  	{



								if($i === 3 && $caught_email_duplicate > 0)
							  	{
							  		$error_values[3] = "This email address is already registered.";
							  	}
								else
								{
									//include("registerUser.php");
						  			//Register User

						 			$regUser[$i] = "true";	
						 		}
							 }
						}
	  				}
	  			}
	  		}
	  	}
	} 
	else if (isset($_POST['update']))
	{

		$first_name = test_input($_POST["fname"]);
		$last_name = test_input($_POST["lname"]);
		$username = test_input($_POST["username"]);

		$GLOBALS["first_name_update"] = $first_name;
		$GLOBALS["last_name_update"] = $last_name;
		$GLOBALS["username_update"] = $username;
		
		//php 5.5 >
		//$password1 = password_hash($_POST["pass1"], PASSWORD_BCRYPT);
		//$password2 = password_hash($_POST["pass2"], PASSWORD_BCRYPT);

		$password1 = password_encrypt($_POST["pass1"]);
		$password2 = crypt($_POST["pass2"], $password1);

		$GLOBALS["password_update"] = $password1;

		//Check if username is taken
		$looking_username_duplicate = $connect->prepare("SELECT username FROM members WHERE username = :username LIMIT 1");
		$looking_username_duplicate->bindParam(":username", $username);
		$looking_username_duplicate->execute();
		$caught_username_duplicate = $looking_username_duplicate->rowCount();


	  	$input_values = array($first_name, $last_name, $username, $password1, $password2);


	  	for($i=0; $i<count($input_values); $i++)
	  	{	  		

	  		if (inputValidate($input_values[$i]))
	  		{

	  			$GLOBALS["error_values_update" .$i] = "This field must be filled out.";
	  		}
	  		else
	  		{

			  		if($i === 3 && strlen($_POST["pass1"]) < 6)
					{
			  			$GLOBALS["error_values_update3"] = "Your password must contain atleast a minimum of 6 characters.";
			  		}
			  		else
			  		{

				  		if($i === 4 && passwordValidate($input_values[3], $input_values[4]))
				  		{
				  			$GLOBALS["error_values_update4"] = "The password fields do not match.";
				  		}
				  		else
				  		{

				  			if($i === 2 && $caught_username_duplicate > 0)
						  	{
						  		$GLOBALS["error_values_update2"] = "This username is already taken.";
						  	} 
						  	else
						  	{
								//include("registerUser.php");
						  		//Register User
					  			$GLOBALS["updateUser" .$i] = "true";

							}
						}
						
	  			}
	  		}
	  	}
	} 
}


function inputValidate($input)
{
	if($input === "" || $input === null || strlen($input) === 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function emailValidate($input)
{
	$email_validate2 = stripos($input, "@");
	$email_validate3 = strripos($input, ".");

	if($email_validate2 < 1 || $email_validate3 < $email_validate2+2 || $email_validate3+2 >= strlen($input) || stripos($input, ""))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function passwordValidate($pass1, $pass2)
{
	if($pass1 === $pass2)
	{
		return false;
	}
	else
	{
		return true;
	}
}







function test_input($input) 
{
	$input = trim($input);
  	$input = stripslashes($input);
  	$input = htmlspecialchars($input);
  	return $input;
}

function password_encrypt($pass)
{
	$hash_format = "$2y$10$";
	$salt = generate_salt();
	$format_and_salt = $hash_format . $salt;
	$hash = crypt($pass, $format_and_salt);
	return $hash;
}

function generate_salt()
{
	$uniq_str = md5(uniqid(mt_rand(), true));
	$base64_str = base64_encode($uniq_str);
	$mod_b64_str = str_replace("+", ".", $base64_str);
	$salt = substr($mod_b64_str, 0, 22);
	return $salt;
}




?>