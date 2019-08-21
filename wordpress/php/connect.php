<?php

if(edoc !== "8169$#") 
{
    header('HTTP/1.1 404 Not Found');
    echo "<!doctype html>\n<html><head>\n<title>404 Not Found</title>\n</head>";
    echo "<body>\n<h1>Not Found</h1>\n<p>The requested URL ".$_SERVER['REQUEST_URI']." was not found on this server.</p>\n";
    echo "<hr>\n".$_SERVER['SERVER_SIGNATURE']."\n</body></html>\n";
    exit;
}
session_start();

$root = explode("/", $_SERVER['DOCUMENT_ROOT']);
array_pop($root);

$file_count = 0;
$credentials = array();

//$file = fopen(implode("/", $root) . "/credentials.config", "r") or die("Unable to open file");
$file = fopen("http://localhost/wordpress/wp-content/themes/silent-investments(wordpress)/credentials.cfg", "r") or die("Unable to open file");



while(!feof($file)) 
{
	$credentials[$file_count] = trim(fgets($file));
	$file_count++;
}
fclose($file);


$connect = new Pdo("mysql:host=$credentials[2]; dbname=$credentials[3]; charset=$credentials[4]", $credentials[0], $credentials[1]);
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



?>