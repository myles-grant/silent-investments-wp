<?php
if(edoc !== "8169$#") 
{
    header('HTTP/1.1 404 Not Found');
    echo "<!doctype html>\n<html><head>\n<title>404 Not Found</title>\n</head>";
    echo "<body>\n<h1>Not Found</h1>\n<p>The requested URL ".$_SERVER['REQUEST_URI']." was not found on this server.</p>\n";
    echo "<hr>\n".$_SERVER['SERVER_SIGNATURE']."\n</body></html>\n";
    exit;
}

  //generate temporary password
 $seed = str_split('!@#$%&abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789');
$rand = '';
foreach (array_rand($seed, 10) as $k) $rand .= $seed[$k];

$rand = $username . $rand;

  //encrypt temporary password
  $gen_temp_pass = str_replace("$2y$10$", "", password_encrypt($rand));


  //input temp password
  $insert_temp_pass = $connect->prepare("UPDATE members SET temp_password = :temp_pass WHERE email = :email");
  $insert_temp_pass->bindParam(":email", $email);
  $insert_temp_pass->bindParam(":temp_pass", $gen_temp_pass);
  $insert_temp_pass->execute();


  //send email with temporary password
  $userMsg =
    "
    Hello,
    <br />
    If you did not request to change your password please disregard this email.
    <br />
    Your temporary password: ". $rand ."
    <hr />
    <br />

    To activate your temporary password please click on the link below:
    <br />
    <a href='http://localhost/wordpress/wp-content/themes/silent-investments(wordpress)/php/forgotPasswordConfirmation.php?email=". $email ."&settp=". $gen_temp_pass ."'>Activate Temporary Password</a>
    <br />
    <br />

    If the above link does not work, type or copy and paste the link below into the url address of your browser:
    <br />
    ". bloginfo("template_url") ."php/forgotPasswordConfirmation.php?email=". $email ."&settp=". $gen_temp_pass ."
    <br />
    <br />
    <hr />
    <br />
     - Silent Investments
  ";

  $userheaders  = 'MIME-Version: 1.0' . "\r\n";
  $userheaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $userheaders .= 'From: Silent Investments <email@email.com>' . "\r\n";

  mail($email, "Silent Investments - Temporary Password", $userMsg, $userheaders);




?>