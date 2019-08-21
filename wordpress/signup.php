<?php
/*

Template Name: Signup

*/

include("php/phpHeader.php");


if(
	$regUser[0] === "true" &&
	$regUser[1] === "true" &&
	$regUser[2] === "true" &&
	$regUser[3] === "true" &&
	$regUser[4] === "true" &&
	$regUser[5] === "true" 
  )
{
	include("php/registerUser.php");

  echo '
        <div id="newUserModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                        <h4 class="modal-title">Welcome to Silent Investments</h4>
                    </div>
                    <div class="modal-body" style="display:table;">
                       Hello '. ucfirst($first_name) .' '. ucfirst($last_name)  .', Your one step away to access your account:<br>- Please check your email or junk mail to activate your account
                    </div>
                </div>
            </div> 
        </div>
  ';
}


if(isset($_SESSION["userID"]))
{
	header("Location: index.php");
	exit();
}

get_header();
?>


<div class="container">
	<!-- Sub Nav -->
	<div id="sub_nav">
		<nav class="col-md-offset-1">
			<ol class="breadcrumb">
 				 <li><a href="<?php bloginfo('url'); ?>">Home</a></li>
 				 <li class="active">Sign Up</li>
			</ol>
		</nav>
	</div>
</div>
<hr style="margin:0;" />






<!-- Signing up form -->
<section class="container">
	
	<div class="panel panel-default" id="form_panel">
  		<div class="panel-heading">
    		<h2 class="panel-title">Create a New Account</h2>
            <h4>Come join the Silent Investments! Let's set up your account. Already have one? <a href="login.html">Sign in here.</a></h4>
  		</div>
        <div style="height:35px;"></div>
  		<div class="panel-body">
  			<!--
        	<span class="col-sm-3">Why be old fashioned?<br>Sign up with:</span>
            <div class="col-sm-1" style="height:393px; width:3px; background-color:rgb(224,224,224); padding:0;"></div>
                -->

			<form class="form-horizontal col-sm-8 col-sm-offset-2 formm" name="signup" role="form" action="<?php echo htmlspecialchars(get_the_permalink()); ?>" method="post" onSubmit="return formValidate('signup')">
 				<div class="form-group has-feedback">
    				<label for="inputFirstName" class="col-sm-3 control-label">First Name:</label>
   					<div class="col-sm-9">
   					   <input type="text" class="form-control" id="inputFirstName" name="fname" placeholder="" value="<?php echo $first_name; ?>" required>
                       <span class="glyphicon glyphicon-remove form-control-feedback remove_signup"></span>
                       <span class="glyphicon glyphicon-ok form-control-feedback ok_signup"></span>
					   <span class="form_error_signup"><?php print_r($error_values[0]); ?></span>
   					</div>
 				</div>
 				<div class="form-group has-feedback">
 					<label for="inputLastName" class="col-sm-3 control-label">Last Name:</label>
  					<div class="col-sm-9">
   						<input type="text" class="form-control" id="inputLastName" name="lname" placeholder="" value="<?php echo $last_name; ?>" required>
                        <span class="glyphicon glyphicon-remove form-control-feedback remove_signup"></span>
                        <span class="glyphicon glyphicon-ok form-control-feedback ok_signup"></span>
						<span class="form_error_signup"><?php print_r($error_values[1]); ?></span>
  					</div>
				</div>
 				<div class="form-group has-feedback">
 					<label for="inputUsername" class="col-sm-3 control-label">Choose a Username:</label>
  					<div class="col-sm-9">
   						<input type="text" class="form-control" id="inputUsername" name="username" placeholder="" value="<?php echo $username; ?>" required>
                        <span class="glyphicon glyphicon-remove form-control-feedback remove_signup"></span>
                        <span class="glyphicon glyphicon-ok form-control-feedback ok_signup"></span>
						<span class="form_error_signup"><?php print_r($error_values[2]); ?></span>
  					</div>
				</div>
 				<div class="form-group has-feedback">
 					<label for="inputEmail" class="col-sm-3 control-label">Your Email Address:</label>
  					<div class="col-sm-9">
   						<input type="email" class="form-control" id="inputEmail" name="email" placeholder="" value="<?php echo $email; ?>" required>
                        <span class="glyphicon glyphicon-remove form-control-feedback remove_signup"></span>
                        <span class="glyphicon glyphicon-ok form-control-feedback ok_signup"></span>
						<span class="form_error_signup"><?php print_r($error_values[3]); ?></span>
  					</div>
				</div>
 				<div class="form-group has-feedback">
    				<label for="inputPassword" class="col-sm-3 control-label">Choose a Password:</label>
   					<div class="col-sm-9">
   					   <input type="password" class="form-control" id="inputPassword" name="pass1" placeholder="at least 6 characters" required>
                       <span class="glyphicon glyphicon-remove form-control-feedback remove_signup"></span>
                       <span class="glyphicon glyphicon-ok form-control-feedback ok_signup"></span>
					   <span class="form_error_signup"><?php print_r($error_values[4]); ?></span>
   					</div>
 				</div>
 				<div class="form-group has-feedback">
 					<label for="inputConfirmPassword" class="col-sm-3 control-label">Repeat the Password:</label>
  					<div class="col-sm-9">
   						<input type="password" class="form-control" id="inputConfirmPassword" name="pass2" placeholder="" required>
                        <span class="glyphicon glyphicon-remove form-control-feedback remove_signup"></span>
                        <span class="glyphicon glyphicon-ok form-control-feedback ok_signup"></span>
						<span class="form_error_signup"><?php print_r($error_values[5]); ?></span>
  					</div>
				</div>
  				<div class="form-group">
   					<div class="col-sm-offset-3 col-sm-9">
    					<p>By submitting this form you agree to Silent Investments <a href="#">Terms and Conditions</a></p>
    				</div>
 				</div>
 				<div class="form-group">
  					<div class="col-sm-offset-3 col-sm-9">
  					    <input type="submit" name="signup" class="btn btn-default" value="REGISTER NOW" >
  					</div>
 				</div>
			</form>
  		</div>
        <div style="height:35px;"></div>
	</div>
</section> 




<?php $connect = NULL; get_footer(); ?>
