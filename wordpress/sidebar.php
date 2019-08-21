<?php
/*

Template Name: Sidebar

*/
?>
	<!-- SideBar Widegts -->
	<aside class="col-md-3 pull-right">
    	<div class="panel panel-default sidebar_widget_border0" id="sidebar_widget1">
  			<div class="panel-heading">
    			<h3 class="panel-title">Free Video Lesson</h3>
  			</div>
 			<div class="panel-body">
            	<p>Sign Up to recieve absolutely</p>
            	<?php echo $GLOBALS['free_user_side']; ?>
            	<form class="formm" name="sidebar_form" action="<?php echo htmlspecialchars(get_the_permalink()); ?>" method="post" onSubmit="return formValidate('sidebar_form')" role="form">
	            	<div class="form-group has-feedback">
						<input class="form-control" type="text" name="fname" placeholder="Name" required>
	                    <span class="glyphicon glyphicon-remove form-control-feedback remove_sidebar"></span>
	                    <span class="glyphicon glyphicon-ok form-control-feedback ok_sidebar"></span>
						<span class="form_error_sidebar"><?php print_r($error_values_sidebar[0]); ?></span>
	                </div>
	                <div class="form-group has-feedback">
						<input class="form-control" type="email" name="email" placeholder="Email" required>
	                    <span class="glyphicon glyphicon-remove form-control-feedback remove_sidebar"></span>
	                    <span class="glyphicon glyphicon-ok form-control-feedback ok_sidebar"></span>
						<span class="form_error_sidebar"><?php print_r($error_values_sidebar[1]); echo $GLOBALS['dup_free_user_side']; ?></span>
	                </div>
	                <div class="form-group">
						<input id="lesson_sub" type="submit" name="sidebar" value="Get a Free Lesson Today" />
	                </div>
				</form>
  			</div>
		</div>
		<div class="panel panel-default sidebar_widget2" id="sidebar_widget1">
  			<div class="panel-heading">
    			<h3 class="panel-title">Statistics</h3>
  			</div>
 			<div class="panel-body">
				<ul>
					<li>
						<span>917 Regular Member</span><br />
						<span>378 Premium Member</span>
					</li>
					<li>
						<span>1000+ Consultations</span><br />
						<span>Last Month</span>
					</li>
					<li>
						<span>8.5 Hours</span><br />
						<span>Average time to answer</span>
					</li>
					<li>
						<span>98.3$ satisfied users</span>
					</li>
				</ul>
  			</div>
		</div>

		<?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('SideBar Widegts')) : else : ?>

		<?php endif; ?>
	</aside>