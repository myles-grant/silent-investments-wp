<?php
/*

Template Name: Trading Secret

*/
?>
<?php include("php/phpHeader.php"); get_header(); ?>
<div class="" style="background-color:rgb(238,238,234); height:40px;"></div>


<!-- Page Sub Nav breadcrumbs -->
<div class="container">
	<!-- breadcrumbs -->
	<div id="sub_nav">
		<nav class="col-md-offset-1">
			<ol class="breadcrumb">
 				 <li><a href="<?php bloginfo('url'); ?>">Home</a></li>
 				 <li class="active">Trading Secret</li>
			</ol>
		</nav>
	</div>
</div>



<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


<!-- Banner -->
<section class="jumbotron" id="banner">

	<div class="container">
		<div>
			<h1><?php the_title(); ?></h1>
			<h3><?php echo get_post_meta($post->ID, "page sub title", true); ?></h3>
			<button id="banner_btn">Call to action btn</button>
		</div>
		
	</div>
</section>


<!-- Body Content -->
<section class="container">

	<header id="header_secret">
		<h2><?php echo get_post_meta($post->ID, "section header 1", true); ?></h2>
		<!-- <h3>egestas cursus erat. Vivamus</h3> -->
	</header>

	<div id="icons">
		<!-- TEMP icons style="width:100px; height:100px; background-color:grey;" -->
		<div class="col-md-2">
			<div style="width:100px; height:100px; background-color:grey;"></div>
			<span>Social Media</span>
			<hr />
		</div>
		<div class="col-md-2">
			<div style="width:100px; height:100px; background-color:grey;"></div>
			<span>Indicators</span>
			<hr />
		</div>
		<div class="col-md-2">
			<div style="width:100px; height:100px; background-color:grey;"></div>
			<span>Patterns</span>
			<hr />
		</div>
		<div class="col-md-2">
			<div style="width:100px; height:100px; background-color:grey;"></div>
			<span>Patience</span>
			<hr />
		</div>
	</div>
	
	<?php the_content(); ?>
</section>




<?php endwhile; ?>
<?php endif; ?>

<?php $connect = NULL; get_footer(); ?>

