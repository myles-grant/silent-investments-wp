<?php

define("edoc", "8169$#");

include("connect.php");


$membersTable = "CREATE table members(
			     id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
			     username VARCHAR(255),
			     firstname VARCHAR(255),
			     lastname VARCHAR(255),
			     email VARCHAR(255),
			     password VARCHAR(255),
			     temp_password VARCHAR(255),
			     sign_up_date DATE,
			     ip_address VARCHAR(255),
			     membership_type ENUM('regular', 'premium', 'student') NOT NULL,
			     /*account ENUM('unactive', 'active', 'deactivated') NOT NULL,*/
			     activated ENUM('0', '1', 'temp', 'temp_password') NOT NULL,
			     activation_code VARCHAR(255),
			     cancel_account_code VARCHAR(255)
			     )" ;


$connect->exec($membersTable);
$connect = NULL;
?>