<?php

define("edoc", "8169$#");
include("connect.php");
include("formValidation.php");

if($regFreeLessonUser[0] === "true" && $regFreeLessonUser[1] === "true")
{ 
	include("registerFreeUser.php");
}


$notification = "";
$changePasswordModal = "";

$check_account_state = $connect->prepare("SELECT activated FROM members WHERE id = :id AND username = :user LIMIT 1");
$check_account_state->bindParam(":id", $_SESSION["userID"]);
$check_account_state->bindParam(":user", $_SESSION["username"]);
$check_account_state->execute();
$check_account_state->setFetchMode(PDO::FETCH_ASSOC); 

$row = $check_account_state->fetch();
$check_account_state_result = $row["activated"];

if($check_account_state_result === "temp") {

	$GLOBALS["notification"] = '<span class="badge pull-right" data-toggle="modal" data-target="#excistingUserModal" style="background-color:red; margin-left:3px; cursor:pointer;" title="Update Account"><b>!</b></span>';

} else if ($check_account_state_result === "temp_password") { 

	$GLOBALS["notification"] = '<span class="badge pull-right" data-toggle="modal" data-target="#changePasswordModal" style="background-color:red; margin-left:3px; cursor:pointer;" title="Change Password"><b>!</b></span>';
	$GLOBALS["changePasswordModal"] = '<!-- Popup -->
								<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" onClick="refresh()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								      	<h4>Change Password</h4>
								      </div>
								      <div class="modal-body">
								      	Our records indicate that your account is using a temporary password. For your account security we recommend that you change your password to a more secure password:
								      	<h4>'. $temp_pass_changed .'</h4>
								      	<br />
											<form class="form-horizontal" name="change_pass" role="form" action="'. htmlspecialchars(get_the_permalink()) .'" method="post" onSubmit="return formValidate('. "'change_pass'" .')">
								 				<div class="form-group has-feedback">
								    				<label for="inputNewPass" class="col-sm-3 control-label">New Password:</label>
								   					<div class="col-sm-8">
								   					   <input type="password" class="form-control" id="inputNewPass" placeholder="" name="newPassword" value="" >
													   <span class="form_error_login"><?php echo $error_values_change_pass; ?></span>
								   					</div>
								 				</div>
								 				<div class="form-group">
								  					<div class="col-sm-offset-3 col-sm-9">
								  					    <input type="submit" name="change_pass" class="btn btn-default" value="CHANGE PASSWORD">
								  					</div>
								 				</div>
											</form>
								      </div>
								    </div>
								  </div>
								</div>';
}
?>  