<?php

if(edoc !== "8169$#") 
{
    header('HTTP/1.1 404 Not Found');
    echo "<!doctype html>\n<html><head>\n<title>404 Not Found</title>\n</head>";
    echo "<body>\n<h1>Not Found</h1>\n<p>The requested URL ".$_SERVER['REQUEST_URI']." was not found on this server.</p>\n";
    echo "<hr>\n".$_SERVER['SERVER_SIGNATURE']."\n</body></html>\n";
    exit;
}

$error_values = array();

$first_name = $last_name = $username = $email = $password1 = $password2 = "";
$first_name_footer = $email_footer = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	if (isset($_POST['footer']))
	{
		$first_name_footer = test_input($_POST["fname"]);
	  	$email_footer = test_input($_POST["email"]);
	}
	else if (isset($_POST['login']))
	{
		$username = test_input($_POST["username"]);
	  	$email = test_input($_POST["email"]);
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

        $error_values = array();
	  	$input_values = array($first_name, $last_name, $username, $email, $password1, $password2);

	  	for($i=0; $i<count($input_values); $i++)
	  	{
	  		if (inputValidate($input_values[$i]))
	  		{
	  			$error_values[$i] = "This field must be filled out";
	  		}
	  		else
	  		{

	  			if(emailValidate($input_values[3]))
	  			{
	  				$error_values[3] = "Not a valid email address";
	  			}
	  			else
	  			{

	  				if(passwordValidate($input_values[4], $input_values[5]))
	  				{
	  					$error_values[5] = "The password fields do not match";
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

echo $first_name;



?>