<?php
if(edoc !== "8169$#") 
{
    header('HTTP/1.1 404 Not Found');
    echo "<!doctype html>\n<html><head>\n<title>404 Not Found</title>\n</head>";
    echo "<body>\n<h1>Not Found</h1>\n<p>The requested URL ".$_SERVER['REQUEST_URI']." was not found on this server.</p>\n";
    echo "<hr>\n".$_SERVER['SERVER_SIGNATURE']."\n</body></html>\n";
    exit;
}


$username = test_input($_SESSION["username"]);

//update new password
$update_new_pass = $connect->prepare("UPDATE members SET password = :newPass, activated = '1' WHERE username = :username");
$update_new_pass->bindParam(":username", $username);
$update_new_pass->bindParam(":newPass", $GLOBALS["newPassword"]);
$update_new_pass->execute();



?>