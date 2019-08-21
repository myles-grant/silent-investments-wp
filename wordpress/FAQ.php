
<?php
/*

Template Name: FAQ

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
 				 <li><a href="index.php">Home</a></li>
 				 <li class="active">FAQ</li>
			</ol>
		</nav>
	</div>
</div>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


<!-- Page Title -->
<div class="page-header col-md-12" id="body_header">
	<div class="container">
		<h1 class="col-md-offset-1"><?php the_title(); ?></h1>
	</div>
</div>



<!-- Body Content -->
<div class="container">

	<!-- FAQ Content -->
	<article class="col-md-7 col-md-offset-1" id="faq_content">
        <?php the_content(); ?>
    </article>


	<?php get_sidebar(); ?>
</div>


<?php endwhile; ?>
<?php endif; ?>


<?php $connect = NULL; get_footer(); ?>