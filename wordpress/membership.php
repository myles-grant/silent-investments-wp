<?php
/*

Template Name: Membership

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
 				 <li class="active">Memberships</li>
			</ol>
		</nav>
	</div>
</div>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- Page Title -->
<div class="page-header col-md-12" id="body_header">
	<header class="container">
		<h1 class="col-md-offset-1">Packages</h1>
	</header>
</div>


<!-- Body Content -->
<section class="container">

	<header id="header_mem">
		<h1><?php echo get_post_meta($post->ID, "section header 1", true); ?></h1>
		<h3><?php echo get_post_meta($post->ID, "section header 2", true); ?></h3>
	</header>
    
    <?php the_content(); ?>
</section>

<?php endwhile; ?>
<?php endif; ?>

<?php $connect = NULL; get_footer(); ?>
