<?php
if(edoc !== "8169$#") 
{
    header('HTTP/1.1 404 Not Found');
    echo "<!doctype html>\n<html><head>\n<title>404 Not Found</title>\n</head>";
    echo "<body>\n<h1>Not Found</h1>\n<p>The requested URL ".$_SERVER['REQUEST_URI']." was not found on this server.</p>\n";
    echo "<hr>\n".$_SERVER['SERVER_SIGNATURE']."\n</body></html>\n";
    exit;
}

	

	$username_update = test_input($_SESSION["username"]);

	//Get account state
	$account_state = $connect->prepare("SELECT activated FROM members WHERE username = :username LIMIT 1");
	$account_state->bindParam(":username", $username_update);
	$account_state->execute();

	$account_state->setFetchMode(PDO::FETCH_ASSOC); 
	$row = $account_state->fetch();
	$account_state_result = $row["activated"];


	if($account_state_result === "temp")
	{
	
		//if user has temp login
		if (
			$GLOBALS["updateUser0"] === "true" &&
			$GLOBALS["updateUser1"] === "true" &&
			$GLOBALS["updateUser2"] === "true" &&
			$GLOBALS["updateUser3"] === "true" &&
			$GLOBALS["updateUser4"] === "true" 
		 	)
		{
			$ip = preg_replace("#[^0-9.]#i", "", $_SERVER['REMOTE_ADDR']);
			$ip = addcslashes($ip, '%_');
			$cancel_code = str_replace("$2y$10$", "", password_encrypt($username));

			//Update user activation state
			//
			$update_account = $connect->prepare("UPDATE members SET firstname = :fname, lastname = :lname, username = :username, password = :pass, sign_up_date = :date, ip_address = :ip, cancel_account_code = :cancel, activated = '1' WHERE username = :username_update");
			$update_account->bindParam(":username_update", $username_update);
			$update_account->bindParam(":username", $GLOBALS["username_update"]);
			$update_account->bindParam(":fname", $GLOBALS["first_name_update"]);
			$update_account->bindParam(":lname", $GLOBALS["last_name_update"]);
			$update_account->bindParam(":pass", $GLOBALS["password_update"]);
			$update_account->bindParam(":date", date("Y.m.d"));
			$update_account->bindParam(":ip", $ip);
			$update_account->bindParam(":cancel", $cancel_code);
			$update_account->execute();

			$_SESSION["username"] = $GLOBALS["username_update"];

			//header("Refresh: 0");

			echo '
				<div id="excistingUserModal" class="modal fade">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="refresh()">&times;</button>
				                <h4 class="modal-title">Updated</h4>
				            </div>
				            <div class="modal-body" style="display:table;">
				               Your account is now updated.
				            </div>
				        </div>
				    </div> 
				</div>

				<script type="text/javascript">//<![CDATA[ 
				$(window).load(function(){
				$(function() {
				    $("#excistingUserModal").modal("show");
				});
				});//]]>  
				</script>
			';
		}
		else
		{
			echo '
				<div id="excistingUserModal" class="modal fade">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                <h4 class="modal-title">Update Account</h4>
				            </div>
				            <div class="modal-body" style="display:table;">
				                Our records indicate that your account is missing required fields. Please fill out the form below to update your account:
				                <br />
				                <hr />
				                <form class="form-horizontal" name="update" role="form" action="'. htmlspecialchars(get_the_permalink()) .'" method="post" onSubmit="return formValidate('. "'update'" .')">
					 				<div class="form-group has-feedback">
					    				<label for="inputFirstName" class="col-sm-3 control-label">First Name:</label>
					   					<div class="col-sm-8">
					   					   <input type="text" class="form-control" id="inputFirstName" name="fname" placeholder="" value="'. $GLOBALS["first_name_update"] .'" required>
										   <span class="form_error_signup">'. $GLOBALS["error_values_update0"] .'</span>
					   					</div>
					 				</div>
					 				<div class="form-group has-feedback">
					 					<label for="inputLastName" class="col-sm-3 control-label">Last Name:</label>
					  					<div class="col-sm-8">
					   						<input type="text" class="form-control" id="inputLastName" name="lname" placeholder="" value="'. $GLOBALS["last_name_update"] .'" required>
											<span class="form_error_signup">'. $GLOBALS["error_values_update1"] .'</span>
					  					</div>
									</div>
					 				<div class="form-group has-feedback">
					 					<label for="inputUsername" class="col-sm-3 control-label">New Username:</label>
					  					<div class="col-sm-8">
					   						<input type="text" class="form-control" id="inputUsername" name="username" placeholder="" value="'. $GLOBALS["username_update"] .'" required>
											<span class="form_error_signup">'. $GLOBALS["error_values_update2"] .'</span>
					  					</div>
									</div>
					 				<div class="form-group has-feedback">
					    				<label for="inputPassword" class="col-sm-3 control-label">New Password:</label>
					   					<div class="col-sm-8">
					   					   <input type="password" class="form-control" id="inputPassword" name="pass1" placeholder="at least 6 characters" required>
										   <span class="form_error_signup">'. $GLOBALS["error_values_update3"] .'</span>
					   					</div>
					 				</div>
					 				<div class="form-group has-feedback">
					 					<label for="inputConfirmPassword" class="col-sm-3 control-label">Confirm Password:</label>
					  					<div class="col-sm-8">
					   						<input type="password" class="form-control" id="inputConfirmPassword" name="pass2" placeholder="" required>
											<span class="form_error_signup">'. $GLOBALS["error_values_update4"] .'</span>
					  					</div>
									</div>
					 				<div class="form-group">
					  					<div class="col-sm-offset-3 col-sm-9">
					  					    <input type="submit" name="update" class="btn btn-default" value="UPDATE ACCOUNT" >
					  					</div>
					 				</div>
								</form>

				            </div>
				        </div>
				    </div> 
				</div>

				<script type="text/javascript">//<![CDATA[ 
				$(window).load(function(){
				$(function() {
				    $("#excistingUserModal").modal("show");
				});
				});//]]>  
				</script>
			';
		}
	}


?>