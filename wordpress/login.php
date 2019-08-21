<?php
/*

Template Name: Login

*/
?>
<?php include("php/phpHeader.php"); ?>
<?php

if($forgot_pass === "true")
{
  include("php/forgotPassword.php");
}

if($loginUser[0] === "true" && $loginUser[1] === "true")
{
  include("php/loginUser.php");
}

if(isset($_SESSION["userID"]))
{
  header("Location: index.php");
  exit();
}

get_header();
?>

<div style="background-color:rgb(238,238,234); height:40px;"></div>
<span><?php echo $userMsg ?></span>

<div class="container">
	<!-- Sub Nav -->
	<div id="sub_nav">
		<nav class="col-md-offset-1">
			<ol class="breadcrumb">
 				 <li><a href="<?php bloginfo('url'); ?>">Home</a></li>
 				 <li class="active">Login</li>
			</ol>
		</nav>
	</div>
</div>
<hr style="margin:0;" />





<!-- Login form -->
<section class="container">
	
	<div class="panel panel-default" id="form_panel">
  		<div class="panel-heading">
    		<h2 class="panel-title" style="padding-bottom: 20px;">Login to your account</h2>
  		</div>
        <div style="height:35px;"></div>
  		<div class="panel-body">           
        <form class="form-horizontal col-sm-8 col-sm-offset-2 ha" name="login" role="form" action="<?php echo htmlspecialchars(get_the_permalink()); ?>" method="post" onSubmit="return formValidate('login')">
          <div class="form-group has-feedback">
              <label for="inputUsername" class="col-sm-3 control-label">Username:</label>
              <div class="col-sm-9">
                 <input type="text" class="form-control" id="inputUsername" placeholder="" name="username" value="<?php echo $username; ?>" required>
                 <span class="glyphicon glyphicon-remove form-control-feedback remove_login"></span>
                         <span class="glyphicon glyphicon-ok form-control-feedback ok_login"></span>
               <span class="form_error_login"><?php print_r($error_values_login[0]); ?></span>
              </div>
          </div>
          <div class="form-group has-feedback">
            <label for="inputLastName" class="col-sm-3 control-label">Password:</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" name="password" id="inputPassword" placeholder="" value="<?php echo $cookie_pass; ?>" required>
                <span class="glyphicon glyphicon-remove form-control-feedback remove_login"></span>
                          <span class="glyphicon glyphicon-ok form-control-feedback ok_login"></span>
                <span class="form_error_login"><?php print_r($error_values_login[1]); ?></span>
              </div>
          </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-9">
                          <div class="checkbox">
                              <label>
                                    <input type="checkbox" name="remember" value="yes" checked="checked"> Remember me | <a href=""  data-toggle="modal" data-target="#forgetPasswordModal">Forgot your Password?</a>
                              </label>
                        </div>
              </div>
          </div>
          <div class="form-group">
              <div class="col-sm-offset-3 col-sm-9">
                  <input type="submit" name="login" class="btn btn-default" value="Login">
              </div>
          </div>
        </form>
      </div>
        <div style="height:35px;"></div>
	</div>
</section>
  

<!-- Popup -->
<div class="modal fade" id="forgetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4>Forgot Password?</h4>
      </div>
      <div class="modal-body">
        <h4><?php echo $temp_pass_sent; ?></h4>
        <br />
      <form class="form-horizontal" name="forgot_pass" role="form" action="<?php echo htmlspecialchars(get_the_permalink()); ?>" method="post" onSubmit="return formValidate('forgot_pass')">
        <div class="form-group has-feedback">
            <label for="inputEmail" class="col-sm-3 control-label">Eamil:</label>
            <div class="col-sm-8">
               <input type="email" class="form-control" id="inputEmail" placeholder="" name="email" value="<?php echo $email; ?>" required>
             <span class="form_error_login"><?php echo $error_values_forgot; ?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <input type="submit" name="forgot_pass" class="btn btn-default" value="SEND">
            </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

<?php $connect = NULL; get_footer(); ?>
