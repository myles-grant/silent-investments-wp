
<?php include("php/phpHeader.php"); get_header(); ?>
<div class="" style="background-color:rgb(238,238,234); height:40px;"></div>

<!-- Page Sub Nav breadcrumbs -->
<div class="container">
	<!-- breadcrumbs -->
	<div id="sub_nav">
		<nav class="col-md-offset-1">
			<ol class="breadcrumb">
 				 <li><a href="index.php">Home</a></li>
 				 <li class="active">Sign Up</li>
			</ol>
		</nav>
	</div>
</div>
<hr style="margin:0;" />


<div class="container">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<h1><?php the_title(); ?></h1>

<p><?php the_content(); ?></p>
<hr> <?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?></p>

</div>


<?php $connect = NULL; get_footer(); ?>

