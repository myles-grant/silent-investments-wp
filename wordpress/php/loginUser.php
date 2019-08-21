<?php

if(edoc !== "8169$#") 
{
    header('HTTP/1.1 404 Not Found');
    echo "<!doctype html>\n<html><head>\n<title>404 Not Found</title>\n</head>";
    echo "<body>\n<h1>Not Found</h1>\n<p>The requested URL ".$_SERVER['REQUEST_URI']." was not found on this server.</p>\n";
    echo "<hr>\n".$_SERVER['SERVER_SIGNATURE']."\n</body></html>\n";
    exit;
}

$_SESSION["userID"] = preg_replace("#[^0-9]#i", "", $userID);
$_SESSION["username"] = $username;
//$_SESSION["password"] = $password;


$expire=time()+60*60*24*30;
if(!isset($_COOKIE["user"]))
{

	if($remember === "yes")
	{
		setcookie("user", $username, $expire);
		setcookie("access", $_POST['password'], $expire);
	}
}
else
{


	if($remember !== "yes")
	{
		setcookie("user", "", time()-3600);
		setcookie("access", "", time()-3600);
	}
	else
	{
		setcookie("user", "", time()-3600);
		setcookie("access", "", time()-3600);
		
		setcookie("user", $username, $expire);
		setcookie("access", $_POST['password'], $expire);
	}
}



?>	