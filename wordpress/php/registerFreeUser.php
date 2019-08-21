<?php

if(edoc !== "8169$#") 
{
    header('HTTP/1.1 404 Not Found');
    echo "<!doctype html>\n<html><head>\n<title>404 Not Found</title>\n</head>";
    echo "<body>\n<h1>Not Found</h1>\n<p>The requested URL ".$_SERVER['REQUEST_URI']." was not found on this server.</p>\n";
    echo "<hr>\n".$_SERVER['SERVER_SIGNATURE']."\n</body></html>\n";
    exit;
}

/*
header("Location: index.php");

$date = date("Y.m.d"); //get server date

$activation_code = str_replace("$2y$10$", "", password_encrypt($email));
$cancel_code = str_replace("$2y$10$", "", password_encrypt($username));

$ip_address = preg_replace("#[^0-9.]#i", "", $_SERVER['REMOTE_ADDR']);
$ip_address = addcslashes($ip_address, '%_');
*/

//$add_member = $connect->prepare("INSERT INTO members (username, firstname, lastname, password, email, sign_up_date, ip_address, activation_code, cancel_account_code) VALUES (:username, :fname, :lname, :pass, :email, :date, :ip_address, :act, :cancel)");

$add_free_member = $connect->prepare("INSERT INTO free_tutorial_members (name, email) VALUES (:name, :email)");
$add_free_member->bindParam(":name", $first_name);
$add_free_member->bindParam(":email", $email);
$add_free_member->execute();


//Send Free Tutorial
$userMsg =
"
Hey " . ucfirst($first_name) .",
<br />
Welcome to Silent Investments!
<br />
I want to thank you for obtaining your membership with Silent Investment community.  Your one step away to have access to our most current updates and open positions.
Live representative will contact you towards the end of the day until then please activate your account to brows around.

Quick Tip:
· Our Portfolio updates are sent on Monday, Tuesday and Friday
· Alerts are randomly sent depending on markets momentum
· Enjoy the Free Tutorial meanwhile we set up your account
<br />
<br />
<hr />
<br />


<br />
<br />
<hr />
<br />
 - Silent Investments
";

$userheaders  = 'MIME-Version: 1.0' . "\r\n";
$userheaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$userheaders .= 'From: Silent Investments <email@email.com>' . "\r\n";

mail($email, "Welcome to Silent Investments - Account Activation", $userMsg, $userheaders);



/*
//Notifaction email sent when user is registered
$notifSubject = $username . " has registered";
$notifMsg = 
"
...


";

$notifheaders  = 'MIME-Version: 1.0' . "\r\n";
$notifheaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$notifheaders .= 'From: Silent Investments <email@email.com>' . "\r\n";

mail("Ceo@silentinvestments.com", $notifSubject, $notifMsg, $notifheaders);
*/











?>