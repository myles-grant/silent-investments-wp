<?php
/*

Template Name: Footer

*/
?>

<!-- Footer Bio/Contact -->
<footer id="footer">
	<div class="container">
		<div class="col-md-4 col-md-offset-1" id="fl">
			<h2>Trusted by<br>389,378 users.<br>EVER DAY</h2>

			<div style="background-color:white; height:20px;"></div> <!-- TEMP -->
		</div>

		<div class="col-md-5 col-md-offset-1" id="fr">
			<h2>Signup to recieve absolutely<br>free video lessons</h2>
			<?php echo $GLOBALS['free_user_foot']; ?>
			<form class="formm" name="footer_form" action="<?php echo htmlspecialchars(get_the_permalink()); ?>" method="post" onSubmit="return formValidate('footer_form')" role="form">
            	<div class="form-group has-feedback">
					<input class="form-control" type="text" name="fname" placeholder="Name" required>
                    <span class="glyphicon glyphicon-remove form-control-feedback remove_footer"></span>
                    <span class="glyphicon glyphicon-ok form-control-feedback ok_footer"></span>
					<span class="form_error_footer"><?php print_r($error_values_footer[0]); ?></span>
                </div>
                <div class="form-group has-feedback">
					<input class="form-control" type="email" name="email" placeholder="Email" required>
                    <span class="glyphicon glyphicon-remove form-control-feedback remove_footer"></span>
                    <span class="glyphicon glyphicon-ok form-control-feedback ok_footer"></span>
					<span class="form_error_footer"><?php print_r($error_values_footer[1]); echo $GLOBALS['dup_free_user_foot']; ?></span>
                </div>
                <div class="form-group">
					<input id="lesson_sub" type="submit" name="footer" value="Get a Free Lesson Today" />
                </div>
			</form>
		</div>
	</div>

	<div class="container">
    	<div class="col-md-offset-1" id="bio">
			<div class="pull-left" style="background-color: #000; width: 100px; height: 150px; margin-right: 20px;"></div><!-- TEMP -->

			<div>
				<h1>About Bob Dales</h1>
				<p>hi my name is bob. hi my name is bob. hi my name is bob. hi my name is bob. hi my name is bob. hi my name is bob. h  hi my name is bob. hi my name is bob. h hi my name is bob. hi my name is bob. hi my name is bob. hi my name is bob. ob. </p>
 
				Contact Me 
			</div>
		</div>
	</div>
	<div id="copyright">
		<p>Learn how to invest and how to buy stocks with 2014 Silent Investments All rights Resered Privacy Policy</p>
	</div>
</footer>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/formValidation.js"></script>


<?php 
include("php/connect.php");

if(isset($_SESSION["userID"])) {

	include("php/excistingUserScript.php");

		if($GLOBALS["changeUserPass"] === "true") {

		include("php/changePassword.php");
	}
}



if (isset($_POST['forgot_pass']))
{

	echo '

				<script type="text/javascript">//<![CDATA[ 
				$(window).load(function(){
				$(function() {
				    $("#forgetPasswordModal").modal("show");
				});
				});//]]>  
				</script>

	';
}
else if (isset($_POST['change_pass'])) {

		echo '

				<script type="text/javascript">//<![CDATA[ 
				$(window).load(function(){
				$(function() {
				    $("#changePasswordModal").modal("show");
				});
				});//]]>  
				</script>
				';

}
else if (isset($_POST['signup'])) {

		echo '

				<script type="text/javascript">//<![CDATA[ 
				$(window).load(function(){
				$(function() {
				    $("#newUserModal").modal("show");
				});
				});//]]>  
				</script>
				';

}
$connect = NULL;
?>

<script type="text/javascript">
	function refresh()
				{
					window.location.reload();
				}
</script>

<?php wp_footer();?>
</body>
</html>