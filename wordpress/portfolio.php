<?php
/*

Template Name: Portfolio

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
 				 <li class="active">Our Portfolio</li>
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
		</div>
	</div>
</section>



<!-- Body Content -->
<article class="container">

	<?php the_content(); ?>
	
</article>


<!-- Popup -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="border-bottom:none;">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</div>
			<div class="modal-body">
			...
			</div>
		</div>
	</div>
</div>

<?php endwhile; ?>
<?php endif; ?>

<?php $connect = NULL; get_footer(); ?>
