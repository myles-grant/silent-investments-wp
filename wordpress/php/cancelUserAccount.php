<?php

define("edoc", "8169$#");
include("connect.php");





//if loggin in give access
if(isset($_SESSION["userID"]))
{

	if(isset($_GET["email"]) && isset($_GET["cancel"]))
	{
		$email = test_input($_GET["email"]);
		$cancel_code = test_input($_GET["cancel"]);


		$id = preg_replace("#[^0-9]#i", "", $_SESSION["userID"]);


		$accountInfo = $connect->prepare("SELECT * FROM members WHERE id = :id AND email = :email AND cancel_account_code = :cancel LIMIT 1");
		$accountInfo->bindParam(":id", $id);
		$accountInfo->bindParam(":email", $email);
		$accountInfo->bindParam(":cancel", $cancel_code);
		$accountInfo->execute();

		$accountInfo_result = $accountInfo->rowCount();

		//$accountInfo->setFetchMode(PDO::FETCH_ASSOC); 
		//$row = $accountInfo->fetch();
		//$activation_state = $row["activated"];

	

		if($accountInfo_result === 0) //acurate error message
		{
			echo "This account has already been deactivated";
		}
		else
		{
			//deactivate user
			$cancel_account = $connect->prepare("DELETE FROM members WHERE id = :id AND email = :email AND cancel_account_code = :cancel LIMIT 1");
			$cancel_account->bindParam(":id", $id);
			$cancel_account->bindParam(":email", $email);
			$cancel_account->bindParam(":cancel", $cancel_code);
			$cancel_account->execute();

			//send canceled account notification
			//Notifaction email sent when user cancels account
			$notifSubject = $username . " has canceled";
			$notifMsg = 
			"
			...


			";

			$notifheaders  = 'MIME-Version: 1.0' . "\r\n";
			$notifheaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$notifheaders .= 'From: Silent Investments <email@email.com>' . "\r\n";

			//mail("Ceo@silentinvestments.com", $notifSubject, $notifMsg, $notifheaders);
			
		}
	}
	else
	{

		//params aren't set!
		//send deactivation email
		if(isset($_SERVER['HTTP_REFERER']))
		{
		
			$id = test_input($_SESSION["userID"]);
			$username = test_input($_SESSION["username"]);
			
			$accountInfo = $connect->prepare("SELECT * FROM members WHERE id = :id AND username = :username LIMIT 1");
			$accountInfo->bindParam(":id", $id);
			$accountInfo->bindParam(":email", $username);
			$accountInfo->execute();

			$accountInfo_result = $accountInfo->rowCount();

			$accountInfo->setFetchMode(PDO::FETCH_ASSOC); 
			$row = $accountInfo->fetch();
			$first_name = $row["firstname"];
			$last_name = $row["lastname"];
			$email  = $row["email"];
			$cancel = $row["cancel_account_code"];

			$userMsg =
				"
				Hello " . ucfirst($first_name) ." ". ucfirst($last_name) . ",
				<br />
				I want to thank you for your dedicated service and time unfortunately we have received an update that you wish to cancel your membership.  Silent Investment not only strives for consistent success but out of all communities we want to ensure that our members have a clear and direct investment vision.  If by any means we were not able to meet your needs, feel free to contact us at Info@silentinvestments.com with subject “Vision” and our special representatives will answer your questions directly and if you do chose to give it another try we will provide you with a special offer free of charge.
				
				Thank you
				<br />
				<br />
				<hr />
				<br />

				To cancel your account click the link below:
				<br />
				<a href='localhost/silent-investments/emailActivation.php?activate=" . $cancel . "&email=" . $email ."'>Click here to cancel your membership</a>
				<br />

				<br />
				If the above link does not work, type or copy and paste the link below into the url address of your browser:
				<br />
				/confirm_activation_link.php?activate=" . $cancel . "&email=" . $email ."

				<br />
				<br />
				<hr />
				<br />
				 - Silent Investments
				";

				$userheaders  = 'MIME-Version: 1.0' . "\r\n";
				$userheaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$userheaders .= 'From: Silent Investments <email@email.com>' . "\r\n";

				mail($email, "Welcome to Silent Investments - Cancel Membership", $userMsg, $userheaders);
		}
		else
		{
			header("Location: ../index.php");
			exit();
		}
	}
}
else
{
	//user is not logged in
	echo "You must be logged in to cancel your membership. <a href='<?php get_the_permalink();?>?page_id=108'>Login</a>";
	
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